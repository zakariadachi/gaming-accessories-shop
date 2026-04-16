<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::withCount('commandes')->latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas modifier votre propre rôle.');
        }

        $request->validate([
            'role' => ['required', 'in:admin,client'],
        ]);

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Rôle de "' . $user->nom . '" mis à jour.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return back()->with('success', 'Utilisateur "' . $user->nom . '" supprimé.');
    }

    public function toggleBan(User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas vous bannir vous-même.');
        }

        if ($user->role === 'admin') {
            return back()->with('error', 'Impossible de bannir un administrateur.');
        }

        $user->update(['is_banned' => !$user->is_banned]);

        $message = $user->is_banned
            ? '"' . $user->nom . '" a été banni avec succès.'
            : '"' . $user->nom . '" a été débanni avec succès.';

        return back()->with('success', $message);
    }
}
