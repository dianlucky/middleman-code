<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        ]);
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

    public function adminDelete($id)
    {
        $status = $this->UserModel->where('id', $id)->delete();

        if ($status) {
            return redirect('/admin')->with('success', 'Data admin berhasil terhapus!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
