@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

<h1 class="text-3xl font-bold text-blue-900 mb-8">📊 Tableau de bord</h1>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- STATISTIQUES (5 cartes) --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">

    {{-- Produits --}}
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-900">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Produits</p>
                <p class="text-3xl font-bold text-blue-900">{{ $stats['products'] }}</p>
            </div>
            <div class="text-4xl">📦</div>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-blue-700 text-sm hover:underline mt-3 inline-block">
            Voir →
        </a>
    </div>

    {{-- Actualités --}}
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-600">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Actualités</p>
                <p class="text-3xl font-bold text-green-600">{{ $stats['posts'] }}</p>
            </div>
            <div class="text-4xl">📰</div>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="text-green-700 text-sm hover:underline mt-3 inline-block">
            Voir →
        </a>
    </div>

    {{-- Appels d'offres --}}
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-600">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Appels d'offres</p>
                <p class="text-3xl font-bold text-purple-600">{{ $stats['tenders'] }}</p>
                @if($stats['open_tenders'] > 0)
                    <p class="text-xs text-green-600 font-semibold">
                        {{ $stats['open_tenders'] }} ouverts
                    </p>
                @endif
            </div>
            <div class="text-4xl">📋</div>
        </div>
        <a href="{{ route('admin.tenders.index') }}" class="text-purple-700 text-sm hover:underline mt-3 inline-block">
            Voir →
        </a>
    </div>

    {{-- Messages --}}
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-orange-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Messages</p>
                <p class="text-3xl font-bold text-orange-500">{{ $stats['contacts'] }}</p>
                @if($stats['unread_contacts'] > 0)
                    <p class="text-xs text-red-600 font-semibold">
                        {{ $stats['unread_contacts'] }} non lus
                    </p>
                @endif
            </div>
            <div class="text-4xl">📬</div>
        </div>
        <a href="{{ route('admin.messages.index') }}" class="text-orange-700 text-sm hover:underline mt-3 inline-block">
            Voir →
        </a>
    </div>

    {{-- Utilisateurs --}}
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-cyan-600">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Utilisateurs</p>
                <p class="text-3xl font-bold text-cyan-600">{{ $stats['users'] }}</p>
            </div>
            <div class="text-4xl">👥</div>
        </div>
    </div>

</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- ACTIONS RAPIDES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="bg-white rounded-xl shadow-md p-6 mb-8">
    <h2 class="text-xl font-bold text-blue-900 mb-4">⚡ Actions rapides</h2>
    <div class="flex flex-wrap gap-3">

        <a href="{{ route('admin.products.create') }}"
           class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition flex items-center gap-2">
            ➕ Nouveau produit
        </a>

        <a href="{{ route('admin.posts.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
            ➕ Nouvelle actualité
        </a>

        <a href="{{ route('admin.tenders.create') }}"
           class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition flex items-center gap-2">
            ➕ Nouvel appel d'offres
        </a>

        <a href="{{ route('admin.messages.index') }}"
           class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition flex items-center gap-2">
            📬 Voir les messages
        </a>

    </div>
</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- APERÇUS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="grid md:grid-cols-2 gap-6">

    {{-- Derniers messages --}}
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-xl font-bold text-blue-900 mb-4 flex items-center justify-between">
            <span>📬 Derniers messages</span>
            <a href="{{ route('admin.messages.index') }}" class="text-sm text-blue-600 hover:underline">
                Voir tous
            </a>
        </h2>

        @if($latestContacts->isEmpty())
            <p class="text-gray-500 text-center py-4">Aucun message.</p>
        @else
            <ul class="space-y-3">
                @foreach($latestContacts as $contact)
                    <li class="border-b pb-3 last:border-0">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800 flex items-center gap-2">
                                    {{ $contact->name }}
                                    @if(!$contact->is_read)
                                        <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded">
                                            Nouveau
                                        </span>
                                    @endif
                                </p>
                                <p class="text-sm text-gray-600">{{ Str::limit($contact->subject, 50) }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $contact->created_at->diffForHumans() }}</p>
                            </div>
                            <a href="{{ route('admin.messages.show', $contact) }}"
                               class="text-blue-600 hover:underline text-sm whitespace-nowrap ml-3">
                                Voir →
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Derniers produits --}}
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-xl font-bold text-blue-900 mb-4 flex items-center justify-between">
            <span>📦 Derniers produits</span>
            <a href="{{ route('admin.products.index') }}" class="text-sm text-blue-600 hover:underline">
                Voir tous
            </a>
        </h2>

        @if($latestProducts->isEmpty())
            <p class="text-gray-500 text-center py-4">Aucun produit.</p>
        @else
            <ul class="space-y-3">
                @foreach($latestProducts as $product)
                    <li class="border-b pb-3 last:border-0">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">{{ $product->name }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $product->category?->name }} — créé {{ $product->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="text-blue-600 hover:underline text-sm whitespace-nowrap ml-3">
                                Modifier →
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</div>

@endsection