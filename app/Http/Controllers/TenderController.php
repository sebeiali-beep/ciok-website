<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    public function index(Request $request)
{
    $query = Tender::where('is_published', true);

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    $tenders = $query->orderByDesc('deadline_date')
                     ->orderByDesc('created_at')
                     ->paginate(9);

    $stats = [
        'open'    => Tender::where('is_published', true)->where('status', 'open')->count(),
        'awarded' => Tender::where('is_published', true)->where('status', 'awarded')->count(),
        'closed'  => Tender::where('is_published', true)->where('status', 'closed')->count(),
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

    public function manual()
{
    return view('tenders.manual');
}

public function plan()
{
    return view('tenders.plan');
}
}