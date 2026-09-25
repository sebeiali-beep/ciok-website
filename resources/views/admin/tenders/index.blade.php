@extends('admin.layout')
@section('title', 'Appels d\'offres')

@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- EN-TÊTE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="flex justify-between items-center mb-6 flex-wrap gap-4">
    <div>
        <h1 class="text-3xl font-bold text-blue-900">📋 Appels d'offres</h1>
        <p class="text-sm text-gray-500 mt-1">Gérez tous vos appels d'offres et consultations élargies</p>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('tenders.index') }}" target="_blank"
           class="bg-white border-2 border-blue-900 text-blue-900 px-4 py-2 rounded-lg hover:bg-blue-50 transition flex items-center gap-2 text-sm font-semibold">
            🌐 Voir sur le site
        </a>
        <a href="{{ route('admin.tenders.create') }}"
           class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition flex items-center gap-2 font-semibold">
            ➕ Nouvel appel d'offres
        </a>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- STATISTIQUES RAPIDES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
@php
    $allTenders = \App\Models\Tender::all();
    $stats = [
        'total' => $allTenders->count(),
        'open' => $allTenders->where('status', 'open')->count(),
        'awarded' => $allTenders->where('status', 'awarded')->count(),
        'closed' => $allTenders->where('status', 'closed')->count(),
        'appel_offre' => $allTenders->where('type', 'appel_offre')->count(),
        'consultation' => $allTenders->where('type', 'consultation_elargie')->count(),
    ];
@endphp

