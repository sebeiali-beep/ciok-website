@extends('layouts.site')

@section('title', __('messages.products') . ' - CIOK')
@section('meta_description', 'Découvrez notre gamme de ciments, chaux et clinker conformes aux normes tunisiennes et européennes. Qualité certifiée ISO 9001.')
@section('og_image', asset('images/silos.webp'))

@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BANNER --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden" style="min-height: 500px;">
    {{-- Image de fond avec effet flou --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/produit.webp') }}"
             alt="Produits CIOK"
             class="w-full h-full object-cover scale-110"
             style="filter: blur(3px) brightness(0.9); object-position: center;">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/85 via-blue-900/70 to-blue-800/50"></div>
    </div>

    {{-- Contenu --}}
    <div class="relative max-w-7xl mx-auto px-4 py-32 flex flex-col justify-center" style="min-height: 500px;">

        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 text-xs font-bold px-4 py-1.5 rounded-full mb-6 w-fit shadow-lg">
            📦 NOS PRODUITS
        </div>

        {{-- Titre --}}
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight drop-shadow-lg">
            {{ __('messages.our_products') }}
        </h1>

        {{-- Sous-titre --}}
        <p class="text-blue-100 text-lg md:text-xl lg:text-2xl max-w-3xl leading-relaxed drop-shadow-md">
            {{ __('messages.our_products_desc') }}
        </p>
    </div>

    {{-- Bande jaune --}}
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500"></div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- FILTRES PAR CATÉGORIE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
@if($categories->isNotEmpty())
<section class="bg-white border-b shadow-sm sticky top-[88px] z-30">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-wrap gap-2 justify-center items-center">

        <span class="text-sm text-gray-500 mr-2 hidden md:inline">Filtrer :</span>

        <a href="{{ route('products.index') }}"
           class="px-5 py-2 rounded-full text-sm font-semibold transition
                  {{ !request('category') ? 'bg-blue-900 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-blue-100 hover:text-blue-900' }}">
            📦 Tous les produits
        </a>

        @foreach($categories as $cat)
            <a href="{{ route('products.index') }}?category={{ $cat->slug }}"
               class="px-5 py-2 rounded-full text-sm font-semibold transition
                      {{ request('category') === $cat->slug ? 'bg-blue-900 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-blue-100 hover:text-blue-900' }}">
                {{ $cat->name }}
            </a>
        @endforeach

    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- GRILLE DE PRODUITS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-16">

    @if($products->isEmpty())
        <div class="text-center py-20 text-gray-500">
            <div class="text-6xl mb-4">📦</div>
            <p class="text-xl">Aucun produit pour le moment.</p>
            <p class="text-sm mt-2">Revenez bientôt pour découvrir nos nouveautés.</p>
        </div>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $product)

                @php
                    $imgSrc = null;
                    $nameLower = strtolower($product->name);

                    if ($product->image) {
                        $imgSrc = asset('storage/' . $product->image);
                    } elseif (str_contains($nameLower, 'cem i ') && !str_contains($nameLower, 'cem ii')) {
                        $imgSrc = asset('images/produits/ciment-cem1-vert.webp');
                    } elseif (str_contains($nameLower, 'cem ii')) {
                        $imgSrc = asset('images/produits/ciment-cem2-bleu.webp');
                    }
                @endphp

                <a href="{{ route('products.show', $product->slug) }}"
                   class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition duration-300 group flex flex-col border border-gray-100">

                    {{-- Image produit --}}
                    <div class="relative h-72 bg-gradient-to-br from-gray-50 via-white to-gray-100 flex items-center justify-center overflow-hidden p-6">

                        @if($imgSrc)
                            <img src="{{ $imgSrc }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-contain group-hover:scale-110 transition duration-500 drop-shadow-lg">
                        @else
                            <div class="text-8xl opacity-20">🏭</div>
                        @endif

                        {{-- Badge Phare --}}
                        @if($product->is_featured)
                            <span class="absolute top-4 right-4 bg-gradient-to-r from-yellow-500 to-yellow-400 text-blue-900 text-xs font-extrabold px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1">
                                ⭐ PHARE
                            </span>
                        @endif

                        {{-- Badge Catégorie --}}
                        @if($product->category)
                            <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-blue-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-md">
                                {{ $product->category->name }}
                            </span>
                        @endif

                    </div>

                    {{-- Contenu --}}
                    <div class="p-6 flex-1 flex flex-col border-t border-gray-100">

                        <h3 class="text-xl font-bold text-blue-900 mb-3 group-hover:text-blue-700 transition leading-snug">
                            {{ $product->name }}
                        </h3>

                        <p class="text-gray-600 text-sm mb-5 flex-1 leading-relaxed">
                            {{ Str::limit($product->description, 110) }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">

                            <span class="text-blue-700 font-bold text-sm group-hover:underline flex items-center gap-1">
                                {{ __('messages.read_more') }}
                                <span class="group-hover:translate-x-1 transition">→</span>
                            </span>

                            <span class="text-xs text-gray-400 bg-gray-50 px-3 py-1 rounded-full">
                                🇹🇳 CIOK
                            </span>

                        </div>

                    </div>
                </a>
            @endforeach
        </div>
    @endif

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BANNIÈRE CERTIFICATIONS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-14">
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
{{-- CTA DEVIS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-white py-16">
    <div class="max-w-4xl mx-auto text-center px-4">

        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            BESOIN D'AIDE ?
        </div>

        <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">
            Besoin d'un devis ou d'informations ?
        </h2>

        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
            Notre équipe commerciale est à votre disposition pour vous conseiller
            sur le choix de nos produits et répondre à toutes vos questions.
        </p>

        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('contact.show') }}"
               class="bg-blue-900 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-800 transition shadow-lg hover:-translate-y-1 flex items-center gap-2">
                ✉️ {{ __('messages.contact_us') }}
            </a>
            <a href="tel:+21678253816"
               class="bg-yellow-500 text-blue-900 px-8 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition shadow-lg hover:-translate-y-1 flex items-center gap-2">
                📞 +216 78 253 816
            </a>
        </div>

    </div>
</section>

@endsection