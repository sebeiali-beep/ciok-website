@extends('admin.layout')
@section('title', 'Modifier produit')

@section('content')

{{-- EN-TÊTE --}}
<div class="flex items-center justify-between mb-6 flex-wrap gap-4">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.products.index') }}"
           class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center text-blue-900 hover:bg-blue-50 transition">
            ←
        </a>
        <div>
            <h1 class="text-3xl font-bold text-blue-900">✏️ Modifier le produit</h1>
            <div class="flex items-center gap-2 mt-1">
                <span class="font-bold text-blue-700 text-sm bg-blue-100 px-2 py-0.5 rounded">
                    {{ $product->name }}
                </span>
                @if($product->is_active)
                    <span class="text-xs bg-green-100 text-green-800 font-bold px-2 py-0.5 rounded-full">✅ Actif</span>
                @else
                    <span class="text-xs bg-gray-100 text-gray-700 font-bold px-2 py-0.5 rounded-full">❌ Inactif</span>
                @endif
                @if($product->is_featured)
                    <span class="text-xs bg-yellow-100 text-yellow-800 font-bold px-2 py-0.5 rounded-full">⭐ Phare</span>
                @endif
            </div>
        </div>
    </div>

    <a href="{{ route('products.show', $product->slug) }}" target="_blank"
       class="text-sm bg-white border-2 border-blue-900 text-blue-900 px-4 py-2 rounded-lg hover:bg-blue-900 hover:text-white transition flex items-center gap-2">
        🌐 Voir sur le site
    </a>
