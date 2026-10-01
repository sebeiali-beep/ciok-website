<footer class="bg-blue-950 text-white mt-20">

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- BANDEAU SUPÉRIEUR --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="border-b border-blue-900">
        <div class="max-w-7xl mx-auto px-4 py-12 grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            {{-- Colonne 1 : Logo + description --}}
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <img src="{{ asset('images/logo.webp') }}"
                         alt="CIOK Logo"
                         class="h-16 w-auto object-contain bg-white/10 backdrop-blur-sm rounded-lg p-1"
                         style="filter: drop-shadow(0 2px 8px rgba(250, 204, 21, 0.2));">
                    <div class="leading-tight border-l-2 border-yellow-500/50 pl-3">
                        <div class="font-extrabold text-xl text-white">CIOK</div>
                        <div class="text-xs text-blue-300">Ciments d'Oum El Kelil</div>
                    </div>
                </div>

                <p class="text-blue-200 text-sm leading-relaxed mb-4">
                    Acteur industriel majeur contribuant au développement des infrastructures
                    et du secteur du bâtiment en Tunisie depuis 1979.
                </p>

                <div class="flex gap-2 text-xs text-blue-300">
                    <span class="bg-blue-900/50 px-2 py-1 rounded">🏆 ISO 9001</span>
                    <span class="bg-blue-900/50 px-2 py-1 rounded">🇹🇳 NT 47.01</span>
                </div>
            </div>

            {{-- Colonne 2 : Navigation --}}
            <div>
                <h4 class="font-bold text-yellow-400 mb-5 uppercase text-sm tracking-wider flex items-center gap-2">
                    <span class="w-1 h-4 bg-yellow-400 rounded"></span>
                    Navigation
                </h4>
                <ul class="text-blue-200 text-sm space-y-2.5">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-yellow-400 transition flex items-center gap-2">
                            <span class="text-xs">→</span> {{ __('messages.home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="hover:text-yellow-400 transition flex items-center gap-2">
                            <span class="text-xs">→</span> {{ __('messages.about') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" class="hover:text-yellow-400 transition flex items-center gap-2">
                            <span class="text-xs">→</span> {{ __('messages.products') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('posts.index') }}" class="hover:text-yellow-400 transition flex items-center gap-2">
                            <span class="text-xs">→</span> {{ __('messages.news') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenders.index') }}" class="hover:text-yellow-400 transition flex items-center gap-2">
                            <span class="text-xs">→</span> Appels d'offres
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('careers') }}" class="hover:text-yellow-400 transition flex items-center gap-2">
                            <span class="text-xs">→</span> {{ __('messages.careers') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Colonne 3 : Contact --}}
            <div>
                <h4 class="font-bold text-yellow-400 mb-5 uppercase text-sm tracking-wider flex items-center gap-2">
                    <span class="w-1 h-4 bg-yellow-400 rounded"></span>
                    Contact
                </h4>
                <ul class="text-blue-200 text-sm space-y-4">

                    <li class="flex items-start gap-3">
                        <span class="text-lg flex-shrink-0">🏢</span>
                        <div>
                            <strong class="text-white block text-xs uppercase tracking-wider mb-1">Antenne Tunis</strong>
                            Rue de Cologne, Tunis
                        </div>
                    </li>

                    <li class="flex items-start gap-3">
                        <span class="text-lg flex-shrink-0">🏭</span>
                        <div>
                            <strong class="text-white block text-xs uppercase tracking-wider mb-1">Siège Kef</strong>
                            Cité des Jardins, BP 94 — 7100 Le Kef
                        </div>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-lg flex-shrink-0">📞</span>
                        <a href="tel:+21678253816" class="hover:text-yellow-400 transition">
                            +216 78 253 816
                        </a>
                    </li>

                    <li class="flex items-center gap-3">
                        <span class="text-lg flex-shrink-0">✉️</span>
                        <a href="mailto:dg@ciok.com.tn" class="hover:text-yellow-400 transition">
                            dg@ciok.com.tn
                        </a>
                    </li>

                </ul>
            </div>

            {{-- Colonne 4 : Réseaux sociaux + Langues --}}
            <div>
                <h4 class="font-bold text-yellow-400 mb-5 uppercase text-sm tracking-wider flex items-center gap-2">
                    <span class="w-1 h-4 bg-yellow-400 rounded"></span>
                    Suivez-nous
                </h4>

                <p class="text-blue-200 text-sm mb-5">
                    Restez informé de nos actualités et appels d'offres.
                </p>

                {{-- Réseaux sociaux --}}
                <div class="flex gap-3 mb-6">
               <a href="https://www.facebook.com/profile.php?id=100087158515055"
       target="_blank"
       rel="noopener noreferrer"
       title="Facebook CIOK"
       aria-label="Facebook CIOK"
       class="w-10 h-10 bg-blue-900 hover:bg-yellow-500 hover:text-blue-950 rounded-lg flex items-center justify-center transition text-lg font-bold">
        f
    </a>
                    <a href="#" title="LinkedIn"
                       class="w-10 h-10 bg-blue-900 hover:bg-yellow-500 hover:text-blue-950 rounded-lg flex items-center justify-center transition text-sm font-bold">
                        in
                    </a>
                    <a href="#" title="Email"
                       class="w-10 h-10 bg-blue-900 hover:bg-yellow-500 hover:text-blue-950 rounded-lg flex items-center justify-center transition text-lg">
                        ✉
                    </a>
                </div>

                {{-- Langues --}}
                <div class="text-xs">
                    <div class="text-blue-300 uppercase tracking-wider font-semibold mb-2">Langues</div>
                    <div class="flex gap-2">
                        <a href="{{ route('lang.switch', 'fr') }}"
                           class="px-3 py-1.5 rounded-md transition {{ app()->getLocale() === 'fr' ? 'bg-yellow-500 text-blue-950 font-bold' : 'bg-blue-900 hover:bg-blue-800' }}">
                            🇫🇷 FR
                        </a>
                        <a href="{{ route('lang.switch', 'ar') }}"
                           class="px-3 py-1.5 rounded-md transition {{ app()->getLocale() === 'ar' ? 'bg-yellow-500 text-blue-950 font-bold' : 'bg-blue-900 hover:bg-blue-800' }}">
                            🇹🇳 AR
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}"
                           class="px-3 py-1.5 rounded-md transition {{ app()->getLocale() === 'en' ? 'bg-yellow-500 text-blue-950 font-bold' : 'bg-blue-900 hover:bg-blue-800' }}">
                            🇬🇧 EN
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- BANDEAU INFÉRIEUR --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-blue-950 border-t border-blue-900">
        <div class="max-w-7xl mx-auto px-4 py-5 flex flex-col md:flex-row justify-between items-center gap-3 text-sm text-blue-300">

            <div class="text-center md:text-left">
                © {{ date('Y') }} <strong class="text-white">CIOK</strong> — Société des Ciments d'Oum El Kelil.
                {{ __('messages.all_rights_reserved') }}.
            </div>

            <div class="flex gap-4 text-xs">
                <a href="#" class="hover:text-yellow-400 transition">Mentions légales</a>
                <span class="text-blue-700">|</span>
                <a href="#" class="hover:text-yellow-400 transition">Politique de confidentialité</a>
                <span class="text-blue-700">|</span>
                <a href="{{ route('contact.show') }}" class="hover:text-yellow-400 transition">Contact</a>
            </div>

        </div>
    </div>

</footer>