<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-blue-900 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Total</div>
        <div class="text-2xl font-bold text-blue-900 mt-1">{{ $stats['total'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-green-500 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">🟢 Ouverts</div>
        <div class="text-2xl font-bold text-green-600 mt-1">{{ $stats['open'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-blue-500 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">✅ Attribués</div>
        <div class="text-2xl font-bold text-blue-600 mt-1">{{ $stats['awarded'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-gray-400 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">🔒 Clôturés</div>
        <div class="text-2xl font-bold text-gray-600 mt-1">{{ $stats['closed'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-purple-500 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">📢 Consultations</div>
        <div class="text-2xl font-bold text-purple-600 mt-1">{{ $stats['consultation'] }}</div>
    </div>

</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BARRE DE RECHERCHE + FILTRES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="bg-white rounded-xl shadow-md p-4 mb-6">
    <form method="GET" action="{{ route('admin.tenders.index') }}" class="flex flex-wrap gap-3 items-center">

        {{-- Recherche --}}
        <div class="flex-1 min-w-[200px] relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher par référence ou objet..."
                   class="w-full pl-10 pr-4 py-2 border-2 border-gray-200 rounded-lg focus:border-blue-900 outline-none transition">
        </div>

        {{-- Filtre type --}}
        <select name="type" class="border-2 border-gray-200 rounded-lg px-3 py-2 focus:border-blue-900 outline-none transition">
            <option value="">Tous les types</option>
            <option value="appel_offre" {{ request('type') === 'appel_offre' ? 'selected' : '' }}>📄 Appels d'offres</option>
            <option value="consultation_elargie" {{ request('type') === 'consultation_elargie' ? 'selected' : '' }}>📢 Consultations</option>
        </select>

        {{-- Filtre statut --}}
        <select name="status" class="border-2 border-gray-200 rounded-lg px-3 py-2 focus:border-blue-900 outline-none transition">
            <option value="">Tous les statuts</option>
            <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>🟢 Ouverts</option>
            <option value="awarded" {{ request('status') === 'awarded' ? 'selected' : '' }}>✅ Attribués</option>
            <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>🔒 Clôturés</option>
        </select>

        {{-- Boutons --}}
        <button type="submit" class="bg-blue-900 text-white px-5 py-2 rounded-lg hover:bg-blue-800 transition font-semibold">
            Filtrer
        </button>

        @if(request('search') || request('type') || request('status'))
            <a href="{{ route('admin.tenders.index') }}" class="text-gray-600 hover:text-gray-900 text-sm flex items-center gap-1">
                ✕ Réinitialiser
            </a>
        @endif

    </form>
</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- TABLEAU --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="bg-white rounded-xl shadow-md overflow-hidden">

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-gray-200">
                <tr>
                    <th class="px-4 py-4 text-left text-xs uppercase tracking-wider font-bold text-gray-600">Référence</th>
                    <th class="px-4 py-4 text-left text-xs uppercase tracking-wider font-bold text-gray-600">Objet</th>
                    <th class="px-4 py-4 text-center text-xs uppercase tracking-wider font-bold text-gray-600">Type</th>
                    <th class="px-4 py-4 text-center text-xs uppercase tracking-wider font-bold text-gray-600">Statut</th>
                    <th class="px-4 py-4 text-center text-xs uppercase tracking-wider font-bold text-gray-600">Date limite</th>
                    <th class="px-4 py-4 text-center text-xs uppercase tracking-wider font-bold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($tenders as $tender)
                <tr class="hover:bg-blue-50/50 transition">

                    {{-- Référence --}}
                    <td class="px-4 py-4">
                        <div class="font-mono font-bold text-blue-900">
                            {{ $tender->reference }}
                        </div>
                        @if(!$tender->is_published)
                            <div class="text-xs text-orange-600 mt-1 flex items-center gap-1">
                                🔒 Non publié
                            </div>
                        @endif
                    </td>

                    {{-- Objet --}}
                    <td class="px-4 py-4">
                        <div class="text-sm font-medium text-gray-800 max-w-md">
                            {{ Str::limit($tender->title, 70) }}
                        </div>
                        @if($tender->description)
                            <div class="text-xs text-gray-500 mt-1">
                                {{ Str::limit($tender->description, 60) }}
                            </div>
                        @endif
                    </td>

                    {{-- Type --}}
                    <td class="px-4 py-4 text-center">
                        @if($tender->type === 'appel_offre')
                            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 px-2.5 py-1 rounded-full text-xs font-bold">
                                📄 AO
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-purple-100 text-purple-800 px-2.5 py-1 rounded-full text-xs font-bold">
                                📢 CE
                            </span>
                        @endif
                    </td>

                    {{-- Statut --}}
                    <td class="px-4 py-4 text-center">
                        @if($tender->status === 'open')
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 px-2.5 py-1 rounded-full text-xs font-bold">
                                🟢 Ouvert
                            </span>
                        @elseif($tender->status === 'awarded')
                            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 px-2.5 py-1 rounded-full text-xs font-bold">
                                ✅ Attribué
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 px-2.5 py-1 rounded-full text-xs font-bold">
                                🔒 Clôturé
                            </span>
                        @endif
                    </td>

                    {{-- Date limite --}}
                    <td class="px-4 py-4 text-center text-sm">
                        @if($tender->deadline_date)
                            <div class="font-semibold text-gray-800">
                                {{ $tender->deadline_date->format('d/m/Y') }}
                            </div>
                            @if($tender->deadline_time)
                                <div class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($tender->deadline_time)->format('H\hi') }}
                                </div>
                            @endif
                        @else
                            <span class="text-gray-400 text-xs">—</span>
                        @endif
                    </td>

                    {{-- Actions --}}
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-center gap-2">

                            {{-- Voir public --}}
                            <a href="{{ route('tenders.show', $tender->slug) }}" target="_blank"
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-blue-100 text-blue-700 transition"
                               title="Voir sur le site">
                                🌐
                            </a>

                            {{-- Modifier --}}
                            <a href="{{ route('admin.tenders.edit', $tender) }}"
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-800 transition"
                               title="Modifier">
                                ✏️
                            </a>

                            {{-- Supprimer --}}
                            <form action="{{ route('admin.tenders.destroy', $tender) }}" method="POST" class="inline"
                                  onsubmit="return confirm('⚠️ Supprimer DÉFINITIVEMENT {{ $tender->reference }} ?\n\nCette action est irréversible.')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-100 hover:bg-red-200 text-red-700 transition"
                                        title="Supprimer">
                                    🗑️
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-16 text-center">
                        <div class="text-6xl mb-4">📋</div>
                        <div class="text-xl font-semibold text-gray-700 mb-2">Aucun appel d'offres</div>
                        <div class="text-sm text-gray-500 mb-6">
                            @if(request('search') || request('type') || request('status'))
                                Aucun résultat pour ces filtres.
                            @else
                                Commencez par créer votre premier appel d'offres.
                            @endif
                        </div>
                        @if(request('search') || request('type') || request('status'))
                            <a href="{{ route('admin.tenders.index') }}"
                               class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">
                                ✕ Réinitialiser les filtres
                            </a>
                        @else
                            <a href="{{ route('admin.tenders.create') }}"
                               class="inline-flex items-center gap-2 bg-blue-900 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition">
                                ➕ Créer le premier
                            </a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- PAGINATION --}}
{{-- ═══════════════════════════════════════════════════════ --}}
@if($tenders->hasPages())
    <div class="mt-6">
        {{ $tenders->appends(request()->query())->links() }}
    </div>
@endif

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- AIDE CONTEXTUELLE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 mt-6">
    <div class="flex items-start gap-3">
        <span class="text-2xl">💡</span>
        <div class="text-sm">
            <strong class="text-blue-900 block mb-1">Rappel des statuts :</strong>
            <ul class="space-y-1 text-gray-700">
                <li><strong>🟢 Ouvert</strong> — Les entreprises peuvent encore soumissionner</li>
                <li><strong>✅ Attribué</strong> — Le marché a été gagné (résultats publiés)</li>
                <li><strong>🔒 Clôturé</strong> — Date limite dépassée, en attente d'attribution</li>
            </ul>
        </div>
    </div>
</div>

@endsection