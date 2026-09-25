@extends('admin.layout')
@section('title', 'Modifier appel d\'offres')

@section('content')

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- EN-TÊTE --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="flex items-center justify-between mb-6 flex-wrap gap-4">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.tenders.index') }}"
           class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center text-blue-900 hover:bg-blue-50 transition">
            ←
        </a>
        <div>
            <h1 class="text-3xl font-bold text-blue-900">✏️ Modifier l'appel d'offres</h1>
            <div class="flex items-center gap-2 mt-1">
                <span class="font-mono font-bold text-blue-700 text-sm bg-blue-100 px-2 py-0.5 rounded">
                    {{ $tender->reference }}
                </span>
                @if($tender->status === 'open')
                    <span class="text-xs bg-green-100 text-green-800 font-bold px-2 py-0.5 rounded-full">🟢 Ouvert</span>
                @elseif($tender->status === 'awarded')
                    <span class="text-xs bg-blue-100 text-blue-800 font-bold px-2 py-0.5 rounded-full">✅ Attribué</span>
                @else
                    <span class="text-xs bg-gray-100 text-gray-700 font-bold px-2 py-0.5 rounded-full">🔒 Clôturé</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Bouton Voir sur le site --}}
    <a href="{{ route('tenders.show', $tender->slug) }}" target="_blank"
       class="text-sm bg-white border-2 border-blue-900 text-blue-900 px-4 py-2 rounded-lg hover:bg-blue-900 hover:text-white transition flex items-center gap-2">
        🌐 Voir sur le site
    </a>
</div>

