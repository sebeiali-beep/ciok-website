<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::active()->featured()->take(3)->get();
        $latestPosts = Post::published()->latest('published_at')->take(3)->get();

        return view('home', compact('featuredProducts', 'latestPosts'));
    }
}