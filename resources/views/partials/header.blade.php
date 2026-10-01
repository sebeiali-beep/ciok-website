<header class="bg-white shadow-sm sticky top-0 z-50">

    {{-- Top bar --}}
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

        {{-- LOGO CIOK --}}
        <a href="{{ route('home') }}" class="flex items-center gap-4 group flex-shrink-0 py-1">

            <img src="{{ asset('images/logo.webp') }}"
                 alt="CIOK - Ciments d'Oum El Kelil"
                 class="h-16 md:h-20 w-auto object-contain transition duration-300 group-hover:scale-105"
                 style="filter: drop-shadow(0 2px 8px rgba(30, 58, 138, 0.15));">

            <div class="hidden md:block leading-tight border-l-2 border-blue-100 pl-4">
                <div class="font-extrabold text-2xl text-blue-900 tracking-tight">CIOK</div>
                <div class="text-xs text-gray-500 font-medium">Les Ciments d'Oum El Kelil</div>
            </div>

        </a>

        {{-- MENU DESKTOP --}}
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

            {{-- ═══ MARCHÉ PUBLIC (menu déroulant) ═══ --}}
            <li class="relative group">
                <a href="{{ route('tenders.index') }}"
                   class="px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-900 transition flex items-center gap-1 {{ request()->routeIs('tenders.*') ? 'bg-blue-50 text-blue-900 font-semibold' : 'text-gray-700' }}">
                    {{ __('messages.tender_market') }}
                    <svg class="w-4 h-4 transition group-hover:rotate-180" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>

                {{-- Sous-menu --}}
                <ul class="absolute left-0 top-full mt-1 w-64 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-2">
                    <li>
                        <a href="{{ route('tenders.index', ['type' => 'appel_offre']) }}"
                           class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition flex items-center gap-2">
                            📄 {{ __('messages.tender_tenders') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenders.index', ['type' => 'consultation']) }}"
                           class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition flex items-center gap-2">
                            💼 {{ __('messages.tender_consultations') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenders.index', ['type' => 'consultation_elargie']) }}"
                           class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition flex items-center gap-2">
                            📢 {{ __('messages.tender_extended') }}
                        </a>
                    </li>
                    <li class="border-t border-gray-100 my-1"></li>
                    <li>
                        <a href="{{ route('tenders.manual') }}"
                           class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition flex items-center gap-2">
                            📘 {{ __('messages.tender_manual') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenders.plan') }}"
                           class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition flex items-center gap-2">
                            📅 {{ __('messages.tender_plan') }}
                        </a>
                    </li>
                </ul>
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

        {{-- BOUTON MENU MOBILE --}}
        <button class="lg:hidden text-3xl text-blue-900"
                onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                aria-label="Menu">
            ☰
        </button>

    </nav>

    {{-- MENU MOBILE --}}
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
                <a href="{{ route('tenders.index') }}" class="block px-3 py-2 rounded hover:bg-blue-50 font-semibold">
                    📋 {{ __('messages.tender_market') }}
                </a>
                <ul class="pl-6 space-y-1">
                    <li><a href="{{ route('tenders.index', ['type' => 'appel_offre']) }}" class="block px-3 py-1.5 text-sm rounded hover:bg-blue-50">📄 {{ __('messages.tender_tenders') }}</a></li>
                    <li><a href="{{ route('tenders.index', ['type' => 'consultation']) }}" class="block px-3 py-1.5 text-sm rounded hover:bg-blue-50">💼 {{ __('messages.tender_consultations') }}</a></li>
                    <li><a href="{{ route('tenders.index', ['type' => 'consultation_elargie']) }}" class="block px-3 py-1.5 text-sm rounded hover:bg-blue-50">📢 {{ __('messages.tender_extended') }}</a></li>
                    <li><a href="{{ route('tenders.manual') }}" class="block px-3 py-1.5 text-sm rounded hover:bg-blue-50">📘 {{ __('messages.tender_manual') }}</a></li>
                    <li><a href="{{ route('tenders.plan') }}" class="block px-3 py-1.5 text-sm rounded hover:bg-blue-50">📅 {{ __('messages.tender_plan') }}</a></li>
                </ul>
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