<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class AdminChatController extends Controller
{
    /**
     * Tampilkan daftar user yang memiliki riwayat chat
     */
    public function index()
    {
        // Ambil user yang pernah chat, diurutkan dari pesan terbaru
        $users = User::whereHas('chats')
            ->with(['chats' => function($query) {
                $query->latest();
            }])
            ->get()
            ->sortByDesc(function($user) {
                return $user->chats->first()->created_at;
            });

        return view('admin.chat.index', compact('users'));
    }

    /**
     * Tampilkan percakapan dengan user tertentu
     */
    public function show(User $user)
    {
        $messages = Chat::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();

        // Tandai pesan sebagai terbaca
        Chat::where('user_id', $user->id)
            ->where('is_from_admin', false)
            ->update(['is_read' => true]);

        return view('admin.chat.show', compact('user', 'messages'));
    }

    /**
     * Kirim balasan dari admin ke user
     */
    public function reply(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        Chat::create([
            'user_id' => $user->id,
            'message' => $request->message,
            'is_from_admin' => true,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Pesan terkirim.');
    }
}
