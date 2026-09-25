@extends('admin.layout')
@section('title', 'Modifier actualité')

@section('content')

{{-- EN-TÊTE --}}
<div class="flex items-center justify-between mb-6 flex-wrap gap-4">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.posts.index') }}"
           class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center text-blue-900 hover:bg-blue-50 transition">
            ←
        </a>
        <div>
            <h1 class="text-3xl font-bold text-blue-900">✏️ Modifier l'actualité</h1>
            <div class="flex items-center gap-2 mt-1">
                <span class="font-bold text-blue-700 text-sm bg-blue-100 px-2 py-0.5 rounded">
                    {{ Str::limit($post->title_fr, 40) }}
                </span>
                @if($post->is_published)
                    <span class="text-xs bg-green-100 text-green-800 font-bold px-2 py-0.5 rounded-full">✅ Publié</span>
                @else
                    <span class="text-xs bg-orange-100 text-orange-800 font-bold px-2 py-0.5 rounded-full">⏳ Brouillon</span>
                @endif
            </div>
        </div>
    </div>

    <a href="{{ route('posts.show', $post->slug) }}" target="_blank"
       class="text-sm bg-white border-2 border-green-600 text-green-700 px-4 py-2 rounded-lg hover:bg-green-600 hover:text-white transition flex items-center gap-2">
        🌐 Voir sur le site
    </a>
</div>

<form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf @method('PUT')

    {{-- SECTION 1 : TITRES --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-green-900 rounded-lg flex items-center justify-center font-bold text-sm">1</div>
            <div>
                <h2 class="text-white font-bold text-lg">📰 Titre de l'actualité</h2>
                <p class="text-green-100 text-xs">Titre en 3 langues (FR / AR / EN)</p>
            </div>
        </div>

        <div class="p-6 space-y-5">

            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇫🇷 Titre en français <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title_fr" value="{{ old('title_fr', $post->title_fr) }}"
                       maxlength="255"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-700 focus:ring-2 focus:ring-green-100 outline-none transition"
                       required>
                @error('title_fr') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇹🇳 العنوان بالعربية
                </label>
                <input type="text" name="title_ar" value="{{ old('title_ar', $post->title_ar) }}"
                       dir="rtl" maxlength="255"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-700 focus:ring-2 focus:ring-green-100 outline-none transition text-right">
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇬🇧 Title in English
                </label>
                <input type="text" name="title_en" value="{{ old('title_en', $post->title_en) }}"
                       maxlength="255"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-700 focus:ring-2 focus:ring-green-100 outline-none transition">
            </div>

        </div>
    </div>

    {{-- SECTION 2 : CONTENU --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-green-900 rounded-lg flex items-center justify-center font-bold text-sm">2</div>
            <div>
                <h2 class="text-white font-bold text-lg">📝 Contenu de l'article</h2>
                <p class="text-green-100 text-xs">Extrait et contenu complet</p>
            </div>
        </div>

        <div class="p-6 space-y-5">

            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇫🇷 Extrait (résumé court)
                </label>
                <textarea name="excerpt_fr" rows="2" maxlength="300"
                          class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-700 focus:ring-2 focus:ring-green-100 outline-none transition">{{ old('excerpt_fr', $post->excerpt_fr) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">💡 Maximum 300 caractères</p>
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇫🇷 Contenu complet
                </label>
                <textarea name="content_fr" rows="10" maxlength="5000"
                          class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-green-700 focus:ring-2 focus:ring-green-100 outline-none transition font-mono text-sm leading-relaxed">{{ old('content_fr', $post->content_fr) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">💡 Maximum 5000 caractères</p>
            </div>

        </div>
    </div>

    {{-- SECTION 3 : IMAGE --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-green-900 rounded-lg flex items-center justify-center font-bold text-sm">3</div>
            <div>
                <h2 class="text-white font-bold text-lg">🖼️ Image de l'actualité</h2>
                <p class="text-green-100 text-xs">Modifier l'image actuelle</p>
            </div>
        </div>

        <div class="p-6">

            @if($post->image)
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('storage/' . $post->image) }}"
                             alt="{{ $post->title }}"
                             class="w-24 h-16 object-cover rounded-lg border-2 border-white shadow">
                        <div>
                            <div class="font-semibold text-green-900">Image actuelle</div>
                            <div class="text-xs text-gray-500">Fichier enregistré</div>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $post->image) }}" target="_blank"
                       class="text-green-700 hover:underline text-sm font-semibold">
                        Voir →
                    </a>
                </div>
            @endif

            <div class="border-2 border-dashed border-green-300 rounded-xl p-8 hover:bg-green-50 transition text-center">
                <div class="text-6xl mb-4">🖼️</div>
                <div class="font-semibold text-green-900 mb-2">
                    {{ $post->image ? 'Remplacer l\'image' : 'Ajouter une image' }}
                </div>
                <div class="text-xs text-gray-500 mb-4">JPG, PNG ou WEBP — max 2 Mo</div>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:bg-green-600 file:text-white file:font-semibold hover:file:bg-green-700 cursor-pointer">

                @if($post->image)
                    <p class="text-xs text-gray-500 mt-3">Laisser vide pour conserver l'image actuelle</p>
                @endif
            </div>

            @error('image') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror

        </div>
    </div>

    {{-- SECTION 4 : PUBLICATION --}}
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="font-bold text-blue-900 mb-4 text-lg">⚙️ Publication</h3>

        <label class="flex items-center gap-4 cursor-pointer bg-green-50 rounded-lg p-5 hover:bg-green-100 transition border border-green-200">
            <input type="checkbox" name="is_published" value="1"
                   {{ $post->is_published ? 'checked' : '' }}
                   class="w-5 h-5 accent-green-600 cursor-pointer">
            <div class="flex-1">
                <div class="font-bold text-gray-800 flex items-center gap-2">
                    ✅ Publier sur le site
                </div>
                <div class="text-sm text-gray-500 mt-1">
                    Décochez pour repasser l'article en <strong>brouillon</strong> (masqué du site).
                </div>
            </div>
        </label>
    </div>

    {{-- BOUTONS --}}
    <div class="bg-white rounded-xl shadow-md p-6 sticky bottom-4 z-10">
        <div class="flex flex-wrap gap-3 justify-between items-center">
            <div class="flex gap-3">
                <a href="{{ route('admin.posts.index') }}"
                   class="text-gray-600 hover:text-gray-900 font-semibold flex items-center gap-2">
                    ← Annuler
                </a>
                <a href="{{ route('posts.show', $post->slug) }}" target="_blank"
                   class="text-green-700 hover:text-green-900 font-semibold flex items-center gap-2">
                    🌐 Aperçu
                </a>
            </div>

            <button type="submit"
                    class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition shadow-md font-semibold flex items-center gap-2">
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
                La suppression de cette actualité est <strong>irréversible</strong>.
                L'image associée sera également supprimée.
            </div>
        </div>

        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
              onsubmit="return confirm('⚠️ Supprimer DÉFINITIVEMENT cette actualité ?\n\nCette action est irréversible.')">
            @csrf @method('DELETE')
            <button type="submit"
                    class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition shadow-md font-semibold flex items-center gap-2">
                🗑️ Supprimer définitivement
            </button>
        </form>
    </div>
</div>

@endsection