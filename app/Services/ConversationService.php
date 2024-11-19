<?php

namespace App\Services;

use App\Events\User\ConversationCreated;
use App\Events\User\ConversationUpdated;
use App\Events\User\ConversationDeleted;
use App\Models\Conversation;
use App\Models\Room;
use App\Models\User;
use App\Repositories\ConversationRepository;
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
class ConversationService extends Service
{
    /**
     * @var ConversationRepository
     */
    protected $conversationRepository;

    /**
     * @param ConversationRepository $conversationRepository
     * @return void
     */
    public function __construct(ConversationRepository $conversationRepository)
    {
        $this->conversationRepository = $conversationRepository;
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function index(array $datas): JsonResponse
    {
        Validator::make($datas, [
            'room_id' => ['required', 'exists:rooms,id'],
        ])->validate();

        $this->conversationRepository->setRoom(Room::find($datas['room_id']));
        $conversations = $this->conversationRepository->all();

        return response()->json($conversations, 200);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function show(array $datas): JsonResponse
    {
        Validator::make($datas, [
            'room_id' => ['required', 'exists:rooms,id'],
            'id' => ['required', Rule::exists(Conversation::class)],
        ])->validate();

        $this->conversationRepository->setRoom(Room::find($datas['room_id']));
        $conversation = $this->conversationRepository->get($datas["id"]);

        return response()->json($conversation, 200);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function store(array $datas): JsonResponse
    {
        Validator::make($datas, [
            'room_id' => ['required', 'exists:rooms,id'],
            'user_sender_id' => ['required', 'exists:users,id'],
            'user_receiver_id' => ['required', 'exists:users,id'],
            'message' => ['required', 'string'],
        ])->validate();

        $this->conversationRepository->setRoom(Room::find($datas['room_id']));
        $newConversation = $this->conversationRepository->create($datas);
        broadcast(new ConversationCreated($newConversation))->toOthers();

        return response()->json($newConversation, 201);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function update(array $datas): JsonResponse
    {
        Validator::make($datas, [
            'room_id' => ['required', 'exists:rooms,id'],
            'id' => ['required', Rule::exists(Conversation::class)],
            'message' => ['nullable', 'string'],
        ])->validate();

        $this->conversationRepository->setRoom(Room::find($datas['room_id']));
        $updatedConversation = $this->conversationRepository->update($datas["id"], $datas);
        broadcast(new ConversationUpdated($updatedConversation))->toOthers();

        return response()->json($updatedConversation, 200);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function destroy(array $datas): JsonResponse
    {
        Validator::make($datas, [
            'room_id' => ['required', 'exists:rooms,id'],
            'id' => ['required', Rule::exists(Conversation::class)],
        ])->validate();

        $this->conversationRepository->setRoom(Room::find($datas['room_id']));
        $deletedConversation = $this->conversationRepository->delete($datas["id"]);
        broadcast(new ConversationDeleted($deletedConversation))->toOthers();

        return response()->json($deletedConversation, 200);
    }
}