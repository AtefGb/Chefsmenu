<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register()
    {
        $user = User::all();

        return response()->json(['user' => $user]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|',
            'password' => 'required|string|',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json(['message' => 'Votre compte a été bien créé']);
    }

    public function login(Request $request)
{
    $validate = $request->validate([
        'email' => 'required|email|',
        'password' => 'required|string|'
    ]);

    if (Auth::attempt($validate)) {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
        // Retourner le message de succès et le nom d'utilisateur de l'utilisateur connecté
        return response()->json(['message' => 'vous êtes connecté', 'username' => $user->name]);
    } else {
        return response()->json(['message' => 'email ou mot de passe incorrect ']);
    }
}


    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Vous êtes déconnecté']);
    }
}
