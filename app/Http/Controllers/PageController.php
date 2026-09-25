<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function quality()
    {
        return view('pages.quality');
    }

    public function careers()
    {
        return view('pages.careers');
    }
}