<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\RoomAdminService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomAdminServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_room_using_room_admin_service()
    {
        $owner = User::factory()->create();
        $inviter = User::factory()->create();
        $admin = User::factory()->create();

        $this->actingAs($admin);

        $roomData = [
            'owner_id' => $owner->id,
            'inviter_id' => $inviter->id,
            'admin_id' => $admin->id,
            'room_name' => 'Test Room',
            'room_password' => 'password123',
            'owner_role' => 'penjual',
        ];

        $roomAdminService = app(RoomAdminService::class);
        $response = $roomAdminService->store($roomData);

        $this->assertEquals(201, $response->status());
    }

    /** @test */
    public function it_can_update_a_room_using_room_admin_service()
    {
        $owner = User::factory()->create();
        $inviter = User::factory()->create();
        $admin = User::factory()->create();

        $this->actingAs($admin);

        $roomData = [
            'owner_id' => $owner->id,
            'inviter_id' => $inviter->id,
            'admin_id' => $admin->id,
            'room_name' => 'Test Room',
            'room_password' => 'password123',
            'owner_role' => 'penjual',
        ];

        $roomAdminService = app(RoomAdminService::class);

        $response = $roomAdminService->store($roomData);
        $roomId = $response->getData()->id;

        $updatedData = ['room_name' => 'Updated Room Name'];
        $response = $roomAdminService->update(array_merge(['id' => $roomId], $updatedData));

        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function it_can_delete_a_room_using_room_admin_service()
    {
        $owner = User::factory()->create();
        $inviter = User::factory()->create();
        $admin = User::factory()->create();

        $this->actingAs($admin);

        $roomData = [
            'owner_id' => $owner->id,
            'inviter_id' => $inviter->id,
            'admin_id' => $admin->id,
            'room_name' => 'Test Room',
            'room_password' => 'password123',
            'owner_role' => 'penjual',
        ];

        $roomAdminService = app(RoomAdminService::class);

        $response = $roomAdminService->store($roomData);
        $roomId = $response->getData()->id;

        $response = $roomAdminService->destroy(['id' => $roomId]);

        $this->assertEquals(200, $response->status());
    }
}
