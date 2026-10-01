<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use App\Models\TenderDocument;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    /**
     * Liste publique des marchés publics (avec filtres par type)
     */
  public function index(Request $request)
{
    // ═══ Base query pour la liste (avec filtre type + approved) ═══
    $query = Tender::where('is_published', true)->approved();

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    $tenders = $query->orderByDesc('deadline_date')
                     ->orderByDesc('created_at')
                     ->paginate(9);

    // ═══ Stats (avec LE MÊME filtre) ═══
    $statsQuery = Tender::where('is_published', true)->approved();

    if ($request->filled('type')) {
        $statsQuery->where('type', $request->type);
    }

    $stats = [
        'open'    => (clone $statsQuery)->where('status', 'open')->count(),
        'awarded' => (clone $statsQuery)->where('status', 'awarded')->count(),
        'closed'  => (clone $statsQuery)->where('status', 'closed')->count(),
    ];

    return view('tenders.index', compact('tenders', 'stats'));
}

    /**
     * Détail d'un marché public
     */
   public function show($slug)
{
    $tender = Tender::where('slug', $slug)
                    ->published()
                    ->approved()  // ← AJOUTEZ
                    ->firstOrFail();

    $related = Tender::published()
        ->approved()  // ← AJOUTEZ
        ->where('id', '!=', $tender->id)
        ->where('type', $tender->type)
        ->latest('published_at')
        ->take(3)
        ->get();

    return view('tenders.show', compact('tender', 'related'));
}

    /**
     * Page "Manuel d'achat"
     */
    public function manual()
    {
        $document = TenderDocument::where('slug', 'manuel-achat-ciok')
            ->published()
            ->firstOrFail();

        return view('tenders.document', compact('document'));
    }

    /**
     * Page "Plan prévisionnel"
     */
    public function plan()
    {
        $document = TenderDocument::where('slug', 'plan-previsionnel')
            ->published()
            ->firstOrFail();

        return view('tenders.document', compact('document'));
    }
}