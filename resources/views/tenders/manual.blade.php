@extends('layouts.site')
@section('title', 'Manuel d\'achat - CIOK')
@section('content')

<section class="relative text-white overflow-hidden" style="min-height: 400px;">
    <div class="absolute inset-0">
        <img src="{{ asset('images/silos.webp') }}" class="w-full h-full object-cover scale-110" style="filter: blur(3px) brightness(0.9);">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/85 via-blue-900/70 to-blue-800/50"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-32 flex flex-col justify-center" style="min-height: 400px;">
        <div class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 text-xs font-bold px-4 py-1.5 rounded-full mb-6 w-fit shadow-lg">
            📘 DOCUMENT
        </div>
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6 drop-shadow-lg">Manuel d'achat CIOK</h1>
    </div>
</section>

<section class="max-w-4xl mx-auto px-4 py-16 text-center">
    <div class="bg-white rounded-2xl shadow-lg p-12">
        <div class="text-8xl mb-6">📘</div>
        <h2 class="text-2xl font-bold text-blue-900 mb-4">Manuel d'achat CIOK</h2>
        <p class="text-gray-600 mb-8">Consultez ou téléchargez le manuel d'achat de la CIOK.</p>
        <a href="{{ asset('documents/manuel-achat-ciok.pdf') }}" target="_blank"
           class="inline-flex items-center gap-2 bg-blue-900 text-white px-8 py-4 rounded-lg font-bold hover:bg-blue-800 transition">
            📥 Télécharger le PDF
        </a>
    </div>
</section>

@endsection