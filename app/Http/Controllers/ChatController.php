<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Ambil semua pesan untuk user yang sedang login
     */
    public function getMessages()
    {
        $messages = Chat::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    /**
     * Kirim pesan dari user ke admin
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $chat = Chat::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_from_admin' => false,
            'is_read' => false,
        ]);

        return response()->json(['status' => 'success', 'chat' => $chat]);
    }
}
