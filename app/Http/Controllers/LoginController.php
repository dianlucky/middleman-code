<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;

class LoginController extends Controller
{
    private $UserModel;

    public function __construct()
    {
        $this->UserModel = new User();
    }
    public function login()
    {
        return view('login.login')->with([
            'title' => 'Login | Middleman',
        ]);
    }

    public function register()
    {
        return view('login.register')->with([
            'title' => 'Register | Middleman',
        ]);
    }

    public function registerSave(StoreUserRequest $request)
    {
        $status = $this->UserModel->create([
            'username' => $request['username'],
            'password' => bcrypt($request['password']),
            'name' => $request['name'],
            'phone' => $request['phone'],
            'role' => 'member',
        ]);

        if ($status) {
            return redirect('/login')->with('success', 'Akun anda berhasil dibuat!');
        } else {
            return redirect('/register')->with('error', 'Terjadi kesalahan!');
        }
    }

    public function auth(AuthRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil...
            $account = Auth::user();

            if ($account->role == 'admin' || $account->role == 'superadmin') {
                return redirect()
                    ->to('/dashboard')
                    ->with('success', 'Selamat datang ' . $account->name);
            } else {
                return redirect()
                    ->to('/')
                    ->with('success', 'Selamat datang ' . $account->name);
            }
        }

        return redirect('/login')->with('error', 'Username atau password salah!')->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Terimakasih!.');
    }
}
