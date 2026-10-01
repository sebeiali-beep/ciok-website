@extends('layouts.site')
@section('title', __('messages.tender_market') . ' - CIOK')
@section('meta_description', __('messages.tender_intro'))
@section('og_image', asset('images/silos.webp'))
@section('content')

{{-- ═══ BANNER ═══ --}}
<section class="relative text-white overflow-hidden" style="min-height: 500px;">
    <div class="absolute inset-0">
        <img src="{{ asset('images/silos.webp') }}" alt="{{ __('messages.tender_market') }} CIOK"
             class="w-full h-full object-cover scale-110"
             style="filter: blur(3px) brightness(0.9); object-position: center;">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-950/85 via-blue-900/70 to-blue-800/50"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 py-32 flex flex-col justify-center" style="min-height: 500px;">
        <div class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 text-xs font-bold px-4 py-1.5 rounded-full mb-6 w-fit shadow-lg">
            📋 {{ __('messages.tender_market') }}
        </div>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight drop-shadow-lg">
            {{ __('messages.tender_market') }}
        </h1>
        <p class="text-blue-100 text-lg md:text-xl lg:text-2xl max-w-3xl leading-relaxed drop-shadow-md">
            {{ __('messages.tender_intro') }}
        </p>
    </div>

    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500"></div>
</section>

{{-- ═══ STATISTIQUES ═══ --}}
<section class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-3 gap-4 text-center">
        <div class="border-r border-gray-100">
            <div class="text-4xl md:text-5xl font-extrabold text-green-600 mb-2">{{ $stats['open'] ?? 0 }}</div>
            <div class="text-xs md:text-sm text-gray-600 uppercase tracking-wider font-semibold">🟢 {{ __('messages.tender_open') }}</div>
        </div>
        <div class="border-r border-gray-100">
            <div class="text-4xl md:text-5xl font-extrabold text-blue-600 mb-2">{{ $stats['awarded'] ?? 0 }}</div>
            <div class="text-xs md:text-sm text-gray-600 uppercase tracking-wider font-semibold">✅ {{ __('messages.tender_awarded') }}</div>
        </div>
        <div>
            <div class="text-4xl md:text-5xl font-extrabold text-gray-500 mb-2">{{ $stats['closed'] ?? 0 }}</div>
            <div class="text-xs md:text-sm text-gray-600 uppercase tracking-wider font-semibold">🔒 {{ __('messages.tender_closed') }}</div>
        </div>
    </div>
</section>

{{-- ═══ FILTRES ═══ --}}
<section class="bg-gray-50 border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-wrap gap-2 justify-center items-center">
        <span class="text-sm text-gray-500 hidden md:inline font-semibold mr-2">{{ __('messages.tender_filter') }}</span>

        <a href="{{ route('tenders.index') }}"
           class="px-5 py-2 rounded-full text-sm font-semibold transition {{ !request('type') ? 'bg-blue-900 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-blue-100 hover:text-blue-900 border border-gray-200' }}">
            📋 {{ __('messages.tender_all') }}
        </a>
        <a href="{{ route('tenders.index', ['type' => 'appel_offre']) }}"
           class="px-5 py-2 rounded-full text-sm font-semibold transition {{ request('type') === 'appel_offre' ? 'bg-blue-900 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-blue-100 hover:text-blue-900 border border-gray-200' }}">
            📄 {{ __('messages.tender_tenders') }}
        </a>
        <a href="{{ route('tenders.index', ['type' => 'consultation']) }}"
           class="px-5 py-2 rounded-full text-sm font-semibold transition {{ request('type') === 'consultation' ? 'bg-purple-600 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-purple-100 hover:text-purple-900 border border-gray-200' }}">
            💼 {{ __('messages.tender_consultations') }}
        </a>
        <a href="{{ route('tenders.index', ['type' => 'consultation_elargie']) }}"
           class="px-5 py-2 rounded-full text-sm font-semibold transition {{ request('type') === 'consultation_elargie' ? 'bg-pink-600 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-pink-100 hover:text-pink-900 border border-gray-200' }}">
            📢 {{ __('messages.tender_extended') }}
        </a>
    </div>
</section>

