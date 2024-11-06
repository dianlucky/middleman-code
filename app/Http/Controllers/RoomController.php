<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;

class RoomController extends Controller
{

    protected $RoomModel;

    public function __construct()
    {
        $this->RoomModel = new Room();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     */
    public function create(StoreRoomRequest $request)
    {
        // dd($this->RoomModel->generateRoomId());
        $status = $this->RoomModel->create([
            'id' => $this->RoomModel->generateRoomId(),
            'name' => $request['name'],
            'user_id1' => $request['user_id1'],
            'role_user1' => $request['role_user1'],
            'role_user2' => $request['role_user1'] == 'pembeli' ? 'penjual' : 'pembeli',
            'admin_id' => $request['admin_id'],
            'status' => 'ongoing',
        ]);

        if($status) {
            return redirect('/transaction')->with('success', 'Ruangan transaksi berhasil dibuat');
        } else {
            return redirect()->back()->with('error', 'Gagal membuat ruangan')->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
