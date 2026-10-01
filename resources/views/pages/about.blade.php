@extends('layouts.site')
@section('title', __('messages.about') . ' - CIOK')
@section('meta_description', __('messages.about_intro'))
@section('og_image', asset('images/usine-flag.webp'))
@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BANNER --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden" style="min-height: 500px;">
    <div class="absolute inset-0">
        <img src="{{ asset('images/aerien1.webp') }}"
             alt="{{ __('messages.about') }} CIOK"
             class="w-full h-full object-cover scale-110"
             style="filter: blur(3px) brightness(0.9); object-position: center;">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/85 via-blue-900/70 to-blue-800/50"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-32 flex flex-col justify-center" style="min-height: 500px;">

        <div class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 text-xs font-bold px-4 py-1.5 rounded-full mb-6 w-fit shadow-lg">
            {{ __('messages.about_badge') }}
        </div>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight drop-shadow-lg">
            {{ __('messages.about') }}
        </h1>
        <p class="text-blue-100 text-lg md:text-xl lg:text-2xl max-w-3xl leading-relaxed drop-shadow-md">
            {{ __('messages.about_intro') }}
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
            {{ __('messages.about_history_badge') }}
        </div>

        <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6 leading-tight">
            {{ __('messages.about_title_part1') }} <span class="text-yellow-500">{{ __('messages.about_title_part2') }}</span>
        </h2>

        <p class="text-gray-700 leading-relaxed mb-4">
            {!! __('messages.about_p1') !!}
        </p>

        <p class="text-gray-700 leading-relaxed mb-4">
            {!! __('messages.about_p2') !!}
        </p>

        <p class="text-gray-700 leading-relaxed mb-6">
            {{ __('messages.about_p3') }}
        </p>

        <a href="{{ route('products.index') }}"
           class="inline-flex items-center gap-2 bg-blue-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition hover:-translate-y-1">
            🏭 {{ __('messages.about_products_btn') }} →
        </a>
    </div>

   <div class="space-y-4">

    {{-- Bloc PDG : photo + bandeau --}}
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="relative w-full overflow-hidden bg-gray-100">
            <img src="{{ asset('images/pdg.webp') }}"
                 alt="Taoufik KHARDANI - {{ __('messages.pdg_title') }}"
                 class="w-full object-contain"
                 style="max-height: 400px;">
        </div>
        <div class="py-4 px-4 text-center bg-gradient-to-r from-blue-900 to-blue-800">
            <h3 class="font-bold text-white text-xl tracking-wide">TAOUFIK KHARDANI</h3>
            <p class="text-blue-200 text-sm mt-1">{{ __('messages.pdg_title') }}</p>
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
            <img src="{{ asset('images/aerien1.webp') }}"
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
            <div class="mt-2 text-blue-200 text-sm uppercase tracking-wider">{{ __('messages.key_stat_creation') }}</div>
        </div>
        <div>
            <div class="text-5xl font-extrabold text-yellow-400">700+</div>
            <div class="mt-2 text-blue-200 text-sm uppercase tracking-wider">{{ __('messages.key_stat_employees') }}</div>
        </div>
        <div>
            <div class="text-5xl font-extrabold text-yellow-400">1M+</div>
            <div class="mt-2 text-blue-200 text-sm uppercase tracking-wider">{{ __('messages.key_stat_tons') }}</div>
        </div>
        <div>
            <div class="text-5xl font-extrabold text-yellow-400">ISO</div>
            <div class="mt-2 text-blue-200 text-sm uppercase tracking-wider">9001 {{ __('messages.key_stat_iso') }}</div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- TIMELINE / HISTOIRE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-5xl mx-auto px-4 py-20 reveal">

    <div class="text-center mb-12">
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            {{ __('messages.about_timeline_badge') }}
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-3">{{ __('messages.about_timeline_title') }}</h2>
        <p class="text-gray-600">{{ __('messages.about_timeline_subtitle') }}</p>
    </div>

    <div class="relative">
        <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-blue-200 hidden md:block"></div>

        <div class="space-y-8">

            {{-- 1979 --}}
            <div class="relative flex gap-6 items-start">
                <div class="w-16 h-16 bg-blue-900 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 z-10 shadow-lg">
                    1979
                </div>
                <div class="flex-1 bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <h3 class="font-bold text-blue-900 text-lg mb-2">{{ __('messages.timeline_1979_title') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ __('messages.timeline_1979_desc') }}
                    </p>
                </div>
            </div>

            {{-- 1990 --}}
            <div class="relative flex gap-6 items-start">
                <div class="w-16 h-16 bg-blue-900 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 z-10 shadow-lg">
                    1990
                </div>
                <div class="flex-1 bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <h3 class="font-bold text-blue-900 text-lg mb-2">{{ __('messages.timeline_1990_title') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ __('messages.timeline_1990_desc') }}
                    </p>
                </div>
            </div>

            {{-- 2005 --}}
            <div class="relative flex gap-6 items-start">
                <div class="w-16 h-16 bg-blue-900 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 z-10 shadow-lg">
                    2005
                </div>
                <div class="flex-1 bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <h3 class="font-bold text-blue-900 text-lg mb-2">{{ __('messages.timeline_2005_title') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ __('messages.timeline_2005_desc') }}
                    </p>
                </div>
            </div>

            {{-- 2026 --}}
            <div class="relative flex gap-6 items-start">
                <div class="w-16 h-16 bg-yellow-500 text-blue-900 rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 z-10 shadow-lg">
                    2026
                </div>
                <div class="flex-1 bg-blue-50 rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                    <h3 class="font-bold text-blue-900 text-lg mb-2">{{ __('messages.timeline_2026_title') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ __('messages.timeline_2026_desc') }}
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
                {{ __('messages.about_priorities_badge') }}
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-3">{{ __('messages.about_priorities_title') }}</h2>
            <p class="text-gray-600">{{ __('messages.about_priorities_subtitle') }}</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow-md p-8 hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-blue-900">
                <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center text-3xl mb-5">🎯</div>
                <h3 class="text-xl font-bold text-blue-900 mb-3">{{ __('messages.about_mission_title') }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('messages.about_mission_desc') }}
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-8 hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-yellow-500">
                <div class="w-16 h-16 bg-yellow-100 rounded-xl flex items-center justify-center text-3xl mb-5">👁️</div>
                <h3 class="text-xl font-bold text-blue-900 mb-3">{{ __('messages.about_vision_title') }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('messages.about_vision_desc') }}
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-8 hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-green-600">
                <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center text-3xl mb-5">💎</div>
                <h3 class="text-xl font-bold text-blue-900 mb-3">{{ __('messages.about_values_title') }}</h3>
                <ul class="text-gray-600 space-y-2">
                    <li class="flex items-center gap-2">{{ __('messages.about_values_li1') }}</li>
                    <li class="flex items-center gap-2">{{ __('messages.about_values_li2') }}</li>
                    <li class="flex items-center gap-2">{{ __('messages.about_values_li3') }}</li>
                    <li class="flex items-center gap-2">{{ __('messages.about_values_li4') }}</li>
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
        <img src="{{ asset('images/entree.webp') }}" alt="{{ __('messages.about_site_title') }}" class="w-full h-96 object-cover">
    </div>

    <div>
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            {{ __('messages.about_site_badge') }}
        </div>
        <h2 class="text-3xl font-bold text-blue-900 mb-6">{{ __('messages.about_site_title') }}</h2>

        <p class="text-gray-700 leading-relaxed mb-4">
            {!! __('messages.about_site_desc') !!}
        </p>

        <ul class="text-gray-700 space-y-3 mt-6">
            <li class="flex items-center gap-3">
                <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm flex-shrink-0">🏭</span>
                {{ __('messages.about_site_li1') }}
            </li>
            <li class="flex items-center gap-3">
                <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm flex-shrink-0">🌍</span>
                {{ __('messages.about_site_li2') }}
            </li>
            <li class="flex items-center gap-3">
                <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm flex-shrink-0">🚛</span>
                {{ __('messages.about_site_li3') }}
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
                {{ __('messages.about_gallery_badge') }}
            </div>
            <h2 class="text-3xl font-bold text-blue-900">{{ __('messages.about_gallery_title') }}</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="img-zoom rounded-xl overflow-hidden shadow-md col-span-2 md:col-span-2">
                <img src="{{ asset('images/aerien1.webp') }}" class="w-full h-64 object-cover" alt="Vue aérienne">
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
            {{ __('messages.about_cta_badge') }}
        </div>
        <h2 class="text-3xl md:text-4xl font-extrabold mb-6">
            {{ __('messages.about_cta_title') }}
        </h2>
        <p class="text-blue-100 text-lg mb-8">
            {{ __('messages.about_cta_desc') }}
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('contact.show') }}"
               class="bg-yellow-500 text-blue-900 px-8 py-3 rounded-lg font-bold hover:bg-yellow-400 transition shadow-lg hover:-translate-y-1">
                ✉️ {{ __('messages.contact_us') }}
            </a>
            <a href="{{ route('products.index') }}"
               class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-900 transition hover:-translate-y-1">
                🏭 {{ __('messages.about_products_btn') }}
            </a>
        </div>
    </div>
</section>

@endsection