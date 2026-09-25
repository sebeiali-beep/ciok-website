@extends('layouts.site')
@section('title', 'Appels d\'offres - CIOK')

@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BANNER --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/silos.jpg') }}" alt="Appels d'offres CIOK" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/95 to-blue-900/70"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-20">
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            📋 MARCHÉ PUBLIC
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Appels d'offres</h1>
        <p class="text-blue-100 text-lg max-w-2xl">
            Consultez nos appels d'offres et consultations élargies en cours
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- STATISTIQUES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-3 gap-4 text-center">

        <div>
            <div class="text-3xl md:text-4xl font-extrabold text-green-600">{{ $stats['open'] }}</div>
            <div class="text-xs md:text-sm text-gray-600 mt-1 uppercase tracking-wider">🟢 En cours</div>
        </div>

        <div>
            <div class="text-3xl md:text-4xl font-extrabold text-blue-600">{{ $stats['awarded'] }}</div>
            <div class="text-xs md:text-sm text-gray-600 mt-1 uppercase tracking-wider">✅ Attribués</div>
        </div>

        <div>
            <div class="text-3xl md:text-4xl font-extrabold text-gray-500">{{ $stats['closed'] }}</div>
            <div class="text-xs md:text-sm text-gray-600 mt-1 uppercase tracking-wider">🔒 Clôturés</div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- FILTRES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gray-50 border-b">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-wrap gap-2 justify-center">

        <span class="text-sm text-gray-500 mr-2 hidden md:inline self-center">Type :</span>

        <a href="{{ route('tenders.index') }}"
           class="px-4 py-2 rounded-full text-sm font-semibold transition
                  {{ !request('type') ? 'bg-blue-900 text-white' : 'bg-white text-gray-700 hover:bg-blue-100' }}">
            Tous
        </a>

        <a href="{{ route('tenders.index') }}?type=appel_offre"
           class="px-4 py-2 rounded-full text-sm font-semibold transition
                  {{ request('type') === 'appel_offre' ? 'bg-blue-900 text-white' : 'bg-white text-gray-700 hover:bg-blue-100' }}">
            📄 Appels d'offres
        </a>

        <a href="{{ route('tenders.index') }}?type=consultation_elargie"
           class="px-4 py-2 rounded-full text-sm font-semibold transition
                  {{ request('type') === 'consultation_elargie' ? 'bg-blue-900 text-white' : 'bg-white text-gray-700 hover:bg-blue-100' }}">
            📢 Consultations élargies
        </a>

        <span class="mx-2 text-gray-300 hidden md:inline">|</span>

        <span class="text-sm text-gray-500 mr-2 hidden md:inline self-center">Statut :</span>

        <a href="{{ route('tenders.index') }}?status=open"
           class="px-4 py-2 rounded-full text-sm font-semibold transition
                  {{ request('status') === 'open' ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-green-100' }}">
            🟢 Ouverts
        </a>

        <a href="{{ route('tenders.index') }}?status=awarded"
           class="px-4 py-2 rounded-full text-sm font-semibold transition
                  {{ request('status') === 'awarded' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-blue-100' }}">
            ✅ Attribués
        </a>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- LISTE DES APPELS D'OFFRES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-12">

    @if($tenders->isEmpty())
        <div class="text-center py-20 text-gray-500">
            <div class="text-6xl mb-4">📋</div>
            <p class="text-xl">Aucun appel d'offres pour le moment.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($tenders as $tender)
                <a href="{{ route('tenders.show', $tender->slug) }}"
                   class="block bg-white rounded-xl shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300 border-l-4
                          {{ $tender->status === 'open' ? 'border-green-500' : ($tender->status === 'awarded' ? 'border-blue-500' : 'border-gray-400') }}">

                    <div class="p-6 grid md:grid-cols-12 gap-4 items-center">

                        {{-- Type + Référence --}}
                        <div class="md:col-span-3">
                            <div class="inline-block text-xs font-bold px-2 py-1 rounded mb-2
                                        {{ $tender->type === 'appel_offre' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                {{ $tender->type_label }}
                            </div>
                            <div class="font-mono font-bold text-blue-900 text-lg">
                                {{ $tender->reference }}
                            </div>
                        </div>

                        {{-- Titre --}}
                        <div class="md:col-span-6">
                            <h3 class="font-bold text-blue-900 mb-1 leading-snug">
                                {{ $tender->title }}
                            </h3>
                            @if($tender->description)
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    {{ Str::limit($tender->description, 120) }}
                                </p>
                            @endif
                        </div>

                        {{-- Dates --}}
                        <div class="md:col-span-3 text-sm">
                            @if($tender->deadline_date)
                                <div class="flex items-center gap-2 text-gray-600">
                                    <span>📅</span>
                                    <div>
                                        <div class="font-semibold text-blue-900">
                                            {{ $tender->deadline_date->format('d/m/Y') }}
                                        </div>
                                        @if($tender->deadline_time)
                                            <div class="text-xs text-gray-500">
                                                avant {{ \Carbon\Carbon::parse($tender->deadline_time)->format('H\hi') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="mt-2">
                                @if($tender->status === 'open')
                                    <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded-full">
                                        🟢 Ouvert
                                    </span>
                                @elseif($tender->status === 'awarded')
                                    <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded-full">
                                        ✅ Attribué
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 text-xs font-bold px-2 py-1 rounded-full">
                                        🔒 Clôturé
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $tenders->links() }}
        </div>
    @endif

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CTA --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-blue-900 text-white py-16">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-4">Une question sur nos appels d'offres ?</h2>
        <p class="text-blue-100 mb-8">Notre service des marchés est à votre disposition.</p>
        <a href="{{ route('contact.show') }}"
           class="inline-block bg-yellow-500 text-blue-900 px-8 py-3 rounded-lg font-bold hover:bg-yellow-400 transition">
            ✉️ {{ __('messages.contact_us') }}
        </a>
    </div>
</section>

@endsection