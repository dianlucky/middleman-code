<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new User();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.index', [
            'title' => 'User | Middleman',
            'users' => $this->UserModel->where('role', 'member')->get(),
        ]);
    }

    // app/Http/Controllers/UserController.php
    public function searchUsers(Request $request)
    {
        $query = $request->input('query');

        // Cari username yang sesuai dengan input
        $users = User::where('username', 'LIKE', "%{$query}%")->where('role', 'member')->get();

        // Kembalikan hasil dalam format JSON
        return response()->json($users);
    }

    public function adminAdd()
    {
        return view('admin.admin.add')->with([
            'title' => 'Tambah admin | Middleman',
        ]);
    }

    public function adminInsert(StoreUserRequest $request)
    {
        $status = $this->UserModel->create([
            'id' => '',
            'username' => $request['username'],
            'password' => bcrypt($request['password']),
            'name' => $request['name'],
            'birth_date' => $request['birth_date'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'role' => 'admin',
        ]);

        if ($status) {
            return redirect('/admin')->with('success', 'Data Admin Ditambah!');
        } else {
            return redirect('/admin/add')->withErrors(['msg' => 'Ada kesalahan pada input Anda.']);
        }
    }

    public function adminEdit($id)
    {
        $dataUser = $this->UserModel->where('id', $id)->get();
        return view('admin.admin.edit')->with([
            'title' => 'Edit Admin | Middleman',
            'dataAdmin' => $dataUser,
        ]);
    }

    public function adminUpdate(UpdateUserRequest $request, $id)
    {
        $user = $this->UserModel->where('id', $request->id)->first();
        if (!$user) {
            return redirect('/admin')->with('error', 'Data admin tidak ditemukan');
        }
        $update = $this->UserModel->where('id', $request['id'])->update([
            'username' => $request['username'],
            'name' => $request['name'],
            'phone' => $request['phone'],
            'birth_date' => $request['birth_date'],
            'address' => $request['address'],
            'password' => $request->password != null ? bcrypt($request->password) : $user->password,
        ]);

        if ($update) {
            return redirect('/admin')->with('success', 'Data admin berhasil dirubah');
        } else {
            return redirect('/admin')->with('error', 'Gagal memperbarui data admin');
        }
    }

    public function adminDelete($id)
    {
        $status = $this->UserModel->where('id', $id)->delete();

        if ($status) {
            return redirect('/admin')->with('success', 'Data admin berhasil terhapus!');
        }
    }
}
