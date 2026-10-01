@extends('layouts.site')
@section('title', __('messages.quality') . ' - CIOK')
@section('meta_description', __('messages.quality_intro'))
@section('og_image', asset('images/labo.webp'))
@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BANNER --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden" style="min-height: 500px;">
    <div class="absolute inset-0">
        <img src="{{ asset('images/labo.webp') }}"
             alt="{{ __('messages.quality') }} CIOK"
             class="w-full h-full object-cover scale-110"
             style="filter: blur(3px) brightness(0.9); object-position: center;">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/85 via-blue-900/70 to-blue-800/50"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 py-32 flex flex-col justify-center" style="min-height: 500px;">
        <div class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 text-xs font-bold px-4 py-1.5 rounded-full mb-6 w-fit shadow-lg">
            {{ __('messages.quality_badge') }}
        </div>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight drop-shadow-lg">
            {{ __('messages.quality') }}
        </h1>
        <p class="text-blue-100 text-lg md:text-xl lg:text-2xl max-w-3xl leading-relaxed drop-shadow-md">
            {{ __('messages.quality_intro') }}
        </p>
    </div>

    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500"></div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- INTRO --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-5xl mx-auto px-4 py-16 text-center reveal">
    <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-4">
        {{ __('messages.quality_engagement_badge') }}
    </div>
    <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6 leading-tight">
        {{ __('messages.quality_engagement_title') }}
    </h2>
    <p class="text-gray-700 leading-relaxed text-lg max-w-3xl mx-auto">
        {{ __('messages.quality_engagement_desc') }}
    </p>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CERTIFICATIONS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-16 reveal">
    <div class="max-w-7xl mx-auto px-4">

        <div class="text-center mb-12">
            <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-3">
                {{ __('messages.quality_certifications_badge') }}
            </div>
            <h2 class="text-3xl font-bold text-blue-900">{{ __('messages.quality_certifications_title') }}</h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-blue-900">
                <div class="text-5xl mb-4">🏆</div>
                <h3 class="font-bold text-blue-900 mb-2 text-lg">{{ __('messages.quality_cert_iso') }}</h3>
                <p class="text-gray-600 text-sm">{{ __('messages.quality_cert_iso_desc') }}</p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-green-600">
                <div class="text-5xl mb-4">🇹🇳</div>
                <h3 class="font-bold text-blue-900 mb-2 text-lg">{{ __('messages.quality_cert_nt') }}</h3>
                <p class="text-gray-600 text-sm">{{ __('messages.quality_cert_nt_desc') }}</p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-yellow-500">
                <div class="text-5xl mb-4">🌍</div>
                <h3 class="font-bold text-blue-900 mb-2 text-lg">{{ __('messages.quality_cert_en') }}</h3>
                <p class="text-gray-600 text-sm">{{ __('messages.quality_cert_en_desc') }}</p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-purple-600">
                <div class="text-5xl mb-4">✅</div>
                <h3 class="font-bold text-blue-900 mb-2 text-lg">{{ __('messages.quality_cert_ce') }}</h3>
                <p class="text-gray-600 text-sm">{{ __('messages.quality_cert_ce_desc') }}</p>
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
            {{ __('messages.quality_lab_badge') }}
        </div>
        <h2 class="text-3xl font-bold text-blue-900 mb-6">{{ __('messages.quality_control_title') }}</h2>

        <p class="text-gray-700 leading-relaxed mb-6">
            {{ __('messages.quality_control_desc') }}
        </p>

        <ul class="space-y-4">
            <li class="flex items-start gap-3">
                <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm flex-shrink-0 mt-0.5">✓</span>
                <div>
                    <strong class="text-blue-900">{{ __('messages.quality_control_li1_title') }}</strong>
                    <p class="text-sm text-gray-600">{{ __('messages.quality_control_li1_desc') }}</p>
                </div>
            </li>
            <li class="flex items-start gap-3">
                <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm flex-shrink-0 mt-0.5">✓</span>
                <div>
                    <strong class="text-blue-900">{{ __('messages.quality_control_li2_title') }}</strong>
                    <p class="text-sm text-gray-600">{{ __('messages.quality_control_li2_desc') }}</p>
                </div>
            </li>
            <li class="flex items-start gap-3">
                <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm flex-shrink-0 mt-0.5">✓</span>
                <div>
                    <strong class="text-blue-900">{{ __('messages.quality_control_li3_title') }}</strong>
                    <p class="text-sm text-gray-600">{{ __('messages.quality_control_li3_desc') }}</p>
                </div>
            </li>
        </ul>
    </div>

    <div class="img-zoom rounded-2xl shadow-xl overflow-hidden">
        <img src="{{ asset('images/aerien.webp') }}" alt="{{ __('messages.quality_control_title') }}" class="w-full h-96 object-cover">
    </div>

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- PROCESSUS QUALITÉ --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-blue-900 text-white py-20 reveal">
    <div class="max-w-7xl mx-auto px-4">

        <div class="text-center mb-12">
            <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-3">
                {{ __('messages.quality_process_badge') }}
            </div>
            <h2 class="text-3xl font-bold mb-3">{{ __('messages.quality_process_title') }}</h2>
            <p class="text-blue-200">{{ __('messages.quality_process_subtitle') }}</p>
        </div>

        <div class="grid md:grid-cols-4 gap-6">

            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-500 text-blue-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">1</div>
                <h3 class="font-bold mb-2">{{ __('messages.quality_step1') }}</h3>
                <p class="text-blue-200 text-sm">{{ __('messages.quality_step1_desc') }}</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-500 text-blue-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">2</div>
                <h3 class="font-bold mb-2">{{ __('messages.quality_step2') }}</h3>
                <p class="text-blue-200 text-sm">{{ __('messages.quality_step2_desc') }}</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-500 text-blue-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">3</div>
                <h3 class="font-bold mb-2">{{ __('messages.quality_step3') }}</h3>
                <p class="text-blue-200 text-sm">{{ __('messages.quality_step3_desc') }}</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-500 text-blue-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">4</div>
                <h3 class="font-bold mb-2">{{ __('messages.quality_step4') }}</h3>
                <p class="text-blue-200 text-sm">{{ __('messages.quality_step4_desc') }}</p>
            </div>

        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CTA --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-4xl mx-auto px-4 py-16 text-center">
    <h2 class="text-3xl font-bold text-blue-900 mb-4">{{ __('messages.quality_cta_title') }}</h2>
    <p class="text-gray-600 mb-8">{{ __('messages.quality_cta_desc') }}</p>
    <a href="{{ route('contact.show') }}"
       class="inline-flex items-center gap-2 bg-blue-900 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-800 transition hover:-translate-y-1">
        ✉️ {{ __('messages.contact_us') }}
    </a>
</section>

@endsection