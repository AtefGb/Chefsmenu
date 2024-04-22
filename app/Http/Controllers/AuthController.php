<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticazione riuscita
            return response()->json(['message' => 'Login avvenuto con successo']);
        } else {
            // Autenticazione fallita
            return response()->json(['message' => 'Credenziali non valide'], 401);
        }
    }
}
