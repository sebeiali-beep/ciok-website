@extends('layouts.site')
@section('title', $tender->reference . ' - Marché public CIOK')
@section('meta_description', Str::limit($tender->description ?? $tender->title, 155))
@section('og_type', 'article')
@section('og_image', asset('images/silos.webp'))
@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- FIL D'ARIANE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="bg-gray-100 border-b">
    <div class="max-w-7xl mx-auto px-4 py-3 text-sm flex items-center gap-2 flex-wrap">
        <a href="{{ route('home') }}" class="text-blue-700 hover:underline flex items-center gap-1">
            🏠 {{ __('messages.home') }}
        </a>
        <span class="text-gray-400">/</span>
        <a href="{{ route('tenders.index') }}" class="text-blue-700 hover:underline">
            Marché public
        </a>
        <span class="text-gray-400">/</span>
        <span class="text-gray-600 font-mono font-semibold">{{ $tender->reference }}</span>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- EN-TÊTE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-r from-blue-950 to-blue-800 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 text-[20rem] opacity-5 leading-none select-none pointer-events-none">📋</div>

    <div class="relative max-w-5xl mx-auto px-4 py-16">

        {{-- Badges --}}
        <div class="flex flex-wrap gap-3 mb-6">
            <span class="inline-flex items-center gap-1.5 text-xs font-bold px-4 py-1.5 rounded-full bg-yellow-500 text-blue-900 shadow-lg">
                @if($tender->type === 'appel_offre') 📄 APPEL D'OFFRE
                @elseif($tender->type === 'consultation') 💼 CONSULTATION
                @else 📢 CONSULTATION ÉLARGIE
                @endif
            </span>

            @if($tender->status === 'open')
                <span class="inline-flex items-center gap-1.5 bg-green-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                    <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                    EN COURS
                </span>
            @elseif($tender->status === 'awarded')
                <span class="inline-flex items-center gap-1.5 bg-blue-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                    ✅ ATTRIBUÉ
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 bg-gray-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                    🔒 CLÔTURÉ
                </span>
            @endif
        </div>

        {{-- Référence --}}
        <div class="text-yellow-400 font-mono font-extrabold text-xl mb-4 tracking-wider">
            {{ $tender->reference }}
        </div>

        {{-- Titre --}}
        <h1 class="text-3xl md:text-5xl font-extrabold mb-6 leading-tight drop-shadow-lg">
            {{ $tender->title }}
        </h1>

        {{-- Description --}}
        @if($tender->description)
            <p class="text-blue-100 text-lg leading-relaxed max-w-3xl">
                {{ $tender->description }}
            </p>
        @endif

    </div>

    <div class="h-1 bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500"></div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CONTENU --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-5xl mx-auto px-4 py-12">

    <div class="grid md:grid-cols-2 gap-6 mb-10">

        {{-- Carte : Dates importantes --}}
        <div class="bg-white rounded-2xl shadow-md p-6 border-t-4 border-blue-900 hover:shadow-xl transition">
            <h3 class="text-lg font-bold text-blue-900 mb-6 flex items-center gap-2">
                <span class="text-2xl">📅</span> Dates importantes
            </h3>

            @if($tender->deadline_date)
                <div class="mb-6 pb-6 border-b border-gray-100">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 bg-blue-100 text-blue-900 rounded-xl flex items-center justify-center text-xl flex-shrink-0">
                            ⏰
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 mb-1">Date limite de dépôt</div>
                            <div class="font-bold text-xl text-blue-900">
                                {{ $tender->deadline_date->format('d/m/Y') }}
                            </div>
                            @if($tender->deadline_time)
                                <div class="text-sm text-gray-600 mt-1">
                                    avant <strong>{{ \Carbon\Carbon::parse($tender->deadline_time)->format('H\hi') }}</strong>
                                </div>
                            @endif
                            @if($tender->is_open)
                                <div class="mt-2 inline-flex items-center gap-1 bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded-full">
                                    🟢 Encore ouvert
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if($tender->opening_date)
                <div>
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 bg-green-100 text-green-700 rounded-xl flex items-center justify-center text-xl flex-shrink-0">
                            📂
                        </div>
                        <div>
                            <div class="text-sm text-gray-500 mb-1">Ouverture des plis</div>
                            <div class="font-bold text-xl text-blue-900">
                                {{ $tender->opening_date->format('d/m/Y') }}
                            </div>
                            @if($tender->opening_time)
                                <div class="text-sm text-gray-600 mt-1">
                                    à <strong>{{ \Carbon\Carbon::parse($tender->opening_time)->format('H\hi') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Carte : Documents --}}
        <div class="bg-white rounded-2xl shadow-md p-6 border-t-4 border-yellow-500 hover:shadow-xl transition">
            <h3 class="text-lg font-bold text-blue-900 mb-6 flex items-center gap-2">
                <span class="text-2xl">📎</span> Documents
            </h3>

            <div class="space-y-3">

                @if($tender->notice_pdf)
                    <a href="{{ asset('storage/' . $tender->notice_pdf) }}" target="_blank"
                       class="flex items-center gap-4 bg-blue-50 hover:bg-blue-100 transition rounded-xl p-4 group">
                        <div class="w-12 h-12 bg-blue-900 text-white rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                            📄
                        </div>
                        <div class="flex-1">
                            <div class="font-bold text-blue-900">Avis d'appel d'offres</div>
                            <div class="text-xs text-gray-500">Cliquez pour télécharger le PDF</div>
                        </div>
                        <div class="text-blue-700 text-2xl group-hover:translate-y-1 transition">
                            ⬇️
                        </div>
                    </a>
                @endif

                @if($tender->result_pdf)
                    <a href="{{ asset('storage/' . $tender->result_pdf) }}" target="_blank"
                       class="flex items-center gap-4 bg-green-50 hover:bg-green-100 transition rounded-xl p-4 group">
                        <div class="w-12 h-12 bg-green-600 text-white rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                            ✅
                        </div>
                        <div class="flex-1">
                            <div class="font-bold text-green-800">Résultats définitifs</div>
                            <div class="text-xs text-gray-500">Cliquez pour télécharger le PDF</div>
                        </div>
                        <div class="text-green-700 text-2xl group-hover:translate-y-1 transition">
                            ⬇️
                        </div>
                    </a>
                @endif

                @if(!$tender->notice_pdf && !$tender->result_pdf)
                    <div class="text-center py-8">
                        <div class="text-5xl mb-3 opacity-30">📎</div>
                        <p class="text-gray-500 text-sm">
                            Aucun document disponible pour le moment.
                        </p>
                    </div>
                @endif

            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- COMMENT SOUMISSIONNER --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-xl p-6 mb-8">
        <div class="flex items-start gap-4">
            <div class="text-4xl flex-shrink-0">💡</div>
            <div class="flex-1">
                <h3 class="text-xl font-bold text-yellow-900 mb-3">Comment soumissionner ?</h3>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Pour participer à cet appel d'offres, veuillez :
                </p>
                <ol class="space-y-2 text-gray-700 text-sm mb-5">
                    <li class="flex items-start gap-2">
                        <span class="font-bold text-yellow-700 flex-shrink-0">1.</span>
                        Télécharger les documents ci-dessus
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="font-bold text-yellow-700 flex-shrink-0">2.</span>
                        Préparer votre dossier selon les exigences
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="font-bold text-yellow-700 flex-shrink-0">3.</span>
                        Déposer votre dossier avant la date limite
                    </li>
                </ol>

                <div class="bg-white rounded-lg p-4 border border-yellow-200">
                    <div class="text-sm font-semibold text-gray-700 mb-2">📞 Contact service des marchés :</div>
                    <div class="flex flex-wrap gap-4 text-sm">
                        <a href="tel:+21678253816" class="text-blue-700 font-semibold hover:underline flex items-center gap-1">
                            📞 +216 78 253 816
                        </a>
                        <a href="mailto:dg@ciok.com.tn" class="text-blue-700 font-semibold hover:underline flex items-center gap-1">
                            ✉️ dg@ciok.com.tn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bouton retour --}}
    <div class="text-center">
        <a href="{{ route('tenders.index') }}"
           class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold transition">
            ← Retour à tous les marchés publics
        </a>
    </div>

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- AUTRES MARCHÉS SIMILAIRES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
@if(isset($related) && $related->isNotEmpty())
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4">

            <div class="text-center mb-10">
                <div class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 text-xs font-bold px-4 py-1.5 rounded-full mb-3 w-fit mx-auto">
                    À CONSULTER
                </div>
                <h2 class="text-3xl font-bold text-blue-900">Autres marchés similaires</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach($related as $t)
                    <a href="{{ route('tenders.show', $t->slug) }}"
                       class="bg-white rounded-xl shadow-md hover:shadow-xl hover:-translate-y-1 transition p-6 border-l-4 group
                              {{ $t->status === 'open' ? 'border-green-500' : ($t->status === 'awarded' ? 'border-blue-500' : 'border-gray-400') }}">

                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs font-bold px-2 py-1 rounded
                                        {{ $t->type === 'appel_offre' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                {{ $t->type === 'appel_offre' ? '📄' : '📢' }}
                            </span>
                            <span class="font-mono font-bold text-blue-900 text-xs">
                                {{ $t->reference }}
                            </span>
                        </div>

                        <h3 class="font-bold text-blue-900 mb-3 leading-snug group-hover:text-blue-700 transition">
                            {{ Str::limit($t->title, 80) }}
                        </h3>

                        @if($t->deadline_date)
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                                📅 {{ $t->deadline_date->format('d/m/Y') }}
                            </div>
                        @endif

                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            @if($t->status === 'open')
                                <span class="text-xs bg-green-100 text-green-800 font-bold px-2 py-1 rounded-full">🟢 Ouvert</span>
                            @elseif($t->status === 'awarded')
                                <span class="text-xs bg-blue-100 text-blue-800 font-bold px-2 py-1 rounded-full">✅ Attribué</span>
                            @else
                                <span class="text-xs bg-gray-100 text-gray-700 font-bold px-2 py-1 rounded-full">🔒 Clôturé</span>
                            @endif

                            <span class="text-blue-700 font-bold text-sm group-hover:underline">
                                Voir →
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
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-16">
    <div class="max-w-4xl mx-auto text-center px-4">
        <div class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 text-xs font-bold px-4 py-1.5 rounded-full mb-4 w-fit mx-auto">
            BESOIN D'AIDE ?
        </div>
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Une question sur ce marché public ?
        </h2>
        <p class="text-blue-100 mb-8 text-lg">
            Notre service des marchés vous répond dans les plus brefs délais.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('contact.show') }}"
               class="bg-yellow-500 text-blue-900 px-8 py-3 rounded-lg font-bold hover:bg-yellow-400 transition shadow-lg hover:-translate-y-1 flex items-center gap-2">
                ✉️ {{ __('messages.contact_us') }}
            </a>
            <a href="tel:+21678253816"
               class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-900 transition hover:-translate-y-1 flex items-center gap-2">
                📞 +216 78 253 816
            </a>
        </div>
    </div>
</section>

@endsection