@extends('admin.layout')
@section('title', 'Messages')

@section('content')

{{-- EN-TÊTE --}}
<div class="flex justify-between items-center mb-6 flex-wrap gap-4">
    <div>
        <h1 class="text-3xl font-bold text-blue-900">📬 Messages de contact</h1>
        <p class="text-sm text-gray-500 mt-1">Gérez les messages reçus via le formulaire de contact</p>
    </div>
</div>

{{-- STATISTIQUES --}}
@php
    $allMessages = \App\Models\Contact::all();
    $stats = [
        'total' => $allMessages->count(),
        'unread' => $allMessages->where('is_read', false)->count(),
        'read' => $allMessages->where('is_read', true)->count(),
        'today' => $allMessages->where('created_at', '>=', now()->startOfDay())->count(),
    ];
@endphp

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-blue-900 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Total</div>
        <div class="text-2xl font-bold text-blue-900 mt-1">{{ $stats['total'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-red-500 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">🔴 Non lus</div>
        <div class="text-2xl font-bold text-red-600 mt-1">{{ $stats['unread'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-green-500 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">✅ Lus</div>
        <div class="text-2xl font-bold text-green-600 mt-1">{{ $stats['read'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-orange-500 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">📅 Aujourd'hui</div>
        <div class="text-2xl font-bold text-orange-600 mt-1">{{ $stats['today'] }}</div>
    </div>

</div>

{{-- RECHERCHE + FILTRES --}}
<div class="bg-white rounded-xl shadow-md p-4 mb-6">
    <form method="GET" action="{{ route('admin.messages.index') }}" class="flex flex-wrap gap-3 items-center">

        <div class="flex-1 min-w-[200px] relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher par nom, email ou sujet..."
                   class="w-full pl-10 pr-4 py-2 border-2 border-gray-200 rounded-lg focus:border-blue-900 outline-none transition">
        </div>

        <select name="status" class="border-2 border-gray-200 rounded-lg px-3 py-2 focus:border-blue-900 outline-none transition">
            <option value="">Tous les statuts</option>
            <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>🔴 Non lus</option>
            <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>✅ Lus</option>
        </select>

        <button type="submit" class="bg-blue-900 text-white px-5 py-2 rounded-lg hover:bg-blue-800 transition font-semibold">
            Filtrer
        </button>

        @if(request('search') || request('status'))
            <a href="{{ route('admin.messages.index') }}" class="text-gray-600 hover:text-gray-900 text-sm flex items-center gap-1">
                ✕ Réinitialiser
            </a>
        @endif

    </form>
</div>

{{-- TABLEAU --}}
<div class="bg-white rounded-xl shadow-md overflow-hidden">

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-gray-200">
                <tr>
                    <th class="px-4 py-4 text-left text-xs uppercase tracking-wider font-bold text-gray-600">Expéditeur</th>
                    <th class="px-4 py-4 text-left text-xs uppercase tracking-wider font-bold text-gray-600">Sujet</th>
                    <th class="px-4 py-4 text-center text-xs uppercase tracking-wider font-bold text-gray-600">Date</th>
                    <th class="px-4 py-4 text-center text-xs uppercase tracking-wider font-bold text-gray-600">Statut</th>
                    <th class="px-4 py-4 text-center text-xs uppercase tracking-wider font-bold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($messages as $msg)
                    <tr class="hover:bg-blue-50/50 transition {{ !$msg->is_read ? 'bg-yellow-50/50' : '' }}">

                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm
                                            {{ !$msg->is_read ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-800' }}">
                                    {{ strtoupper(substr($msg->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-blue-900 flex items-center gap-2">
                                        {{ $msg->name }}
                                        @if(!$msg->is_read)
                                            <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $msg->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            <div class="font-semibold text-gray-800">
                                {{ Str::limit($msg->subject, 50) }}
                            </div>
                            <div class="text-xs text-gray-500 mt-0.5">
                                {{ Str::limit($msg->message, 60) }}
                            </div>
                        </td>

                        <td class="px-4 py-4 text-center text-sm">
                            <div class="font-semibold text-gray-800">{{ $msg->created_at->format('d/m/Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $msg->created_at->format('H:i') }}</div>
                            <div class="text-xs text-gray-400">{{ $msg->created_at->diffForHumans() }}</div>
                        </td>

                        <td class="px-4 py-4 text-center">
                            @if(!$msg->is_read)
                                <span class="inline-flex items-center gap-1 bg-red-100 text-red-800 text-xs font-bold px-2.5 py-1 rounded-full">
                                    🔴 Nouveau
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 text-xs font-bold px-2.5 py-1 rounded-full">
                                    ✅ Lu
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center gap-2">

                                <a href="{{ route('admin.messages.show', $msg) }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-800 transition"
                                   title="Voir le message">
                                    👁️
                                </a>

                                <a href="mailto:{{ $msg->email }}?subject=RE: {{ $msg->subject }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-green-100 hover:bg-green-200 text-green-700 transition"
                                   title="Répondre par email">
                                    ✉️
                                </a>

                                <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="inline"
                                      onsubmit="return confirm('⚠️ Supprimer ce message ?\n\nCette action est irréversible.')">
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
                        <td colspan="5" class="px-4 py-16 text-center">
                            <div class="text-6xl mb-4">📬</div>
                            <div class="text-xl font-semibold text-gray-700 mb-2">Aucun message</div>
                            <div class="text-sm text-gray-500 mb-6">
                                @if(request('search') || request('status'))
                                    Aucun résultat pour ces filtres.
                                @else
                                    Vous n'avez pas encore reçu de message de contact.
                                @endif
                            </div>
                            @if(request('search') || request('status'))
                                <a href="{{ route('admin.messages.index') }}"
                                   class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">
                                    ✕ Réinitialiser les filtres
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- PAGINATION --}}
@if($messages->hasPages())
    <div class="mt-6">
        {{ $messages->appends(request()->query())->links() }}
    </div>
@endif

{{-- AIDE CONTEXTUELLE --}}
<div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 mt-6">
    <div class="flex items-start gap-3">
        <span class="text-2xl">💡</span>
        <div class="text-sm">
            <strong class="text-blue-900 block mb-1">Comment ça marche :</strong>
            <ul class="space-y-1 text-gray-700">
                <li><strong>🔴 Nouveau</strong> — Message non lu (marqué automatiquement comme lu quand vous l'ouvrez)</li>
                <li><strong>👁️ Voir</strong> — Ouvre le message en détail</li>
                <li><strong>✉️ Répondre</strong> — Ouvre votre client email avec l'adresse du client</li>
            </ul>
        </div>
    </div>
</div>

@endsection