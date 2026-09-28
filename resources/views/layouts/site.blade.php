<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'CIOK - Ciments d\'Oum El Kelil')</title>

    {{-- Meta de base --}}
    <meta name="description" content="@yield('meta_description', config('seo.default_description'))">
    <meta name="keywords" content="@yield('meta_keywords', config('seo.default_keywords'))">
    <meta name="author" content="{{ config('seo.site_full_name') }}">
    <meta name="robots" content="index, follow">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ config('seo.site_name') }}">
    <meta property="og:title" content="@yield('title', 'CIOK')">
    <meta property="og:description" content="@yield('meta_description', config('seo.default_description'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset(config('seo.default_image')))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="{{ app()->getLocale() === 'ar' ? 'ar_TN' : (app()->getLocale() === 'en' ? 'en_US' : 'fr_FR') }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{ config('seo.twitter_handle') }}">
    <meta name="twitter:title" content="@yield('title', 'CIOK')">
    <meta name="twitter:description" content="@yield('meta_description', config('seo.default_description'))">
    <meta name="twitter:image" content="@yield('og_image', asset(config('seo.default_image')))">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">

    {{-- Schema.org --}}
    @verbatim
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Société des Ciments d'Oum El Kelil",
        "alternateName": "CIOK",
        "url": "https://ciok.tn",
        "logo": "/images/logo.webp",
        "description": "CIOK, Les Ciments d'Oum El Kelil - Production de ciment, chaux et clinker de haute qualité en Tunisie depuis 1979.",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Route de Tajerouine",
            "addressLocality": "Le Kef",
            "addressCountry": "TN"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+216-78-253-816",
            "contactType": "customer service",
            "email": "commercial@ciok.com.tn",
            "availableLanguage": ["French", "Arabic", "English"]
        }
    }
    </script>
    @endverbatim

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- POLICES LOCALES (gain 2000ms) --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <style>
        /* ═══ Inter (latin) ═══ */
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url('{{ asset('fonts/inter-400.woff2') }}') format('woff2');
        }
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url('{{ asset('fonts/inter-500.woff2') }}') format('woff2');
        }
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url('{{ asset('fonts/inter-600.woff2') }}') format('woff2');
        }
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url('{{ asset('fonts/inter-700.woff2') }}') format('woff2');
        }
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 800;
            font-display: swap;
            src: url('{{ asset('fonts/inter-800.woff2') }}') format('woff2');
        }

        /* ═══ Cairo (arabe) ═══ */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url('{{ asset('fonts/cairo-400.woff2') }}') format('woff2');
        }
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url('{{ asset('fonts/cairo-600.woff2') }}') format('woff2');
        }
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url('{{ asset('fonts/cairo-700.woff2') }}') format('woff2');
        }
    </style>

    {{-- Preload des polices critiques --}}
    <link rel="preload" as="font" type="font/woff2" href="{{ asset('fonts/inter-400.woff2') }}" crossorigin>
    <link rel="preload" as="font" type="font/woff2" href="{{ asset('fonts/inter-700.woff2') }}" crossorigin>
    <link rel="preload" as="font" type="font/woff2" href="{{ asset('fonts/inter-800.woff2') }}" crossorigin>

 <script defer src="https://cdn.jsdelivr.net/gh/sebeiali-beep/ciok-website@main/public/js/alpine.min.js"></script>

    {{-- CSS principal (preload non-bloquant) --}}
    <link rel="preload" as="style" href="{{ Vite::asset('resources/css/app.css') }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">
    <noscript>
        <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">
    </noscript>

    @vite(['resources/js/app.js'])

    <style>
        /* CSS critique inline */
        body { margin: 0; font-family: 'Inter', system-ui, sans-serif; }
        html[dir="rtl"] body, html[lang="ar"] body { font-family: 'Cairo', 'Tahoma', sans-serif; }

        .reveal { opacity: 0; transform: translateY(40px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        #scroll-progress {
            position: fixed; top: 0; left: 0; height: 3px;
            background: linear-gradient(to right, #EAB308, #FACC15);
            z-index: 9999; transition: width 0.1s; width: 0;
        }

        #back-to-top {
            position: fixed; bottom: 30px; right: 30px; width: 50px; height: 50px;
            background: #1E3A8A; color: white; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; box-shadow: 0 10px 25px rgba(30, 58, 138, 0.4);
            opacity: 0; visibility: hidden; transition: all 0.3s;
            z-index: 9998; font-size: 20px; border: none;
        }
        #back-to-top.show { opacity: 1; visibility: visible; }
        #back-to-top:hover { background: #EAB308; transform: translateY(-5px); }

        .img-zoom { overflow: hidden; }
        .img-zoom img { transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1); }
        .img-zoom:hover img { transform: scale(1.08); }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeInUp 0.8s ease-out; }

        .counter-animating { color: #EAB308; }
        .hero-slider { transition: opacity 0.5s ease; }

        /* Éviter le CLS sur les compteurs */
        [data-counter] { display: inline-block; min-width: 1ch; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <div id="scroll-progress"></div>

    @include('partials.header')

    <main class="flex-1" style="min-height: 500px;">
        @yield('content')
    </main>

    @include('partials.footer')

    <button id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" title="Retour en haut">
        ↑
    </button>

    <script>
        // Animation fade-in au scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Barre de progression + bouton retour
        const progressBar = document.getElementById('scroll-progress');
        const backTop = document.getElementById('back-to-top');

        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    const scrollTop = window.scrollY;
                    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                    const progress = (scrollTop / docHeight) * 100;
                    progressBar.style.width = progress + '%';

                    if (scrollTop > 400) {
                        backTop.classList.add('show');
                    } else {
                        backTop.classList.remove('show');
                    }
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Compteurs animés
        function animateCounter(el, target, duration = 2000) {
            if (isNaN(target)) return;
            const startTime = performance.now();
            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                const current = Math.floor(target * eased);
                el.textContent = current;
                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    el.textContent = target;
                    el.classList.remove('counter-animating');
                }
            }
            requestAnimationFrame(update);
        }

        window.addEventListener('load', () => {
            document.querySelectorAll('[data-counter]').forEach(el => {
                const target = parseInt(el.dataset.target);
                el.classList.add('counter-animating');
                animateCounter(el, target);
            });
        });
    </script>

</body>
</html>