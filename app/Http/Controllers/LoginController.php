<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        // dd($request);
        $account = $this->UserModel->where('username', $request->username)->first();

        if (!$account) {
            return redirect('/login')->with('error', 'Username atau password salah!')->withInput();
        }

        $password_check = Hash::check($request->password, $account->password);

        if ($password_check) {
            $_SESSION['account'] = $account;
            dd($_SESSION['account']);
            if($account->role == 'admin'){
                return redirect()->to('/dashboard')->with('success', 'Selamat datang'. $account->name);
            } else {
                return redirect()->to('/')->with('success', 'Selamat datang'. $account->name);
            }
        } else {
            return redirect('/login')->with('error', 'Username atau password salah!')->withInput();
        }
    }
}
