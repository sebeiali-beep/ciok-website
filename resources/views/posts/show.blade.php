@extends('layouts.site')

@section('title', $post->title . ' - CIOK')
@section('meta_description', Str::limit($post->excerpt ?? strip_tags($post->content), 155))
@section('og_type', 'article')
@section('og_image', $post->image ? asset('storage/' . $post->image) : asset(config('seo.default_image')))
@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- FIL D'ARIANE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="bg-gray-100 border-b">
    <div class="max-w-7xl mx-auto px-4 py-3 text-sm flex items-center gap-2 flex-wrap">
        <a href="{{ route('home') }}" class="text-blue-700 hover:underline flex items-center gap-1">
            🏠 {{ __('messages.home') }}
        </a>
        <span class="text-gray-400">/</span>
        <a href="{{ route('posts.index') }}" class="text-blue-700 hover:underline">
            {{ __('messages.news') }}
        </a>
        <span class="text-gray-400">/</span>
        <span class="text-gray-600">{{ Str::limit($post->title, 50) }}</span>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- EN-TÊTE DE L'ARTICLE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<article class="max-w-4xl mx-auto px-4 py-12">

    <header class="text-center mb-10">

        <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-4">
            📰 {{ __('messages.news') }}
        </div>

        <h1 class="text-3xl md:text-5xl font-extrabold text-blue-900 mb-6 leading-tight">
            {{ $post->title }}
        </h1>

        <div class="flex items-center justify-center gap-6 text-sm text-gray-500 flex-wrap">
            <span class="flex items-center gap-2">
                <span class="text-lg">📅</span>
                {{ $post->published_at?->translatedFormat('d F Y') ?? $post->created_at->format('d/m/Y') }}
            </span>
            @if($post->published_at)
                <span class="flex items-center gap-2">
                    <span class="text-lg">⏱️</span>
                    {{ $post->published_at->diffForHumans() }}
                </span>
            @endif
        </div>

    </header>

    {{-- Image principale --}}
    @if($post->image)
        <div class="rounded-2xl overflow-hidden mb-10 shadow-xl">
            <img src="{{ asset('storage/' . $post->image) }}"
                 alt="{{ $post->title }}"
                 class="w-full h-auto object-cover">
        </div>
    @endif

    {{-- Extrait en exergue --}}
    @if($post->excerpt)
        <div class="border-l-4 border-yellow-500 bg-yellow-50 rounded-r-lg p-6 mb-10">
            <p class="text-lg md:text-xl text-gray-700 italic leading-relaxed">
                « {{ $post->excerpt }} »
            </p>
        </div>
    @endif

    {{-- Contenu --}}
    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
        {!! nl2br(e($post->content)) !!}
    </div>

    {{-- Barre de partage --}}
    <div class="mt-12 pt-8 border-t border-gray-200">
        <div class="flex items-center justify-between flex-wrap gap-4">

            <div class="flex items-center gap-2 text-sm text-gray-600">
                <span class="font-semibold">Partager :</span>

                @php
                    $shareUrl = urlencode(url()->current());
                    $shareTitle = urlencode($post->title);
                @endphp

                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
                   target="_blank"
                   class="w-9 h-9 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center justify-center transition"
                   title="Partager sur Facebook">
                    f
                </a>

                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}"
                   target="_blank"
                   class="w-9 h-9 bg-blue-700 hover:bg-blue-800 text-white rounded-lg flex items-center justify-center transition text-sm font-bold"
                   title="Partager sur LinkedIn">
                    in
                </a>

                <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}"
                   target="_blank"
                   class="w-9 h-9 bg-black hover:bg-gray-800 text-white rounded-lg flex items-center justify-center transition"
                   title="Partager sur X (Twitter)">
                    𝕏
                </a>

                <a href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}"
                   target="_blank"
                   class="w-9 h-9 bg-green-600 hover:bg-green-700 text-white rounded-lg flex items-center justify-center transition"
                   title="Partager sur WhatsApp">
                    💬
                </a>
            </div>

            <a href="{{ route('posts.index') }}"
               class="text-blue-700 font-semibold hover:underline flex items-center gap-1">
                ← {{ __('messages.news') }}
            </a>

        </div>
    </div>

</article>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- ARTICLES SIMILAIRES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
@if($related->isNotEmpty())
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4">

            <div class="text-center mb-10">
                <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-3">
                    À LIRE AUSSI
                </div>
                <h2 class="text-3xl font-bold text-blue-900">Articles similaires</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($related as $p)
                    <a href="{{ route('posts.show', $p->slug) }}"
                       class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition duration-300 group flex flex-col border border-gray-100">

                        <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center overflow-hidden">
                            @if($p->image)
                                <img src="{{ asset('storage/' . $p->image) }}"
                                     alt="{{ $p->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="text-6xl opacity-30">📰</div>
                            @endif
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <p class="text-xs text-gray-500 mb-2 flex items-center gap-2">
                                <span>📅</span> {{ $p->published_at?->format('d/m/Y') }}
                            </p>
                            <h3 class="font-bold text-blue-900 mb-3 leading-snug flex-1 group-hover:text-blue-700 transition">
                                {{ $p->title }}
                            </h3>
                            <span class="text-blue-700 font-semibold text-sm group-hover:underline flex items-center gap-1">
                                {{ __('messages.read_more') }}
                                <span class="group-hover:translate-x-1 transition">→</span>
                            </span>
                        </div>

                    </a>
                @endforeach
            </div>

        </div>
    </section>
@endif

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CTA --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-16">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-4">Vous avez aimé cet article ?</h2>
        <p class="text-blue-100 mb-8 text-lg">
            Découvrez toutes nos actualités et restez informé.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('posts.index') }}"
               class="bg-yellow-500 text-blue-900 px-8 py-3 rounded-lg font-bold hover:bg-yellow-400 transition shadow-lg hover:-translate-y-1 flex items-center gap-2">
                📰 Toutes les actualités
            </a>
            <a href="{{ route('contact.show') }}"
               class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-900 transition hover:-translate-y-1 flex items-center gap-2">
                ✉️ {{ __('messages.contact_us') }}
            </a>
        </div>
    </div>
</section>

@endsection