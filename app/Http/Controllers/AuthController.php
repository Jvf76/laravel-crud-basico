<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ================= LOGIN =================

    // Mostra o formulário de login (GET /login)
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Processa o login (POST /login)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redireciona para a lista de produtos após logar
            return redirect()->route('produtos.index');
        }

        return back()->withErrors([
            'email' => 'As credenciais não conferem.',
        ])->onlyInput('email');
    }

    // ================= LOGOUT =================

    // Faz logout (POST /logout)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }

    // ================= REGISTRO =================

    // Mostra formulário de registro (GET /register)
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Cria o usuário no banco (POST /register)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Exige campo password_confirmation no form
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // Loga o usuário automaticamente

        return redirect()->route('produtos.index')
            ->with('success', 'Conta criada com sucesso!');
    }
}