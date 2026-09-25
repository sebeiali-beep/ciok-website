<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
class ProductController extends Controller
{
   public function index(Request $request)
{
    $categories = Category::with('products')->get();

    $query = Product::active()->orderBy('order');

    if ($request->has('category') && $request->category) {
        $category = Category::where('slug', $request->category)->first();
        if ($category) {
            $query->where('category_id', $category->id);
        }
    }

    $products = $query->get();

    return view('products.index', compact('products', 'categories'));
}

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->active()->firstOrFail();

        $related = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}