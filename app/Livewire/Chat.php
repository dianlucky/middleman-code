<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\RoomAdminService;
use App\Services\RoomService;
use App\Services\ConversationAdminService;
use App\Services\ConversationService;
use Livewire\Component;

class Chat extends Component
{
    public $admins;
    public $members;
    public $rooms;
    public $conversations;

    protected $roomAdminService;
    protected $roomService;
    protected $conversationAdminService;
    protected $conversationService;

    /**
     * @param RoomAdminService $roomAdminService
     * @param RoomService $roomService
     * @param ConversationAdminService $conversationAdminService
     * @param ConversationService $conversationService
     * @return void
     */
    public function mount(
        RoomAdminService $roomAdminService,
        RoomService $roomService,
        ConversationAdminService $conversationAdminService,
        ConversationService $conversationService
    ) {
        $this->roomAdminService = $roomAdminService;
        $this->roomService = $roomService;
        $this->conversationAdminService = $conversationAdminService;
        $this->conversationService = $conversationService;

        $this->admins = User::where('role', 'admin')->get();
        $this->members = User::whereKeyNot(auth()->id())->where('role', 'member')->get();
        $this->rooms = $this->roomAdminService->index()->getData();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('userview.transaction')
        ->extends('layouts.userMain')
        ->section('content')
        ->layoutData(
        [
            'title' => 'Transaction | MiddleMan',
        ]);
    }
}
