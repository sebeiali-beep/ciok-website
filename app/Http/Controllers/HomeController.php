<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Post;
use App\Models\Tender;

class HomeController extends Controller
{
    public function index()
{
    $featuredProducts = Product::active()
        ->featured()
        ->approved()  // ← AJOUTEZ
        ->take(3)
        ->get();

    $latestPosts = Post::published()
        ->approved()  // ← AJOUTEZ
        ->latest('published_at')
        ->take(3)
        ->get();

    $latestTender = Tender::where('is_published', true)
        ->approved()  // ← AJOUTEZ
        ->latest('created_at')
        ->first();

    return view('home', compact('featuredProducts', 'latestPosts', 'latestTender'));
}
}