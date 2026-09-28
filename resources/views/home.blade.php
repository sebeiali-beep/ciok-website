@extends('layouts.site')

@section('title', 'CIOK - ' . __('messages.welcome_title'))
@section('meta_description', 'CIOK - Société des Ciments d\'Oum El Kelil. Production de ciment, chaux et clinker de haute qualité en Tunisie depuis 1979.')
@section('og_image', asset('images/hero.webp'))

@section('content')
...

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- HERO SLIDER --}}
{{-- ═══════════════════════════════════════════════════════ --}}
@include('partials.hero-slider')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CHIFFRES CLÉS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">

        <div class="border-r border-gray-100 last:border-0">
            <div class="text-4xl md:text-5xl font-extrabold text-blue-900">
                <span data-counter data-target="1979">0</span>
            </div>
            <div class="text-xs md:text-sm text-gray-600 mt-2 uppercase tracking-wider">Année de création</div>
        </div>

        <div class="border-r border-gray-100 last:border-0">
            <div class="text-4xl md:text-5xl font-extrabold text-blue-900">
                <span data-counter data-target="700">0</span><span class="text-yellow-500">+</span>
            </div>
            <div class="text-xs md:text-sm text-gray-600 mt-2 uppercase tracking-wider">Collaborateurs</div>
        </div>

        <div class="border-r border-gray-100 last:border-0">
            <div class="text-4xl md:text-5xl font-extrabold text-blue-900">
                <span data-counter data-target="1">0</span>M<span class="text-yellow-500">+</span>
            </div>
            <div class="text-xs md:text-sm text-gray-600 mt-2 uppercase tracking-wider">Tonnes / an</div>
        </div>

        <div>
            <div class="text-4xl md:text-5xl font-extrabold text-blue-900">ISO</div>
            <div class="text-xs md:text-sm text-gray-600 mt-2 uppercase tracking-wider">9001 Certifié</div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- QUI SOMMES-NOUS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-20 grid lg:grid-cols-2 gap-12 items-center reveal">

    <div>
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            QUI SOMMES-NOUS
        </div>

        <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6 leading-tight">
            Un acteur clé dans la production de <span class="text-yellow-500">ciment de qualité</span>
        </h2>

        <p class="text-gray-700 leading-relaxed mb-4">
            La <strong>Société des Ciments d'Oum El Khelil (CIOK)</strong> est une entreprise industrielle
            spécialisée dans la production de ciment destiné aux secteurs du bâtiment et des travaux publics.
        </p>

        <p class="text-gray-700 leading-relaxed mb-6">
            Elle s'appuie sur un savoir-faire reconnu, des équipements performants et un engagement
            permanent en faveur de la qualité, de la sécurité et du respect de l'environnement.
        </p>

        <ul class="space-y-3 mb-8">
            <li class="flex items-center gap-3 text-gray-700">
                <span class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-xs">✓</span>
                Production conforme aux normes tunisiennes et internationales
            </li>
            <li class="flex items-center gap-3 text-gray-700">
                <span class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-xs">✓</span>
                Équipements industriels de dernière génération
            </li>
            <li class="flex items-center gap-3 text-gray-700">
                <span class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-xs">✓</span>
                Réseau de distribution national
            </li>
        </ul>

        <a href="{{ route('about') }}"
           class="inline-flex items-center gap-2 bg-blue-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition hover:-translate-y-1">
            {{ __('messages.learn_more') }} →
        </a>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="img-zoom rounded-xl shadow-lg col-span-2">
            <img src="{{ asset('images/silos.webp') }}" alt="Silos CIOK" class="w-full h-72 object-cover">
        </div>
        <div class="img-zoom rounded-xl shadow-lg">
            <img src="{{ asset('images/usine-panorama.webp') }}" alt="Usine CIOK" class="w-full h-40 object-cover">
        </div>
        <div class="img-zoom rounded-xl shadow-lg">
            <img src="{{ asset('images/aerien.webp') }}" alt="Vue aérienne" class="w-full h-40 object-cover">
        </div>
    </div>

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- PRODUITS PHARES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-4 reveal">

        <div class="text-center mb-12">
            <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-4">
                NOS PRODUITS
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">
                {{ __('messages.our_products') }}
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                {{ __('messages.our_products_desc') }}
            </p>
        </div>

        @if($featuredProducts->isEmpty())
            <p class="text-center text-gray-500 py-12">Aucun produit pour le moment.</p>
        @else
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($featuredProducts as $product)

                    @php
                        $imgSrc = null;
                        $nameLower = strtolower($product->name);

                        if ($product->image) {
                            $imgSrc = asset('storage/' . $product->image);
                        } elseif (str_contains($nameLower, 'cem i ') && !str_contains($nameLower, 'cem ii')) {
                            $imgSrc = asset('images/produits/ciment-cem1-vert.png');
                        } elseif (str_contains($nameLower, 'cem ii')) {
                            $imgSrc = asset('images/produits/ciment-cem2-bleu.png');
                        }
                    @endphp

                    <a href="{{ route('products.show', $product->slug) }}"
                       class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition duration-300 group flex flex-col border border-gray-100">

                        <div class="relative h-72 bg-gradient-to-br from-gray-50 via-white to-blue-50 flex items-center justify-center overflow-hidden p-6">

                            @if($imgSrc)
                                <img src="{{ $imgSrc }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-contain group-hover:scale-110 transition duration-500 drop-shadow-lg">
                            @else
                                <div class="text-7xl opacity-20">🏭</div>
                            @endif

                            @if($product->is_featured)
                                <span class="absolute top-3 right-3 bg-gradient-to-r from-yellow-500 to-yellow-400 text-blue-900 text-xs font-extrabold px-3 py-1.5 rounded-full shadow-lg">
                                    ⭐ PHARE
                                </span>
                            @endif

                            @if($product->category)
                                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-blue-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-md">
                                    {{ $product->category->name }}
                                </span>
                            @endif
                        </div>

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

        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2 bg-blue-900 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-800 transition hover:-translate-y-1">
                Voir tous nos produits →
            </a>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- ENGAGEMENTS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-20 reveal">

    <div class="text-center mb-12">
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            NOS ENGAGEMENTS
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">Qualité, environnement & sécurité</h2>
    </div>

    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white rounded-xl shadow-md p-8 hover:shadow-xl transition hover:-translate-y-2 border-t-4 border-blue-900">
            <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center text-3xl mb-4">✅</div>
            <h3 class="text-xl font-bold text-blue-900 mb-3">Qualité certifiée</h3>
            <p class="text-gray-600 text-sm leading-relaxed">
                Nos produits sont conformes aux normes tunisiennes et européennes (EN 197-1).
                Certification ISO 9001 pour l'ensemble de nos processus.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-8 hover:shadow-xl transition hover:-translate-y-2 border-t-4 border-green-600">
            <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center text-3xl mb-4">🌱</div>
            <h3 class="text-xl font-bold text-blue-900 mb-3">Respect de l'environnement</h3>
            <p class="text-gray-600 text-sm leading-relaxed">
                Engagement dans le programme national d'élimination des déchets PCB
                et investissements continus dans des technologies propres.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-8 hover:shadow-xl transition hover:-translate-y-2 border-t-4 border-yellow-500">
            <div class="w-16 h-16 bg-yellow-100 rounded-xl flex items-center justify-center text-3xl mb-4">🛡️</div>
            <h3 class="text-xl font-bold text-blue-900 mb-3">Sécurité maximale</h3>
            <p class="text-gray-600 text-sm leading-relaxed">
                Priorité absolue à la sécurité de nos collaborateurs avec des formations
                régulières et des équipements aux normes internationales.
            </p>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- ACTUALITÉS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gray-100 py-20">
    <div class="max-w-7xl mx-auto px-4 reveal">

        <div class="text-center mb-12">
            <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-4">
                ACTUALITÉS
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">
                {{ __('messages.latest_news') }}
            </h2>
            <p class="text-gray-600">{{ __('messages.latest_news_desc') }}</p>
        </div>

        @if($latestPosts->isEmpty())
            <p class="text-center text-gray-500 py-12">Aucune actualité pour le moment.</p>
        @else
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($latestPosts as $post)
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition duration-300 flex flex-col">

                        <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center overflow-hidden">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}"
                                     alt="{{ $post->title }}"
                                     class="w-full h-full object-cover hover:scale-110 transition duration-500">
                            @else
                                <div class="text-6xl opacity-30">📰</div>
                            @endif
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <p class="text-xs text-gray-500 mb-2 flex items-center gap-2">
                                <span>📅</span> {{ $post->published_at?->format('d/m/Y') }}
                            </p>
                            <h3 class="text-lg font-bold text-blue-900 mb-3 flex-1 leading-snug">
                                {{ $post->title }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($post->excerpt, 100) }}</p>
                            <a href="{{ route('posts.show', $post->slug) }}"
                               class="text-blue-700 font-semibold hover:underline">
                                {{ __('messages.read_more') }} →
                            </a>
                        </div>

                    </article>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center gap-2 bg-white border-2 border-blue-900 text-blue-900 px-8 py-3 rounded-lg font-semibold hover:bg-blue-900 hover:text-white transition hover:-translate-y-1">
                    Voir toutes les actualités →
                </a>
            </div>
        @endif

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- APPELS D'OFFRES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-20 reveal">

    <div class="bg-gradient-to-r from-blue-950 to-blue-800 rounded-2xl shadow-2xl p-8 md:p-12 text-white relative overflow-hidden">

        <div class="absolute top-0 right-0 text-9xl opacity-10 select-none">📋</div>

        <div class="relative grid lg:grid-cols-2 gap-8 items-center">
            <div>
                <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
                    MARCHÉ PUBLIC
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Appels d'offres en cours</h2>
                <p class="text-blue-100 mb-6 leading-relaxed">
                    Consultez nos appels d'offres et consultations élargies en cours.
                    Toutes les informations et documents sont disponibles en téléchargement.
                </p>
                <a href="#"
                   class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 px-6 py-3 rounded-lg font-bold hover:bg-yellow-400 transition shadow-lg hover:-translate-y-1">
                    📋 Voir les appels d'offres →
                </a>
            </div>

            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    Dernier appel d'offres
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-blue-200">N° :</span>
                        <span class="font-semibold">AO N° 16/2026</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-blue-200">Objet :</span>
                        <span class="font-semibold text-right">Acquisition voitures hybrides</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-blue-200">Date limite :</span>
                        <span class="font-semibold text-yellow-400">17/09/2026 — 13h00</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CTA CONTACT --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden reveal">
    <div class="absolute inset-0">
        <img src="{{ asset('images/entree.webp') }}" alt="Contact CIOK" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-blue-950/90"></div>
    </div>

    <div class="relative max-w-4xl mx-auto text-center px-4 py-20">
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            CONTACTEZ-NOUS
        </div>

        <h2 class="text-3xl md:text-5xl font-extrabold mb-6">
            {{ __('messages.contact_us') }}
        </h2>

        <p class="text-blue-100 text-lg mb-10 max-w-2xl mx-auto">
            Une question, un projet, une demande de devis ? Notre équipe commerciale
            est à votre disposition pour vous accompagner.
        </p>

        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('contact.show') }}"
               class="bg-yellow-500 text-blue-900 px-8 py-4 rounded-lg font-bold hover:bg-yellow-400 transition shadow-xl hover:-translate-y-1">
                ✉️ {{ __('messages.send_message') }}
            </a>
            <a href="tel:+21678253816"
               class="border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-blue-900 transition hover:-translate-y-1">
                📞 +216 78 253 816
            </a>
        </div>
    </div>
</section>

@endsection