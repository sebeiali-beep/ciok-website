@extends('layouts.site')
@section('title', __('messages.about') . ' - CIOK')
@section('meta_description', 'Découvrez la CIOK - Société des Ciments d\'Oum El Kelil. Acteur industriel majeur en Tunisie depuis 1979. Notre histoire, mission et valeurs.')
@section('og_image', asset('images/usine-flag.webp'))
@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BANNER --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden" style="min-height: 500px;">
    <div class="absolute inset-0">
        <img src="{{ asset('images/aerien.webp') }}" alt="CIOK" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/95 to-blue-900/70"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-32 flex flex-col justify-center" style="min-height: 500px;">

        <div class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 text-xs font-bold px-4 py-1.5 rounded-full mb-6 w-fit shadow-lg">
            🏢 QUI SOMMES-NOUS
        </div>
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">{{ __('messages.about') }}</h1>
        <p class="text-blue-100 text-lg md:text-xl max-w-3xl leading-relaxed">
            Découvrez l'histoire, la mission et les valeurs de la Société des Ciments d'Oum El Kelil
        </p>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500"></div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- PRÉSENTATION --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-20 grid lg:grid-cols-2 gap-12 items-center reveal">

    <div>
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            NOTRE HISTOIRE
        </div>

        <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6 leading-tight">
            Un acteur clé dans la production de <span class="text-yellow-500">ciment de qualité</span>
        </h2>

        <p class="text-gray-700 leading-relaxed mb-4">
            La <strong>Société des Ciments d'Oum El Khelil (CIOK)</strong> est une entreprise industrielle
            spécialisée dans la production de ciment destiné aux secteurs du bâtiment et des travaux publics.
        </p>

        <p class="text-gray-700 leading-relaxed mb-4">
            Elle s'appuie sur un <strong>savoir-faire reconnu</strong>, des équipements performants
            et un engagement permanent en faveur de la <strong>qualité</strong>, de la <strong>sécurité</strong>
            et du <strong>respect de l'environnement</strong>.
        </p>

        <p class="text-gray-700 leading-relaxed mb-6">
            Sa mission est d'accompagner le développement des infrastructures en proposant des
            produits fiables, conformes aux normes en vigueur et adaptés aux besoins de ses partenaires.
        </p>

        <a href="{{ route('products.index') }}"
           class="inline-flex items-center gap-2 bg-blue-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition hover:-translate-y-1">
            🏭 Nos produits →
        </a>
    </div>

   <div class="space-y-4">

    {{-- Bloc PDG : photo + bandeau --}}
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="relative w-full overflow-hidden bg-gray-100">
            <img src="{{ asset('images/pdg.webp') }}"
                 alt="Taoufik KHARDANI - PDG CIOK"
                 class="w-full object-contain"
                 style="max-height: 400px;">
        </div>
        <div class="py-4 px-4 text-center bg-gradient-to-r from-blue-900 to-blue-800">
            <h3 class="font-bold text-white text-xl tracking-wide">TAOUFIK KHARDANI</h3>
            <p class="text-blue-200 text-sm mt-1">Président Directeur Général</p>
        </div>
    </div>

    {{-- Deux images côte à côte avec effet zoom --}}
    <div class="grid grid-cols-2 gap-4">
        <div class="rounded-2xl shadow-xl overflow-hidden group cursor-pointer">
            <img src="{{ asset('images/usine-panorama.webp') }}"
                 alt="Usine CIOK"
                 class="w-full h-56 object-cover group-hover:scale-110 transition duration-700">
        </div>
        <div class="rounded-2xl shadow-xl overflow-hidden group cursor-pointer">
            <img src="{{ asset('images/aerien.webp') }}"
                 alt="Vue aérienne"
                 class="w-full h-56 object-cover group-hover:scale-110 transition duration-700">
        </div>
    </div>

