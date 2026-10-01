<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
class ProductController extends Controller
{
 public function index(Request $request)
{
    $query = Product::active()
                    ->approved();  // ← AJOUTEZ

    if ($request->filled('category')) {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    $products = $query->orderBy('order')->paginate(9);
   $categories = Category::all();

    return view('products.index', compact('products', 'categories'));
}

   public function show($slug)
{
    $product = Product::where('slug', $slug)
                      ->active()
                      ->approved()  // ← AJOUTEZ
                      ->firstOrFail();

    $related = Product::active()
        ->approved()  // ← AJOUTEZ
        ->where('id', '!=', $product->id)
        ->where('category_id', $product->category_id)
        ->take(3)
        ->get();

    return view('products.show', compact('product', 'related'));
}
}