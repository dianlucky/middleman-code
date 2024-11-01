<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class LoginController extends Controller
{
    private $UserModel;

    public function __construct(){
        $this->UserModel = new User();
    }
    public function index()
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

    public function registerSave(StoreUserRequest $request){

        $status = $this->UserModel->create([
            'username' => $request['username'],
            'password' => bcrypt($request['password']),
            'name' => $request['name'],
            'phone' => $request['phone'],
            'role' => 'member',
            
        ]);

        if($status) {
            return redirect('/login')->with('success', 'Akun anda berhasil dibuat!');
        } else {
            return redirect('/register')->with('error', 'Terjadi kesalahan!');
        }
    }

}