</div>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf @method('PUT')

    {{-- SECTION 1 : INFORMATIONS DE BASE --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">1</div>
            <div>
                <h2 class="text-white font-bold text-lg">📦 Informations de base</h2>
                <p class="text-blue-200 text-xs">Catégorie et noms du produit</p>
            </div>
        </div>

        <div class="p-6 space-y-5">

            <div>
                <label class="block font-semibold mb-2 text-gray-800">
                    Catégorie <span class="text-red-500">*</span>
                </label>
                <select name="category_id"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition"
                        required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇫🇷 Nom du produit en français <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name_fr" value="{{ old('name_fr', $product->name_fr) }}"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition"
                       required>
                @error('name_fr') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇹🇳 اسم المنتج بالعربية
                </label>
                <input type="text" name="name_ar" value="{{ old('name_ar', $product->name_ar) }}"
                       dir="rtl"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition text-right">
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇬🇧 Product name in English
                </label>
                <input type="text" name="name_en" value="{{ old('name_en', $product->name_en) }}"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">
            </div>

        </div>
    </div>

    {{-- SECTION 2 : DESCRIPTIONS --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">2</div>
            <div>
                <h2 class="text-white font-bold text-lg">📝 Descriptions</h2>
                <p class="text-blue-200 text-xs">Description du produit en 3 langues</p>
            </div>
        </div>

        <div class="p-6 space-y-5">

            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇫🇷 Description en français
                </label>
                <textarea name="description_fr" rows="4"
                          class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">{{ old('description_fr', $product->description_fr) }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇹🇳 الوصف بالعربية
                </label>
                <textarea name="description_ar" rows="4" dir="rtl"
                          class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition text-right">{{ old('description_ar', $product->description_ar) }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇬🇧 Description in English
                </label>
                <textarea name="description_en" rows="4"
                          class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">{{ old('description_en', $product->description_en) }}</textarea>
            </div>

        </div>
    </div>

    {{-- SECTION 3 : SPÉCIFICATIONS --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">3</div>
            <div>
                <h2 class="text-white font-bold text-lg">📋 Spécifications techniques</h2>
                <p class="text-blue-200 text-xs">Détails techniques du produit</p>
            </div>
        </div>

        <div class="p-6">
            <label class="block font-semibold mb-2 text-gray-800">Spécifications (FR)</label>
            <textarea name="specifications_fr" rows="5"
                      class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition font-mono text-sm">{{ old('specifications_fr', $product->specifications_fr) }}</textarea>
            <p class="text-xs text-gray-500 mt-2">💡 Une ligne par caractéristique</p>
        </div>
    </div>

    {{-- SECTION 4 : IMAGE --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">4</div>
            <div>
                <h2 class="text-white font-bold text-lg">🖼️ Image du produit</h2>
                <p class="text-blue-200 text-xs">Modifier l'image actuelle</p>
            </div>
        </div>

        <div class="p-6">

            @if($product->image)
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-20 h-20 object-cover rounded-lg border-2 border-white shadow">
                        <div>
                            <div class="font-semibold text-blue-900">Image actuelle</div>
                            <div class="text-xs text-gray-500">Fichier enregistré</div>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $product->image) }}" target="_blank"
                       class="text-blue-700 hover:underline text-sm font-semibold">
                        Voir →
                    </a>
                </div>
            @endif

            <div class="border-2 border-dashed border-blue-300 rounded-xl p-8 hover:bg-blue-50 transition text-center">
                <div class="text-6xl mb-4">🖼️</div>
                <div class="font-semibold text-blue-900 mb-2">
                    {{ $product->image ? 'Remplacer l\'image' : 'Ajouter une image' }}
                </div>
                <div class="text-xs text-gray-500 mb-4">JPG, PNG ou WEBP — max 2 Mo</div>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:bg-blue-900 file:text-white file:font-semibold hover:file:bg-blue-800 cursor-pointer">

                @if($product->image)
                    <p class="text-xs text-gray-500 mt-3">Laisser vide pour conserver l'image actuelle</p>
                @endif
            </div>

            @error('image') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror

        </div>
    </div>

    {{-- SECTION 5 : OPTIONS --}}
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="font-bold text-blue-900 mb-4 text-lg">⚙️ Options d'affichage</h3>

        <div class="space-y-3">
            <label class="flex items-center gap-3 cursor-pointer bg-yellow-50 rounded-lg p-4 hover:bg-yellow-100 transition border border-yellow-200">
                <input type="checkbox" name="is_featured" value="1"
                       {{ $product->is_featured ? 'checked' : '' }}
                       class="w-5 h-5 accent-yellow-500 cursor-pointer">
                <div class="flex-1">
                    <div class="font-bold text-gray-800">⭐ Mettre en avant sur la page d'accueil</div>
                    <div class="text-xs text-gray-500 mt-1">Apparaîtra dans la section « Produits phares »</div>
                </div>
            </label>

            <label class="flex items-center gap-3 cursor-pointer bg-green-50 rounded-lg p-4 hover:bg-green-100 transition border border-green-200">
                <input type="checkbox" name="is_active" value="1"
                       {{ $product->is_active ? 'checked' : '' }}
                       class="w-5 h-5 accent-green-500 cursor-pointer">
                <div class="flex-1">
                    <div class="font-bold text-gray-800">✅ Actif (visible sur le site)</div>
                    <div class="text-xs text-gray-500 mt-1">Décochez pour masquer le produit</div>
                </div>
            </label>
        </div>
    </div>

    {{-- BOUTONS --}}
    <div class="bg-white rounded-xl shadow-md p-6 sticky bottom-4 z-10">
        <div class="flex flex-wrap gap-3 justify-between items-center">
            <div class="flex gap-3">
                <a href="{{ route('admin.products.index') }}"
                   class="text-gray-600 hover:text-gray-900 font-semibold flex items-center gap-2">
                    ← Annuler
                </a>
                <a href="{{ route('products.show', $product->slug) }}" target="_blank"
                   class="text-blue-700 hover:text-blue-900 font-semibold flex items-center gap-2">
                    🌐 Aperçu
                </a>
            </div>

            <button type="submit"
                    class="bg-blue-900 text-white px-8 py-3 rounded-lg hover:bg-blue-800 transition shadow-md font-semibold flex items-center gap-2">
                💾 Enregistrer les modifications
            </button>
        </div>
    </div>

</form>

{{-- ZONE DANGER : SUPPRESSION --}}
<div class="bg-red-50 border-2 border-red-200 rounded-xl p-6 mt-6">
    <div class="flex items-center justify-between flex-wrap gap-4">
        <div>
            <div class="font-bold text-red-900 flex items-center gap-2">⚠️ Zone dangereuse</div>
            <div class="text-sm text-red-700 mt-1">
                La suppression de ce produit est <strong>irréversible</strong>.
                L'image associée sera également supprimée.
            </div>
        </div>

        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
              onsubmit="return confirm('⚠️ Supprimer DÉFINITIVEMENT {{ $product->name }} ?\n\nCette action est irréversible.')">
            @csrf @method('DELETE')
            <button type="submit"
                    class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition shadow-md font-semibold flex items-center gap-2">
                🗑️ Supprimer définitivement
            </button>
        </form>
    </div>
</div>

@endsection