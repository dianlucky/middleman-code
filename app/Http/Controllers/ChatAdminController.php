<?php

namespace App\Http\Controllers;

use App\Services\RoomAdminService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ChatAdminController extends Controller
{
    protected $roomAdminService;

    /**
     * @param \App\Services\RoomAdminService $roomAdminService
     * @return void
     */
    public function __construct(
        RoomAdminService $roomAdminService
    ) {
        $this->roomAdminService = $roomAdminService;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $title = 'Room Page | MiddleMan';

        return view('admin.room.index')->with(compact('title'));
    }

    /**
     * @param Illuminate\Http\Request $request
     * @param int|string $id
     * @return Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $roomData = [

            'id' => $id,
            'room_status' => $request->room_status,
        ];

        $data = $this->roomAdminService->update($roomData);

        return response()->json($data);
    }
}
