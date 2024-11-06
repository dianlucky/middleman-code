<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [''];

    function generateRoomId()
    {
        do {
            $randomId = mt_rand(10000, 99999);
        } while (\App\Models\Room::where('id', $randomId)->exists());

        return $randomId;
    }
}
