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
use Illuminate\Http\JsonResponse;
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
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $title = 'Transaction | MiddleMan';

        return view('userview.transaction')->with(compact('title'));
    }

    /**
     * @param Illuminate\Http\Request $request
     * @param int|string $id
     * @return Illuminate\Http\JsonResponse
     */
    public function showRoom(Request $request, $id = 0): JsonResponse
    {
        $rooms = $this->roomService->index([ 'id' => $id, ])->getData();

        if (! $id) {

            $authId = auth()->id();
            $authRole = auth()->user()->role;
            $admins = User::where('role', 'admin')->get();
            $members = User::whereKeyNot(auth()->id())->where('role', 'member')->get();

            $data = compact(

                'authId',
                'authRole',
                'admins',
                'members',
                'rooms'
            );

        } else {

            $data = compact(

                'rooms'
            );
        }

        return response()->json($data);
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function storeRoom(Request $request): JsonResponse
    {
        $roomData = [

            'owner_role' => $request->room_role_user1,
            'inviter_id' => (int) $request->room_user_id2,
            'room_name' => $request->room_name,
            'room_password' => $request->room_password,
        ];

        if ($request->room_admin_id) $roomData['admin_id'] = (int) $request->room_admin_id;
        else if ($request->room_user_id1) $roomData['owner_id'] = (int) $request->room_user_id1;

        $data = $this->roomService->store($roomData);

        return response()->json($data);
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function destroyRoom(Request $request): JsonResponse
    {
        $roomData = [

            'id' => (int) $request->id,
        ];

        $data = $this->roomService->destroy($roomData);

        return response()->json($data);
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function joinRoom(Request $request): JsonResponse
    {
        $roomData = [

            'id' => (int) $request->id,
            'password' => $request->password,
        ];

        $data = $this->roomService->join($roomData);

        return response()->json($data);
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function leaveRoom(Request $request): JsonResponse
    {
        $roomData = [

            'id' => (int) $request->id,
        ];

        $data = $this->roomService->leave($roomData);

        return response()->json($data);
    }

    /**
     * @param Illuminate\Http\Request $request
     * @param int|string $id
     * @return Illuminate\Http\JsonResponse
     */
    public function showConversation(Request $request, $id): JsonResponse
    {
        $conversations = $this->conversationService->index([ 'room_id' => $id, ])->getData();

        $data = compact(

            'conversations'
        );

        return response()->json($data);
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function storeConversation(Request $request): JsonResponse
    {
        $conversationData = [

            'room_id' => (int) $request->conversation_room_id,
            'user_receiver_id' => (int) $request->conversation_receiver_id,
            'message' => $request->conversation_message,
        ];

        $data = $this->conversationService->store($conversationData);

        return response()->json($data);
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function destroyConversation(Request $request): JsonResponse
    {
        $conversationData = [

            'id' => (int) $request->id,
            'room_id' => (int) $request->conversation_room_id,
        ];

        $data = $this->conversationService->destroy($roomData);

        return response()->json($data);
    }
}
