<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    public function index(Request $request)
    {
        $query = Tender::published()->latest('published_at');

        // Filtre par type
        if ($request->has('type') && in_array($request->type, ['appel_offre', 'consultation_elargie'])) {
            $query->where('type', $request->type);
        }

        // Filtre par statut
        if ($request->has('status') && in_array($request->status, ['open', 'closed', 'awarded'])) {
            $query->where('status', $request->status);
        }

        $tenders = $query->paginate(10);

        $stats = [
            'open' => Tender::published()->where('status', 'open')->count(),
            'closed' => Tender::published()->where('status', 'closed')->count(),
            'awarded' => Tender::published()->where('status', 'awarded')->count(),
        ];

        return view('tenders.index', compact('tenders', 'stats'));
    }

    public function show($slug)
    {
        $tender = Tender::where('slug', $slug)->published()->firstOrFail();

        $related = Tender::published()
            ->where('id', '!=', $tender->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('tenders.show', compact('tender', 'related'));
    }
}