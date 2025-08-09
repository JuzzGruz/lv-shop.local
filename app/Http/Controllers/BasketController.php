<?php

namespace App\Http\Controllers;

use App\Actions\Controllers\Basket\AddAction;
use App\Actions\Controllers\Basket\ChangeAction;
use App\Actions\Controllers\Basket\SaveOrderAction;
use App\Http\Requests\Basket\BasketRequest;
use App\Models\Basket;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class BasketController extends Controller
{
    
    private $basket;

    public function __construct()
    {
        $this->basket = Basket::get_basket();
    }
    
    /**
     * Страница корзины
     */
    public function index() : View
    {
        $basket = $this->basket;
        return view('basket.index', compact('basket'));
    }

    /**
     * Страница заказа
     */
    public function checkout(Request $request) : View
    {
        $profile = null;
        $profiles = null;
        if (auth()->check()) {
            
            $user = auth()->user();
            $profiles = $user->order_profile;
            $prof_id = (int)$request->input('profile_id');
            if ($prof_id) {
                $profile = $user->order_profile()->whereIdAndUserId($prof_id, $user->id)->first();
            }
        }
        return view('basket.checkout', compact('profiles', 'profile', 'user'));
    }

    /**
     * Добавления продукта в корзину
     */
    public function add(Request $request, $id, AddAction $action)
    {
        $quantity = $request->input('quantity') ?? 1;
        $int = $action($this->basket, $id, $quantity);
        if ( ! $request->ajax()) {
            return back();
        }
        // в случае ajax-запроса возвращаем html-код корзины в правом
        // верхнем углу, чтобы заменить исходный html-код
        $positions = $this->basket->products_count + $int;
        return view('basket.part.basket', compact('positions'));
    }

    /**
     * Увеличивает кол-во товара $id в корзине на единицу
     */
    public function plus($id, ChangeAction $action) : RedirectResponse
    {
        $action($this->basket, $id, 1);
        // выполняем редирект обратно на страницу корзины
        return redirect()->route('basket.index');
    }

    /**
     * Уменьшает кол-во товара $id в корзине на единицу
     */
    public function minus($id, ChangeAction $action) : RedirectResponse
    {
        $action($this->basket, $id, -1);
        // выполняем редирект обратно на страницу корзины
        return redirect()->route('basket.index');
    }

    /**
     * Удаляет продукт из корзины
     */
    public function remove($id) : RedirectResponse
    {
        $this->basket->products()->detach($id);
        // выполняем редирект обратно на страницу корзины
        return redirect()->route('basket.index');
    }

    /**
     * Полностью очищает содержимое корзины покупателя
     */
    public function clear() : RedirectResponse
    {
        $this->basket->delete();
        Cookie::expire('basket_id');
        return redirect()->route('basket.index');
    }

    /**
     * Сохранение заказа в БД
     */
    public function save_order(BasketRequest $request, SaveOrderAction $action) : RedirectResponse
    {
        //проверка на наличие данного количества товара
        $errors = $this->basket->check_products($this->basket->products);
        if (!empty($errors)) {
            return redirect()
                ->route('basket.index')
                ->withErrors("Таких товаров сейчас нет в наличии:" . implode(', ', $errors));
        }
        
        $request->validated();
        $order = $action($this->basket, $request);

        return redirect()
            ->route('basket.success')
            ->with('order_id', $order->id);
    }

    /**
     * Сообщение об успешном оформлении заказа
     */
    public function success(Request $request)
    {
        if ($request->session()->exists('order_id')) {
            // сюда покупатель попадает сразу после успешного оформления заказа
            $order_id = $request->session()->pull('order_id');
            $order = Order::findOrFail($order_id);
            return view('basket.success', compact('order'));
        } else {
            // если покупатель попал сюда случайно
            return redirect()->route('basket.index');
        }
    }
}
