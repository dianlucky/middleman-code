<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;

class RoomController extends Controller
{
    protected $RoomModel;
    protected $ConversationModel;

    public function __construct()
    {
        $this->RoomModel = new Room();
        $this->ConversationModel = new Conversation();
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
            'password' => $request['password'],
            'user_id1' => $request['user_id1'],
            'role_user1' => $request['role_user1'],
            'role_user2' => $request['role_user1'] == 'pembeli' ? 'penjual' : 'pembeli',
            'admin_id' => $request['admin_id'],
            'status' => 'ongoing',
        ]);

        if ($status) {
            return redirect('/transaction')->with('success', 'Ruangan transaksi berhasil dibuat');
        } else {
            return redirect()->back()->with('error', 'Gagal membuat ruangan')->withInput();
        }
    }

    public function in(Request $request)
    {
        $room = $this->RoomModel->where('id', $request['room_id'])->first();
        $message = $this->ConversationModel::where('room_id', $room['id'])->with('user')->get();
        // dd($room);
        if ($room['password'] == $request['password']) {
            // return view('userview.chatroom',[
            //     'title' => 'Chatroom | Middleman',
            //     'room' => $room,
            //     'room_id' =>$request['room_id'],
            //     'messages' => $message,
            // ]);
            return redirect('room/' . $room['id']);
        }
    }

    public function roomEnter($room_id)
    {
       $messages = Conversation::where('room_id', $room_id)->with('user')->get();
        $room = Room::where('id', $room_id)->first();
        return view('userview.chatroom', ['messages' => $messages, 'room_id' => $room_id, 'room_name' => $room['name'], 'role' => $room['role_user1'], 'title' => 'Chatroom | Middleman']);
    }

    public function searchRooms(Request $request)
    {
        $query = $request->input('query');

        // Cari username yang sesuai dengan input
        $users = $this->RoomModel
            ->where('id', 'LIKE', "%{$query}%")
            ->where('status', 'ongoing')
            ->get();

        // Kembalikan hasil dalam format JSON
        return response()->json($users);
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
