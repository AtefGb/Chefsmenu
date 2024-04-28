<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register()
    {
      
        return response()->json([]);
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

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Votre compte a été bien créé', 'access_token' => $token,
        'token_type' => 'Bearer',]);
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email|',
            'password' => 'required|string|'
        ]);
        
        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        if (Auth::attempt($validate)) {
            // Récupérer l'utilisateur connecté
            $user = Auth::user();
            // Retourner le message de succès et le nom d'utilisateur de l'utilisateur connecté
            return response()->json(['message' => 'vous êtes connecté', 'username' => $user->name, 'access_token' => $token,
            'token_type' => 'Bearer',]);
        } else {
            return response()->json(['message' => 'email ou mot de passe incorrect ']);
        }
       
    }

    public function logout(Request $request)
    {
        $logout = Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message'=>'Logout effettuato con successo', 'logout' => $logout]);
    }

}
