<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\OrderProfileStoreRequest;
use App\Http\Requests\User\OrderProfileUpdateRequest;
use App\Models\OrderProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $profiles = auth()->user()->order_profile()->paginate(4);
        return view('user.orderProfile.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('user.orderProfile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderProfileStoreRequest $request) : RedirectResponse
    {
        $data = $request->validated();
        $profile = OrderProfile::create($data);
        return redirect()
            ->route('user.orderProfile.show', $profile->id)
            ->with('success', 'Новый профиль успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderProfile $orderProfile) : View
    {
        if ($orderProfile->user_id !== auth()->user()->id) {
            abort(404);
        }
        return view('user.orderProfile.show', ['profile' => $orderProfile]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderProfile $orderProfile) : View
    {
        if ($orderProfile->user_id !== auth()->user()->id) {
            abort(404);
        }
        return view('user.orderProfile.edit', ['profile' => $orderProfile]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderProfileUpdateRequest $request, OrderProfile $orderProfile) : RedirectResponse
    {
        $data = $request->validated();
        $orderProfile->update($data);

        return redirect()
            ->route('user.orderProfile.show', $orderProfile->id)
            ->with('success', "Изменения в профиль $orderProfile->title внесены успешно");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderProfile $orderProfile)
    {
        if ($orderProfile->user_id !== auth()->user()->id) {
            abort(404);
        }
        $title = $orderProfile->title;
        $orderProfile->delete();
        return redirect()
            ->route('user.orderProfile.index')
            ->with('success', "Профиль $title был успешно удален");
    }
}
