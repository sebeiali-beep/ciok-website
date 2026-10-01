@extends('admin.layout')
@section('title', 'Produits')

@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- EN-TÊTE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="flex justify-between items-center mb-6 flex-wrap gap-4">
    <div>
        <h1 class="text-3xl font-bold text-blue-900">📦 Produits</h1>
        <p class="text-sm text-gray-500 mt-1">Gérez votre catalogue de produits</p>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('products.index') }}" target="_blank"
           class="bg-white border-2 border-blue-900 text-blue-900 px-4 py-2 rounded-lg hover:bg-blue-50 transition flex items-center gap-2 text-sm font-semibold">
            🌐 Voir sur le site
        </a>
        <a href="{{ route('admin.products.create') }}"
           class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition flex items-center gap-2 font-semibold">
            ➕ Nouveau produit
        </a>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- STATISTIQUES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
@php
    $allProducts = \App\Models\Product::all();
    $stats = [
        'total'    => $allProducts->count(),
        'active'   => $allProducts->where('is_active', true)->count(),
        'featured' => $allProducts->where('is_featured', true)->count(),
        'pending'  => $allProducts->where('approval_status', 'pending')->count(),
        'approved' => $allProducts->where('approval_status', 'approved')->count(),
        'rejected' => $allProducts->where('approval_status', 'rejected')->count(),
    ];
