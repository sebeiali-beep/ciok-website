@extends('admin.layout')
@section('title', 'Nouveau produit')

@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- EN-TÊTE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.products.index') }}"
       class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center text-blue-900 hover:bg-blue-50 transition">
        ←
    </a>
    <div>
        <h1 class="text-3xl font-bold text-blue-900">➕ Nouveau produit</h1>
        <p class="text-sm text-gray-500 mt-1">Ajoutez un nouveau produit à votre catalogue</p>
    </div>
</div>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 1 : INFORMATIONS DE BASE --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">
                1
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">📦 Informations de base</h2>
                <p class="text-blue-200 text-xs">Catégorie et noms du produit</p>
            </div>
        </div>

        <div class="p-6 space-y-5">

            {{-- Catégorie --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800">
                    Catégorie <span class="text-red-500">*</span>
                </label>
                <select name="category_id"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition"
                        required>
                    <option value="">-- Choisir une catégorie --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Nom FR --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇫🇷 Nom du produit en français <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name_fr" value="{{ old('name_fr') }}"
                       placeholder="Ex: CEM I 42.5 N"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition"
                       required>
                @error('name_fr') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Nom AR --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇹🇳 اسم المنتج بالعربية
                </label>
                <input type="text" name="name_ar" value="{{ old('name_ar') }}"
                       placeholder="مثال: CEM I 42.5 N"
                       dir="rtl"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition text-right">
            </div>

            {{-- Nom EN --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇬🇧 Product name in English
                </label>
                <input type="text" name="name_en" value="{{ old('name_en') }}"
                       placeholder="Ex: CEM I 42.5 N"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 2 : DESCRIPTIONS --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">
                2
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">📝 Descriptions</h2>
                <p class="text-blue-200 text-xs">Description du produit en 3 langues</p>
            </div>
        </div>

        <div class="p-6 space-y-5">

            {{-- Description FR --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇫🇷 Description en français
                </label>
                <textarea name="description_fr" rows="4"
                          placeholder="Décrivez les caractéristiques et usages du produit..."
                          class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">{{ old('description_fr') }}</textarea>
            </div>

            {{-- Description AR --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇹🇳 الوصف بالعربية
                </label>
                <textarea name="description_ar" rows="4"
                          dir="rtl"
                          placeholder="وصف المنتج..."
                          class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition text-right">{{ old('description_ar') }}</textarea>
            </div>

            {{-- Description EN --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇬🇧 Description in English
                </label>
                <textarea name="description_en" rows="4"
                          placeholder="Product description..."
                          class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">{{ old('description_en') }}</textarea>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 3 : SPÉCIFICATIONS --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">
                3
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">📋 Spécifications techniques</h2>
                <p class="text-blue-200 text-xs">Détails techniques du produit</p>
            </div>
        </div>

        <div class="p-6">
            <label class="block font-semibold mb-2 text-gray-800">Spécifications (FR)</label>
            <textarea name="specifications_fr" rows="5"
                      placeholder="Résistance : 42.5 MPa&#10;Classe : CEM I 42.5 N&#10;Norme : NT 47.01 / EN 197-1&#10;Conditionnement : Sacs de 50 kg"
                      class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition font-mono text-sm">{{ old('specifications_fr') }}</textarea>
            <p class="text-xs text-gray-500 mt-2">💡 Une ligne par caractéristique</p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 4 : IMAGE --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">
                4
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">🖼️ Image du produit</h2>
                <p class="text-blue-200 text-xs">Photo officielle du produit (optionnel)</p>
            </div>
        </div>

        <div class="p-6">

            <div class="border-2 border-dashed border-blue-300 rounded-xl p-8 hover:bg-blue-50 transition text-center">
                <div class="text-6xl mb-4">🖼️</div>
                <div class="font-semibold text-blue-900 mb-2">Choisir une image</div>
                <div class="text-xs text-gray-500 mb-4">JPG, PNG ou WEBP — max 2 Mo</div>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:bg-blue-900 file:text-white file:font-semibold hover:file:bg-blue-800 cursor-pointer">

                <p class="text-xs text-gray-500 mt-3">
                    💡 Si aucune image n'est uploadée, une <strong>image par défaut</strong> s'affichera
                    automatiquement (sac de ciment selon le type)
                </p>
            </div>

            @error('image') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 5 : OPTIONS --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="font-bold text-blue-900 mb-4 text-lg">⚙️ Options d'affichage</h3>

        <div class="space-y-3">

            <label class="flex items-center gap-3 cursor-pointer bg-yellow-50 rounded-lg p-4 hover:bg-yellow-100 transition border border-yellow-200">
                <input type="checkbox" name="is_featured" value="1"
                       {{ old('is_featured') ? 'checked' : '' }}
                       class="w-5 h-5 accent-yellow-500 cursor-pointer">
                <div class="flex-1">
                    <div class="font-bold text-gray-800 flex items-center gap-2">
                        ⭐ Mettre en avant sur la page d'accueil
                    </div>
                    <div class="text-xs text-gray-500 mt-1">
                        Le produit apparaîtra dans la section « Produits phares » de la page d'accueil
                    </div>
                </div>
            </label>

            <label class="flex items-center gap-3 cursor-pointer bg-green-50 rounded-lg p-4 hover:bg-green-100 transition border border-green-200">
                <input type="checkbox" name="is_active" value="1"
                       {{ old('is_active', true) ? 'checked' : '' }}
                       class="w-5 h-5 accent-green-500 cursor-pointer">
                <div class="flex-1">
                    <div class="font-bold text-gray-800 flex items-center gap-2">
                        ✅ Actif (visible sur le site)
                    </div>
                    <div class="text-xs text-gray-500 mt-1">
                        Décochez pour masquer le produit sans le supprimer
                    </div>
                </div>
            </label>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- BOUTONS D'ACTION --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md p-6 sticky bottom-4 z-10">
        <div class="flex flex-wrap gap-3 justify-between items-center">
            <a href="{{ route('admin.products.index') }}"
               class="text-gray-600 hover:text-gray-900 font-semibold flex items-center gap-2">
                ← Annuler
            </a>

            <button type="submit"
                    class="bg-blue-900 text-white px-8 py-3 rounded-lg hover:bg-blue-800 transition shadow-md font-semibold flex items-center gap-2">
                💾 Enregistrer le produit
            </button>
        </div>
    </div>

</form>

@endsection