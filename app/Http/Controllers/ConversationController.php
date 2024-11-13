<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Events\MessageCreated;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreConversationRequest;
use App\Http\Requests\UpdateConversationRequest;

class ConversationController extends Controller
{

     public function sendMessage(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'message' => 'required|string',
        ]);

        $conversation = Conversation::create([
            'room_id' => $request->room_id,
            'user_id' => Auth::id(),
            'role' => Auth::user()->role, // Pastikan model User memiliki atribut 'role'
            'message' => $request->message,
        ]);

        // Load relasi user
        $conversation->load('user');

        // Broadcast event
        broadcast(new MessageCreated(Auth::user(), $conversation))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }
}
