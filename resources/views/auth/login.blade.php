<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - CIOK Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 flex items-center justify-center p-4 relative overflow-hidden">

    {{-- Motif décoratif --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 text-[30rem] leading-none select-none">🏭</div>
    </div>

    {{-- Conteneur principal --}}
    <div class="relative w-full max-w-md">

        {{-- Logo CIOK --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3 group">
                <img src="{{ asset('images/logo.webp') }}"
                     alt="CIOK Logo"
                     class="w-16 h-16 object-contain group-hover:scale-105 transition drop-shadow-lg">
                <div class="text-left">
                    <div class="font-extrabold text-3xl text-white">CIOK</div>
                    <div class="text-xs text-blue-200">Ciments d'Oum El Kelil</div>
                </div>
            </a>
        </div>

        {{-- Carte de connexion --}}
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

            {{-- En-tête --}}
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-8 py-6">
                <h1 class="text-white text-2xl font-bold mb-1">🔐 Espace Administrateur</h1>
                <p class="text-blue-200 text-sm">Connectez-vous pour gérer votre site</p>
            </div>

            {{-- Formulaire --}}
            <div class="p-8">

                {{-- Session status --}}
                @if (session('status'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded mb-5 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            📧 Adresse email
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               required autofocus autocomplete="username"
                               placeholder="admin@ciok.tn"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            🔑 Mot de passe
                        </label>
                        <input id="password" type="password" name="password"
                               required autocomplete="current-password"
                               placeholder="••••••••"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember + Forgot --}}
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember"
                                   class="w-4 h-4 accent-blue-900 cursor-pointer">
                            <span class="text-gray-700">Se souvenir de moi</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-blue-700 hover:underline font-semibold">
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>

                    {{-- Bouton --}}
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-900 to-blue-700 text-white py-3.5 rounded-lg font-bold hover:from-blue-800 hover:to-blue-600 transition shadow-md text-base flex items-center justify-center gap-2">
                        🔓 Se connecter
                    </button>

                </form>

            </div>

            {{-- Pied de carte --}}
            <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-500">
                    © {{ date('Y') }} CIOK — Tous droits réservés
                </p>
            </div>

        </div>

        {{-- Lien retour --}}
        <div class="text-center mt-6">
            <a href="/" class="inline-flex items-center gap-2 text-blue-200 hover:text-yellow-400 transition text-sm">
                ← Retour au site
            </a>
        </div>

    </div>

</body>
</html>