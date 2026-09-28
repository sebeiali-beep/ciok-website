<header class="bg-white shadow-sm sticky top-0 z-50">

    {{-- Top bar (bandeau bleu foncé) --}}
    <div class="bg-blue-950 text-white text-xs md:text-sm border-b border-blue-800">
        <div class="max-w-7xl mx-auto px-4 py-2 flex flex-col md:flex-row justify-between items-center gap-2">

            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1">
                    <span>📞</span> +216 78 253 816
                </span>
                <span class="hidden md:flex items-center gap-1">
                    <span>✉️</span> dg@ciok.com.tn
                </span>
            </div>

            <div class="flex items-center gap-3">
                <span class="hidden md:inline text-blue-300">|</span>
                <a href="{{ route('lang.switch', 'fr') }}"
                   class="hover:text-yellow-300 transition {{ app()->getLocale() === 'fr' ? 'font-bold text-yellow-300 underline' : '' }}">
                    🇫🇷 FR
                </a>
                <a href="{{ route('lang.switch', 'ar') }}"
                   class="hover:text-yellow-300 transition {{ app()->getLocale() === 'ar' ? 'font-bold text-yellow-300 underline' : '' }}">
                    🇹🇳 AR
                </a>
                <a href="{{ route('lang.switch', 'en') }}"
                   class="hover:text-yellow-300 transition {{ app()->getLocale() === 'en' ? 'font-bold text-yellow-300 underline' : '' }}">
                    🇬🇧 EN
                </a>
            </div>

        </div>
    </div>

    {{-- Navbar principale --}}
    <nav class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center gap-6">

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- LOGO CIOK --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <a href="{{ route('home') }}" class="flex items-center gap-4 group flex-shrink-0 py-1">

            {{-- Logo image --}}
            <img src="{{ asset('images/logo.webp') }}"
                 alt="CIOK - Ciments d'Oum El Kelil"
                 class="h-16 md:h-20 w-auto object-contain transition duration-300 group-hover:scale-105"
                 style="filter: drop-shadow(0 2px 8px rgba(30, 58, 138, 0.15));">

            {{-- Texte à côté du logo --}}
            <div class="hidden md:block leading-tight border-l-2 border-blue-100 pl-4">
                <div class="font-extrabold text-2xl text-blue-900 tracking-tight">CIOK</div>
                <div class="text-xs text-gray-500 font-medium">Ciments d'Oum El Kelil</div>
            </div>

        </a>

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- MENU DESKTOP --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <ul class="hidden lg:flex gap-1 items-center font-medium text-sm">

            <li>
                <a href="{{ route('home') }}"
                   class="px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-900 font-semibold' : 'text-gray-700' }}">
                    {{ __('messages.home') }}
                </a>
            </li>

            <li>
                <a href="{{ route('about') }}"
                   class="px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-900 font-semibold' : 'text-gray-700' }}">
                    {{ __('messages.about') }}
                </a>
            </li>

            <li>
                <a href="{{ route('products.index') }}"
                   class="px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition {{ request()->routeIs('products.*') ? 'bg-blue-50 text-blue-900 font-semibold' : 'text-gray-700' }}">
                    {{ __('messages.products') }}
                </a>
            </li>

            <li>
                <a href="{{ route('posts.index') }}"
                   class="px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition {{ request()->routeIs('posts.*') ? 'bg-blue-50 text-blue-900 font-semibold' : 'text-gray-700' }}">
                    {{ __('messages.news') }}
                </a>
            </li>

            <li>
                <a href="{{ route('tenders.index') }}"
                   class="px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition {{ request()->routeIs('tenders.*') ? 'bg-blue-50 text-blue-900 font-semibold' : 'text-gray-700' }}">
                    Appels d'offres
                </a>
            </li>

            <li>
                <a href="{{ route('quality') }}"
                   class="px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition {{ request()->routeIs('quality') ? 'bg-blue-50 text-blue-900 font-semibold' : 'text-gray-700' }}">
                    {{ __('messages.quality') }}
                </a>
            </li>

            <li>
                <a href="{{ route('careers') }}"
                   class="px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition {{ request()->routeIs('careers') ? 'bg-blue-50 text-blue-900 font-semibold' : 'text-gray-700' }}">
                    {{ __('messages.careers') }}
                </a>
            </li>

            <li class="ml-2">
                <a href="{{ route('contact.show') }}"
                   class="bg-gradient-to-r from-blue-900 to-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold hover:from-blue-800 hover:to-blue-600 transition shadow-md">
                    {{ __('messages.contact') }}
                </a>
            </li>

        </ul>

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- BOUTON MENU MOBILE --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <button class="lg:hidden text-3xl text-blue-900"
                onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
            ☰
        </button>

    </nav>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- MENU MOBILE --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-t">
        <ul class="px-4 py-3 space-y-1">

            <li>
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded hover:bg-blue-50">
                    {{ __('messages.home') }}
                </a>
            </li>
            <li>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded hover:bg-blue-50">
                    {{ __('messages.about') }}
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded hover:bg-blue-50">
                    {{ __('messages.products') }}
                </a>
            </li>
            <li>
                <a href="{{ route('posts.index') }}" class="block px-3 py-2 rounded hover:bg-blue-50">
                    {{ __('messages.news') }}
                </a>
            </li>
            <li>
                <a href="{{ route('tenders.index') }}" class="block px-3 py-2 rounded hover:bg-blue-50">
                    📋 Appels d'offres
                </a>
            </li>
            <li>
                <a href="{{ route('quality') }}" class="block px-3 py-2 rounded hover:bg-blue-50">
                    {{ __('messages.quality') }}
                </a>
            </li>
            <li>
                <a href="{{ route('careers') }}" class="block px-3 py-2 rounded hover:bg-blue-50">
                    {{ __('messages.careers') }}
                </a>
            </li>
            <li>
                <a href="{{ route('contact.show') }}" class="block px-3 py-2 rounded bg-blue-900 text-white">
                    {{ __('messages.contact') }}
                </a>
            </li>

        </ul>
    </div>

</header>