<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Content\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Page $page)
    {
        return view('app.page', compact('page'));
    }
}
