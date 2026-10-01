@extends('layouts.site')
@section('title', 'Marché public - CIOK')
@section('meta_description', 'Consultez nos appels d\'offres, consultations et consultations élargies en cours. Documents téléchargeables et informations à jour.')
@section('og_image', asset('images/silos.webp'))
@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BANNER --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden" style="min-height: 500px;">
    <div class="absolute inset-0">
        <img src="{{ asset('images/silos.webp') }}"
             alt="Marché public CIOK"
             class="w-full h-full object-cover scale-110"
             style="filter: blur(3px) brightness(0.9); object-position: center;">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/85 via-blue-900/70 to-blue-800/50"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 py-32 flex flex-col justify-center" style="min-height: 500px;">
        <div class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 text-xs font-bold px-4 py-1.5 rounded-full mb-6 w-fit shadow-lg">
            📋 MARCHÉ PUBLIC
        </div>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight drop-shadow-lg">
            Marché public
        </h1>
        <p class="text-blue-100 text-lg md:text-xl lg:text-2xl max-w-3xl leading-relaxed drop-shadow-md">
            Consultez nos appels d'offres, consultations et consultations élargies.
            Toutes les informations et documents sont disponibles en téléchargement.
        </p>
    </div>

    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500"></div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- STATISTIQUES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-3 gap-4 text-center">
        <div class="border-r border-gray-100">
            <div class="text-4xl md:text-5xl font-extrabold text-green-600 mb-2">{{ $stats['open'] ?? 0 }}</div>
            <div class="text-xs md:text-sm text-gray-600 uppercase tracking-wider font-semibold">🟢 En cours</div>
        </div>
        <div class="border-r border-gray-100">
            <div class="text-4xl md:text-5xl font-extrabold text-blue-600 mb-2">{{ $stats['awarded'] ?? 0 }}</div>
            <div class="text-xs md:text-sm text-gray-600 uppercase tracking-wider font-semibold">✅ Attribués</div>
        </div>
        <div>
            <div class="text-4xl md:text-5xl font-extrabold text-gray-500 mb-2">{{ $stats['closed'] ?? 0 }}</div>
            <div class="text-xs md:text-sm text-gray-600 uppercase tracking-wider font-semibold">🔒 Clôturés</div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- FILTRES PAR TYPE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gray-50 border-b sticky top-[88px] z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-wrap gap-2 justify-center items-center">
        <span class="text-sm text-gray-500 hidden md:inline font-semibold mr-2">Filtrer :</span>

        <a href="{{ route('tenders.index') }}"
           class="px-5 py-2 rounded-full text-sm font-semibold transition {{ !request('type') ? 'bg-blue-900 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-blue-100 hover:text-blue-900' }}">
            📋 Tous
        </a>
        <a href="{{ route('tenders.index', ['type' => 'appel_offre']) }}"
           class="px-5 py-2 rounded-full text-sm font-semibold transition {{ request('type') === 'appel_offre' ? 'bg-blue-900 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-blue-100 hover:text-blue-900' }}">
            📄 Appel d'offre
        </a>
        <a href="{{ route('tenders.index', ['type' => 'consultation']) }}"
           class="px-5 py-2 rounded-full text-sm font-semibold transition {{ request('type') === 'consultation' ? 'bg-blue-900 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-blue-100 hover:text-blue-900' }}">
            💼 Consultation
        </a>
        <a href="{{ route('tenders.index', ['type' => 'consultation_elargie']) }}"
           class="px-5 py-2 rounded-full text-sm font-semibold transition {{ request('type') === 'consultation_elargie' ? 'bg-blue-900 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-blue-100 hover:text-blue-900' }}">
            📢 Consultation élargie
        </a>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- LISTE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-16">

    @if($tenders->isEmpty())
        <div class="text-center py-20">
            <div class="text-8xl mb-6">📋</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-3">Aucun résultat</h3>
            <p class="text-gray-500 mb-6">Aucun marché public ne correspond à votre recherche.</p>
            @if(request('type'))
                <a href="{{ route('tenders.index') }}"
                   class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg transition">
                    ✕ Voir tous
                </a>
            @endif
        </div>
    @else

        <div class="mb-6 text-sm text-gray-600">
            <strong class="text-blue-900">{{ $tenders->total() }}</strong> résultat{{ $tenders->total() > 1 ? 's' : '' }}
            @if(request('type')) <span class="text-gray-400">(filtré)</span> @endif
        </div>

        {{-- Grille de cartes (3 colonnes comme l'ancien site) --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($tenders as $tender)
                <a href="{{ route('tenders.show', $tender->slug) }}"
                   class="bg-white rounded-2xl shadow-md hover:shadow-2xl hover:-translate-y-2 transition duration-300 overflow-hidden group flex flex-col">

                    {{-- Image illustrative --}}
                    <div class="relative h-48 bg-gradient-to-br from-blue-50 via-white to-yellow-50 flex items-center justify-center overflow-hidden">

                        @if($tender->image)
                            <img src="{{ asset('storage/' . $tender->image) }}"
                                 alt="{{ $tender->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="text-center">
                                <div class="text-6xl mb-2">
                                    @if($tender->type === 'appel_offre') 📄
                                    @elseif($tender->type === 'consultation') 💼
                                    @else 📢
                                    @endif
                                </div>
                                <div class="text-xs font-bold text-blue-900 uppercase tracking-wider">
                                    @if($tender->type === 'appel_offre') Appel d'offres
                                    @elseif($tender->type === 'consultation') Consultation
                                    @else Avis de consultation élargie
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Badge "En cours" --}}
                        @if($tender->status === 'open')
                            <span class="absolute top-3 right-3 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                En cours
                            </span>
                        @elseif($tender->status === 'awarded')
                            <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                Attribué
                            </span>
                        @else
                            <span class="absolute top-3 right-3 bg-gray-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                Clôturé
                            </span>
                        @endif
                    </div>

                    {{-- Contenu --}}
                    <div class="p-6 flex-1 flex flex-col text-center">
                        {{-- Type badge --}}
                        <div class="mb-3">
                            <span class="inline-block text-xs font-bold px-3 py-1 rounded-full
                                @if($tender->type === 'appel_offre') bg-blue-100 text-blue-800
                                @elseif($tender->type === 'consultation') bg-purple-100 text-purple-800
                                @else bg-pink-100 text-pink-800
                                @endif">
                                @if($tender->type === 'appel_offre') APPEL D'OFFRE
                                @elseif($tender->type === 'consultation') CONSULTATION
                                @else CONSULTATION ÉLARGIE
                                @endif
                            </span>
                        </div>

                        {{-- Titre --}}
                        <h3 class="font-bold text-blue-900 text-lg mb-4 leading-snug group-hover:text-blue-700 transition flex-1">
                            {{ $tender->title }}
                        </h3>

                        {{-- Infos --}}
                        <div class="space-y-2 text-sm text-gray-600 border-t border-gray-100 pt-4">
                            <div class="flex items-center justify-center gap-2">
                                <span>🔢</span>
                                <span>Numéro : <strong>{{ $tender->reference }}</strong></span>
                            </div>
                            @if($tender->deadline_date)
                                <div class="flex items-center justify-center gap-2">
                                    <span>📅</span>
                                    <span>Date limite : <strong>{{ $tender->deadline_date->format('d/m/Y') }}</strong>
                                        @if($tender->deadline_time) à {{ \Carbon\Carbon::parse($tender->deadline_time)->format('H\hi') }} @endif
                                    </span>
                                </div>
                            @endif
                            @if($tender->opening_date)
                                <div class="flex items-center justify-center gap-2">
                                    <span>🕐</span>
                                    <span>Ouverture : <strong>{{ $tender->opening_date->format('d/m/Y') }}</strong>
                                        @if($tender->opening_time) à {{ \Carbon\Carbon::parse($tender->opening_time)->format('H\hi') }} @endif
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Liens --}}
                        <div class="mt-4 pt-4 border-t border-gray-100 flex flex-col gap-2">
                            @if($tender->notice_pdf)
                                <span class="text-blue-700 font-semibold text-sm hover:underline inline-flex items-center justify-center gap-1">
                                    📄 Ouvrir l'avis
                                </span>
                            @endif
                            @if($tender->result_pdf)
                                <span class="text-green-700 font-semibold text-sm hover:underline inline-flex items-center justify-center gap-1">
                                    ✅ Résultats définitifs
                                </span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($tenders->hasPages())
            <div class="mt-12">
                {{ $tenders->appends(request()->query())->links() }}
            </div>
        @endif
    @endif
</section>

@endsection