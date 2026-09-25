@extends('admin.layout')
@section('title', 'Nouvel utilisateur')

@section('content')

<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.users.index') }}"
       class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center text-blue-900 hover:bg-blue-50 transition">←</a>
    <div>
        <h1 class="text-3xl font-bold text-blue-900">➕ Nouvel utilisateur</h1>
        <p class="text-sm text-gray-500 mt-1">Créez un nouveau compte administrateur</p>
    </div>
</div>

<form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
    @csrf

    {{-- SECTION 1 : IDENTITÉ --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">1</div>
            <h2 class="text-white font-bold text-lg">👤 Identité</h2>
        </div>
        <div class="p-6 space-y-5">
            <div>
                <label class="block font-semibold mb-2 text-gray-800">Nom complet <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 outline-none transition"
                       required>
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-800">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 outline-none transition"
                       required>
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold mb-2 text-gray-800">Mot de passe <span class="text-red-500">*</span></label>
                    <input type="password" name="password"
                           class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 outline-none transition"
                           required>
                    @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block font-semibold mb-2 text-gray-800">Confirmer <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation"
                           class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 outline-none transition"
                           required>
                </div>
            </div>
            <p class="text-xs text-gray-500">💡 Minimum 8 caractères</p>
        </div>
    </div>

    {{-- SECTION 2 : RÔLE --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">2</div>
            <h2 class="text-white font-bold text-lg">🔑 Rôle et permissions</h2>
        </div>
        <div class="p-6">
            <label class="block font-semibold mb-3 text-gray-800">Choisir un rôle <span class="text-red-500">*</span></label>

            <div class="space-y-3">
                @foreach($roles as $key => $label)
                    <label class="flex items-center gap-3 cursor-pointer bg-gray-50 hover:bg-blue-50 rounded-lg p-4 transition border-2 border-gray-200 hover:border-blue-300">
                        <input type="radio" name="role" value="{{ $key }}"
                               {{ old('role') === $key ? 'checked' : '' }}
                               class="w-5 h-5 accent-blue-900 cursor-pointer" required>
                        <div class="flex-1">
                            <div class="font-bold text-gray-800">{{ $label }}</div>
                            <div class="text-xs text-gray-500 mt-1">
                                @switch($key)
                                    @case('admin')
                                        Accès à toutes les sections sauf la gestion des Super Admins
                                        @break
                                    @case('product_manager')
                                        Peut gérer uniquement les produits
                                        @break
                                    @case('post_manager')
                                        Peut gérer uniquement les actualités
                                        @break
                                    @case('tender_manager')
                                        Peut gérer uniquement les appels d'offres
                                        @break
                                    @case('message_manager')
                                        Peut voir et gérer uniquement les messages
                                        @break
                                    @case('viewer')
                                        Peut uniquement consulter le dashboard (lecture seule)
                                        @break
                                @endswitch
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>

            @error('role') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- BOUTONS --}}
    <div class="bg-white rounded-xl shadow-md p-6 sticky bottom-4 z-10">
        <div class="flex flex-wrap gap-3 justify-between items-center">
            <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 font-semibold">← Annuler</a>
            <button type="submit" class="bg-blue-900 text-white px-8 py-3 rounded-lg hover:bg-blue-800 transition shadow-md font-semibold">
                💾 Créer l'utilisateur
            </button>
        </div>
    </div>

</form>

@endsection