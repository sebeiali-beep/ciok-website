<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - CIOK Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 flex items-center justify-center p-4 relative overflow-hidden">

    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 text-[30rem] leading-none select-none">🏭</div>
    </div>

    <div class="relative w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3 group">
                <img src="{{ asset('images/logo.webp') }}" alt="CIOK Logo"
                     class="w-16 h-16 object-contain group-hover:scale-105 transition drop-shadow-lg">
                <div class="text-left">
                    <div class="font-extrabold text-3xl text-white">CIOK</div>
                    <div class="text-xs text-blue-200">Ciments d'Oum El Kelil</div>
                </div>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

            <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-8 py-6">
                <h1 class="text-white text-2xl font-bold mb-1">👤 Créer un compte</h1>
                <p class="text-blue-200 text-sm">Rejoignez l'espace administrateur</p>
            </div>

            <div class="p-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">👤 Nom complet</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                               required autofocus autocomplete="name"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">📧 Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               required autocomplete="username"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">
                        @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">🔑 Mot de passe</label>
                        <input id="password" type="password" name="password"
                               required autocomplete="new-password"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">
                        @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">🔒 Confirmer</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               required autocomplete="new-password"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <a href="{{ route('login') }}" class="text-sm text-blue-700 hover:underline">
                            Déjà inscrit ?
                        </a>

                        <button type="submit"
                                class="bg-gradient-to-r from-blue-900 to-blue-700 text-white px-6 py-3 rounded-lg font-bold hover:from-blue-800 hover:to-blue-600 transition shadow-md">
                            ✨ S'inscrire
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-500">© {{ date('Y') }} CIOK — Tous droits réservés</p>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="/" class="inline-flex items-center gap-2 text-blue-200 hover:text-yellow-400 transition text-sm">
                ← Retour au site
            </a>
        </div>

    </div>

</body>
</html>