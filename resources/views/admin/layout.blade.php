<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - CIOK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Barre du haut --}}
    <header class="bg-blue-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center flex-wrap gap-3">

            {{-- Logo --}}
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white text-blue-900 rounded-lg flex items-center justify-center font-bold text-lg">
                    C
                </div>
                <div>
                    <div class="font-bold text-lg">CIOK Admin</div>
                    <div class="text-xs text-blue-200">Panneau d'administration</div>
                </div>
            </a>

            {{-- Menu --}}
            <nav class="hidden md:flex items-center gap-4 text-sm">
                <a href="{{ route('admin.dashboard') }}"
                   class="hover:text-blue-200 {{ request()->routeIs('admin.dashboard') ? 'text-yellow-400 font-semibold' : '' }}">
                    📊 Dashboard
                </a>

                @if(Auth::user()->canManageProducts())
                    <a href="{{ route('admin.products.index') }}"
                       class="hover:text-blue-200 {{ request()->routeIs('admin.products.*') ? 'text-yellow-400 font-semibold' : '' }}">
                        📦 Produits
                    </a>
                @endif

                @if(Auth::user()->canManagePosts())
                    <a href="{{ route('admin.posts.index') }}"
                       class="hover:text-blue-200 {{ request()->routeIs('admin.posts.*') ? 'text-yellow-400 font-semibold' : '' }}">
                        📰 Actualités
                    </a>
                @endif

                @if(Auth::user()->canManageTenders())
                    <a href="{{ route('admin.tenders.index') }}"
                       class="hover:text-blue-200 {{ request()->routeIs('admin.tenders.*') ? 'text-yellow-400 font-semibold' : '' }}">
                        📋 Appels d'offres
                    </a>
                @endif

                @if(Auth::user()->canManageMessages())
                    <a href="{{ route('admin.messages.index') }}"
                       class="hover:text-blue-200 {{ request()->routeIs('admin.messages.*') ? 'text-yellow-400 font-semibold' : '' }}">
                        📬 Messages
                    </a>
                @endif

                @if(Auth::user()->canManageUsers())
                    <a href="{{ route('admin.users.index') }}"
                       class="hover:text-blue-200 {{ request()->routeIs('admin.users.*') ? 'text-yellow-400 font-semibold' : '' }}">
                        👥 Utilisateurs
                    </a>
                @endif

                <a href="{{ route('home') }}" target="_blank" class="hover:text-blue-200">
                    🌐 Voir le site
                </a>
            </nav>

            {{-- Utilisateur + Déconnexion --}}
            <div class="flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <div class="text-sm font-semibold">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-blue-200">{{ Auth::user()->role_label }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm">
                        Déconnexion
                    </button>
                </form>
            </div>

        </div>
    </header>

    {{-- Messages flash --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded flex items-center gap-2">
                <span class="text-2xl">✅</span>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded flex items-center gap-2">
                <span class="text-2xl">❌</span>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    {{-- Contenu --}}
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

</body>
</html>