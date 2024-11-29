<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('site.pages.user.index');
    }


    public function fetch_all()
    {
        return response()->json([
            'data' => User::all()
        ]);
    }



    public function change_role(Request $request)
    {
        $user = User::findOrFail($request->id);

        // Vérifiez que l'utilisateur authentifié a les droits nécessaires
        if (!auth()->user()->is_admin) {
            return response()->json(['error' => 'Non autorisé.'], 403);
        }

        // Inverser le rôle de l'utilisateur ciblé
        $user->is_admin = !$user->is_admin;
        $user->save();

        // Retourner une réponse
        return response()->json([
            'success' => true,
            'message' => $user->is_admin
                ? 'L\'utilisateur a été promu administrateur.'
                : 'Les droits administrateur de l\'utilisateur ont été révoqués.',
            'is_admin' => $user->is_admin,
        ]);
    }
}
