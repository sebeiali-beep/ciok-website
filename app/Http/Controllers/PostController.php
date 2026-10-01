<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
{
    $posts = Post::published()
                 ->approved()  // ← AJOUTEZ
                 ->orderByDesc('published_at')
                 ->paginate(9);

    return view('posts.index', compact('posts'));
}

    public function show($slug)
{
    $post = Post::where('slug', $slug)
                ->published()
                ->approved()  // ← AJOUTEZ
                ->firstOrFail();

    $related = Post::published()
        ->approved()  // ← AJOUTEZ
        ->where('id', '!=', $post->id)
        ->latest('published_at')
        ->take(3)
        ->get();

    return view('posts.show', compact('post', 'related'));
}
}