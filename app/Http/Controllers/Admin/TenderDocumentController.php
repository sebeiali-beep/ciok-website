<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TenderDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TenderDocumentController extends Controller
{
    public function index()
    {
        $documents = TenderDocument::ordered()->paginate(20);
        return view('admin.tender-documents.index', compact('documents'));
    }

    public function edit(TenderDocument $document)
    {
        return view('admin.tender-documents.edit', compact('document'));
    }

    public function update(Request $request, TenderDocument $document)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'icon'         => 'nullable|string|max:10',
            'badge_label'  => 'nullable|string|max:100',
            'file'         => 'nullable|file|mimes:pdf|max:20480',
            'order'        => 'nullable|integer',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('file')) {
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('tender-documents', 'public');
        }

        $document->update($validated);

        return redirect()->route('admin.tender-documents.index')
            ->with('success', 'Document mis à jour.');
    }
}