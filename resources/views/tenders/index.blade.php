@extends('layouts.site')
@section('title', 'Appels d\'offres - CIOK')
@section('meta_description', 'Consultez nos appels d\'offres et consultations élargies en cours. Documents téléchargeables et informations à jour.')
@section('og_image', asset('images/silos.jpg'))
@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BANNER --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/silos.jpg') }}" alt="Appels d'offres CIOK" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/95 to-blue-900/70"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-24">
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            📋 MARCHÉ PUBLIC
        </div>
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Appels d'offres</h1>
        <p class="text-blue-100 text-lg md:text-xl max-w-3xl leading-relaxed">
            Consultez nos appels d'offres et consultations élargies.
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
            <div class="text-4xl md:text-5xl font-extrabold text-green-600 mb-2">{{ $stats['open'] }}</div>
            <div class="text-xs md:text-sm text-gray-600 uppercase tracking-wider font-semibold">
                🟢 En cours
            </div>
            <div class="text-xs text-gray-400 mt-1">Vous pouvez postuler</div>
        </div>

        <div class="border-r border-gray-100">
            <div class="text-4xl md:text-5xl font-extrabold text-blue-600 mb-2">{{ $stats['awarded'] }}</div>
            <div class="text-xs md:text-sm text-gray-600 uppercase tracking-wider font-semibold">
                ✅ Attribués
            </div>
            <div class="text-xs text-gray-400 mt-1">Résultats publiés</div>
        </div>

        <div>
            <div class="text-4xl md:text-5xl font-extrabold text-gray-500 mb-2">{{ $stats['closed'] }}</div>
            <div class="text-xs md:text-sm text-gray-600 uppercase tracking-wider font-semibold">
                🔒 Clôturés
            </div>
            <div class="text-xs text-gray-400 mt-1">En attente de résultats</div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- FILTRES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gray-50 border-b sticky top-[88px] z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4">

        <form method="GET" action="{{ route('tenders.index') }}" class="flex flex-wrap gap-3 justify-center items-center">

            <span class="text-sm text-gray-500 hidden md:inline font-semibold">Filtrer :</span>

            {{-- Type --}}
            <select name="type" class="border-2 border-gray-200 rounded-lg px-4 py-2 focus:border-blue-900 outline-none transition text-sm bg-white">
                <option value="">📁 Tous les types</option>
                <option value="appel_offre" {{ request('type') === 'appel_offre' ? 'selected' : '' }}>📄 Appels d'offres</option>
                <option value="consultation_elargie" {{ request('type') === 'consultation_elargie' ? 'selected' : '' }}>📢 Consultations élargies</option>
            </select>

            {{-- Statut --}}
            <select name="status" class="border-2 border-gray-200 rounded-lg px-4 py-2 focus:border-blue-900 outline-none transition text-sm bg-white">
                <option value="">🎯 Tous les statuts</option>
                <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>🟢 Ouverts</option>
                <option value="awarded" {{ request('status') === 'awarded' ? 'selected' : '' }}>✅ Attribués</option>
                <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>🔒 Clôturés</option>
            </select>

            <button type="submit"
                    class="bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition font-semibold text-sm">
                🔍 Filtrer
            </button>

            @if(request('type') || request('status'))
                <a href="{{ route('tenders.index') }}"
                   class="text-gray-600 hover:text-gray-900 text-sm flex items-center gap-1">
                    ✕ Réinitialiser
                </a>
            @endif

        </form>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- LISTE DES APPELS D'OFFRES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-12">

    @if($tenders->isEmpty())
        <div class="text-center py-20">
            <div class="text-8xl mb-6">📋</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-3">Aucun appel d'offres</h3>
            <p class="text-gray-500 mb-6">
                @if(request('type') || request('status'))
                    Aucun résultat pour ces filtres.
                @else
                    Aucun appel d'offres n'est disponible pour le moment.
                @endif
            </p>
            @if(request('type') || request('status'))
                <a href="{{ route('tenders.index') }}"
                   class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg transition">
                    ✕ Voir tous les appels d'offres
                </a>
            @endif
        </div>
    @else

        {{-- Compteur de résultats --}}
        <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
            <div class="text-sm text-gray-600">
                <strong class="text-blue-900">{{ $tenders->total() }}</strong>
                appel{{ $tenders->total() > 1 ? 's' : '' }} d'offres
                @if(request('type') || request('status'))
                    <span class="text-gray-400">(filtré)</span>
                @endif
            </div>
        </div>

        <div class="space-y-4">
            @foreach($tenders as $tender)

                {{-- Carte de l'appel d'offres --}}
                <a href="{{ route('tenders.show', $tender->slug) }}"
                   class="block bg-white rounded-2xl shadow-md hover:shadow-2xl hover:-translate-y-1 transition duration-300 overflow-hidden group border border-gray-100">

                    <div class="grid md:grid-cols-12 gap-0">

                        {{-- Barre latérale colorée --}}
                        <div class="md:col-span-1 h-2 md:h-auto
                                    {{ $tender->status === 'open' ? 'bg-green-500' : ($tender->status === 'awarded' ? 'bg-blue-500' : 'bg-gray-400') }}">
                        </div>

                        {{-- Contenu principal --}}
                        <div class="md:col-span-11 p-6">
                            <div class="grid md:grid-cols-12 gap-6 items-center">

                                {{-- Type + Référence --}}
                                <div class="md:col-span-3">
                                    <div class="inline-flex items-center gap-1 text-xs font-bold px-3 py-1 rounded-full mb-3
                                                {{ $tender->type === 'appel_offre' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ $tender->type === 'appel_offre' ? '📄' : '📢' }}
                                        {{ $tender->type_label }}
                                    </div>
                                    <div class="font-mono font-extrabold text-blue-900 text-lg leading-tight">
                                        {{ $tender->reference }}
                                    </div>
                                </div>

                                {{-- Objet --}}
                                <div class="md:col-span-6">
                                    <h3 class="font-bold text-blue-900 mb-2 leading-snug text-lg group-hover:text-blue-700 transition">
                                        {{ $tender->title }}
                                    </h3>
                                    @if($tender->description)
                                        <p class="text-sm text-gray-600 leading-relaxed">
                                            {{ Str::limit($tender->description, 150) }}
                                        </p>
                                    @endif
                                </div>

                                {{-- Dates + Statut + Flèche --}}
                                <div class="md:col-span-3 text-right">
                                    @if($tender->deadline_date)
                                        <div class="bg-gray-50 rounded-lg p-3 mb-3 inline-block">
                                            <div class="text-xs text-gray-500 mb-1">📅 Date limite</div>
                                            <div class="font-bold text-blue-900 text-sm">
                                                {{ $tender->deadline_date->format('d/m/Y') }}
                                            </div>
                                            @if($tender->deadline_time)
                                                <div class="text-xs text-gray-500">
                                                    à {{ \Carbon\Carbon::parse($tender->deadline_time)->format('H\hi') }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="flex items-center justify-end gap-3">
                                        @if($tender->status === 'open')
                                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 text-xs font-bold px-3 py-1.5 rounded-full">
                                                🟢 Ouvert
                                            </span>
                                        @elseif($tender->status === 'awarded')
                                            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1.5 rounded-full">
                                                ✅ Attribué
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                                🔒 Clôturé
                                            </span>
                                        @endif

                                        <span class="w-8 h-8 bg-blue-900 text-white rounded-full flex items-center justify-center group-hover:bg-yellow-500 group-hover:text-blue-900 transition">
                                            →
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </a>

            @endforeach
        </div>

        {{-- Pagination --}}
        @if($tenders->hasPages())
            <div class="mt-8">
                {{ $tenders->appends(request()->query())->links() }}
            </div>
        @endif

    @endif

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- INFO : COMMENT SOUMISSIONNER --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-blue-50 py-16">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-8">
            <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
                💡 BON À SAVOIR
            </div>
            <h2 class="text-3xl font-bold text-blue-900 mb-4">Comment soumissionner ?</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl p-6 text-center shadow-md">
                <div class="w-14 h-14 bg-blue-900 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">1</div>
                <h3 class="font-bold text-blue-900 mb-2">Consulter</h3>
                <p class="text-sm text-gray-600">
                    Lisez l'avis d'appel d'offres et téléchargez les documents PDF.
                </p>
            </div>

            <div class="bg-white rounded-xl p-6 text-center shadow-md">
                <div class="w-14 h-14 bg-blue-900 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">2</div>
                <h3 class="font-bold text-blue-900 mb-2">Préparer</h3>
                <p class="text-sm text-gray-600">
                    Préparez votre dossier selon les exigences du cahier des charges.
                </p>
            </div>

            <div class="bg-white rounded-xl p-6 text-center shadow-md">
                <div class="w-14 h-14 bg-blue-900 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">3</div>
                <h3 class="font-bold text-blue-900 mb-2">Déposer</h3>
                <p class="text-sm text-gray-600">
                    Déposez votre dossier avant la date limite indiquée.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CTA CONTACT --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-16">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Une question sur nos appels d'offres ?</h2>
        <p class="text-blue-100 mb-8 text-lg">
            Notre service des marchés est à votre disposition pour vous accompagner.
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