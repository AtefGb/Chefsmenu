<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /**
     * Mostra il form per richiedere il reset della password.
     *
     * @return \Illuminate\View\View
     */
    public function forgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Invia il link per il reset della password via email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? redirect()->route('password.request')->with('status', 'Un email è stato inviato con le istruzioni per reimpostare la password.')
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Mostra il form per reimpostare la password.
     *
     * @param  string  $token
     * @return \Illuminate\View\View
     */
    public function resetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Reimposta la password dell'utente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'La tua password è stata reimpostata con successo.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