{{-- ═══ LISTE ═══ --}}
<section class="max-w-7xl mx-auto px-4 py-16">

    @if($tenders->isEmpty())
        <div class="text-center py-20">
            <div class="text-8xl mb-6">📋</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-3">{{ __('messages.tender_no_results') }}</h3>
            <p class="text-gray-500 mb-6">{{ __('messages.tender_no_results_desc') }}</p>
            @if(request('type'))
                <a href="{{ route('tenders.index') }}"
                   class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg transition">
                    ✕ {{ __('messages.tender_view_all') }}
                </a>
            @endif
        </div>
    @else

        <div class="mb-8 text-sm text-gray-600">
            <strong class="text-blue-900 text-lg">{{ $tenders->total() }}</strong>
            {{ __('messages.tender_results') }}
            @if(request('type')) <span class="text-gray-400 ml-1">{{ __('messages.tender_filtered') }}</span> @endif
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($tenders as $tender)
                <a href="{{ route('tenders.show', $tender->slug) }}"
                   class="bg-white rounded-2xl shadow-md hover:shadow-2xl hover:-translate-y-2 transition duration-300 overflow-hidden group flex flex-col border border-gray-100">

                    <div class="relative h-48 bg-gradient-to-br from-blue-50 via-white to-yellow-50 flex items-center justify-center overflow-hidden">
                        @if($tender->image)
                            <img src="{{ asset('storage/' . $tender->image) }}" alt="{{ $tender->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="text-center">
                                <div class="text-6xl mb-2">
                                    @if($tender->type === 'appel_offre') 📄
                                    @elseif($tender->type === 'consultation') 💼
                                    @else 📢
                                    @endif
                                </div>
                                <div class="text-xs font-bold text-blue-900 uppercase tracking-wider px-4">
                                    {{ $tender->type_label }}
                                </div>
                            </div>
                        @endif

                        @if($tender->status === 'open')
                            <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg flex items-center gap-1">
                                <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                                {{ __('messages.tender_open') }}
                            </span>
                        @elseif($tender->status === 'awarded')
                            <span class="absolute top-3 right-3 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                ✅ {{ __('messages.tender_awarded') }}
                            </span>
                        @else
                            <span class="absolute top-3 right-3 bg-gray-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                🔒 {{ __('messages.tender_closed') }}
                            </span>
                        @endif
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center justify-between mb-3">
                            @php
                                $badge = match($tender->type) {
                                    'appel_offre'          => ['AO', 'bg-blue-100 text-blue-800'],
                                    'consultation'         => ['CS', 'bg-purple-100 text-purple-800'],
                                    'consultation_elargie' => ['CE', 'bg-pink-100 text-pink-800'],
                                    default                => ['❓', 'bg-gray-100 text-gray-800'],
                                };
                            @endphp
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $badge[1] }}">{{ $badge[0] }}</span>
                            <span class="font-mono font-bold text-blue-900 text-xs">{{ $tender->reference }}</span>
                        </div>

                        <h3 class="font-bold text-blue-900 text-base mb-4 leading-snug group-hover:text-blue-700 transition flex-1">
                            {{ $tender->title }}
                        </h3>

                        <div class="space-y-2 text-xs text-gray-600 border-t border-gray-100 pt-4">
                            @if($tender->deadline_date)
                                <div class="flex items-center gap-2">
                                    <span class="text-blue-900">📅</span>
                                    <span>{{ __('messages.tender_deadline') }} : <strong>{{ $tender->deadline_date->format('d/m/Y') }}</strong>
                                        @if($tender->deadline_time)
                                            {{ __('messages.tender_at') }} {{ \Carbon\Carbon::parse($tender->deadline_time)->format('H\hi') }}
                                        @endif
                                    </span>
                                </div>
                            @endif
                            @if($tender->opening_date)
                                <div class="flex items-center gap-2">
                                    <span class="text-green-600">🔓</span>
                                    <span>{{ __('messages.tender_opening') }} : <strong>{{ $tender->opening_date->format('d/m/Y') }}</strong></span>
                                </div>
                            @endif
                        </div>

                        <div class="mt-5 pt-4 border-t border-gray-100 flex flex-wrap gap-2">
                            @if($tender->notice_pdf)
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-blue-700 bg-blue-50 px-3 py-1.5 rounded-lg">
                                    📄 {{ __('messages.tender_notice_short') }}
                                </span>
                            @endif
                            @if($tender->result_pdf)
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-green-700 bg-green-50 px-3 py-1.5 rounded-lg">
                                    ✅ {{ __('messages.tender_results_short') }}
                                </span>
                            @endif
                            <span class="ml-auto text-blue-700 font-bold text-xs group-hover:translate-x-1 transition flex items-center gap-1">
                                {{ __('messages.tender_see') }} →
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        @if($tenders->hasPages())
            <div class="mt-12">{{ $tenders->appends(request()->query())->links() }}</div>
        @endif
    @endif
</section>

{{-- ═══ COMMENT SOUMISSIONNER ═══ --}}
<section class="bg-blue-50 py-16">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 bg-yellow-500 text-blue-900 text-xs font-bold px-4 py-1.5 rounded-full mb-4 w-fit mx-auto">
                {{ __('messages.tender_how_badge') }}
            </div>
            <h2 class="text-3xl font-bold text-blue-900 mb-4">{{ __('messages.tender_how_to_apply') }}</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl p-6 text-center shadow-md">
                <div class="w-14 h-14 bg-blue-900 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">1</div>
                <h3 class="font-bold text-blue-900 mb-2">{{ __('messages.tender_how_step1') }}</h3>
                <p class="text-sm text-gray-600">{{ __('messages.tender_how_step1_desc') }}</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center shadow-md">
                <div class="w-14 h-14 bg-blue-900 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">2</div>
                <h3 class="font-bold text-blue-900 mb-2">{{ __('messages.tender_how_step2') }}</h3>
                <p class="text-sm text-gray-600">{{ __('messages.tender_how_step2_desc') }}</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center shadow-md">
                <div class="w-14 h-14 bg-blue-900 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">3</div>
                <h3 class="font-bold text-blue-900 mb-2">{{ __('messages.tender_how_step3') }}</h3>
                <p class="text-sm text-gray-600">{{ __('messages.tender_how_step3_desc') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══ CTA ═══ --}}
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-16">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ __('messages.tender_question') }}</h2>
        <p class="text-blue-100 mb-8 text-lg">{{ __('messages.tender_question_desc') }}</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('contact.show') }}"
               class="bg-yellow-500 text-blue-900 px-8 py-3 rounded-lg font-bold hover:bg-yellow-400 transition shadow-lg hover:-translate-y-1">
                ✉️ {{ __('messages.contact_us') }}
            </a>
            <a href="tel:+21678253816"
               class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-900 transition hover:-translate-y-1">
                📞 +216 78 253 816
            </a>
        </div>
    </div>
</section>

@endsection