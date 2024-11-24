<?php

namespace App\Services;

use App\Events\Admin\ConversationAdminCreated;
use App\Events\Admin\ConversationAdminUpdated;
use App\Events\Admin\ConversationAdminDeleted;
use App\Models\Conversation;
use App\Models\User;
use App\Models\Room;
use App\Repositories\ConversationAdminRepository;
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
class ConversationAdminService extends Service
{
    /**
     * @var ConversationAdminRepository
     */
    protected $conversationAdminRepository;

    /**
     * @param ConversationAdminRepository $conversationAdminRepository
     * @return void
     */
    public function __construct(ConversationAdminRepository $conversationAdminRepository)
    {
        $this->conversationAdminRepository = $conversationAdminRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $conversations = $this->conversationAdminRepository->all();
        return response()->json($conversations, 200);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function show(array $datas): JsonResponse
    {
        Validator::make($datas, [
            'id' => ['required', Rule::exists(Conversation::class)],
        ])->validate();

        $conversation = $this->conversationAdminRepository->get($datas['id']);
        broadcast(new ConversationAdminShowed($conversation))->toOthers();

        return response()->json($conversation, 200);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function store(array $datas): JsonResponse
    {
        Validator::make($datas, [
            'room_id' => ['required', Rule::exists(Room::class, 'id')],
            'user_sender_id' => ['required', Rule::exists(User::class, 'id')],
            'user_receiver_id' => ['required', Rule::exists(User::class, 'id')],
            'message' => ['required', 'string'],
        ])->validate();

        $newConversation = $this->conversationAdminRepository->create($datas);
        broadcast(new ConversationAdminCreated($newConversation))->toOthers();

        return response()->json($newConversation, 201);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function update(array $datas): JsonResponse
    {
        Validator::make($datas, [
            'id' => ['required', Rule::exists(Conversation::class)],
            'message' => ['nullable', 'string'],
        ])->validate();

        $updatedConversation = $this->conversationAdminRepository->update($datas['id'], $datas);
        broadcast(new ConversationAdminUpdated($updatedConversation))->toOthers();

        return response()->json($updatedConversation, 200);
    }

    /**
     * @param array $datas
     * @return JsonResponse
     */
    public function destroy(array $datas): JsonResponse
    {
        Validator::make($datas, [
            'id' => ['required', Rule::exists(Conversation::class)],
        ])->validate();

        $deletedConversation = $this->conversationAdminRepository->delete($datas['id']);
        broadcast(new ConversationAdminDeleted($deletedConversation))->toOthers();

        return response()->json($deletedConversation, 200);
    }
}
