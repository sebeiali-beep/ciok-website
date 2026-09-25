<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $hasPermission = match($permission) {
            'products' => $user->canManageProducts(),
            'posts' => $user->canManagePosts(),
            'tenders' => $user->canManageTenders(),
            'messages' => $user->canManageMessages(),
            'users' => $user->canManageUsers(),
            default => false,
        };

        if (!$hasPermission) {
            abort(403, 'Vous n\'avez pas la permission d\'accéder à cette section.');
        }

        return $next($request);
    }
}