@extends('layouts.site')
@section('title', __('messages.news') . ' - CIOK')
@section('meta_description', 'Restez informé de nos dernières actualités, communiqués et événements.')
@section('og_image', asset('images/usine-panorama.jpg'))
@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BANNER --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/usine-panorama.jpg') }}" alt="Actualités CIOK" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/95 to-blue-900/70"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-24">
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            📰 ACTUALITÉS
        </div>
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">{{ __('messages.news') }}</h1>
        <p class="text-blue-100 text-lg md:text-xl max-w-3xl leading-relaxed">
            {{ __('messages.latest_news_desc') }}
        </p>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500"></div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- STATISTIQUES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-6 flex justify-center items-center gap-8 text-center">

        <div>
            <div class="text-3xl font-extrabold text-blue-900">{{ $posts->total() }}</div>
            <div class="text-xs text-gray-500 uppercase tracking-wider mt-1">Articles publiés</div>
        </div>

        <div class="w-px h-10 bg-gray-200"></div>

        <div>
            <div class="text-3xl font-extrabold text-blue-900">
                {{ $posts->first()?->published_at?->format('Y') ?? date('Y') }}
            </div>
            <div class="text-xs text-gray-500 uppercase tracking-wider mt-1">Dernière mise à jour</div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- LISTE DES ACTUALITÉS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-16">

    @if($posts->isEmpty())
        <div class="text-center py-20">
            <div class="text-8xl mb-6 opacity-30">📰</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-3">Aucune actualité pour le moment</h3>
            <p class="text-gray-500 mb-6">Revenez bientôt pour découvrir nos dernières nouvelles.</p>
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 bg-blue-900 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition">
                🏠 Retour à l'accueil
            </a>
        </div>
    @else

        {{-- Article à la une (1er article) --}}
        @if($posts->currentPage() === 1 && $posts->count() > 0)
            @php $featured = $posts->first(); @endphp

            <article class="mb-12 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition group">
                <div class="grid md:grid-cols-2 gap-0">

                    {{-- Image --}}
                    <div class="relative h-64 md:h-auto bg-gradient-to-br from-blue-100 to-blue-50 overflow-hidden">
                        @if($featured->image)
                            <img src="{{ asset('storage/' . $featured->image) }}"
                                 alt="{{ $featured->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-9xl opacity-20">📰</div>
                        @endif

                        <span class="absolute top-4 left-4 bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                            ⭐ À LA UNE
                        </span>
                    </div>

                    {{-- Contenu --}}
                    <div class="p-8 md:p-10 flex flex-col justify-center">
                        <p class="text-sm text-gray-500 mb-3 flex items-center gap-2">
                            <span>📅</span>
                            {{ $featured->published_at?->translatedFormat('d F Y') ?? $featured->created_at->format('d/m/Y') }}
                        </p>

                        <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-4 leading-tight group-hover:text-blue-700 transition">
                            {{ $featured->title }}
                        </h2>

                        <p class="text-gray-600 leading-relaxed mb-6">
                            {{ Str::limit($featured->excerpt ?? strip_tags($featured->content), 200) }}
                        </p>

                        <a href="{{ route('posts.show', $featured->slug) }}"
                           class="inline-flex items-center gap-2 bg-blue-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition w-fit group-hover:shadow-lg">
                            {{ __('messages.read_more') }}
                            <span class="group-hover:translate-x-1 transition">→</span>
                        </a>
                    </div>

                </div>
            </article>

            {{-- Autres articles --}}
            @if($posts->count() > 1)
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-px flex-1 bg-gray-200"></div>
                    <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">Autres actualités</div>
                    <div class="h-px flex-1 bg-gray-200"></div>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts->skip(1) as $post)
                        <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition duration-300 group flex flex-col border border-gray-100">

                            {{-- Image --}}
                            <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center overflow-hidden">
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="text-6xl opacity-30">📰</div>
                                @endif
                            </div>

                            {{-- Contenu --}}
                            <div class="p-6 flex-1 flex flex-col">
                                <p class="text-xs text-gray-500 mb-2 flex items-center gap-2">
                                    <span>📅</span>
                                    {{ $post->published_at?->format('d/m/Y') }}
                                </p>

                                <h3 class="text-lg font-bold text-blue-900 mb-3 flex-1 leading-snug group-hover:text-blue-700 transition">
                                    {{ $post->title }}
                                </h3>

                                <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                    {{ Str::limit($post->excerpt, 120) }}
                                </p>

                                <a href="{{ route('posts.show', $post->slug) }}"
                                   class="text-blue-700 font-semibold text-sm group-hover:underline flex items-center gap-1">
                                    {{ __('messages.read_more') }}
                                    <span class="group-hover:translate-x-1 transition">→</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

        @else
            {{-- Pages suivantes : grille simple --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition duration-300 group flex flex-col border border-gray-100">

                        <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center overflow-hidden">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}"
                                     alt="{{ $post->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="text-6xl opacity-30">📰</div>
                            @endif
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <p class="text-xs text-gray-500 mb-2 flex items-center gap-2">
                                <span>📅</span> {{ $post->published_at?->format('d/m/Y') }}
                            </p>

                            <h3 class="text-lg font-bold text-blue-900 mb-3 flex-1 leading-snug group-hover:text-blue-700 transition">
                                {{ $post->title }}
                            </h3>

                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($post->excerpt, 120) }}</p>

                            <a href="{{ route('posts.show', $post->slug) }}"
                               class="text-blue-700 font-semibold text-sm group-hover:underline flex items-center gap-1">
                                {{ __('messages.read_more') }}
                                <span class="group-hover:translate-x-1 transition">→</span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        {{-- Pagination --}}
        @if($posts->hasPages())
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @endif

    @endif

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- NEWSLETTER / CTA --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-16">
    <div class="max-w-4xl mx-auto text-center px-4">
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            📬 RESTEZ INFORMÉ
        </div>
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Ne manquez aucune actualité
        </h2>
        <p class="text-blue-100 mb-8 text-lg">
            Suivez nos dernières nouvelles, communiqués et événements.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('contact.show') }}"
               class="bg-yellow-500 text-blue-900 px-8 py-3 rounded-lg font-bold hover:bg-yellow-400 transition shadow-lg hover:-translate-y-1 flex items-center gap-2">
                ✉️ {{ __('messages.contact_us') }}
            </a>
            <a href="{{ route('tenders.index') }}"
               class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-900 transition hover:-translate-y-1 flex items-center gap-2">
                📋 Appels d'offres
            </a>
        </div>
    </div>
</section>

@endsection