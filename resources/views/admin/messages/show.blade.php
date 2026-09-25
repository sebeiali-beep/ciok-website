@extends('admin.layout')
@section('title', 'Message')

@section('content')

{{-- EN-TÊTE --}}
<div class="flex items-center justify-between mb-6 flex-wrap gap-4">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.messages.index') }}"
           class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center text-blue-900 hover:bg-blue-50 transition">
            ←
        </a>
        <div>
            <h1 class="text-3xl font-bold text-blue-900">📬 Détail du message</h1>
            <p class="text-sm text-gray-500 mt-1">Reçu {{ $message->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <a href="{{ route('admin.messages.index') }}"
       class="text-sm bg-white border-2 border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition flex items-center gap-2">
        ← Retour à la liste
    </a>
</div>

{{-- CONTENU --}}
<div class="grid lg:grid-cols-3 gap-6">

    {{-- Colonne principale --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Sujet --}}
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white rounded-xl shadow-lg p-6">
            <div class="flex items-start justify-between gap-4 mb-3">
                <div>
                    <div class="text-xs text-blue-200 uppercase tracking-wider font-semibold mb-1">Sujet</div>
                    <h2 class="text-2xl font-bold">{{ $message->subject }}</h2>
                </div>
                @if($message->is_read)
                    <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">
                        ✅ Lu
                    </span>
                @else
                    <span class="bg-yellow-500 text-blue-900 text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">
                        🔴 Nouveau
                    </span>
                @endif
            </div>
        </div>

        {{-- Message --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center gap-2 mb-4 pb-4 border-b border-gray-100">
                <span class="text-2xl">💬</span>
                <h3 class="font-bold text-blue-900 text-lg">Message</h3>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 leading-relaxed text-gray-800 whitespace-pre-line">
                {{ $message->message }}
            </div>
        </div>

        {{-- Actions --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="font-bold text-blue-900 mb-4 text-lg">⚡ Actions</h3>

            <div class="flex flex-wrap gap-3">
                <a href="mailto:{{ $message->email }}?subject=RE: {{ $message->subject }}"
                   class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition shadow-md font-semibold flex items-center gap-2">
                    ✉️ Répondre par email
                </a>

                <a href="tel:{{ $message->phone }}"
                   class="bg-blue-900 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition shadow-md font-semibold flex items-center gap-2 {{ !$message->phone ? 'opacity-50 pointer-events-none' : '' }}">
                    📞 Appeler
                </a>

                <a href="{{ route('admin.messages.index') }}"
                   class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition font-semibold flex items-center gap-2">
                    ← Retour
                </a>
            </div>
        </div>

    </div>

    {{-- Colonne latérale : infos expéditeur --}}
    <div class="space-y-6">

        {{-- Carte expéditeur --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="font-bold text-blue-900 mb-4 flex items-center gap-2">
                <span>👤</span> Expéditeur
            </h3>

            <div class="text-center mb-5">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-900 to-blue-700 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-3 shadow-lg">
                    {{ strtoupper(substr($message->name, 0, 2)) }}
                </div>
                <div class="font-bold text-lg text-blue-900">{{ $message->name }}</div>
                <div class="text-sm text-gray-500">{{ $message->email }}</div>
            </div>

            <div class="space-y-3 text-sm border-t border-gray-100 pt-4">
                <div class="flex items-center gap-3">
                    <span class="text-lg">📧</span>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-gray-500">Email</div>
                        <a href="mailto:{{ $message->email }}" class="font-semibold text-blue-700 hover:underline truncate block">
                            {{ $message->email }}
                        </a>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <span class="text-lg">📞</span>
                    <div class="flex-1">
                        <div class="text-xs text-gray-500">Téléphone</div>
                        <div class="font-semibold text-gray-800">
                            {{ $message->phone ?: 'Non renseigné' }}
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <span class="text-lg">📅</span>
                    <div class="flex-1">
                        <div class="text-xs text-gray-500">Reçu le</div>
                        <div class="font-semibold text-gray-800">
                            {{ $message->created_at->format('d/m/Y à H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Zone danger --}}
        <div class="bg-red-50 border-2 border-red-200 rounded-xl p-6">
            <div class="font-bold text-red-900 flex items-center gap-2 mb-3">
                ⚠️ Zone dangereuse
            </div>
            <p class="text-sm text-red-700 mb-4">
                Supprimer ce message est <strong>irréversible</strong>.
            </p>

            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                  onsubmit="return confirm('⚠️ Supprimer définitivement ce message ?\n\nCette action est irréversible.')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="w-full bg-red-600 text-white px-4 py-3 rounded-lg hover:bg-red-700 transition font-semibold flex items-center justify-center gap-2">
                    🗑️ Supprimer le message
                </button>
            </form>
        </div>

    </div>

</div>

@endsection