</div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CHIFFRES CLÉS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-16 reveal">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">

        <div>
            <div class="text-5xl font-extrabold text-yellow-400">1979</div>
            <div class="mt-2 text-blue-200 text-sm uppercase tracking-wider">Année de création</div>
        </div>
        <div>
            <div class="text-5xl font-extrabold text-yellow-400">700+</div>
            <div class="mt-2 text-blue-200 text-sm uppercase tracking-wider">Collaborateurs</div>
        </div>
        <div>
            <div class="text-5xl font-extrabold text-yellow-400">1M+</div>
            <div class="mt-2 text-blue-200 text-sm uppercase tracking-wider">Tonnes / an</div>
        </div>
        <div>
            <div class="text-5xl font-extrabold text-yellow-400">ISO</div>
            <div class="mt-2 text-blue-200 text-sm uppercase tracking-wider">9001 Certifié</div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- TIMELINE / HISTOIRE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-5xl mx-auto px-4 py-20 reveal">

    <div class="text-center mb-12">
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            📅 NOTRE PARCOURS
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-3">Notre histoire</h2>
        <p class="text-gray-600">Plus de 45 ans au service du bâtiment tunisien</p>
    </div>

    <div class="relative">
        {{-- Ligne verticale --}}
        <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-blue-200 hidden md:block"></div>

        <div class="space-y-8">

            {{-- 1979 --}}
            <div class="relative flex gap-6 items-start">
                <div class="w-16 h-16 bg-blue-900 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 z-10 shadow-lg">
                    1979
                </div>
                <div class="flex-1 bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <h3 class="font-bold text-blue-900 text-lg mb-2">Création de la CIOK</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Fondation de la Société des Ciments d'Oum El Khelil à Tajerouine dans le gouvernorat du Kef.
                    </p>
                </div>
            </div>

            {{-- 1990 --}}
            <div class="relative flex gap-6 items-start">
                <div class="w-16 h-16 bg-blue-900 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 z-10 shadow-lg">
                    1990
                </div>
                <div class="flex-1 bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <h3 class="font-bold text-blue-900 text-lg mb-2">Modernisation</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Investissement dans de nouveaux équipements industriels et augmentation de la capacité de production.
                    </p>
                </div>
            </div>

            {{-- 2005 --}}
            <div class="relative flex gap-6 items-start">
                <div class="w-16 h-16 bg-blue-900 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 z-10 shadow-lg">
                    2005
                </div>
                <div class="flex-1 bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <h3 class="font-bold text-blue-900 text-lg mb-2">Certification ISO 9001</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Obtention de la certification ISO 9001 reconnaissant l'excellence de nos processus qualité.
                    </p>
                </div>
            </div>

            {{-- 2026 --}}
            <div class="relative flex gap-6 items-start">
                <div class="w-16 h-16 bg-yellow-500 text-blue-900 rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 z-10 shadow-lg">
                    2026
                </div>
                <div class="flex-1 bg-blue-50 rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                    <h3 class="font-bold text-blue-900 text-lg mb-2">Aujourd'hui</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Un acteur majeur du marché tunisien du ciment, avec plus de 700 collaborateurs
                        et une capacité de production d'un million de tonnes par an.
                    </p>
                </div>
            </div>

        </div>
    </div>

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- MISSION / VISION / VALEURS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-20 reveal">

    <div class="max-w-7xl mx-auto px-4">

        <div class="text-center mb-12">
            <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-4">
                NOS PRIORITÉS
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-3">Notre engagement</h2>
            <p class="text-gray-600">Trois piliers fondent notre action quotidienne</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow-md p-8 hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-blue-900">
                <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center text-3xl mb-5">🎯</div>
                <h3 class="text-xl font-bold text-blue-900 mb-3">Notre mission</h3>
                <p class="text-gray-600 leading-relaxed">
                    Accompagner le développement des infrastructures tunisiennes en fournissant
                    des ciments de haute qualité, conformes aux normes nationales et internationales.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-8 hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-yellow-500">
                <div class="w-16 h-16 bg-yellow-100 rounded-xl flex items-center justify-center text-3xl mb-5">👁️</div>
                <h3 class="text-xl font-bold text-blue-900 mb-3">Notre vision</h3>
                <p class="text-gray-600 leading-relaxed">
                    Être un acteur industriel de référence en Tunisie, reconnu pour son excellence,
                    son innovation et son engagement en faveur du développement durable.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-8 hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-green-600">
                <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center text-3xl mb-5">💎</div>
                <h3 class="text-xl font-bold text-blue-900 mb-3">Nos valeurs</h3>
                <ul class="text-gray-600 space-y-2">
                    <li class="flex items-center gap-2">✦ Excellence industrielle</li>
                    <li class="flex items-center gap-2">✦ Sécurité et qualité</li>
                    <li class="flex items-center gap-2">✦ Respect de l'environnement</li>
                    <li class="flex items-center gap-2">✦ Engagement partenaires</li>
                </ul>
            </div>

        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- LOCALISATION --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-20 grid lg:grid-cols-2 gap-12 items-center reveal">

    <div class="img-zoom rounded-2xl shadow-xl overflow-hidden">
        <img src="{{ asset('images/entree.webp') }}" alt="Entrée usine CIOK" class="w-full h-96 object-cover">
    </div>

    <div>
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            📍 NOTRE SITE
        </div>
        <h2 class="text-3xl font-bold text-blue-900 mb-6">Un site industriel stratégique</h2>

        <p class="text-gray-700 leading-relaxed mb-4">
            Située à <strong>Tajerouine, dans le gouvernorat du Kef</strong>, notre usine
            bénéficie d'une position stratégique au cœur de la Tunisie et d'un accès
            privilégié aux carrières de calcaire et de marne.
        </p>

        <ul class="text-gray-700 space-y-3 mt-6">
            <li class="flex items-center gap-3">
                <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm flex-shrink-0">🏭</span>
                Site de production moderne
            </li>
            <li class="flex items-center gap-3">
                <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm flex-shrink-0">🌍</span>
                Proximité des matières premières
            </li>
            <li class="flex items-center gap-3">
                <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm flex-shrink-0">🚛</span>
                Réseau de distribution national
            </li>
        </ul>

        <a href="{{ route('contact.show') }}"
           class="inline-flex items-center gap-2 bg-blue-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition mt-8 hover:-translate-y-1">
            ✉️ {{ __('messages.contact_us') }}
        </a>
    </div>

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- GALERIE PHOTOS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-16 reveal">
    <div class="max-w-7xl mx-auto px-4">

        <div class="text-center mb-10">
            <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-3">
                📸 GALERIE
            </div>
            <h2 class="text-3xl font-bold text-blue-900">Notre usine en images</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="img-zoom rounded-xl overflow-hidden shadow-md col-span-2 md:col-span-2">
                <img src="{{ asset('images/aerien.webp') }}" class="w-full h-64 object-cover" alt="Vue aérienne">
            </div>
            <div class="img-zoom rounded-xl overflow-hidden shadow-md">
                <img src="{{ asset('images/silos.webp') }}" class="w-full h-64 object-cover" alt="Silos">
            </div>
            <div class="img-zoom rounded-xl overflow-hidden shadow-md">
                <img src="{{ asset('images/usine-panorama.webp') }}" class="w-full h-64 object-cover" alt="Usine">
            </div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CTA FINAL --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero.webp') }}" alt="CIOK" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-blue-950/90"></div>
    </div>
    <div class="relative max-w-4xl mx-auto text-center px-4 py-20">
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            COLLABORONS
        </div>
        <h2 class="text-3xl md:text-4xl font-extrabold mb-6">
            Envie de travailler avec nous ?
        </h2>
        <p class="text-blue-100 text-lg mb-8">
            Notre équipe commerciale est à votre disposition.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('contact.show') }}"
               class="bg-yellow-500 text-blue-900 px-8 py-3 rounded-lg font-bold hover:bg-yellow-400 transition shadow-lg hover:-translate-y-1">
                ✉️ {{ __('messages.contact_us') }}
            </a>
            <a href="{{ route('products.index') }}"
               class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-900 transition hover:-translate-y-1">
                🏭 Nos produits
            </a>
        </div>
    </div>
</section>

@endsection