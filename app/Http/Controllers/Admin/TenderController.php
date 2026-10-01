<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tender;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TenderController extends Controller
{
  public function index(Request $request)
{
    $query = Tender::query();

    // ═══ Recherche ═══
    if ($request->filled('search')) {
        $s = $request->search;
        $query->where(function ($q) use ($s) {
            $q->where('reference', 'like', "%{$s}%")
              ->orWhere('title_fr', 'like', "%{$s}%")
              ->orWhere('title_ar', 'like', "%{$s}%")
              ->orWhere('title_en', 'like', "%{$s}%");
        });
    }

    // ═══ Filtre type ═══
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    // ═══ Filtre statut ═══
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // ═══ Filtre approbation ═══
    if ($request->filled('approval')) {
        $query->where('approval_status', $request->approval);
    }

    // ═══ Filtre année ═══
    if ($request->filled('year')) {
        $query->whereYear('created_at', $request->year);
    }

    $tenders = $query->latest()->paginate(15);

    return view('admin.tenders.index', compact('tenders'));
}

    public function create()
    {
        return view('admin.tenders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'           => 'required|in:appel_offre,consultation,consultation_elargie',
            'reference'      => 'required|string|max:255|unique:tenders,reference',
            'title_fr'       => 'required|string|max:255',
            'title_ar'       => 'nullable|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description_fr' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'deadline_date'  => 'nullable|date',
            'deadline_time'  => 'nullable',
            'opening_date'   => 'nullable|date',
            'opening_time'   => 'nullable',
            'status'         => 'required|in:open,closed,awarded',
            'notice_pdf'     => 'nullable|mimes:pdf|max:10240',
            'result_pdf'     => 'nullable|mimes:pdf|max:10240',
        ]);

        $validated['slug'] = Str::slug($validated['reference']) . '-' . uniqid();
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $request->has('is_published') ? now() : null;

        if ($request->hasFile('notice_pdf')) {
            $validated['notice_pdf'] = $request->file('notice_pdf')->store('tenders', 'public');
        }
        if ($request->hasFile('result_pdf')) {
            $validated['result_pdf'] = $request->file('result_pdf')->store('tenders', 'public');
        }

        Tender::create($validated);

        return redirect()->route('admin.tenders.index')
            ->with('success', 'Marché public créé avec succès !');
    }

    public function edit(Tender $tender)
    {
        return view('admin.tenders.edit', compact('tender'));
    }

    public function update(Request $request, Tender $tender)
    {
        $validated = $request->validate([
            'type'           => 'required|in:appel_offre,consultation,consultation_elargie',
            'reference'      => 'required|string|max:255|unique:tenders,reference,' . $tender->id,
            'title_fr'       => 'required|string|max:255',
            'title_ar'       => 'nullable|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description_fr' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'deadline_date'  => 'nullable|date',
            'deadline_time'  => 'nullable',
            'opening_date'   => 'nullable|date',
            'opening_time'   => 'nullable',
            'status'         => 'required|in:open,closed,awarded',
            'notice_pdf'     => 'nullable|mimes:pdf|max:10240',
            'result_pdf'     => 'nullable|mimes:pdf|max:10240',
        ]);

        $validated['is_published'] = $request->has('is_published');
        if ($request->has('is_published') && !$tender->published_at) {
            $validated['published_at'] = now();
        } elseif (!$request->has('is_published')) {
            $validated['published_at'] = null;
        }

        if ($request->hasFile('notice_pdf')) {
            if ($tender->notice_pdf && Storage::disk('public')->exists($tender->notice_pdf)) {
                Storage::disk('public')->delete($tender->notice_pdf);
            }
            $validated['notice_pdf'] = $request->file('notice_pdf')->store('tenders', 'public');
        }
        if ($request->hasFile('result_pdf')) {
            if ($tender->result_pdf && Storage::disk('public')->exists($tender->result_pdf)) {
                Storage::disk('public')->delete($tender->result_pdf);
            }
            $validated['result_pdf'] = $request->file('result_pdf')->store('tenders', 'public');
        }

        $tender->update($validated);

        return redirect()->route('admin.tenders.index')
            ->with('success', 'Marché public modifié avec succès !');
    }

    public function destroy(Tender $tender)
    {
        if ($tender->notice_pdf && Storage::disk('public')->exists($tender->notice_pdf)) {
            Storage::disk('public')->delete($tender->notice_pdf);
        }
        if ($tender->result_pdf && Storage::disk('public')->exists($tender->result_pdf)) {
            Storage::disk('public')->delete($tender->result_pdf);
        }

        $tender->delete();

        return redirect()->route('admin.tenders.index')
            ->with('success', 'Marché public supprimé !');
    }

    // ═══ DUPLICATION ═══
    public function duplicate(Tender $tender)
    {
        $newTender = $tender->replicate();
        $newTender->reference = $tender->reference . ' (COPIE)';
        $newTender->slug = Str::slug($newTender->reference) . '-' . uniqid();
        $newTender->status = 'open';
        $newTender->is_published = false;
        $newTender->published_at = null;
        $newTender->save();

        return redirect()->route('admin.tenders.edit', $newTender)
            ->with('success', 'Marché dupliqué. Modifiez-le avant de publier.');
    }

    // ═══ EXPORT CSV ═══
    public function exportCsv()
    {
        $tenders = Tender::orderByDesc('created_at')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="marche-public-' . date('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($tenders) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM UTF-8

            fputcsv($file, ['Référence', 'Type', 'Titre FR', 'Statut', 'Date limite', 'Ouverture', 'Publié']);

            foreach ($tenders as $t) {
                fputcsv($file, [
                    $t->reference,
                    $t->type_label,
                    $t->title_fr,
                    $t->status_label,
                    $t->deadline_date?->format('d/m/Y'),
                    $t->opening_date?->format('d/m/Y'),
                    $t->is_published ? 'Oui' : 'Non',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
        // ═══════════════════════════════════════════════════════
    // APPROBATION
    // ═══════════════════════════════════════════════════════

    public function approve(Tender $tender)
    {
        // Vérifier que l'utilisateur peut approuver
        if (!auth()->user()->canManageUsers()) {
            abort(403, 'Vous n\'avez pas la permission d\'approuver.');
        }

        $tender->update([
            'approval_status'  => 'approved',
            'approved_by'      => auth()->id(),
            'approved_at'      => now(),
            'rejection_reason' => null,
        ]);

        return back()->with('success', '✅ Marché public approuvé et publié.');
    }

    public function reject(Request $request, Tender $tender)
    {
        if (!auth()->user()->canManageUsers()) {
            abort(403, 'Vous n\'avez pas la permission de rejeter.');
        }

        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $tender->update([
            'approval_status'  => 'rejected',
            'approved_by'      => auth()->id(),
            'approved_at'      => now(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        return back()->with('success', '❌ Marché public rejeté.');
    }
}