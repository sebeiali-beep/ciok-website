@extends('layouts.site')
@section('title', __('messages.quality') . ' - CIOK')
@section('meta_description', 'Notre engagement pour la qualité : certification ISO 9001, conformité aux normes NT 47.01 et EN 197-1. Contrôle qualité rigoureux.')
@section('og_image', asset('images/silos.jpg'))
@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BANNER --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/silos.webp') }}" alt="Qualité CIOK" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/95 to-blue-900/70"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-24">
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            ✅ QUALITÉ
        </div>
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">{{ __('messages.quality') }}</h1>
        <p class="text-blue-100 text-lg md:text-xl max-w-3xl leading-relaxed">
            Notre engagement pour l'excellence et la conformité aux normes internationales
        </p>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500"></div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- INTRO --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-5xl mx-auto px-4 py-16 text-center reveal">
    <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-4">
        NOTRE ENGAGEMENT
    </div>
    <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6 leading-tight">
        La qualité au cœur de nos priorités
    </h2>
    <p class="text-gray-700 leading-relaxed text-lg max-w-3xl mx-auto">
        CIOK s'engage à respecter les normes nationales et internationales les plus strictes
        pour garantir la qualité, la résistance et la durabilité de ses produits.
    </p>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CERTIFICATIONS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-16 reveal">
    <div class="max-w-7xl mx-auto px-4">

        <div class="text-center mb-12">
            <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-3">
                🏆 CERTIFICATIONS
            </div>
            <h2 class="text-3xl font-bold text-blue-900">Nos certifications</h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-blue-900">
                <div class="text-5xl mb-4">🏆</div>
                <h3 class="font-bold text-blue-900 mb-2 text-lg">ISO 9001</h3>
                <p class="text-gray-600 text-sm">Système de management de la qualité</p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-green-600">
                <div class="text-5xl mb-4">🇹🇳</div>
                <h3 class="font-bold text-blue-900 mb-2 text-lg">NT 47.01</h3>
                <p class="text-gray-600 text-sm">Norme tunisienne du ciment</p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-yellow-500">
                <div class="text-5xl mb-4">🌍</div>
                <h3 class="font-bold text-blue-900 mb-2 text-lg">EN 197-1</h3>
                <p class="text-gray-600 text-sm">Norme européenne du ciment</p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-purple-600">
                <div class="text-5xl mb-4">✅</div>
                <h3 class="font-bold text-blue-900 mb-2 text-lg">Marquage CE</h3>
                <p class="text-gray-600 text-sm">Conformité européenne</p>
            </div>

        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CONTRÔLE QUALITÉ --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-20 grid lg:grid-cols-2 gap-12 items-center reveal">

    <div>
        <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-4">
            🔬 LABORATOIRE
        </div>
        <h2 class="text-3xl font-bold text-blue-900 mb-6">Contrôle qualité rigoureux</h2>

        <p class="text-gray-700 leading-relaxed mb-6">
            Chaque lot de production est soumis à des tests rigoureux en laboratoire
            afin de garantir la résistance, la durabilité et la conformité de nos ciments.
        </p>

        <ul class="space-y-4">
            <li class="flex items-start gap-3">
                <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm flex-shrink-0 mt-0.5">✓</span>
                <div>
                    <strong class="text-blue-900">Tests physiques</strong>
                    <p class="text-sm text-gray-600">Résistance, temps de prise, stabilité volumique</p>
                </div>
            </li>
            <li class="flex items-start gap-3">
                <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm flex-shrink-0 mt-0.5">✓</span>
                <div>
                    <strong class="text-blue-900">Analyses chimiques</strong>
                    <p class="text-sm text-gray-600">Composition, taux de sulfates, alcalins</p>
                </div>
            </li>
            <li class="flex items-start gap-3">
                <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm flex-shrink-0 mt-0.5">✓</span>
                <div>
                    <strong class="text-blue-900">Traçabilité</strong>
                    <p class="text-sm text-gray-600">Suivi complet de chaque lot de production</p>
                </div>
            </li>
        </ul>
    </div>

    <div class="img-zoom rounded-2xl shadow-xl overflow-hidden">
        <img src="{{ asset('images/aerien.webp') }}" alt="Contrôle qualité" class="w-full h-96 object-cover">
    </div>

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- PROCESSUS QUALITÉ --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-blue-900 text-white py-20 reveal">
    <div class="max-w-7xl mx-auto px-4">

        <div class="text-center mb-12">
            <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-3">
                📋 PROCESSUS
            </div>
            <h2 class="text-3xl font-bold mb-3">Le processus qualité CIOK</h2>
            <p class="text-blue-200">De la matière première au produit fini</p>
        </div>

        <div class="grid md:grid-cols-4 gap-6">

            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-500 text-blue-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">1</div>
                <h3 class="font-bold mb-2">Extraction</h3>
                <p class="text-blue-200 text-sm">Sélection rigoureuse des matières premières</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-500 text-blue-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">2</div>
                <h3 class="font-bold mb-2">Production</h3>
                <p class="text-blue-200 text-sm">Contrôle continu à chaque étape</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-500 text-blue-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">3</div>
                <h3 class="font-bold mb-2">Analyse</h3>
                <p class="text-blue-200 text-sm">Tests en laboratoire par lot</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-500 text-blue-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">4</div>
                <h3 class="font-bold mb-2">Livraison</h3>
                <p class="text-blue-200 text-sm">Produits certifiés conformes</p>
            </div>

        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CTA --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-4xl mx-auto px-4 py-16 text-center">
    <h2 class="text-3xl font-bold text-blue-900 mb-4">Des questions sur notre qualité ?</h2>
    <p class="text-gray-600 mb-8">Notre équipe technique est à votre disposition.</p>
    <a href="{{ route('contact.show') }}"
       class="inline-flex items-center gap-2 bg-blue-900 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-800 transition hover:-translate-y-1">
        ✉️ {{ __('messages.contact_us') }}
    </a>
</section>

@endsection