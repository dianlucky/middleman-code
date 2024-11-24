<?php

namespace App\Services;

use App\Events\Admin\RoomAdminUpdated;
use App\Events\Admin\RoomAdminCreated;
use App\Events\Admin\RoomAdminDeleted;
use App\Models\User;
use App\Models\Room;
use App\Repositories\RoomAdminRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

/**
 * @method JsonResponse index()
 * @method JsonResponse show(array $datas)
 * @method JsonResponse update(array $datas)
 * @method JsonResponse store(array $datas)
 * @method JsonResponse destroy(array $datas)
 */
class RoomAdminService extends Service
{
    /**
     * @var RoomAdminRepository
     */
    protected $roomAdminRepository;

    /**
     * @param RoomAdminRepository $roomAdminRepository
     * @return void
     */
    public function __construct(RoomAdminRepository $roomAdminRepository)
    {
        $this->roomAdminRepository = $roomAdminRepository;
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function index(array $datas = []): JsonResponse
    {
        $roomId = $datas['id'] ?? 0;
        $rooms = $this->roomAdminRepository->all($roomId);
        return response()->json($rooms, 200);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function show(array $datas): JsonResponse
    {
        Validator::make($datas, [
            'id' => ['required', Rule::exists(Room::class)],
        ])->validate();

        $room = $this->roomAdminRepository->get($datas['id']);
        return response()->json($room, 200);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function store(array $datas): JsonResponse
    {
        Validator::make($datas, [
            'owner_id' => ['required', Rule::exists(User::class, 'id')],
            'inviter_id' => ['required', Rule::exists(User::class, 'id')],
            'admin_id' => ['required', Rule::exists(User::class, 'id')],
            'room_name' => ['required', 'string', 'min:1', 'max:255'],
            'room_password' => ['required', 'string', 'min:8'],
            'owner_role' => ['required', Rule::in([RoomAdminRepository::$ROLE_SELLER, RoomAdminRepository::$ROLE_BUYER])],
        ])->validate();

        $newRoom = $this->roomAdminRepository->create($datas);
        broadcast(new RoomAdminCreated($newRoom))->toOthers();

        return response()->json($newRoom, 201);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function update(array $datas): JsonResponse
    {
        Validator::make($datas, [
            'id' => ['required', Rule::exists(Room::class)],
            'room_name' => ['nullable', 'string', 'min:1', 'max:255'],
            'room_password' => ['nullable', 'string', 'min:8'],
            'room_status' => ['nullable', 'string'],
        ])->validate();

        $updatedRoom = $this->roomAdminRepository->update($datas['id'], $datas);
        broadcast(new RoomAdminUpdated($updatedRoom))->toOthers();

        return response()->json($updatedRoom, 200);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function destroy(array $datas): JsonResponse
    {
        Validator::make($datas, [
            'id' => ['required', Rule::exists(Room::class)],
        ])->validate();

        $deletedRoom = $this->roomAdminRepository->delete($datas['id']);
        broadcast(new RoomAdminDeleted($deletedRoom))->toOthers();

        return response()->json($deletedRoom, 200);
    }
}
