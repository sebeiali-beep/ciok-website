@extends('layouts.site')
@section('title', __('messages.contact') . ' - CIOK')
@section('meta_description', 'Contactez la CIOK - Siège à Le Kef, antenne à Tunis. Téléphone : +216 78 253 816. Formulaire de contact en ligne.')
@section('og_image', asset('images/entree.webp'))
@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BANNER --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/entree.webp') }}" alt="Contact CIOK" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/95 to-blue-900/70"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-24">
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            ✉️ CONTACT
        </div>
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">{{ __('messages.contact_us') }}</h1>
        <p class="text-blue-100 text-lg md:text-xl max-w-3xl leading-relaxed">
            Notre équipe est à votre disposition pour répondre à toutes vos questions
        </p>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500"></div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CARTES DE CONTACT RAPIDE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 -mt-12 relative z-10">
    <div class="grid md:grid-cols-3 gap-6">

        <a href="tel:+21678253816"
           class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-blue-900 group">
            <div class="w-14 h-14 bg-blue-100 text-blue-900 rounded-full flex items-center justify-center text-2xl mx-auto mb-4 group-hover:scale-110 transition">
                📞
            </div>
            <h3 class="font-bold text-blue-900 mb-1">Téléphone</h3>
            <p class="text-gray-600 text-sm">+216 78 253 816</p>
        </a>

        <a href="mailto:commercial@ciok.com.tn"
           class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-yellow-500 group">
            <div class="w-14 h-14 bg-yellow-100 text-yellow-700 rounded-full flex items-center justify-center text-2xl mx-auto mb-4 group-hover:scale-110 transition">
                ✉️
            </div>
            <h3 class="font-bold text-blue-900 mb-1">Email commercial</h3>
            <p class="text-gray-600 text-sm">commercial@ciok.com.tn</p>
        </a>

        <a href="mailto:rh@ciok.com.tn"
           class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-green-600 group">
            <div class="w-14 h-14 bg-green-100 text-green-700 rounded-full flex items-center justify-center text-2xl mx-auto mb-4 group-hover:scale-110 transition">
                💼
            </div>
            <h3 class="font-bold text-blue-900 mb-1">Ressources humaines</h3>
            <p class="text-gray-600 text-sm">grh@ciok.com.tn</p>
        </a>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- FORMULAIRE + ADRESSES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-16 grid lg:grid-cols-2 gap-12">

    {{-- Formulaire --}}
    <div>
        <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-4">
            📝 FORMULAIRE
        </div>
        <h2 class="text-3xl font-bold text-blue-900 mb-6">Envoyez-nous un message</h2>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-4 rounded mb-6 flex items-start gap-3">
                <span class="text-2xl">✅</span>
                <div>
                    <strong class="block mb-1">Message envoyé avec succès !</strong>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST" class="bg-white shadow-md rounded-2xl p-6 space-y-5">
            @csrf

            {{-- Nom + Email --}}
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold mb-2 text-sm text-gray-700">
                        {{ __('messages.your_name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           placeholder="Votre nom complet"
                           class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition @error('name') border-red-300 @enderror"
                           required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block font-semibold mb-2 text-sm text-gray-700">
                        {{ __('messages.your_email') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="votre@email.com"
                           class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition @error('email') border-red-300 @enderror"
                           required>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Téléphone --}}
            <div>
                <label class="block font-semibold mb-2 text-sm text-gray-700">
                    {{ __('messages.your_phone') }}
                </label>
                <input type="tel" name="phone" value="{{ old('phone') }}"
                       placeholder="+216 XX XXX XXX"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">
            </div>

            {{-- Sujet --}}
            <div>
                <label class="block font-semibold mb-2 text-sm text-gray-700">
                    {{ __('messages.subject') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" name="subject" value="{{ old('subject') }}"
                       placeholder="Objet de votre message"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition @error('subject') border-red-300 @enderror"
                       required>
                @error('subject') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Message --}}
            <div>
                <label class="block font-semibold mb-2 text-sm text-gray-700">
                    {{ __('messages.message') }} <span class="text-red-500">*</span>
                </label>
                <textarea name="message" rows="6"
                          placeholder="Décrivez votre demande..."
                          class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition @error('message') border-red-300 @enderror"
                          required>{{ old('message') }}</textarea>
                @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Bouton --}}
            <button type="submit"
                    class="w-full bg-blue-900 text-white py-4 rounded-lg font-bold hover:bg-blue-800 transition shadow-md flex items-center justify-center gap-2">
                ✉️ {{ __('messages.send_message') }}
            </button>

            <p class="text-xs text-gray-500 text-center">
                * Champs obligatoires — Vos données ne seront jamais partagées.
            </p>

        </form>
    </div>

    {{-- Coordonnées --}}
    <div>
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            📍 NOUS TROUVER
        </div>
        <h2 class="text-3xl font-bold text-blue-900 mb-6">Nos coordonnées</h2>

        <div class="space-y-4">

            {{-- Siège Kef --}}
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-900">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-900 rounded-lg flex items-center justify-center text-2xl flex-shrink-0">
                        🏭
                    </div>
                    <div>
                        <h3 class="font-bold text-blue-900 mb-2">Siège Kef</h3>
                        <p class="text-gray-700 text-sm leading-relaxed">
                            Cité des Jardins<br>
                            BP 94 — 7100 Le Kef, Tunisie
                        </p>
                    </div>
                </div>
            </div>

            {{-- Antenne Tunis --}}
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-700 rounded-lg flex items-center justify-center text-2xl flex-shrink-0">
                        🏢
                    </div>
                    <div>
                        <h3 class="font-bold text-blue-900 mb-2">Antenne Tunis</h3>
                        <p class="text-gray-700 text-sm leading-relaxed">
                            Rue de Cologne<br>
                            Tunis, Tunisie
                        </p>
                    </div>
                </div>
            </div>

            {{-- Usine --}}
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-600">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-green-100 text-green-700 rounded-lg flex items-center justify-center text-2xl flex-shrink-0">
                        🏗️
                    </div>
                    <div>
                        <h3 class="font-bold text-blue-900 mb-2">Usine de production</h3>
                        <p class="text-gray-700 text-sm leading-relaxed">
                            Route de Tajerouine<br>
                            Le Kef, Tunisie
                        </p>
                        <a href="tel:+21678253816" class="text-blue-700 font-semibold hover:underline text-sm mt-2 inline-block">
                            📞 +216 78 253 816
                        </a>
                    </div>
                </div>
            </div>

        </div>

        {{-- Carte Google Maps --}}
        <div class="mt-6 rounded-xl overflow-hidden shadow-md">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3200.0!2d8.5!3d35.9!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzXCsDU0JzAwLjAiTiA4wrAzMCcwMC4wIkU!5e0!3m2!1sfr!2stn!4v1234567890"
                width="100%"
                height="300"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

    </div>

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- HORAIRES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-16 reveal">
    <div class="max-w-4xl mx-auto px-4">

        <div class="text-center mb-10">
            <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-3">
                🕐 HORAIRES
            </div>
            <h2 class="text-3xl font-bold text-blue-900">Horaires d'ouverture</h2>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="grid md:grid-cols-2">

                <div class="p-6 border-b md:border-b-0 md:border-r border-gray-100">
                    <h3 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
                        🏢 Bureaux administratifs
                    </h3>
                    <div class="text-gray-700 text-sm space-y-1">
                        <div class="flex justify-between">
                            <span>Lundi — Vendredi :</span>
                            <strong>08h00 — 17h00</strong>
                        </div>
                        <div class="flex justify-between">
                            <span>Samedi :</span>
                            <strong>08h00 — 12h00</strong>
                        </div>
                        <div class="flex justify-between">
                            <span>Dimanche :</span>
                            <strong class="text-red-500">Fermé</strong>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
                        🏭 Usine de production
                    </h3>
                    <div class="text-gray-700 text-sm space-y-1">
                        <div class="flex justify-between">
                            <span>Production :</span>
                            <strong>24h/24 — 7j/7</strong>
                        </div>
                        <div class="flex justify-between">
                            <span>Service commercial :</span>
                            <strong>08h00 — 16h30</strong>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CTA --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-16">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-4">Besoin d'une information urgente ?</h2>
        <p class="text-blue-100 mb-8 text-lg">
            Appelez-nous directement, notre équipe vous répondra immédiatement.
        </p>
        <a href="tel:+21678253816"
           class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 px-8 py-3 rounded-lg font-bold hover:bg-yellow-400 transition shadow-lg hover:-translate-y-1 text-lg">
            📞 +216 78 253 816
        </a>
    </div>
</section>

@endsection