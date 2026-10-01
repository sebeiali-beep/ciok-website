@extends('layouts.site')
@section('title', $document->title . ' - CIOK')
@section('content')

<section class="relative text-white overflow-hidden" style="min-height: 400px;">
    <div class="absolute inset-0">
        <img src="{{ asset('images/silos.webp') }}" class="w-full h-full object-cover scale-110"
             style="filter: blur(3px) brightness(0.9);">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/85 via-blue-900/70 to-blue-800/50"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-32 flex flex-col justify-center" style="min-height: 400px;">
        <div class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 text-xs font-bold px-4 py-1.5 rounded-full mb-6 w-fit shadow-lg">
            {{ $document->icon }} {{ $document->badge_label }}
        </div>
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6 drop-shadow-lg">{{ $document->title }}</h1>
        @if($document->description)
            <p class="text-blue-100 text-lg md:text-xl max-w-3xl drop-shadow-md">{{ $document->description }}</p>
        @endif
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500"></div>
</section>

<section class="max-w-4xl mx-auto px-4 py-20">
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
        <div class="text-8xl mb-6">{{ $document->icon }}</div>
        <h2 class="text-3xl font-bold text-blue-900 mb-4">{{ $document->title }}</h2>

        @if($document->file_path)
            <a href="{{ $document->file_url }}" target="_blank"
               class="inline-flex items-center gap-3 bg-blue-900 text-white px-8 py-4 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg hover:-translate-y-1 mb-4">
                📥 Télécharger le PDF
            </a>
        @else
            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-4 mb-6 text-left">
                <p class="text-yellow-800 text-sm">
                    📄 Le document sera disponible prochainement.
                </p>
            </div>
        @endif

        <div>
            <a href="{{ route('tenders.index') }}"
               class="inline-flex items-center gap-3 bg-gray-100 text-gray-700 px-8 py-4 rounded-xl font-bold hover:bg-gray-200 transition">
                ← Retour au marché public
            </a>
        </div>
    </div>
</section>

@endsection