<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatCotroller extends Controller
{
    //====================Display All Cart================//
    public function index()
    {
        $user = auth()->user();
        return view('setting.chats.index', ['user' => $user]);
    }

    //====================Create Cart================//
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        Chat::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return redirect()->route('chats.index');
    }


}
