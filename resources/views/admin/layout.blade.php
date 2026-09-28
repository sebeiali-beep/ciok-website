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

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- BARRE DU HAUT --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <header class="bg-gradient-to-r from-blue-950 to-blue-900 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center flex-wrap gap-3">

            {{-- Logo admin --}}
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo.webp') }}"
                     alt="CIOK Admin"
                     class="h-12 w-auto object-contain bg-white rounded-lg p-1 transition group-hover:scale-105"
                     style="filter: drop-shadow(0 2px 8px rgba(30, 58, 138, 0.4));">
                <div class="leading-tight border-l-2 border-yellow-500/50 pl-3">
                    <div class="font-extrabold text-lg">CIOK Admin</div>
                    <div class="text-xs text-blue-200">Panneau d'administration</div>
                </div>
            </a>

            {{-- Menu principal --}}
            <nav class="hidden md:flex items-center gap-4 text-sm">

                <a href="{{ route('admin.dashboard') }}"
                   class="px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-yellow-500 text-blue-950 font-bold' : 'hover:bg-blue-800 hover:text-yellow-400' }}">
                    📊 Dashboard
                </a>

                @if(Auth::user()->canManageProducts())
                    <a href="{{ route('admin.products.index') }}"
                       class="px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.products.*') ? 'bg-yellow-500 text-blue-950 font-bold' : 'hover:bg-blue-800 hover:text-yellow-400' }}">
                        📦 Produits
                    </a>
                @endif

                @if(Auth::user()->canManagePosts())
                    <a href="{{ route('admin.posts.index') }}"
                       class="px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.posts.*') ? 'bg-yellow-500 text-blue-950 font-bold' : 'hover:bg-blue-800 hover:text-yellow-400' }}">
                        📰 Actualités
                    </a>
                @endif

                @if(Auth::user()->canManageTenders())
                    <a href="{{ route('admin.tenders.index') }}"
                       class="px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.tenders.*') ? 'bg-yellow-500 text-blue-950 font-bold' : 'hover:bg-blue-800 hover:text-yellow-400' }}">
                        📋 Appels d'offres
                    </a>
                @endif

                @if(Auth::user()->canManageMessages())
                    <a href="{{ route('admin.messages.index') }}"
                       class="px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.messages.*') ? 'bg-yellow-500 text-blue-950 font-bold' : 'hover:bg-blue-800 hover:text-yellow-400' }}">
                        📬 Messages
                    </a>
                @endif

                @if(Auth::user()->canManageUsers())
                    <a href="{{ route('admin.users.index') }}"
                       class="px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.users.*') ? 'bg-yellow-500 text-blue-950 font-bold' : 'hover:bg-blue-800 hover:text-yellow-400' }}">
                        👥 Utilisateurs
                    </a>
                @endif

                <a href="{{ route('home') }}" target="_blank"
                   class="px-3 py-2 rounded-lg hover:bg-blue-800 hover:text-yellow-400 transition flex items-center gap-1">
                    🌐 Voir le site
                </a>

            </nav>

            {{-- Utilisateur + Déconnexion --}}
            <div class="flex items-center gap-3">

                <div class="text-right hidden md:block leading-tight">
                    <div class="text-sm font-semibold">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-blue-300">{{ Auth::user()->role_label }}</div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                        🚪 Déconnexion
                    </button>
                </form>

            </div>

        </div>
    </header>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- MESSAGES FLASH --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-5 py-4 rounded-lg flex items-center gap-3 shadow-sm">
                <span class="text-2xl">✅</span>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800 px-5 py-4 rounded-lg flex items-center gap-3 shadow-sm">
                <span class="text-2xl">❌</span>
                <span class="font-semibold">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- CONTENU PRINCIPAL --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- PIED DE PAGE ADMIN --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <footer class="max-w-7xl mx-auto px-4 py-6 mt-8 border-t border-gray-200">
        <div class="flex flex-wrap justify-between items-center gap-3 text-xs text-gray-500">
            <div>
                © {{ date('Y') }} <strong class="text-blue-900">CIOK</strong> — Panneau d'administration
            </div>
            <div class="flex gap-4">
                <a href="{{ route('home') }}" class="hover:text-blue-900">Site public</a>
                <span>|</span>
                <a href="#" class="hover:text-blue-900">Aide</a>
                <span>|</span>
                <a href="#" class="hover:text-blue-900">Support</a>
            </div>
        </div>
    </footer>

</body>
</html>