<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Room;
use App\Services\ConversationService;
use App\Services\RoomService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConversationServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_conversation_using_conversation_service()
    {
        $owner = User::factory()->create();
        $inviter = User::factory()->create();
        $admin = User::factory()->create();

        $this->actingAs($admin);

        $roomService = app(RoomService::class);
        $roomData = [
            'owner_id' => $owner->id,
            'inviter_id' => $inviter->id,
            'admin_id' => $admin->id,
            'room_name' => 'Test Room',
            'room_password' => 'password123',
            'owner_role' => 'penjual',
        ];

        $response = $roomService->store($roomData);
        $roomId = $response->getData()->id;

        $conversationService = app(ConversationService::class);
        $conversationData = [
            'room_id' => $roomId,
            'user_sender_id' => $admin->id,
            'user_receiver_id' => $inviter->id,
            'message' => 'Hello, this is a test conversation!',
        ];

        $response = $conversationService->store($conversationData);
        $this->assertEquals(201, $response->status());
    }

    /** @test */
    public function it_can_update_a_conversation_using_conversation_service()
    {
        $owner = User::factory()->create();
        $inviter = User::factory()->create();
        $admin = User::factory()->create();

        $this->actingAs($admin);

        $roomService = app(RoomService::class);
        $roomData = [
            'owner_id' => $owner->id,
            'inviter_id' => $inviter->id,
            'admin_id' => $admin->id,
            'room_name' => 'Test Room',
            'room_password' => 'password123',
            'owner_role' => 'penjual',
        ];

        $response = $roomService->store($roomData);
        $roomId = $response->getData()->id;

        $conversationService = app(ConversationService::class);
        $conversationData = [
            'room_id' => $roomId,
            'user_sender_id' => $admin->id,
            'user_receiver_id' => $inviter->id,
            'message' => 'Hello, this is a test conversation!',
        ];

        $response = $conversationService->store($conversationData);
        $conversationId = $response->getData()->id;

        $updatedData = [
            'id' => $conversationId,
            'room_id' => $roomId,
            'message' => 'Updated message content!',
        ];

        $response = $conversationService->update($updatedData);
        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function it_can_delete_a_conversation_using_conversation_service()
    {
        $owner = User::factory()->create();
        $inviter = User::factory()->create();
        $admin = User::factory()->create();

        $this->actingAs($admin);

        $roomService = app(RoomService::class);
        $roomData = [
            'owner_id' => $owner->id,
            'inviter_id' => $inviter->id,
            'admin_id' => $admin->id,
            'room_name' => 'Test Room',
            'room_password' => 'password123',
            'owner_role' => 'penjual',
        ];

        $response = $roomService->store($roomData);
        $roomId = $response->getData()->id;

        $conversationService = app(ConversationService::class);
        $conversationData = [
            'room_id' => $roomId,
            'user_sender_id' => $admin->id,
            'user_receiver_id' => $inviter->id,
            'message' => 'Hello, this is a test conversation!',
        ];

        $response = $conversationService->store($conversationData);
        $conversationId = $response->getData()->id;

        $response = $conversationService->destroy([
            'id' => $conversationId,
            'room_id' => $roomId,
        ]);

        $this->assertEquals(200, $response->status());
    }
}
