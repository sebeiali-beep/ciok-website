{{-- ═══════════════════════════════════════════════════════ --}}
{{-- HERO SLIDER avec 5 images --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="hero-slider relative text-white overflow-hidden flex items-center"
         style="min-height: 650px; height: 650px;"
         x-data="{
            current: 0,
            slides: 5,
            paused: false,
            init() {
                setInterval(() => {
                    if (!this.paused) {
                        this.current = (this.current + 1) % this.slides;
                    }
                }, 6000);
            }
         }"
         x-init="init()"
         @mouseenter="paused = true"
         @mouseleave="paused = false">

    @php
        $slides = [
            [
                'image' => 'hero-1.webp',
                'badge' => '🏭 EXCELLENCE INDUSTRIELLE DEPUIS 1979',
                'title' => 'Bienvenue chez CIOK',
                'subtitle' => 'Les Ciments d\'Oum El Kelil — Excellence industrielle depuis 1979',
                'btn1' => ['text' => 'Nos produits', 'url' => '/produits', 'icon' => '🏭'],
                'btn2' => ['text' => 'Nous contacter', 'url' => '/contact', 'icon' => '✉️'],
            ],
            [
                'image' => 'hero-2.webp',
                'badge' => '🇹🇳 ACTEUR CLÉ DU BÂTIMENT EN TUNISIE',
                'title' => 'Une entreprise nationale',
                'subtitle' => 'Fièrement tunisienne, au service du développement du pays',
                'btn1' => ['text' => 'Découvrir CIOK', 'url' => '/a-propos', 'icon' => '🏢'],
                'btn2' => ['text' => 'Nos produits', 'url' => '/produits', 'icon' => '🏭'],
            ],
            [
                'image' => 'hero-3.webp',
                'badge' => '🏷️ UN CIMENT DE QUALITÉ CERTIFIÉE',
                'title' => 'Des produits reconnus',
                'subtitle' => 'Conforme aux normes tunisiennes NT 47.01 et européennes EN 197-1',
                'btn1' => ['text' => 'Nos produits', 'url' => '/produits', 'icon' => '🏭'],
                'btn2' => ['text' => 'Notre qualité', 'url' => '/qualite', 'icon' => '✅'],
            ],
            [
                'image' => 'hero-4.webp',
                'badge' => '🚛 DISTRIBUTION NATIONALE',
                'title' => 'Une logistique performante',
                'subtitle' => 'Un réseau de distribution couvrant toute la Tunisie',
                'btn1' => ['text' => 'Nos services', 'url' => '/a-propos', 'icon' => '🚚'],
                'btn2' => ['text' => 'Nous contacter', 'url' => '/contact', 'icon' => '✉️'],
            ],
            [
                'image' => 'hero-5.webp',
                'badge' => '⚙️ TECHNOLOGIE DE POINTE',
                'title' => 'Un savoir-faire reconnu',
                'subtitle' => 'Des équipements de dernière génération pour une qualité constante',
                'btn1' => ['text' => 'Voir la qualité', 'url' => '/qualite', 'icon' => '✅'],
                'btn2' => ['text' => 'Nous contacter', 'url' => '/contact', 'icon' => '✉️'],
            ],
        ];
    @endphp

    {{-- IMAGES EN ARRIÈRE-PLAN (z-0) --}}
    @foreach($slides as $index => $slide)
        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out pointer-events-none"
             style="z-index: {{ $index === 0 ? 1 : 0 }};"
             :class="current === {{ $index }} ? 'opacity-100' : 'opacity-0'">
            <img src="{{ asset('images/heroes/' . str_replace('.jpg', '.webp', $slide['image'])) }}"
     alt="{{ $slide['title'] }}"
     width="1920"
     height="650"
     loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
     fetchpriority="{{ $index === 0 ? 'high' : 'low' }}"
     class="w-full h-full object-cover"
     style="aspect-ratio: 1920/650;">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-950/90 via-blue-900/75 to-blue-800/50"></div>
        </div>
    @endforeach

    {{-- CONTENU (z-20) --}}
 <div class="relative max-w-7xl mx-auto px-4 min-height: 500px" style="z-index: 20; min-height: 500px;">
        <div class="max-w-3xl" style="min-height: 420px;">

            @foreach($slides as $index => $slide)
                <div x-show="current === {{ $index }}"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 transform translate-y-8"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-4">

                    <div class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 text-xs md:text-sm font-bold px-4 py-2 rounded-full mb-6 shadow-lg">
                        {{ $slide['badge'] }}
                    </div>

                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight drop-shadow-lg">
                        {{ $slide['title'] }}
                    </h1>

                    <p class="text-xl md:text-2xl text-blue-100 mb-10 max-w-2xl leading-relaxed">
                        {{ $slide['subtitle'] }}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ url($slide['btn1']['url']) }}"
                           class="inline-block bg-white text-blue-900 px-8 py-4 rounded-lg font-bold hover:bg-yellow-400 transition shadow-xl">
                            {{ $slide['btn1']['icon'] }} {{ $slide['btn1']['text'] }}
                        </a>
                        <a href="{{ url($slide['btn2']['url']) }}"
                           class="inline-block border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-blue-900 transition">
                            {{ $slide['btn2']['icon'] }} {{ $slide['btn2']['text'] }}
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    {{-- POINTS INDICATEURS (z-30) --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex gap-3" style="z-index: 30;">
        @foreach($slides as $index => $slide)
            <button type="button"
                    @click="current = {{ $index }}"
                    class="h-3 rounded-full transition-all duration-300 cursor-pointer"
                    :class="current === {{ $index }} ? 'bg-yellow-500 w-8' : 'bg-white/50 hover:bg-white/80 w-3'">
            </button>
        @endforeach
    </div>

    {{-- FLÈCHE GAUCHE (z-30) --}}
    <button type="button"
            @click="current = (current - 1 + slides) % slides"
            class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur hover:bg-yellow-500 hover:text-blue-900 rounded-full flex items-center justify-center text-2xl transition cursor-pointer"
            style="z-index: 30;">
        ‹
    </button>

    {{-- FLÈCHE DROITE (z-30) --}}
    <button type="button"
            @click="current = (current + 1) % slides"
            class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur hover:bg-yellow-500 hover:text-blue-900 rounded-full flex items-center justify-center text-2xl transition cursor-pointer"
            style="z-index: 30;">
        ›
    </button>

    {{-- COMPTEUR (z-30) --}}
    <div class="absolute bottom-6 right-6 text-white/70 text-sm font-mono" style="z-index: 30;">
        <span x-text="String(current + 1).padStart(2, '0')"></span>
        <span class="mx-1">/</span>
        <span>{{ str_pad(count($slides), 2, '0', STR_PAD_LEFT) }}</span>
    </div>

    {{-- BARRE JAUNE (z-30) --}}
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500" style="z-index: 30;"></div>

</section>