@extends('layouts.site')
@section('title', 'Plan prévisionnel des marchés - CIOK')
@section('meta_description', 'Consultez le plan prévisionnel des marchés publics de la CIOK.')
@section('content')

<section class="relative text-white overflow-hidden" style="min-height: 400px;">
    <div class="absolute inset-0">
        <img src="{{ asset('images/silos.webp') }}"
             alt="Plan prévisionnel CIOK"
             class="w-full h-full object-cover scale-110"
             style="filter: blur(3px) brightness(0.9);">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/85 via-blue-900/70 to-blue-800/50"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-32 flex flex-col justify-center" style="min-height: 400px;">
        <div class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 text-xs font-bold px-4 py-1.5 rounded-full mb-6 w-fit shadow-lg">
            📅 MARCHÉS À VENIR
        </div>
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight drop-shadow-lg">
            Plan prévisionnel des marchés publics
        </h1>
        <p class="text-blue-100 text-lg md:text-xl max-w-3xl leading-relaxed drop-shadow-md">
            Consultez ou téléchargez le plan prévisionnel des marchés publics de la CIOK
        </p>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500"></div>
</section>

<section class="max-w-4xl mx-auto px-4 py-20">
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
        <div class="text-8xl mb-6">📅</div>
        <h2 class="text-3xl font-bold text-blue-900 mb-4">Plan prévisionnel des marchés publics</h2>
        <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
            Ce document présente la planification prévisionnelle des marchés publics
            pour l'année en cours.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ asset('documents/plan-previsionnel.pdf') }}" target="_blank"
               class="inline-flex items-center gap-3 bg-blue-900 text-white px-8 py-4 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Télécharger le PDF
            </a>
            <a href="{{ route('tenders.index') }}"
               class="inline-flex items-center gap-3 bg-gray-100 text-gray-700 px-8 py-4 rounded-xl font-bold hover:bg-gray-200 transition">
                ← Retour au marché public
            </a>
        </div>
    </div>
</section>

@endsection