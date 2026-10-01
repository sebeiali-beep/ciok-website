<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TenderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 🌐 Changement de langue
Route::get('lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

// 🏠 Site public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [PageController::class, 'about'])->name('about');
Route::get('/qualite', [PageController::class, 'quality'])->name('quality');
Route::get('/carrieres', [PageController::class, 'careers'])->name('careers');

Route::get('/produits', [ProductController::class, 'index'])->name('products.index');
Route::get('/produits/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/actualites', [PostController::class, 'index'])->name('posts.index');
Route::get('/actualites/{slug}', [PostController::class, 'show'])->name('posts.show');

// 📋 Marché public
Route::get('/marche-public', [TenderController::class, 'index'])->name('tenders.index');
Route::get('/marche-public/manuel-achat', [TenderController::class, 'manual'])->name('tenders.manual');
Route::get('/marche-public/plan-previsionnel', [TenderController::class, 'plan'])->name('tenders.plan');
Route::get('/marche-public/{slug}', [TenderController::class, 'show'])->name('tenders.show');

// ✉️ Contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// 🔁 Redirection après login (Breeze cherche 'dashboard')
Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home');
})->middleware('auth')->name('dashboard');

// ═══════════════════════════════════════════════════════════════════
// 🔐 ADMIN
// ═══════════════════════════════════════════════════════════════════
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // ═══ Dashboard ═══
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // ═══ Produits ═══
    Route::middleware('role:products')->group(function () {
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

        // Approbation
        Route::post('products/{product}/approve', [\App\Http\Controllers\Admin\ProductController::class, 'approve'])
            ->name('products.approve');
        Route::post('products/{product}/reject', [\App\Http\Controllers\Admin\ProductController::class, 'reject'])
            ->name('products.reject');
    });

    // ═══ Actualités ═══
    Route::middleware('role:posts')->group(function () {
        Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);

        // Approbation
        Route::post('posts/{post}/approve', [\App\Http\Controllers\Admin\PostController::class, 'approve'])
            ->name('posts.approve');
        Route::post('posts/{post}/reject', [\App\Http\Controllers\Admin\PostController::class, 'reject'])
            ->name('posts.reject');
    });

    // ═══ Marché public ═══
    Route::middleware('role:tenders')->group(function () {
        Route::resource('tenders', \App\Http\Controllers\Admin\TenderController::class);

        // Approbation
        Route::post('tenders/{tender}/approve', [\App\Http\Controllers\Admin\TenderController::class, 'approve'])
            ->name('tenders.approve');
        Route::post('tenders/{tender}/reject', [\App\Http\Controllers\Admin\TenderController::class, 'reject'])
            ->name('tenders.reject');

        // Duplication
        Route::post('tenders/{tender}/duplicate', [\App\Http\Controllers\Admin\TenderController::class, 'duplicate'])
            ->name('tenders.duplicate');

        // Export CSV
        Route::get('tenders/export/csv', [\App\Http\Controllers\Admin\TenderController::class, 'exportCsv'])
            ->name('tenders.export.csv');

        // Documents (Manuel + Plan)
        Route::get('tender-documents', [\App\Http\Controllers\Admin\TenderDocumentController::class, 'index'])
            ->name('tender-documents.index');
        Route::get('tender-documents/{document}/edit', [\App\Http\Controllers\Admin\TenderDocumentController::class, 'edit'])
            ->name('tender-documents.edit');
        Route::put('tender-documents/{document}', [\App\Http\Controllers\Admin\TenderDocumentController::class, 'update'])
            ->name('tender-documents.update');
    });

    // ═══ Messages ═══
    Route::middleware('role:messages')->group(function () {
        Route::resource('messages', \App\Http\Controllers\Admin\MessageController::class)
            ->only(['index', 'show', 'destroy']);
    });

    // ═══ Utilisateurs ═══
    Route::middleware('role:users')->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });
});

// Auth routes (Breeze) — TOUJOURS À LA FIN
require __DIR__.'/auth.php';