@endphp

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 mb-6">
    <div class="bg-white rounded-lg shadow-sm border-l-4 border-blue-900 p-3">
        <div class="text-xs text-gray-500 uppercase font-semibold">Total</div>
        <div class="text-2xl font-bold text-blue-900 mt-1">{{ $stats['total'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-green-500 p-3">
        <div class="text-xs text-gray-500 uppercase font-semibold">✅ Actifs</div>
        <div class="text-2xl font-bold text-green-600 mt-1">{{ $stats['active'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-yellow-500 p-3">
        <div class="text-xs text-gray-500 uppercase font-semibold">⭐ Phares</div>
        <div class="text-2xl font-bold text-yellow-600 mt-1">{{ $stats['featured'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-orange-500 p-3">
        <div class="text-xs text-gray-500 uppercase font-semibold">⏳ En attente</div>
        <div class="text-2xl font-bold text-orange-600 mt-1">{{ $stats['pending'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-green-600 p-3">
        <div class="text-xs text-gray-500 uppercase font-semibold">✅ Approuvés</div>
        <div class="text-2xl font-bold text-green-700 mt-1">{{ $stats['approved'] }}</div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border-l-4 border-red-500 p-3">
        <div class="text-xs text-gray-500 uppercase font-semibold">❌ Rejetés</div>
        <div class="text-2xl font-bold text-red-600 mt-1">{{ $stats['rejected'] }}</div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- FILTRES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="bg-white rounded-xl shadow-md p-4 mb-6">
    <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-wrap gap-3 items-center">

        <div class="flex-1 min-w-[200px] relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher un produit..."
                   class="w-full pl-10 pr-4 py-2 border-2 border-gray-200 rounded-lg focus:border-blue-900 outline-none transition">
        </div>

        <select name="category" class="border-2 border-gray-200 rounded-lg px-3 py-2">
            <option value="">Toutes les catégories</option>
            @foreach(\App\Models\Category::all() as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <select name="approval" class="border-2 border-gray-200 rounded-lg px-3 py-2">
            <option value="">Toutes les approbations</option>
            <option value="pending" {{ request('approval') === 'pending' ? 'selected' : '' }}>⏳ En attente</option>
            <option value="approved" {{ request('approval') === 'approved' ? 'selected' : '' }}>✅ Approuvés</option>
            <option value="rejected" {{ request('approval') === 'rejected' ? 'selected' : '' }}>❌ Rejetés</option>
        </select>

        <button type="submit" class="bg-blue-900 text-white px-5 py-2 rounded-lg hover:bg-blue-800 transition font-semibold">
            Filtrer
        </button>

        @if(request()->hasAny(['search', 'category', 'approval']))
            <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900 text-sm">✕ Réinitialiser</a>
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
                    <th class="px-4 py-4 text-left text-xs uppercase font-bold text-gray-600">Produit</th>
                    <th class="px-4 py-4 text-left text-xs uppercase font-bold text-gray-600">Catégorie</th>
                    <th class="px-4 py-4 text-center text-xs uppercase font-bold text-gray-600">Statut</th>
                    <th class="px-4 py-4 text-center text-xs uppercase font-bold text-gray-600">Approbation</th>
                    <th class="px-4 py-4 text-center text-xs uppercase font-bold text-gray-600">Phare</th>
                    <th class="px-4 py-4 text-center text-xs uppercase font-bold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)

                    @php
                        $imgSrc = null;
                        $nameLower = strtolower($product->name);
                        if ($product->image) {
                            $imgSrc = asset('storage/' . $product->image);
                        } elseif (str_contains($nameLower, 'cem i ') && !str_contains($nameLower, 'cem ii')) {
                            $imgSrc = asset('images/produits/ciment-cem1-vert.webp');
                        } elseif (str_contains($nameLower, 'cem ii')) {
                            $imgSrc = asset('images/produits/ciment-cem2-bleu.webp');
                        }
                    @endphp

                    <tr class="hover:bg-blue-50/50 transition">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                @if($imgSrc)
                                    <img src="{{ $imgSrc }}" alt="{{ $product->name }}"
                                         class="w-14 h-14 object-contain bg-gray-50 rounded-lg p-1 border border-gray-100">
                                @else
                                    <div class="w-14 h-14 bg-gray-200 rounded-lg flex items-center justify-center text-xl">📦</div>
                                @endif
                                <div>
                                    <div class="font-bold text-blue-900">{{ $product->name }}</div>
                                    @if($product->description)
                                        <div class="text-xs text-gray-500 mt-0.5">
                                            {{ Str::limit($product->description, 60) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            @if($product->category)
                                <span class="inline-flex items-center bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-1 rounded-full">
                                    {{ $product->category->name }}
                                </span>
                            @else
                                <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>

                        <td class="px-4 py-4 text-center">
                            @if($product->is_active)
                                <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 text-xs font-bold px-2.5 py-1 rounded-full">
                                    ✅ Actif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 text-xs font-bold px-2.5 py-1 rounded-full">
                                    ❌ Inactif
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-4 text-center">
                            <span class="inline-flex items-center gap-1 bg-{{ $product->approval_color }}-100 text-{{ $product->approval_color }}-800 px-2.5 py-1 rounded-full text-xs font-bold">
                                {{ $product->approval_label }}
                            </span>
                        </td>

                        <td class="px-4 py-4 text-center">
                            @if($product->is_featured)
                                <span class="text-2xl">⭐</span>
                            @else
                                <span class="text-gray-300 text-2xl">☆</span>
                            @endif
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center gap-2 flex-wrap">

                                {{-- Approuver / Rejeter --}}
                                @if($product->approval_status === 'pending' && Auth::user()->canManageUsers())
                                    <form action="{{ route('admin.products.approve', $product) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-green-100 hover:bg-green-200 text-green-800 transition"
                                                title="Approuver">✅</button>
                                    </form>
                                    <button type="button" onclick="rejectProduct({{ $product->id }})"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-100 hover:bg-red-200 text-red-800 transition"
                                            title="Rejeter">❌</button>
                                @endif

                                <a href="{{ route('products.show', $product->slug) }}" target="_blank"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-blue-100 text-blue-700 transition"
                                   title="Voir sur le site">🌐</a>

                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-800 transition"
                                   title="Modifier">✏️</a>

                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline"
                                      onsubmit="return confirm(@js('Supprimer DÉFINITIVEMENT ' . $product->name . ' ? Action irréversible.'))">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-100 hover:bg-red-200 text-red-700 transition"
                                            title="Supprimer">🗑️</button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-16 text-center">
                            <div class="text-6xl mb-4">📦</div>
                            <div class="text-xl font-semibold text-gray-700 mb-2">Aucun produit</div>
                            <div class="text-sm text-gray-500 mb-6">
                                @if(request()->hasAny(['search', 'category', 'approval']))
                                    Aucun résultat pour ces filtres.
                                @else
                                    Commencez par créer votre premier produit.
                                @endif
                            </div>
                            @if(request()->hasAny(['search', 'category', 'approval']))
                                <a href="{{ route('admin.products.index') }}"
                                   class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">
                                    ✕ Réinitialiser les filtres
                                </a>
                            @else
                                <a href="{{ route('admin.products.create') }}"
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

{{-- PAGINATION --}}
@if($products->hasPages())
    <div class="mt-6">{{ $products->appends(request()->query())->links() }}</div>
@endif

{{-- AIDE --}}
<div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 mt-6">
    <div class="flex items-start gap-3">
        <span class="text-2xl">💡</span>
        <div class="text-sm">
            <strong class="text-blue-900 block mb-1">Rappel :</strong>
            <ul class="space-y-1 text-gray-700">
                <li><strong>⭐ Phare</strong> — Apparaît sur la page d'accueil</li>
                <li><strong>✅ Actif</strong> — Visible sur le site public</li>
                <li><strong>⏳ En attente</strong> — Doit être approuvé par un Admin/Super Admin</li>
                <li><strong>✅ Approuvé</strong> — Validé et publié</li>
                <li><strong>❌ Rejeté</strong> — Non conforme, à corriger</li>
            </ul>
        </div>
    </div>
</div>

{{-- SCRIPT DE REJET --}}
<script>
function rejectProduct(id) {
    const reason = prompt('Motif du rejet :');
    if (reason && reason.trim() !== '') {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/products/${id}/reject`;

        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';

        const reasonInput = document.createElement('input');
        reasonInput.type = 'hidden';
        reasonInput.name = 'rejection_reason';
        reasonInput.value = reason.trim();

        form.appendChild(csrf);
        form.appendChild(reasonInput);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

@endsection