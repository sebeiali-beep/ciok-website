@extends('layouts.site')
@section('title', __('messages.careers') . ' - CIOK')
@section('meta_description', 'Rejoignez la CIOK ! Découvrez nos offres d\'emploi, nos valeurs et envoyez votre candidature spontanée.')
@section('og_image', asset('images/usine-flag.jpg'))
@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- BANNER --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="relative text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/usine-flag.webp') }}" alt="Carrières CIOK" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/95 to-blue-900/70"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-24">
        <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
            💼 CARRIÈRES
        </div>
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">{{ __('messages.careers') }}</h1>
        <p class="text-blue-100 text-lg md:text-xl max-w-3xl leading-relaxed">
            Rejoignez une équipe dynamique et contribuez au développement industriel de la Tunisie
        </p>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500"></div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- POURQUOI NOUS REJOINDRE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-20 reveal">

    <div class="text-center mb-12">
        <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-4">
            POURQUOI CIOK ?
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-3">Travailler chez CIOK</h2>
        <p class="text-gray-600">Un environnement de travail stimulant et des opportunités de carrière</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-blue-900">
            <div class="text-5xl mb-4">🏭</div>
            <h3 class="font-bold text-blue-900 mb-2">Industrie majeure</h3>
            <p class="text-gray-600 text-sm">Un acteur clé du secteur industriel tunisien</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-green-600">
            <div class="text-5xl mb-4">📚</div>
            <h3 class="font-bold text-blue-900 mb-2">Formation continue</h3>
            <p class="text-gray-600 text-sm">Développez vos compétences tout au long de votre carrière</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-yellow-500">
            <div class="text-5xl mb-4">🤝</div>
            <h3 class="font-bold text-blue-900 mb-2">Esprit d'équipe</h3>
            <p class="text-gray-600 text-sm">Une culture d'entreprise collaborative</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-2xl transition hover:-translate-y-2 border-t-4 border-purple-600">
            <div class="text-5xl mb-4">🌟</div>
            <h3 class="font-bold text-blue-900 mb-2">Évolution</h3>
            <p class="text-gray-600 text-sm">Perspectives d'évolution au sein du groupe</p>
        </div>

    </div>

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- OFFRES D'EMPLOI --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-20 reveal">
    <div class="max-w-5xl mx-auto px-4">

        <div class="text-center mb-12">
            <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
                💼 OFFRES D'EMPLOI
            </div>
            <h2 class="text-3xl font-bold text-blue-900 mb-3">Offres actuelles</h2>
            <p class="text-gray-600">Découvrez nos opportunités de carrière</p>
        </div>

        {{-- État vide élégant --}}
        <div class="bg-white rounded-2xl shadow-md p-12 text-center">
            <div class="text-8xl mb-6 opacity-30">💼</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-3">
                Aucune offre disponible pour le moment
            </h3>
            <p class="text-gray-500 mb-8 max-w-md mx-auto">
                Nous n'avons pas d'offre d'emploi actuellement, mais vous pouvez
                nous envoyer votre candidature spontanée.
            </p>
            <a href="mailto:rh@ciok.com.tn"
               class="inline-flex items-center gap-2 bg-blue-900 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition hover:-translate-y-1">
                ✉️ Envoyer une candidature
            </a>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CANDIDATURE SPONTANÉE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-5xl mx-auto px-4 py-20 reveal">

    <div class="bg-gradient-to-r from-blue-950 to-blue-800 rounded-2xl shadow-2xl p-8 md:p-12 text-white relative overflow-hidden">

        <div class="absolute top-0 right-0 text-9xl opacity-10 select-none">✉️</div>

        <div class="relative grid md:grid-cols-2 gap-8 items-center">

            <div>
                <div class="inline-block bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full mb-4">
                    📧 CANDIDATURE SPONTANÉE
                </div>
                <h2 class="text-3xl font-bold mb-4">Vous n'avez pas trouvé votre poste ?</h2>
                <p class="text-blue-100 leading-relaxed mb-6">
                    Envoyez-nous votre CV et votre lettre de motivation.
                    Nous étudierons votre candidature avec attention et vous contacterons
                    dès qu'une opportunité correspondra à votre profil.
                </p>

                <a href="mailto:rh@ciok.com.tn?subject=Candidature%20spontanée"
                   class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 px-6 py-3 rounded-lg font-bold hover:bg-yellow-400 transition shadow-lg hover:-translate-y-1">
                    ✉️ rh@ciok.com.tn
                </a>
            </div>

            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                <h3 class="font-bold text-lg mb-4">📋 Documents à envoyer</h3>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start gap-2">
                        <span class="text-yellow-400">✓</span>
                        <span>Curriculum Vitae (CV) à jour</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-yellow-400">✓</span>
                        <span>Lettre de motivation</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-yellow-400">✓</span>
                        <span>Copies des diplômes</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-yellow-400">✓</span>
                        <span>Attestations de travail (si applicable)</span>
                    </li>
                </ul>
            </div>

        </div>

    </div>

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- RÉSULTATS DE CONCOURS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="max-w-5xl mx-auto px-4 py-16 reveal">

    <div class="text-center mb-8">
        <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-3">
            📢 ANNONCES
        </div>
        <h2 class="text-2xl font-bold text-blue-900">Résultats de concours</h2>
    </div>

    <div class="bg-blue-50 border-l-4 border-blue-900 rounded-lg p-6">
        <div class="flex items-start gap-4">
            <span class="text-3xl flex-shrink-0">📄</span>
            <div>
                <h3 class="font-bold text-blue-900 mb-2">Consultez les résultats des concours</h3>
                <p class="text-gray-700 text-sm leading-relaxed mb-3">
                    Les résultats des concours de recrutement sont disponibles sur le site
                    officiel de la CIOK.
                </p>
                <a href="http://www.ciok.tn" target="_blank"
                   class="text-blue-700 font-semibold hover:underline text-sm">
                    🌐 Voir sur www.ciok.tn →
                </a>
            </div>
        </div>
    </div>

</section>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- CTA --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-16">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Une question sur le recrutement ?
        </h2>
        <p class="text-blue-100 mb-8 text-lg">
            Notre service des ressources humaines vous répondra dans les plus brefs délais.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="mailto:rh@ciok.com.tn"
               class="bg-yellow-500 text-blue-900 px-8 py-3 rounded-lg font-bold hover:bg-yellow-400 transition shadow-lg hover:-translate-y-1 flex items-center gap-2">
                ✉️ rh@ciok.com.tn
            </a>
            <a href="{{ route('contact.show') }}"
               class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-900 transition hover:-translate-y-1 flex items-center gap-2">
                📞 {{ __('messages.contact_us') }}
            </a>
        </div>
    </div>
</section>

@endsection