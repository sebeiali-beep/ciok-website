<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15);

        $roles = [
            'super_admin' => '👑 Super Admin',
            'admin' => '⚙️ Admin',
            'product_manager' => '📦 Gestionnaire Produits',
            'post_manager' => '📰 Gestionnaire Actualités',
            'tender_manager' => '📋 Gestionnaire Appels d\'offres',
            'message_manager' => '📬 Gestionnaire Messages',
            'viewer' => '👁️ Lecteur',
        ];

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = [
            'admin' => '⚙️ Admin',
            'product_manager' => '📦 Gestionnaire Produits',
            'post_manager' => '📰 Gestionnaire Actualités',
            'tender_manager' => '📋 Gestionnaire Appels d\'offres',
            'message_manager' => '📬 Gestionnaire Messages',
            'viewer' => '👁️ Lecteur',
        ];

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,product_manager,post_manager,tender_manager,message_manager,viewer',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_admin'] = true;
        $validated['email_verified_at'] = now();

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur créé avec succès !');
    }

    public function show(User $user)
    {
        return redirect()->route('admin.users.edit', $user);
    }

    public function edit(User $user)
    {
        $roles = [
            'super_admin' => '👑 Super Admin',
            'admin' => '⚙️ Admin',
            'product_manager' => '📦 Gestionnaire Produits',
            'post_manager' => '📰 Gestionnaire Actualités',
            'tender_manager' => '📋 Gestionnaire Appels d\'offres',
            'message_manager' => '📬 Gestionnaire Messages',
            'viewer' => '👁️ Lecteur',
        ];

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:super_admin,admin,product_manager,post_manager,tender_manager,message_manager,viewer',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Empêcher un admin non-super de passer un user en super_admin
        if ($validated['role'] === 'super_admin' && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'Seul un Super Admin peut attribuer ce rôle.');
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur modifié avec succès !');
    }

    public function destroy(User $user)
    {
        // Empêcher de se supprimer soi-même
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        // Empêcher de supprimer un super_admin (sauf par un autre super_admin)
        if ($user->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer un Super Admin.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur supprimé !');
    }
}