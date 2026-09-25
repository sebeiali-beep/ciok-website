@extends('admin.layout')
@section('title', 'Modifier utilisateur')

@section('content')

<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.users.index') }}"
       class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center text-blue-900 hover:bg-blue-50 transition">←</a>
    <div>
        <h1 class="text-3xl font-bold text-blue-900">✏️ Modifier l'utilisateur</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $user->name }} — {{ $user->email }}</p>
    </div>
</div>

<form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
    @csrf @method('PUT')

    {{-- SECTION 1 : IDENTITÉ --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">1</div>
            <h2 class="text-white font-bold text-lg">👤 Identité</h2>
        </div>
        <div class="p-6 space-y-5">
            <div>
                <label class="block font-semibold mb-2 text-gray-800">Nom complet <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 outline-none transition"
                       required>
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-800">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 outline-none transition"
                       required>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-4">
                <div class="font-semibold text-yellow-900 mb-3">🔐 Changer le mot de passe (optionnel)</div>
                <div class="grid md:grid-cols-2 gap-4">
                    <input type="password" name="password" placeholder="Nouveau mot de passe"
                           class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 outline-none transition bg-white">
                    <input type="password" name="password_confirmation" placeholder="Confirmer"
                           class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 outline-none transition bg-white">
                </div>
                <p class="text-xs text-gray-500 mt-2">💡 Laisser vide pour conserver le mot de passe actuel</p>
            </div>
        </div>
    </div>

    {{-- SECTION 2 : RÔLE --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">2</div>
            <h2 class="text-white font-bold text-lg">🔑 Rôle et permissions</h2>
        </div>
        <div class="p-6">
            <div class="space-y-3">
                @foreach($roles as $key => $label)
                    <label class="flex items-center gap-3 cursor-pointer bg-gray-50 hover:bg-blue-50 rounded-lg p-4 transition border-2 border-gray-200 hover:border-blue-300">
                        <input type="radio" name="role" value="{{ $key }}"
                               {{ old('role', $user->role) === $key ? 'checked' : '' }}
                               class="w-5 h-5 accent-blue-900 cursor-pointer" required>
                        <div class="flex-1">
                            <div class="font-bold text-gray-800">{{ $label }}</div>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    {{-- BOUTONS --}}
    <div class="bg-white rounded-xl shadow-md p-6 sticky bottom-4 z-10">
        <div class="flex flex-wrap gap-3 justify-between items-center">
            <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 font-semibold">← Annuler</a>
            <button type="submit" class="bg-blue-900 text-white px-8 py-3 rounded-lg hover:bg-blue-800 transition shadow-md font-semibold">
                💾 Enregistrer
            </button>
        </div>
    </div>

</form>

{{-- ZONE DANGER --}}
@if($user->id !== auth()->id())
    <div class="bg-red-50 border-2 border-red-200 rounded-xl p-6 mt-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <div class="font-bold text-red-900">⚠️ Zone dangereuse</div>
                <div class="text-sm text-red-700 mt-1">Supprimer cet utilisateur est irréversible.</div>
            </div>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                  onsubmit="return confirm('⚠️ Supprimer DÉFINITIVEMENT {{ $user->name }} ?')">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-semibold">
                    🗑️ Supprimer
                </button>
            </form>
        </div>
    </div>
@endif

@endsection