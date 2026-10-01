<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
 public function index(Request $request)
{
    $query = Post::query();

    // ═══ Recherche ═══
    if ($request->filled('search')) {
        $s = $request->search;
        $query->where(function ($q) use ($s) {
            $q->where('title_fr', 'like', "%{$s}%")
              ->orWhere('title_ar', 'like', "%{$s}%")
              ->orWhere('title_en', 'like', "%{$s}%")
              ->orWhere('excerpt_fr', 'like', "%{$s}%");
        });
    }

    // ═══ Filtre statut (publié/brouillon) ═══
    if ($request->filled('status')) {
        if ($request->status === 'published') {
            $query->where('is_published', true);
        } elseif ($request->status === 'draft') {
            $query->where('is_published', false);
        }
    }

    // ═══ Filtre approbation ═══
    if ($request->filled('approval')) {
        $query->where('approval_status', $request->approval);
    }

    $posts = $query->latest()->paginate(15);

    return view('admin.posts.index', compact('posts'));
}

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'excerpt_fr' => 'nullable|string',
            'content_fr' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title_fr']) . '-' . uniqid();
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = now();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Actualité créée avec succès !');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'excerpt_fr' => 'nullable|string',
            'content_fr' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Actualité modifiée !');
    }

    public function destroy(Post $post)
    {
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Actualité supprimée !');
    }
        // ═══════════════════════════════════════════════════════
    // APPROBATION
    // ═══════════════════════════════════════════════════════

    public function approve(Post $post)
    {
        if (!auth()->user()->canManageUsers()) {
            abort(403, 'Vous n\'avez pas la permission d\'approuver.');
        }

        $post->update([
            'approval_status'  => 'approved',
            'approved_by'      => auth()->id(),
            'approved_at'      => now(),
            'rejection_reason' => null,
        ]);

        return back()->with('success', '✅ Actualité approuvée et publiée.');
    }

    public function reject(Request $request, Post $post)
    {
        if (!auth()->user()->canManageUsers()) {
            abort(403, 'Vous n\'avez pas la permission de rejeter.');
        }

        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $post->update([
            'approval_status'  => 'rejected',
            'approved_by'      => auth()->id(),
            'approved_at'      => now(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        return back()->with('success', '❌ Actualité rejetée.');
    }
}