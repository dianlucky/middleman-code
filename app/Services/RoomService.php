<?php

namespace App\Services;

use App\Events\User\RoomCreated;
use App\Events\User\RoomUpdated;
use App\Events\User\RoomDeleted;
use App\Models\Room;
use App\Repositories\RoomRepository;
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
class RoomService extends Service
{
    /**
     * @var RoomRepository
     */
    protected $roomRepository;

    /**
     * @param RoomRepository $roomRepository
     * @return void
     */
    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function index(array $datas = []): JsonResponse
    {
        $roomId = $datas['id'] ?? 0;
        $rooms = $this->roomRepository->all($roomId);
        return response()->json($rooms, 200);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function show(array $datas): JsonResponse
    {
        Validator::make($datas, [
            "id" => ["required", Rule::exists(Room::class)],
        ])->validate();

        $room = $this->roomRepository->get($datas["id"]);

        return response()->json($room, 200);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function store(array $datas): JsonResponse
    {
        Validator::make($datas, [
            "room_name" => ["required", "string", "min:1", "max:255"],
            "room_password" => ["nullable", "string", "min:8"],
            "room_status" => ["nullable", "string"],
        ])->validate();

        $newRoom = $this->roomRepository->create($datas);
        broadcast(new RoomCreated($newRoom))->toOthers();

        return response()->json($newRoom, 201);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function update(array $datas): JsonResponse
    {
        Validator::make($datas, [
            "id" => ["required", Rule::exists(Room::class)],
            "room_name" => ["nullable", "string", "min:1", "max:255"],
            "room_password" => ["nullable", "string", "min:8"],
            "room_status" => ["nullable", "string"],
        ])->validate();

        $updatedRoom = $this->roomRepository->update($datas["id"], $datas);
        broadcast(new RoomUpdated($updatedRoom))->toOthers();

        return response()->json($updatedRoom, 200);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function destroy(array $datas): JsonResponse
    {
        Validator::make($datas, [
            "id" => ["required", Rule::exists(Room::class)],
        ])->validate();

        $deletedRoom = $this->roomRepository->delete($datas["id"]);
        broadcast(new RoomDeleted($deletedRoom))->toOthers();

        return response()->json($deletedRoom, 200);
    }
}
