<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Models\FriendList;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    protected $UserModel;
    protected $FriendlistModel;
    protected $RoomModel;

    public function __construct()
    {
        $this->UserModel = new User();
        $this->FriendlistModel = new FriendList();
        $this->RoomModel = new Room();
    }
    public function homepage()
    {
        // MessageCreated::dispatch('Testing Pusher');
        return view('userview.index', [
            'title' => 'Homepage | MiddleMan',
        ]);
    }
    public function about()
    {
        return view('userview.about', [
            'title' => 'About | MiddleMan',
        ]);
    }
    public function price()
    {
        return view('userview.price', [
            'title' => 'Pricing List | MiddleMan',
        ]);
    }

    public function testimonial()
    {
        return view('userview.testimonial', [
            'title' => 'Testimonial | MiddleMan',
        ]);
    }
    public function contact()
    {
        return view('userview.contact', [
            'title' => 'Contact | MiddleMan',
        ]);
    }

    public function transaction()
    {
        $dataMember = $this->UserModel->where('role', 'member')->get();
        $dataFriendList = $this->FriendlistModel->where('status', 'friend')->get();
        $dataAdmin = $this->UserModel->where('role', 'admin')->get();
        $dataRoom = $this->RoomModel->where('status', 'ongoing')->get();
        $myRooms = $this->RoomModel
            ->where('user_id1', auth()->user()->id)
            ->where('status', 'ongoing')
            ->get();
        // dd($dataRoom);
        return view('userview.transaction', [
            'member' => $dataMember,
            'admin' => $dataAdmin,
            'friendlist' => $dataFriendList,
            'myRooms' => $myRooms,
            'rooms' => $dataRoom,
            'title' => 'Transaction | MiddleMan',
        ]);
    }
}
