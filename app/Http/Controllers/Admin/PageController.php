<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Page\PageStoreRequest;
use App\Http\Requests\Admin\Page\PageUpdateRequest;
use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $pages = Page::all();
        return view('admin.page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Page::where('parent_id', 0)->get();
        return view('admin.page.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageStoreRequest $request)
    {
        $parent = Page::where('parent_id', 0)->get();
        if (count($parent) > 1) {
            return back()->withErrors('Нельзя создать более 2 родительских страниц');
        }
        $data = $request->validated();
        $page = Page::create($data);
        return redirect()
            ->route('admin.page.show', $page->id)
            ->with('success', 'Новая страница успешно создана');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('admin.page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        $parents = Page::where('parent_id', 0)->get();
        return view('admin.page.edit', compact('page', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageUpdateRequest $request, Page $page)
    {
        $data = $request->validated();
        $page->update($data);
        return redirect()
            ->route('admin.page.show', $page->id)
            ->with('success', 'Страница была успешно отредактирована');
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page) 
    {
        if ($page->children->count()) {
            return back()->withErrors('Нельзя удалить страницу, у которой есть дочерние');
        }
        $page->delete();
        return redirect()
            ->route('admin.page.index')
            ->with('success', 'Страница сайта успешно удалена');
    }
}
