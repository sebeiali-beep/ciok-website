@extends('admin.layout')
@section('title', 'Nouvelle actualité')

@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- EN-TÊTE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.posts.index') }}"
       class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center text-blue-900 hover:bg-blue-50 transition">
        ←
    </a>
    <div>
        <h1 class="text-3xl font-bold text-blue-900">➕ Nouvelle actualité</h1>
        <p class="text-sm text-gray-500 mt-1">Publiez un nouvel article sur le site</p>
    </div>
</div>

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 1 : TITRES --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-green-900 rounded-lg flex items-center justify-center font-bold text-sm">
                1
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">📰 Titre de l'actualité</h2>
                <p class="text-green-100 text-xs">Titre en 3 langues (FR / AR / EN)</p>
            </div>
        </div>

        <div class="p-6 space-y-5">

            {{-- Titre FR --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇫🇷 Titre en français <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title_fr" value="{{ old('title_fr') }}"
                       placeholder="Ex: CIOK annonce une augmentation de sa production"
                       maxlength="255"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-700 focus:ring-2 focus:ring-green-100 outline-none transition"
                       required>
                @error('title_fr') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Titre AR --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇹🇳 العنوان بالعربية
                </label>
                <input type="text" name="title_ar" value="{{ old('title_ar') }}"
                       placeholder="مثال: CIOK تعلن عن زيادة في إنتاجها"
                       dir="rtl" maxlength="255"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-700 focus:ring-2 focus:ring-green-100 outline-none transition text-right">
            </div>

            {{-- Titre EN --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇬🇧 Title in English
                </label>
                <input type="text" name="title_en" value="{{ old('title_en') }}"
                       placeholder="Ex: CIOK announces production increase"
                       maxlength="255"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-700 focus:ring-2 focus:ring-green-100 outline-none transition">
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 2 : CONTENU --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-green-900 rounded-lg flex items-center justify-center font-bold text-sm">
                2
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">📝 Contenu de l'article</h2>
                <p class="text-green-100 text-xs">Extrait et contenu complet</p>
            </div>
        </div>

        <div class="p-6 space-y-5">

            {{-- Extrait FR --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇫🇷 Extrait (résumé court)
                </label>
                <textarea name="excerpt_fr" rows="2" maxlength="300"
                          placeholder="Un court résumé qui apparaîtra dans la liste des actualités..."
                          class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-700 focus:ring-2 focus:ring-green-100 outline-none transition">{{ old('excerpt_fr') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">💡 Maximum 300 caractères — apparaît dans les cartes de la liste</p>
            </div>

            {{-- Contenu FR --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇫🇷 Contenu complet
                </label>
                <textarea name="content_fr" rows="10" maxlength="5000"
                          placeholder="Rédigez ici le contenu complet de l'article...&#10;&#10;Vous pouvez utiliser des paragraphes séparés par des sauts de ligne."
                          class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-700 focus:ring-2 focus:ring-green-100 outline-none transition font-mono text-sm leading-relaxed">{{ old('content_fr') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">💡 Maximum 5000 caractères — Utilisez les sauts de ligne pour séparer les paragraphes</p>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 3 : IMAGE --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-green-900 rounded-lg flex items-center justify-center font-bold text-sm">
                3
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">🖼️ Image de l'actualité</h2>
                <p class="text-green-100 text-xs">Photo illustrative (optionnel)</p>
            </div>
        </div>

        <div class="p-6">

            <div class="border-2 border-dashed border-green-300 rounded-xl p-8 hover:bg-green-50 transition text-center">
                <div class="text-6xl mb-4">🖼️</div>
                <div class="font-semibold text-green-900 mb-2">Choisir une image</div>
                <div class="text-xs text-gray-500 mb-4">JPG, PNG ou WEBP — max 2 Mo — Recommandé : 1200 x 600 px</div>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:bg-green-600 file:text-white file:font-semibold hover:file:bg-green-700 cursor-pointer">

                <p class="text-xs text-gray-500 mt-3">
                    💡 Sans image, une icône 📰 par défaut s'affichera
                </p>
            </div>

            @error('image') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 4 : PUBLICATION --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md p-6">

        <h3 class="font-bold text-blue-900 mb-4 text-lg">⚙️ Publication</h3>

        <label class="flex items-center gap-4 cursor-pointer bg-green-50 rounded-lg p-5 hover:bg-green-100 transition border border-green-200">
            <input type="checkbox" name="is_published" value="1"
                   {{ old('is_published', true) ? 'checked' : '' }}
                   class="w-5 h-5 accent-green-600 cursor-pointer">
            <div class="flex-1">
                <div class="font-bold text-gray-800 flex items-center gap-2">
                    ✅ Publier immédiatement sur le site
                </div>
                <div class="text-sm text-gray-500 mt-1">
                    L'actualité sera visible sur la page <code class="bg-gray-100 px-1 rounded">/actualites</code> dès maintenant.
                    Décochez pour enregistrer en brouillon.
                </div>
            </div>
        </label>

    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- BOUTONS D'ACTION --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md p-6 sticky bottom-4 z-10">
        <div class="flex flex-wrap gap-3 justify-between items-center">
            <a href="{{ route('admin.posts.index') }}"
               class="text-gray-600 hover:text-gray-900 font-semibold flex items-center gap-2">
                ← Annuler
            </a>

            <button type="submit"
                    class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition shadow-md font-semibold flex items-center gap-2">
                💾 Publier l'actualité
            </button>
        </div>
    </div>

</form>

{{-- AIDE CONTEXTUELLE --}}
<div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mt-6">
    <div class="flex items-start gap-3">
        <span class="text-2xl">💡</span>
        <div class="text-sm">
            <strong class="text-green-900 block mb-2">Conseils pour une bonne actualité :</strong>
            <ul class="space-y-1 text-gray-700">
                <li>📌 <strong>Titre</strong> — Court et accrocheur (max 100 caractères)</li>
                <li>📝 <strong>Extrait</strong> — Résumé qui donne envie de lire (max 300 caractères)</li>
                <li>📄 <strong>Contenu</strong> — Divisé en paragraphes pour la lisibilité</li>
                <li>🖼️ <strong>Image</strong> — Format paysage recommandé (1200x600 px)</li>
            </ul>
        </div>
    </div>
</div>

@endsection