<?php

namespace App\Http\Controllers;

use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontSessionController extends Controller
{
    public function sendSession(Request $request)
    {
        $store = UserSession::create([
            'name' => $request->name,
            'session_id' => Str::random(40),
            'start_time' => now(),
            'end_time' => now()->addMinutes(180),
        ]);
        return redirect()->route('chat-bot.chat', ['session_id' => $store->session_id]);
    }
}
