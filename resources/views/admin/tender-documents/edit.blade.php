@extends('admin.layout')
@section('title', 'Modifier document')

@section('content')

<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.tender-documents.index') }}"
       class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center text-blue-900 hover:bg-blue-50">←</a>
    <div>
        <h1 class="text-3xl font-bold text-blue-900">✏️ Modifier document</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $document->title }}</p>
    </div>
</div>

<form action="{{ route('admin.tender-documents.update', $document) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf @method('PUT')

    <div class="bg-white rounded-xl shadow-md p-6 space-y-5">

        <div>
            <label class="block font-semibold mb-2">Titre <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $document->title) }}"
                   class="w-full border-2 border-gray-200 rounded-lg px-4 py-3" required>
        </div>

        <div>
            <label class="block font-semibold mb-2">Description</label>
            <textarea name="description" rows="3"
                      class="w-full border-2 border-gray-200 rounded-lg px-4 py-3">{{ old('description', $document->description) }}</textarea>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block font-semibold mb-2">Icône (emoji)</label>
                <input type="text" name="icon" value="{{ old('icon', $document->icon) }}"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 text-center text-2xl">
            </div>
            <div>
                <label class="block font-semibold mb-2">Badge</label>
                <input type="text" name="badge_label" value="{{ old('badge_label', $document->badge_label) }}"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3">
            </div>
            <div>
                <label class="block font-semibold mb-2">Ordre</label>
                <input type="number" name="order" value="{{ old('order', $document->order) }}"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3">
            </div>
        </div>

        <div>
            <label class="block font-semibold mb-2">Fichier PDF</label>
            @if($document->file_path)
                <div class="bg-green-50 rounded-lg p-3 mb-3 text-sm">
                    ✅ Fichier actuel : <a href="{{ $document->file_url }}" target="_blank" class="text-blue-700 hover:underline">Voir</a>
                </div>
            @endif
            <input type="file" name="file" accept="application/pdf"
                   class="w-full border-2 border-dashed border-blue-300 rounded-lg p-4 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-900 file:text-white">
            <p class="text-xs text-gray-500 mt-2">Laisser vide pour conserver le fichier actuel</p>
        </div>

        <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="is_published" value="1"
                   {{ old('is_published', $document->is_published) ? 'checked' : '' }}
                   class="w-5 h-5 accent-blue-900">
            <span class="font-bold text-blue-900">✅ Publier sur le site</span>
        </label>

    </div>

    <div class="bg-white rounded-xl shadow-md p-6 sticky bottom-4 z-10 flex justify-between">
        <a href="{{ route('admin.tender-documents.index') }}" class="text-gray-600 hover:text-gray-900 font-semibold">
            ← Annuler
        </a>
        <button type="submit" class="bg-blue-900 text-white px-8 py-3 rounded-lg hover:bg-blue-800 font-semibold">
            💾 Enregistrer
        </button>
    </div>

</form>

@endsection