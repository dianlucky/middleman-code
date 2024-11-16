<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\RoomService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_room_using_room_service()
    {
        $owner = User::factory()->create();
        $inviter = User::factory()->create();
        $admin = User::factory()->create();

        $this->actingAs($owner);

        $roomData = [
            'owner_id' => $owner->id,
            'inviter_id' => $inviter->id,
            'admin_id' => $admin->id,
            'room_name' => 'Test Room',
            'room_password' => 'password123',
            'owner_role' => 'penjual',
        ];

        $roomService = app(RoomService::class);
        $response = $roomService->store($roomData);

        $this->assertEquals(201, $response->status());
    }

    /** @test */
    public function it_can_update_a_room_using_room_service()
    {
        $owner = User::factory()->create();
        $inviter = User::factory()->create();
        $admin = User::factory()->create();

        $this->actingAs($owner);

        $roomData = [
            'owner_id' => $owner->id,
            'inviter_id' => $inviter->id,
            'admin_id' => $admin->id,
            'room_name' => 'Test Room',
            'room_password' => 'password123',
            'owner_role' => 'penjual',
        ];

        $roomService = app(RoomService::class);

        $response = $roomService->store($roomData);
        $roomId = $response->getData()->id;

        $updatedData = ['room_name' => 'Updated Room Name'];
        $response = $roomService->update(array_merge(['id' => $roomId], $updatedData));

        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function it_can_delete_a_room_using_room_service()
    {
        $owner = User::factory()->create();
        $inviter = User::factory()->create();
        $admin = User::factory()->create();

        $this->actingAs($owner);

        $roomData = [
            'owner_id' => $owner->id,
            'inviter_id' => $inviter->id,
            'admin_id' => $admin->id,
            'room_name' => 'Test Room',
            'room_password' => 'password123',
            'owner_role' => 'penjual',
        ];

        $roomService = app(RoomService::class);

        $response = $roomService->store($roomData);
        $roomId = $response->getData()->id;

        $response = $roomService->destroy(['id' => $roomId]);

        $this->assertEquals(200, $response->status());
    }
}
