@extends('layouts.site')

@section('title', $product->name . ' - CIOK')
@section('meta_description', Str::limit($product->description, 155))
@section('og_image', $product->image ? asset('storage/' . $product->image) : asset('images/silos.jpg'))
@section('og_type', 'product')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- FIL D'ARIANE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="bg-gray-100 border-b">
    <div class="max-w-7xl mx-auto px-4 py-3 text-sm flex items-center gap-2">
        <a href="{{ route('home') }}" class="text-blue-700 hover:underline flex items-center gap-1">
            🏠 {{ __('messages.home') }}
        </a>
        <span class="text-gray-400">/</span>
        <a href="{{ route('products.index') }}" class="text-blue-700 hover:underline">
            {{ __('messages.products') }}
        </a>
        <span class="text-gray-400">/</span>
        <span class="text-gray-600 font-medium">{{ $product->name }}</span>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- PRODUIT PRINCIPAL --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-12 grid lg:grid-cols-2 gap-12 items-start">

    {{-- IMAGE PRODUIT avec zoom --}}
    <div class="lg:sticky lg:top-28">
        <div class="relative bg-gradient-to-br from-gray-50 via-white to-blue-50 rounded-3xl aspect-square flex items-center justify-center overflow-hidden p-8 shadow-xl border border-gray-100 group">

            {{-- Badge catégorie --}}
            @if($product->category)
                <span class="absolute top-6 left-6 bg-white text-blue-900 text-xs font-bold px-4 py-2 rounded-full shadow-md z-10">
                    {{ $product->category->name }}
                </span>
            @endif

            {{-- Badge Phare --}}
            @if($product->is_featured)
                <span class="absolute top-6 right-6 bg-gradient-to-r from-yellow-500 to-yellow-400 text-blue-900 text-xs font-extrabold px-4 py-2 rounded-full shadow-lg z-10 flex items-center gap-1">
                    ⭐ PHARE
                </span>
            @endif

            @php
                $mainImgSrc = null;
                $nameLower = strtolower($product->name);

                if ($product->image) {
                    $mainImgSrc = asset('storage/' . $product->image);
                } elseif (str_contains($nameLower, 'cem i ') && !str_contains($nameLower, 'cem ii')) {
                    $mainImgSrc = asset('images/produits/ciment-cem1-vert.webp');
                } elseif (str_contains($nameLower, 'cem ii')) {
                    $mainImgSrc = asset('images/produits/ciment-cem2-bleu.webp');
                }
            @endphp

            @if($mainImgSrc)
                <img src="{{ $mainImgSrc }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-contain transition duration-500 group-hover:scale-105 drop-shadow-2xl">
            @else
                <div class="text-9xl opacity-20">🏭</div>
            @endif

            {{-- Effet brillance au survol --}}
            <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/0 to-white/30 opacity-0 group-hover:opacity-100 transition duration-700 pointer-events-none rounded-3xl"></div>
        </div>

        {{-- Mini-badges sous l'image --}}
        <div class="grid grid-cols-3 gap-3 mt-6">
            <div class="bg-white rounded-xl p-3 text-center shadow-sm border border-gray-100">
                <div class="text-2xl mb-1">🏆</div>
                <div class="text-[10px] font-bold text-gray-700 uppercase">ISO 9001</div>
            </div>
            <div class="bg-white rounded-xl p-3 text-center shadow-sm border border-gray-100">
                <div class="text-2xl mb-1">🇹🇳</div>
                <div class="text-[10px] font-bold text-gray-700 uppercase">NT 47.01</div>
            </div>
            <div class="bg-white rounded-xl p-3 text-center shadow-sm border border-gray-100">
                <div class="text-2xl mb-1">🌍</div>
                <div class="text-[10px] font-bold text-gray-700 uppercase">EN 197-1</div>
            </div>
        </div>
    </div>

    {{-- INFORMATIONS PRODUIT --}}
    <div>

        {{-- Titre --}}
        <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-4 leading-tight">
            {{ $product->name }}
        </h1>

        {{-- Séparateur décoratif --}}
        <div class="w-20 h-1 bg-gradient-to-r from-yellow-500 to-yellow-400 rounded-full mb-6"></div>

        {{-- Description --}}
        <div class="prose prose-lg text-gray-700 mb-8 leading-relaxed">
            {!! nl2br(e($product->description)) !!}
        </div>

        {{-- Spécifications techniques --}}
        @if($product->specifications)
            <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 mb-8 border-l-4 border-blue-900 shadow-sm">
                <h3 class="font-bold text-blue-900 mb-4 text-lg flex items-center gap-2">
                    <span class="text-2xl">📋</span> Spécifications techniques
                </h3>
                <div class="text-gray-700 whitespace-pre-line leading-relaxed">
                    {{ $product->specifications }}
                </div>
            </div>
        @endif

        {{-- Avantages --}}
        <div class="grid grid-cols-2 gap-3 mb-8">
            <div class="flex items-center gap-2 text-sm text-gray-700">
                <span class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-xs flex-shrink-0">✓</span>
                Qualité certifiée
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-700">
                <span class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-xs flex-shrink-0">✓</span>
                Livraison nationale
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-700">
                <span class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-xs flex-shrink-0">✓</span>
                Production locale
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-700">
                <span class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-xs flex-shrink-0">✓</span>
                Support technique
            </div>
        </div>

        {{-- Info devis --}}
        <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-4 mb-8 text-sm text-yellow-800 flex items-start gap-3">
            <span class="text-xl">💡</span>
            <div>
                <strong>Besoin d'un devis ?</strong><br>
                Contactez notre équipe commerciale pour connaître les tarifs et disponibilités.
            </div>
        </div>

        {{-- Boutons d'action --}}
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('contact.show') }}"
               class="flex-1 min-w-[200px] bg-blue-900 text-white px-6 py-4 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg hover:-translate-y-1 flex items-center justify-center gap-2">
                ✉️ {{ __('messages.contact_us') }}
            </a>
            <a href="tel:+21678253816"
               class="flex-1 min-w-[200px] bg-yellow-500 text-blue-900 px-6 py-4 rounded-xl font-bold hover:bg-yellow-400 transition shadow-lg hover:-translate-y-1 flex items-center justify-center gap-2">
                📞 +216 78 253 816
            </a>
        </div>

        {{-- Retour --}}
        <div class="mt-6 text-center">
            <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-blue-700 text-sm transition">
                ← Retour à tous les produits
            </a>
        </div>

    </div>

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BANNIÈRE CERTIFICATIONS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-12 mt-8">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">

        <div>
            <div class="text-4xl mb-2">🏆</div>
            <div class="font-bold text-sm uppercase tracking-wider">ISO 9001</div>
            <div class="text-blue-200 text-xs mt-1">Certifié qualité</div>
        </div>

        <div>
            <div class="text-4xl mb-2">🇹🇳</div>
            <div class="font-bold text-sm uppercase tracking-wider">NT 47.01</div>
            <div class="text-blue-200 text-xs mt-1">Norme tunisienne</div>
        </div>

        <div>
            <div class="text-4xl mb-2">🌍</div>
            <div class="font-bold text-sm uppercase tracking-wider">EN 197-1</div>
            <div class="text-blue-200 text-xs mt-1">Norme européenne</div>
        </div>

        <div>
            <div class="text-4xl mb-2">✅</div>
            <div class="font-bold text-sm uppercase tracking-wider">CE</div>
            <div class="text-blue-200 text-xs mt-1">Marquage conforme</div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- PRODUITS SIMILAIRES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
@if($related->isNotEmpty())
    <section class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4">

            <div class="text-center mb-12">
                <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
                    À DÉCOUVRIR
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-3">Produits similaires</h2>
                <p class="text-gray-600">D'autres références de notre gamme</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($related as $p)
                    @php
                        $imgSrc = null;
                        $nameLower = strtolower($p->name);

                        if ($p->image) {
                            $imgSrc = asset('storage/' . $p->image);
                        } elseif (str_contains($nameLower, 'cem i ') && !str_contains($nameLower, 'cem ii')) {
                            $imgSrc = asset('images/produits/ciment-cem1-vert.webp');
                        } elseif (str_contains($nameLower, 'cem ii')) {
                            $imgSrc = asset('images/produits/ciment-cem2-bleu.webp');
                        }
                    @endphp

                    <a href="{{ route('products.show', $p->slug) }}"
                       class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition duration-300 group flex flex-col border border-gray-100">

                        <div class="relative h-56 bg-gradient-to-br from-gray-50 to-blue-50 flex items-center justify-center p-6 overflow-hidden">

                            @if($imgSrc)
                                <img src="{{ $imgSrc }}"
                                     alt="{{ $p->name }}"
                                     class="w-full h-full object-contain group-hover:scale-110 transition duration-500 drop-shadow-lg">
                            @else
                                <div class="text-6xl opacity-20">🏭</div>
                            @endif

                            @if($p->is_featured)
                                <span class="absolute top-3 right-3 bg-yellow-500 text-blue-900 text-xs font-bold px-2 py-1 rounded-full">
                                    ⭐
                                </span>
                            @endif
                        </div>

                        <div class="p-5 border-t border-gray-100 flex-1 flex flex-col">
                            @if($p->category)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full mb-2 self-start">
                                    {{ $p->category->name }}
                                </span>
                            @endif

                            <h3 class="font-bold text-blue-900 group-hover:text-blue-700 transition mb-3 leading-snug flex-1">
                                {{ $p->name }}
                            </h3>

                            <span class="text-blue-700 font-semibold text-sm group-hover:underline flex items-center gap-1">
                                Voir le produit
                                <span class="group-hover:translate-x-1 transition">→</span>
                            </span>
                        </div>

                    </a>
                @endforeach
            </div>

        </div>
    </section>
@endif

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CTA CONTACT --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden mt-8">
    <div class="absolute inset-0">
        <img src="{{ asset('images/entree.jpg') }}" alt="Contact CIOK" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-blue-950/90"></div>
    </div>

    <div class="relative max-w-4xl mx-auto text-center px-4 py-16">
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            UN PROJET ?
        </div>

        <h2 class="text-3xl md:text-4xl font-extrabold mb-6">
            Parlons de votre projet
        </h2>

        <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
            Notre équipe commerciale vous accompagne dans le choix de vos matériaux
            et vous fournit un devis personnalisé.
        </p>

        <a href="{{ route('contact.show') }}"
           class="inline-block bg-yellow-500 text-blue-900 px-8 py-4 rounded-lg font-bold hover:bg-yellow-400 transition shadow-xl hover:-translate-y-1">
            ✉️ {{ __('messages.send_message') }}
        </a>
    </div>
</section>

@endsection