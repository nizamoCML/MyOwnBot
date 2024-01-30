<?php

namespace App\Http\Controllers;

use App\Models\UserSession;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function chat($session_id)
    {
        $data_session = UserSession::where('session_id', $session_id)->firstOrFail();
        return view('chat-app', compact('session_id', 'data_session'));
    }
}
