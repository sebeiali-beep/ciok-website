@extends('admin.layout')
@section('title', 'Documents Marché public')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-blue-900">📄 Documents Marché public</h1>
        <p class="text-sm text-gray-500 mt-1">Gérez le Manuel d'achat et le Plan prévisionnel</p>
    </div>
    <a href="{{ route('admin.tenders.index') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200">
        ← Retour aux marchés
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded mb-6">
        ✅ {{ session('success') }}
    </div>
@endif

<div class="grid md:grid-cols-2 gap-6">
    @foreach($documents as $document)
        <div class="bg-white rounded-2xl shadow-md p-6 border-t-4 border-blue-900">
            <div class="flex items-start gap-4 mb-4">
                <div class="text-5xl">{{ $document->icon }}</div>
                <div class="flex-1">
                    <h3 class="font-bold text-blue-900 text-lg mb-1">{{ $document->title }}</h3>
                    <p class="text-sm text-gray-500">{{ $document->description }}</p>
                </div>
            </div>

            @if($document->file_path)
                <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                    <div class="text-xs text-green-800 font-semibold mb-1">✅ Fichier PDF</div>
                    <a href="{{ $document->file_url }}" target="_blank" class="text-blue-700 hover:underline text-sm">
                        Voir le fichier actuel →
                    </a>
                </div>
            @else
                <div class="bg-orange-50 border border-orange-200 rounded-lg p-3 mb-4">
                    <div class="text-xs text-orange-800 font-semibold">⚠️ Aucun fichier</div>
                </div>
            @endif

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <div class="text-xs text-gray-500">
                    @if($document->is_published)
                        <span class="text-green-600 font-bold">✅ Publié</span>
                    @else
                        <span class="text-orange-600 font-bold">🔒 Non publié</span>
                    @endif
                </div>
                <a href="{{ route('admin.tender-documents.edit', $document) }}"
                   class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 text-sm font-semibold">
                    ✏️ Modifier
                </a>
            </div>
        </div>
    @endforeach
</div>

@endsection