<form action="{{ route('admin.tenders.update', $tender) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf @method('PUT')

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 1 : IDENTIFICATION --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">
                1
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">📋 Identification</h2>
                <p class="text-blue-200 text-xs">Type et référence de l'appel d'offres</p>
            </div>
        </div>

        <div class="p-6 space-y-5">

            {{-- Type --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800">
                    Type d'annonce <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="cursor-pointer">
                        <input type="radio" name="type" value="appel_offre"
                               class="peer sr-only" required
                               {{ old('type', $tender->type) === 'appel_offre' ? 'checked' : '' }}>
                        <div class="border-2 rounded-xl p-4 text-center transition
                                    peer-checked:border-blue-900 peer-checked:bg-blue-50 peer-checked:shadow-md
                                    border-gray-200 hover:border-blue-300">
                            <div class="text-3xl mb-2">📄</div>
                            <div class="font-bold text-blue-900">Appel d'offres</div>
                            <div class="text-xs text-gray-500 mt-1">Procédure formelle</div>
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="radio" name="type" value="consultation_elargie"
                               class="peer sr-only" required
                               {{ old('type', $tender->type) === 'consultation_elargie' ? 'checked' : '' }}>
                        <div class="border-2 rounded-xl p-4 text-center transition
                                    peer-checked:border-purple-600 peer-checked:bg-purple-50 peer-checked:shadow-md
                                    border-gray-200 hover:border-purple-300">
                            <div class="text-3xl mb-2">📢</div>
                            <div class="font-bold text-purple-700">Consultation élargie</div>
                            <div class="text-xs text-gray-500 mt-1">Procédure simplifiée</div>
                        </div>
                    </label>
                </div>
                @error('type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Référence --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800">
                    Référence <span class="text-red-500">*</span>
                </label>
                <input type="text" name="reference" value="{{ old('reference', $tender->reference) }}"
                       placeholder="Ex: AO N° 16/2026"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 font-mono text-lg focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition"
                       required>
                <p class="text-xs text-gray-500 mt-1">💡 Attention : modifier la référence n'affecte pas l'URL publique (slug)</p>
                @error('reference') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 2 : OBJET --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">
                2
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">📝 Objet de l'appel d'offres</h2>
                <p class="text-blue-200 text-xs">Description multilingue (FR / AR / EN)</p>
            </div>
        </div>

        <div class="p-6 space-y-5">

            {{-- FR --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇫🇷 Objet en français <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title_fr" value="{{ old('title_fr', $tender->title_fr) }}"
                       maxlength="255"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition"
                       required>
                @error('title_fr') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- AR --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇹🇳 الكائن بالعربية
                </label>
                <input type="text" name="title_ar" value="{{ old('title_ar', $tender->title_ar) }}"
                       dir="rtl" maxlength="255"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition text-right">
            </div>

            {{-- EN --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800 flex items-center gap-2">
                    🇬🇧 Object in English
                </label>
                <input type="text" name="title_en" value="{{ old('title_en', $tender->title_en) }}"
                       maxlength="255"
                       class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">
            </div>

            {{-- Description --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800">
                    📄 Description détaillée (FR)
                </label>
                <textarea name="description_fr" rows="4" maxlength="2000"
                          class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition">{{ old('description_fr', $tender->description_fr) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Maximum 2000 caractères</p>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 3 : DATES ET STATUT --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">
                3
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">📅 Dates et statut</h2>
                <p class="text-blue-200 text-xs">Planification de l'appel d'offres</p>
            </div>
        </div>

        <div class="p-6 space-y-5">

            {{-- Deadline --}}
            <div class="bg-blue-50 rounded-lg p-4">
                <div class="font-semibold text-blue-900 mb-3 flex items-center gap-2">
                    ⏰ Date limite de dépôt
                </div>
                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Date</label>
                        <input type="date" name="deadline_date"
                               value="{{ old('deadline_date', $tender->deadline_date?->format('Y-m-d')) }}"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-2 focus:border-blue-900 outline-none transition bg-white">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Heure</label>
                        <input type="time" name="deadline_time"
                               value="{{ old('deadline_time', $tender->deadline_time) }}"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-2 focus:border-blue-900 outline-none transition bg-white">
                    </div>
                </div>
            </div>

            {{-- Ouverture --}}
            <div class="bg-green-50 rounded-lg p-4">
                <div class="font-semibold text-green-900 mb-3 flex items-center gap-2">
                    📂 Ouverture des plis
                </div>
                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Date</label>
                        <input type="date" name="opening_date"
                               value="{{ old('opening_date', $tender->opening_date?->format('Y-m-d')) }}"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-2 focus:border-green-900 outline-none transition bg-white">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Heure</label>
                        <input type="time" name="opening_time"
                               value="{{ old('opening_time', $tender->opening_time) }}"
                               class="w-full border-2 border-gray-200 rounded-lg px-4 py-2 focus:border-green-900 outline-none transition bg-white">
                    </div>
                </div>
            </div>

            {{-- Statut --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-800">
                    Statut de l'appel d'offres <span class="text-red-500">*</span>
                </label>
                <select name="status"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-900 focus:ring-2 focus:ring-blue-100 outline-none transition"
                        required>
                    <option value="open" {{ old('status', $tender->status) === 'open' ? 'selected' : '' }}>
                        🟢 Ouvert — Les entreprises peuvent postuler
                    </option>
                    <option value="awarded" {{ old('status', $tender->status) === 'awarded' ? 'selected' : '' }}>
                        ✅ Attribué — Marché gagné par une entreprise
                    </option>
                    <option value="closed" {{ old('status', $tender->status) === 'closed' ? 'selected' : '' }}>
                        🔒 Clôturé — En attente de résultats
                    </option>
                </select>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 4 : DOCUMENTS PDF --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-500 text-blue-900 rounded-lg flex items-center justify-center font-bold text-sm">
                4
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">📎 Documents</h2>
                <p class="text-blue-200 text-xs">Avis et résultats au format PDF</p>
            </div>
        </div>

        <div class="p-6 grid md:grid-cols-2 gap-5">

            {{-- Avis --}}
            <div class="border-2 border-dashed border-blue-300 rounded-lg p-5 hover:bg-blue-50 transition">

                @if($tender->notice_pdf)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-2xl">📄</span>
                            <div>
                                <div class="text-sm font-semibold text-green-800">Avis actuel</div>
                                <div class="text-xs text-gray-500">Fichier enregistré</div>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $tender->notice_pdf) }}" target="_blank"
                           class="text-blue-700 hover:underline text-sm font-semibold">
                            Voir →
                        </a>
                    </div>
                @endif

                <div class="text-center">
                    <div class="text-4xl mb-2">📄</div>
                    <div class="font-semibold text-blue-900 mb-1">
                        {{ $tender->notice_pdf ? 'Remplacer l\'avis' : 'Ajouter l\'avis' }}
                    </div>
                    <div class="text-xs text-gray-500 mb-3">PDF — max 5 Mo</div>
                    <input type="file" name="notice_pdf" accept="application/pdf"
                           class="w-full text-xs file:mr-2 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-900 file:text-white file:font-semibold hover:file:bg-blue-800">
                </div>
                @if($tender->notice_pdf)
                    <p class="text-xs text-gray-500 mt-2 text-center">Laisser vide pour conserver le fichier actuel</p>
                @endif
                @error('notice_pdf') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            {{-- Résultats --}}
            <div class="border-2 border-dashed border-green-300 rounded-lg p-5 hover:bg-green-50 transition">

                @if($tender->result_pdf)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-2xl">✅</span>
                            <div>
                                <div class="text-sm font-semibold text-green-800">Résultats actuels</div>
                                <div class="text-xs text-gray-500">Fichier enregistré</div>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $tender->result_pdf) }}" target="_blank"
                           class="text-green-700 hover:underline text-sm font-semibold">
                            Voir →
                        </a>
                    </div>
                @endif

                <div class="text-center">
                    <div class="text-4xl mb-2">✅</div>
                    <div class="font-semibold text-green-900 mb-1">
                        {{ $tender->result_pdf ? 'Remplacer les résultats' : 'Ajouter les résultats' }}
                    </div>
                    <div class="text-xs text-gray-500 mb-3">PDF — max 5 Mo</div>
                    <input type="file" name="result_pdf" accept="application/pdf"
                           class="w-full text-xs file:mr-2 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-600 file:text-white file:font-semibold hover:file:bg-green-700">
                </div>
                @if($tender->result_pdf)
                    <p class="text-xs text-gray-500 mt-2 text-center">Laisser vide pour conserver le fichier actuel</p>
                @endif
                @error('result_pdf') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- SECTION 5 : PUBLICATION --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md p-6">
        <label class="flex items-center gap-4 cursor-pointer">
            <input type="checkbox" name="is_published" value="1"
                   {{ old('is_published', $tender->is_published) ? 'checked' : '' }}
                   class="w-5 h-5 accent-blue-900 cursor-pointer">
            <div>
                <div class="font-bold text-blue-900">
                    {{ $tender->is_published ? '✅ Publié sur le site public' : '🔒 Non publié' }}
                </div>
                <div class="text-sm text-gray-500">
                    Décochez pour masquer temporairement cet appel d'offres
                </div>
            </div>
        </label>
    </div>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- BOUTONS D'ACTION --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-xl shadow-md p-6 sticky bottom-4 z-10">
        <div class="flex flex-wrap gap-3 justify-between items-center">
            <div class="flex gap-3">
                <a href="{{ route('admin.tenders.index') }}"
                   class="text-gray-600 hover:text-gray-900 font-semibold flex items-center gap-2">
                    ← Annuler
                </a>

                {{-- Bouton Voir sur le site --}}
                <a href="{{ route('tenders.show', $tender->slug) }}" target="_blank"
                   class="text-blue-700 hover:text-blue-900 font-semibold flex items-center gap-2">
                    🌐 Aperçu
                </a>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-blue-900 text-white px-8 py-3 rounded-lg hover:bg-blue-800 transition shadow-md font-semibold flex items-center gap-2">
                    💾 Enregistrer les modifications
                </button>
            </div>
        </div>
    </div>

</form>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- ZONE DANGER : SUPPRESSION --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="bg-red-50 border-2 border-red-200 rounded-xl p-6 mt-6">
    <div class="flex items-center justify-between flex-wrap gap-4">
        <div>
            <div class="font-bold text-red-900 flex items-center gap-2">
                ⚠️ Zone dangereuse
            </div>
            <div class="text-sm text-red-700 mt-1">
                La suppression de cet appel d'offres est <strong>irréversible</strong>.
                Tous les documents PDF associés seront également supprimés.
            </div>
        </div>

        <form action="{{ route('admin.tenders.destroy', $tender) }}" method="POST"
              onsubmit="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer DÉFINITIVEMENT cet appel d\'offres ?\n\nCette action est irréversible.')">
            @csrf @method('DELETE')
            <button type="submit"
                    class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition shadow-md font-semibold flex items-center gap-2">
                🗑️ Supprimer définitivement
            </button>
        </form>
    </div>
</div>

@endsection