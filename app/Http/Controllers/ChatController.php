<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Repositories\RoomAdminRepository;
use App\Services\RoomAdminService;
use App\Services\RoomService;
use App\Services\ConversationAdminService;
use App\Services\ConversationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    protected $roomAdminService;
    protected $roomService;
    protected $conversationAdminService;
    protected $conversationService;

    /**
     * @param \App\Services\RoomAdminService $roomAdminService
     * @param \App\Services\RoomService $roomService
     * @param \App\Services\ConversationAdminService $conversationAdminService
     * @param \App\Services\ConversationService $conversationService
     * @return void
     */
    public function __construct(
        RoomAdminService $roomAdminService,
        RoomService $roomService,
        ConversationAdminService $conversationAdminService,
        ConversationService $conversationService
    ) {
        $this->roomAdminService = $roomAdminService;
        $this->roomService = $roomService;
        $this->conversationAdminService = $conversationAdminService;
        $this->conversationService = $conversationService;
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return View
     */
    public function index(Request $request, $id = null): View
    {
        $title = 'Transaction | MiddleMan';
        $roomSearch = (int) $request->query('roomSearch', 0);

        $roles = [ RoomAdminRepository::$ROLE_SELLER, RoomAdminRepository::$ROLE_BUYER, ];
        $admins = User::where('role', 'admin')->get();
        $members = User::whereKeyNot(auth()->id())->where('role', 'member')->get();
        $rooms = $this->roomService->index([ 'id' => $roomSearch, ])->getData();

        $view = view('userview.transaction')->with
        (
            compact(

                'title',
                'roles',
                'admins',
                'members',
                'rooms'
            )
        );

        if ($id) {

            $data_room = [];
            $data_conversations = [];

            try {

                $data_room = $this->roomService->show([ 'id' => $id, ])->getData();
                $data_conversations = $this->conversationService->index([ 'room_id' => $id, ])->getData();

            } catch (Exception $thrower) {

                Log::debug($thrower);
            }

            $view->with(compact(

                'data_room',
                'data_conversations'
            ));
        }

        return $view;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeRoom(Request $request): RedirectResponse
    {
        $roomData = [

            'owner_role' => $request->room_role_user1,
            'inviter_id' => (int) $request->room_user_id2,
            'admin_id' => (int) $request->room_admin_id,
            'room_name' => $request->room_name,
            'room_password' => $request->room_password,
        ];

        $this->roomService->store($roomData);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroyRoom(Request $request): RedirectResponse
    {
        $roomData = [

            'id' => (int) $request->id,
        ];

        $this->roomService->destroy($roomData);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function joinRoom(Request $request): RedirectResponse
    {
        $roomData = [

            'id' => (int) $request->id,
        ];

        $this->roomService->join($roomData);

        return redirect()->route('transaction.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function leaveRoom(Request $request): RedirectResponse
    {
        $roomData = [

            'id' => (int) $request->id,
        ];

        $this->roomService->leave($roomData);

        return redirect()->route('transaction.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeConversation(Request $request): RedirectResponse
    {
        $conversationData = [

            'room_id' => (int) $request->conversation_room_id,
            'user_receiver_id' => (int) $request->conversation_receiver_id,
            'message' => $request->conversation_message,
        ];

        $this->conversationService->store($conversationData);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroyConversation(Request $request): RedirectResponse
    {
        $conversationData = [

            'id' => (int) $request->id,
            'room_id' => (int) $request->conversation_room_id,
        ];

        $this->conversationService->destroy($roomData);

        return redirect()->back();
    }
}
