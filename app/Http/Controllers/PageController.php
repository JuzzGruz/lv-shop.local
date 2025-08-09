<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Page $page) : View
    {
        return view('page.show', compact('page'));
    }
}
