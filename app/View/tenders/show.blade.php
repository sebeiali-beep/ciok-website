@extends('layouts.site')
@section('title', $tender->reference . ' - CIOK')

@section('content')

{{-- Fil d'Ariane --}}
<div class="bg-gray-100 border-b">
    <div class="max-w-7xl mx-auto px-4 py-3 text-sm flex items-center gap-2 flex-wrap">
        <a href="{{ route('home') }}" class="text-blue-700 hover:underline flex items-center gap-1">
            🏠 {{ __('messages.home') }}
        </a>
        <span class="text-gray-400">/</span>
        <a href="{{ route('tenders.index') }}" class="text-blue-700 hover:underline">
            Appels d'offres
        </a>
        <span class="text-gray-400">/</span>
        <span class="text-gray-600 font-mono font-semibold">{{ $tender->reference }}</span>
    </div>
</div>

<section class="max-w-5xl mx-auto px-4 py-12">

    {{-- En-tête --}}
    <div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white rounded-2xl p-8 mb-8 shadow-xl relative overflow-hidden">
        <div class="absolute top-0 right-0 text-9xl opacity-10">📋</div>

        <div class="relative">
            <div class="flex flex-wrap gap-3 mb-4">
                <span class="inline-block text-xs font-bold px-3 py-1 rounded-full bg-yellow-500 text-blue-900">
                    {{ $tender->type_label }}
                </span>

                @if($tender->status === 'open')
                    <span class="inline-flex items-center gap-1 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        🟢 Ouvert
                    </span>
                @elseif($tender->status === 'awarded')
                    <span class="inline-flex items-center gap-1 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        ✅ Attribué
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 bg-gray-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        🔒 Clôturé
                    </span>
                @endif
            </div>

            <div class="text-yellow-400 font-mono font-bold text-lg mb-2">
                {{ $tender->reference }}
            </div>

            <h1 class="text-2xl md:text-4xl font-extrabold mb-4 leading-tight">
                {{ $tender->title }}
            </h1>

            @if($tender->description)
                <p class="text-blue-100 text-lg leading-relaxed">
                    {{ $tender->description }}
                </p>
            @endif
        </div>
    </div>

    {{-- Informations --}}
    <div class="grid md:grid-cols-2 gap-6 mb-8">

        {{-- Dates --}}
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-blue-900">
            <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center gap-2">
                📅 Dates importantes
            </h3>

            @if($tender->deadline_date)
                <div class="mb-4 pb-4 border-b border-gray-100">
                    <div class="text-sm text-gray-500 mb-1">Date limite de dépôt</div>
                    <div class="font-bold text-lg text-blue-900">
                        {{ $tender->deadline_date->format('d/m/Y') }}
                        @if($tender->deadline_time)
                            à {{ \Carbon\Carbon::parse($tender->deadline_time)->format('H\hi') }}
                        @endif
                    </div>
                </div>
            @endif

            @if($tender->opening_date)
                <div>
                    <div class="text-sm text-gray-500 mb-1">Ouverture des plis</div>
                    <div class="font-bold text-lg text-blue-900">
                        {{ $tender->opening_date->format('d/m/Y') }}
                        @if($tender->opening_time)
                            à {{ \Carbon\Carbon::parse($tender->opening_time)->format('H\hi') }}
                        @endif
                    </div>
                </div>
            @endif
        </div>

        {{-- Documents --}}
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-yellow-500">
            <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center gap-2">
                📎 Documents
            </h3>

            @if($tender->notice_pdf)
                <a href="{{ asset('storage/' . $tender->notice_pdf) }}"
                   target="_blank"
                   class="flex items-center gap-3 bg-blue-50 hover:bg-blue-100 transition rounded-lg p-3 mb-3">
                    <div class="w-10 h-10 bg-blue-900 text-white rounded-lg flex items-center justify-center text-xl">
                        📄
                    </div>
                    <div class="flex-1">
                        <div class="font-semibold text-blue-900">Avis d'appel d'offres</div>
                        <div class="text-xs text-gray-500">Cliquez pour télécharger</div>
                    </div>
                    <div class="text-blue-700 text-xl">⬇️</div>
                </a>
            @endif

            @if($tender->result_pdf)
                <a href="{{ asset('storage/' . $tender->result_pdf) }}"
                   target="_blank"
                   class="flex items-center gap-3 bg-green-50 hover:bg-green-100 transition rounded-lg p-3">
                    <div class="w-10 h-10 bg-green-600 text-white rounded-lg flex items-center justify-center text-xl">
                        ✅
                    </div>
                    <div class="flex-1">
                        <div class="font-semibold text-green-800">Résultats définitifs</div>
                        <div class="text-xs text-gray-500">Cliquez pour télécharger</div>
                    </div>
                    <div class="text-green-700 text-xl">⬇️</div>
                </a>
            @endif

            @if(!$tender->notice_pdf && !$tender->result_pdf)
                <p class="text-gray-500 text-sm text-center py-4">
                    Aucun document disponible pour le moment.
                </p>
            @endif
        </div>

    </div>

    {{-- Info contact --}}
    <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-6 mb-8">
        <div class="flex items-start gap-3">
            <span class="text-2xl">💡</span>
            <div>
                <strong class="text-yellow-900 block mb-2">Comment soumissionner ?</strong>
                <p class="text-gray-700 text-sm leading-relaxed mb-3">
                    Pour participer à cet appel d'offres, veuillez consulter les documents ci-dessus
                    et les déposer selon les modalités indiquées avant la date limite.
                </p>
                <p class="text-sm text-gray-600">
                    Pour toute question, contactez notre service des marchés :
                </p>
                <div class="mt-2 flex flex-wrap gap-4 text-sm">
                    <a href="tel:+21678253816" class="text-blue-700 font-semibold hover:underline">
                        📞 +216 78 253 816
                    </a>
                    <a href="mailto:commercial@ciok.com.tn" class="text-blue-700 font-semibold hover:underline">
                        ✉️ commercial@ciok.com.tn
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Bouton retour --}}
    <div class="text-center mb-12">
        <a href="{{ route('tenders.index') }}"
           class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold transition">
            ← Retour à tous les appels d'offres
        </a>
    </div>

</section>

{{-- Autres appels d'offres --}}
@if($related->isNotEmpty())
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-blue-900 mb-8 text-center">Autres appels d'offres</h2>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach($related as $t)
                    <a href="{{ route('tenders.show', $t->slug) }}"
                       class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-6 border-l-4
                              {{ $t->status === 'open' ? 'border-green-500' : 'border-gray-400' }}">
                        <div class="font-mono font-bold text-blue-900 text-sm mb-2">
                            {{ $t->reference }}
                        </div>
                        <h3 class="font-bold text-blue-900 mb-2 leading-snug">
                            {{ Str::limit($t->title, 80) }}
                        </h3>
                        @if($t->deadline_date)
                            <div class="text-xs text-gray-500">
                                📅 {{ $t->deadline_date->format('d/m/Y') }}
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

@endsection