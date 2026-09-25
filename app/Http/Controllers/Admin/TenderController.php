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

    // Recherche (référence ou titre)
    if ($request->has('search') && $request->search) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('reference', 'like', "%{$search}%")
              ->orWhere('title_fr', 'like', "%{$search}%")
              ->orWhere('title_ar', 'like', "%{$search}%")
              ->orWhere('title_en', 'like', "%{$search}%");
        });
    }

    // Filtre par type
    if ($request->has('type') && $request->type) {
        $query->where('type', $request->type);
    }

    // Filtre par statut
    if ($request->has('status') && $request->status) {
        $query->where('status', $request->status);
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
            'type' => 'required|in:appel_offre,consultation_elargie',
            'reference' => 'required|string|max:255',
            'title_fr' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_fr' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'deadline_date' => 'nullable|date',
            'deadline_time' => 'nullable',
            'opening_date' => 'nullable|date',
            'opening_time' => 'nullable',
            'status' => 'required|in:open,closed,awarded',
            'notice_pdf' => 'nullable|mimes:pdf|max:5120',
            'result_pdf' => 'nullable|mimes:pdf|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['reference']) . '-' . uniqid();
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = now();

        if ($request->hasFile('notice_pdf')) {
            $validated['notice_pdf'] = $request->file('notice_pdf')->store('tenders', 'public');
        }

        if ($request->hasFile('result_pdf')) {
            $validated['result_pdf'] = $request->file('result_pdf')->store('tenders', 'public');
        }

        Tender::create($validated);

        return redirect()->route('admin.tenders.index')->with('success', 'Appel d\'offres créé avec succès !');
    }

    public function edit(Tender $tender)
    {
        return view('admin.tenders.edit', compact('tender'));
    }

    public function update(Request $request, Tender $tender)
    {
        $validated = $request->validate([
            'type' => 'required|in:appel_offre,consultation_elargie',
            'reference' => 'required|string|max:255',
            'title_fr' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_fr' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'deadline_date' => 'nullable|date',
            'deadline_time' => 'nullable',
            'opening_date' => 'nullable|date',
            'opening_time' => 'nullable',
            'status' => 'required|in:open,closed,awarded',
            'notice_pdf' => 'nullable|mimes:pdf|max:5120',
            'result_pdf' => 'nullable|mimes:pdf|max:5120',
        ]);

        $validated['is_published'] = $request->has('is_published');

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

        return redirect()->route('admin.tenders.index')->with('success', 'Appel d\'offres modifié avec succès !');
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

        return redirect()->route('admin.tenders.index')->with('success', 'Appel d\'offres supprimé !');
    }
}