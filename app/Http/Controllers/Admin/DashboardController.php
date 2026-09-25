<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Post;
use App\Models\Contact;
use App\Models\User;
use App\Models\Tender;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'posts' => Post::count(),
            'contacts' => Contact::count(),
            'unread_contacts' => Contact::where('is_read', false)->count(),
            'users' => User::count(),
            'tenders' => Tender::count(),
            'open_tenders' => Tender::where('status', 'open')->count(),
        ];

        $latestContacts = Contact::latest()->take(5)->get();
        $latestProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestContacts', 'latestProducts'));
    }
}