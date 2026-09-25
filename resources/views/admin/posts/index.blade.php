@extends('admin.layout')
@section('title', 'Actualités')

@section('content')

{{-- EN-TÊTE --}}
<div class="flex justify-between items-center mb-6 flex-wrap gap-4">
    <div>
        <h1 class="text-3xl font-bold text-blue-900">📰 Actualités</h1>
        <p class="text-sm text-gray-500 mt-1">Gérez vos articles et communiqués</p>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('posts.index') }}" target="_blank"
           class="bg-white border-2 border-green-600 text-green-700 px-4 py-2 rounded-lg hover:bg-green-50 transition flex items-center gap-2 text-sm font-semibold">
            🌐 Voir sur le site
        </a>
        <a href="{{ route('admin.posts.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2 font-semibold">
            ➕ Nouvelle actualité
        </a>
    </div>
</div>

{{-- STATISTIQUES --}}
@php
    $allPosts = \App\Models\Post::all();
    $stats = [
        'total' => $allPosts->count(),
        'published' => $allPosts->where('is_published', true)->count(),
        'draft' => $allPosts->where('is_published', false)->count(),
        'this_month' => $allPosts->where('published_at', '>=', now()->startOfMonth())->count(),
    ];
@endphp

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-green-600 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Total</div>
        <div class="text-2xl font-bold text-green-700 mt-1">{{ $stats['total'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-blue-500 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">✅ Publiés</div>
        <div class="text-2xl font-bold text-blue-600 mt-1">{{ $stats['published'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-orange-500 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">⏳ Brouillons</div>
        <div class="text-2xl font-bold text-orange-600 mt-1">{{ $stats['draft'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-purple-500 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">📅 Ce mois</div>
        <div class="text-2xl font-bold text-purple-600 mt-1">{{ $stats['this_month'] }}</div>
    </div>

</div>

{{-- RECHERCHE + FILTRES --}}
<div class="bg-white rounded-xl shadow-md p-4 mb-6">
    <form method="GET" action="{{ route('admin.posts.index') }}" class="flex flex-wrap gap-3 items-center">

        <div class="flex-1 min-w-[200px] relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher une actualité..."
                   class="w-full pl-10 pr-4 py-2 border-2 border-gray-200 rounded-lg focus:border-green-600 outline-none transition">
        </div>

        <select name="status" class="border-2 border-gray-200 rounded-lg px-3 py-2 focus:border-green-600 outline-none transition">
            <option value="">Tous les statuts</option>
            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>✅ Publiés</option>
            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>⏳ Brouillons</option>
        </select>

        <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition font-semibold">
            Filtrer
        </button>

        @if(request('search') || request('status'))
            <a href="{{ route('admin.posts.index') }}" class="text-gray-600 hover:text-gray-900 text-sm flex items-center gap-1">
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
                    <th class="px-4 py-4 text-left text-xs uppercase tracking-wider font-bold text-gray-600">Actualité</th>
                    <th class="px-4 py-4 text-center text-xs uppercase tracking-wider font-bold text-gray-600">Date</th>
                    <th class="px-4 py-4 text-center text-xs uppercase tracking-wider font-bold text-gray-600">Statut</th>
                    <th class="px-4 py-4 text-center text-xs uppercase tracking-wider font-bold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($posts as $post)
                    <tr class="hover:bg-green-50/50 transition">

                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}"
                                         alt="{{ $post->title }}"
                                         class="w-16 h-12 object-cover rounded-lg border border-gray-100">
                                @else
                                    <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-xl">📰</div>
                                @endif
                                <div>
                                    <div class="font-bold text-blue-900">
                                        {{ Str::limit($post->title, 60) }}
                                    </div>
                                    @if($post->excerpt)
                                        <div class="text-xs text-gray-500 mt-0.5">
                                            {{ Str::limit($post->excerpt, 70) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-4 text-center text-sm text-gray-600">
                            @if($post->published_at)
                                <div class="font-semibold text-gray-800">{{ $post->published_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $post->published_at->diffForHumans() }}</div>
                            @else
                                <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>

                        <td class="px-4 py-4 text-center">
                            @if($post->is_published)
                                <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 text-xs font-bold px-2.5 py-1 rounded-full">
                                    ✅ Publié
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 bg-orange-100 text-orange-800 text-xs font-bold px-2.5 py-1 rounded-full">
                                    ⏳ Brouillon
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center gap-2">

                                <a href="{{ route('posts.show', $post->slug) }}" target="_blank"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-blue-100 text-blue-700 transition"
                                   title="Voir sur le site">
                                    🌐
                                </a>

                                <a href="{{ route('admin.posts.edit', $post) }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-800 transition"
                                   title="Modifier">
                                    ✏️
                                </a>

                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline"
                                      onsubmit="return confirm('⚠️ Supprimer DÉFINITIVEMENT cette actualité ?\n\nCette action est irréversible.')">
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
                        <td colspan="4" class="px-4 py-16 text-center">
                            <div class="text-6xl mb-4">📰</div>
                            <div class="text-xl font-semibold text-gray-700 mb-2">Aucune actualité</div>
                            <div class="text-sm text-gray-500 mb-6">
                                @if(request('search') || request('status'))
                                    Aucun résultat pour ces filtres.
                                @else
                                    Commencez par créer votre première actualité.
                                @endif
                            </div>
                            @if(request('search') || request('status'))
                                <a href="{{ route('admin.posts.index') }}"
                                   class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">
                                    ✕ Réinitialiser les filtres
                                </a>
                            @else
                                <a href="{{ route('admin.posts.create') }}"
                                   class="inline-flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                                    ➕ Créer la première
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
@if($posts->hasPages())
    <div class="mt-6">
        {{ $posts->appends(request()->query())->links() }}
    </div>
@endif

{{-- AIDE CONTEXTUELLE --}}
<div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mt-6">
    <div class="flex items-start gap-3">
        <span class="text-2xl">💡</span>
        <div class="text-sm">
            <strong class="text-green-900 block mb-1">Rappel :</strong>
            <ul class="space-y-1 text-gray-700">
                <li><strong>✅ Publié</strong> — Visible sur le site public</li>
                <li><strong>⏳ Brouillon</strong> — Masqué, non visible par les visiteurs</li>
                <li><strong>🌐 Voir sur le site</strong> — Ouvre la page publique</li>
            </ul>
        </div>
    </div>
</div>

@endsection