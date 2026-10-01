<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
 public function index(Request $request)
{
    $query = Product::query();

    // ═══ Recherche ═══
    if ($request->filled('search')) {
        $s = $request->search;
        $query->where(function ($q) use ($s) {
            $q->where('name_fr', 'like', "%{$s}%")
              ->orWhere('name_ar', 'like', "%{$s}%")
              ->orWhere('name_en', 'like', "%{$s}%")
              ->orWhere('description_fr', 'like', "%{$s}%");
        });
    }

    // ═══ Filtre catégorie ═══
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // ═══ Filtre approbation ═══
    if ($request->filled('approval')) {
        $query->where('approval_status', $request->approval);
    }

    $products = $query->latest()->paginate(15);

    return view('admin.products.index', compact('products'));
}
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_fr' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description_fr' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'specifications_fr' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name_fr']) . '-' . uniqid();
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produit créé avec succès !');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_fr' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description_fr' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'specifications_fr' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produit modifié avec succès !');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé !');
    }
        // ═══════════════════════════════════════════════════════
    // APPROBATION
    // ═══════════════════════════════════════════════════════

    public function approve(Product $product)
    {
        if (!auth()->user()->canManageUsers()) {
            abort(403, 'Vous n\'avez pas la permission d\'approuver.');
        }

        $product->update([
            'approval_status'  => 'approved',
            'approved_by'      => auth()->id(),
            'approved_at'      => now(),
            'rejection_reason' => null,
        ]);

        return back()->with('success', '✅ Produit approuvé et publié.');
    }

    public function reject(Request $request, Product $product)
    {
        if (!auth()->user()->canManageUsers()) {
            abort(403, 'Vous n\'avez pas la permission de rejeter.');
        }

        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $product->update([
            'approval_status'  => 'rejected',
            'approved_by'      => auth()->id(),
            'approved_at'      => now(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        return back()->with('success', '❌ Produit rejeté.');
    }
}