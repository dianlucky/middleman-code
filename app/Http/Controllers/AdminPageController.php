<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new User();
    }

    public function dashboard()
    {
        return view('admin.index')->with( [
            'title' => 'Dashboard | MiddleMan',
        ]);
    }

    public function admin()
    {
        // $dataUser = $this->UserModel->where('role', 'admin')->get();
        return view('admin.admin.index')->with([
            'title' => 'Admin Page | MiddleMan',
            'users' => $this->UserModel->where('role', 'admin')->get(),
        ]);
    }
}
