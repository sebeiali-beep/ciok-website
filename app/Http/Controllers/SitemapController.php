<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Post;
use App\Models\Tender;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        // Pages statiques
        $urls[] = ['loc' => route('home'), 'changefreq' => 'weekly', 'priority' => '1.0'];
        $urls[] = ['loc' => route('about'), 'changefreq' => 'monthly', 'priority' => '0.8'];
        $urls[] = ['loc' => route('products.index'), 'changefreq' => 'weekly', 'priority' => '0.9'];
        $urls[] = ['loc' => route('posts.index'), 'changefreq' => 'daily', 'priority' => '0.8'];
        $urls[] = ['loc' => route('tenders.index'), 'changefreq' => 'daily', 'priority' => '0.9'];
        $urls[] = ['loc' => route('quality'), 'changefreq' => 'monthly', 'priority' => '0.7'];
        $urls[] = ['loc' => route('careers'), 'changefreq' => 'weekly', 'priority' => '0.6'];
        $urls[] = ['loc' => route('contact.show'), 'changefreq' => 'monthly', 'priority' => '0.7'];

        // Produits
        foreach (Product::active()->get() as $product) {
            $urls[] = [
                'loc' => route('products.show', $product->slug),
                'lastmod' => $product->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        }

        // Actualités
        foreach (Post::published()->get() as $post) {
            $urls[] = [
                'loc' => route('posts.show', $post->slug),
                'lastmod' => $post->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.6',
            ];
        }

        // Appels d'offres
        foreach (Tender::published()->get() as $tender) {
            $urls[] = [
                'loc' => route('tenders.show', $tender->slug),
                'lastmod' => $tender->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        }

        return response()->view('sitemap', compact('urls'))
            ->header('Content-Type', 'text/xml');
    }
}