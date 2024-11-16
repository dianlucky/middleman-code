<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\RoomService;
use App\Services\ConversationAdminService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConversationAdminServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_conversation_using_conversation_admin_service()
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

        $conversationData = [
            'room_id' => $roomId,
            'user_sender_id' => $admin->id,
            'user_receiver_id' => $inviter->id,
            'message' => 'Hello, this is a test conversation!',
        ];

        $conversationAdminService = app(ConversationAdminService::class);
        $response = $conversationAdminService->store($conversationData);

        $this->assertEquals(201, $response->status());
        $this->assertNotNull($response->getData()->id);
        $this->assertEquals($conversationData['message'], $response->getData()->message);
    }

    /** @test */
    public function it_can_update_a_conversation_using_conversation_admin_service()
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

        $conversationData = [
            'room_id' => $roomId,
            'user_sender_id' => $admin->id,
            'user_receiver_id' => $inviter->id,
            'message' => 'Hello, this is a test conversation!',
        ];

        $conversationAdminService = app(ConversationAdminService::class);
        $response = $conversationAdminService->store($conversationData);
        $conversationId = $response->getData()->id;

        $updatedData = [
            'id' => $conversationId,
            'message' => 'Updated message content!',
        ];

        $response = $conversationAdminService->update($updatedData);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('Updated message content!', $response->getData()->message);
    }

    /** @test */
    public function it_can_delete_a_conversation_using_conversation_admin_service()
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

        $conversationData = [
            'room_id' => $roomId,
            'user_sender_id' => $admin->id,
            'user_receiver_id' => $inviter->id,
            'message' => 'Hello, this is a test conversation!',
        ];

        $conversationAdminService = app(ConversationAdminService::class);
        $response = $conversationAdminService->store($conversationData);
        $conversationId = $response->getData()->id;

        $response = $conversationAdminService->destroy(['id' => $conversationId]);

        $this->assertEquals(200, $response->status());
        $this->assertEquals($conversationId, $response->getData()->id);
    }
}
