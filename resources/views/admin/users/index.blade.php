@extends('admin.layout')
@section('title', 'Utilisateurs')

@section('content')

{{-- EN-TÊTE --}}
<div class="flex justify-between items-center mb-6 flex-wrap gap-4">
    <div>
        <h1 class="text-3xl font-bold text-blue-900">👥 Utilisateurs</h1>
        <p class="text-sm text-gray-500 mt-1">Gérez les comptes et permissions</p>
    </div>

    <a href="{{ route('admin.users.create') }}"
       class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition flex items-center gap-2 font-semibold">
        ➕ Nouvel utilisateur
    </a>
</div>

{{-- STATISTIQUES --}}
@php
    $allUsers = \App\Models\User::all();
    $stats = [
        'total' => $allUsers->count(),
        'admins' => $allUsers->whereIn('role', ['super_admin', 'admin'])->count(),
        'managers' => $allUsers->whereIn('role', ['product_manager', 'post_manager', 'tender_manager', 'message_manager'])->count(),
        'viewers' => $allUsers->where('role', 'viewer')->count(),
    ];
@endphp

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow-sm border-l-4 border-blue-900 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Total</div>
        <div class="text-2xl font-bold text-blue-900 mt-1">{{ $stats['total'] }}</div>
    </div>
    <div class="bg-white rounded-lg shadow-sm border-l-4 border-purple-500 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">👑 Admins</div>
        <div class="text-2xl font-bold text-purple-600 mt-1">{{ $stats['admins'] }}</div>
    </div>
    <div class="bg-white rounded-lg shadow-sm border-l-4 border-green-500 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">📋 Gestionnaires</div>
        <div class="text-2xl font-bold text-green-600 mt-1">{{ $stats['managers'] }}</div>
    </div>
    <div class="bg-white rounded-lg shadow-sm border-l-4 border-gray-400 p-4">
        <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">👁️ Lecteurs</div>
        <div class="text-2xl font-bold text-gray-600 mt-1">{{ $stats['viewers'] }}</div>
    </div>
</div>

{{-- RECHERCHE + FILTRES --}}
<div class="bg-white rounded-xl shadow-md p-4 mb-6">
    <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap gap-3 items-center">
        <div class="flex-1 min-w-[200px] relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher par nom ou email..."
                   class="w-full pl-10 pr-4 py-2 border-2 border-gray-200 rounded-lg focus:border-blue-900 outline-none transition">
        </div>

        <select name="role" class="border-2 border-gray-200 rounded-lg px-3 py-2 focus:border-blue-900 outline-none transition">
            <option value="">Tous les rôles</option>
            @foreach($roles as $key => $label)
                <option value="{{ $key }}" {{ request('role') === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-900 text-white px-5 py-2 rounded-lg hover:bg-blue-800 transition font-semibold">
            Filtrer
        </button>

        @if(request('search') || request('role'))
            <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 text-sm flex items-center gap-1">
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
                    <th class="px-4 py-4 text-left text-xs uppercase tracking-wider font-bold text-gray-600">Utilisateur</th>
                    <th class="px-4 py-4 text-left text-xs uppercase tracking-wider font-bold text-gray-600">Rôle</th>
                    <th class="px-4 py-4 text-center text-xs uppercase tracking-wider font-bold text-gray-600">Permissions</th>
                    <th class="px-4 py-4 text-center text-xs uppercase tracking-wider font-bold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                    <tr class="hover:bg-blue-50/50 transition">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm
                                            {{ $user->id === auth()->id() ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-blue-900 flex items-center gap-2">
                                        {{ $user->name }}
                                        @if($user->id === auth()->id())
                                            <span class="text-xs bg-yellow-100 text-yellow-800 font-bold px-2 py-0.5 rounded-full">Vous</span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            <span class="inline-flex items-center gap-1 bg-{{ $user->role_color }}-100 text-{{ $user->role_color }}-800 text-xs font-bold px-3 py-1 rounded-full">
                                {{ $user->role_label }}
                            </span>
                        </td>

                        <td class="px-4 py-4 text-center">
                            <div class="flex flex-wrap gap-1 justify-center">
                                @if($user->canManageProducts())
                                    <span class="text-xs bg-indigo-100 text-indigo-800 font-bold px-2 py-0.5 rounded">📦</span>
                                @endif
                                @if($user->canManagePosts())
                                    <span class="text-xs bg-green-100 text-green-800 font-bold px-2 py-0.5 rounded">📰</span>
                                @endif
                                @if($user->canManageTenders())
                                    <span class="text-xs bg-yellow-100 text-yellow-800 font-bold px-2 py-0.5 rounded">📋</span>
                                @endif
                                @if($user->canManageMessages())
                                    <span class="text-xs bg-orange-100 text-orange-800 font-bold px-2 py-0.5 rounded">📬</span>
                                @endif
                                @if($user->canManageUsers())
                                    <span class="text-xs bg-purple-100 text-purple-800 font-bold px-2 py-0.5 rounded">👥</span>
                                @endif
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-800 transition"
                                   title="Modifier">
                                    ✏️
                                </a>

                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                                          onsubmit="return confirm('⚠️ Supprimer cet utilisateur ?\n\nCette action est irréversible.')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-100 hover:bg-red-200 text-red-700 transition"
                                                title="Supprimer">
                                            🗑️
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-16 text-center">
                            <div class="text-6xl mb-4">👥</div>
                            <div class="text-xl font-semibold text-gray-700 mb-2">Aucun utilisateur</div>
                            <a href="{{ route('admin.users.create') }}"
                               class="inline-flex items-center gap-2 bg-blue-900 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition mt-4">
                                ➕ Créer le premier
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($users->hasPages())
    <div class="mt-6">{{ $users->appends(request()->query())->links() }}</div>
@endif

@endsection