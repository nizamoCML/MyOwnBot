<?php

namespace App\Http\Livewire;

use App\Models\UserChat;
use App\Models\UserSession;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatBotComponent extends Component
{
    public $session;
    public $message;

    public function mount($session)
    {
        $this->session = $session;
    }
    public function render()
    {
        $current_session = UserSession::where('session_id', $this->session)->firstOrFail();
        $chat_history = UserChat::where('session_id', $this->session)->get();
        $current_time = date('Y-m-d H:i:s');
        return view('livewire.chat-bot-component', compact('current_session', 'chat_history', 'current_time'));
    }

    public function sendMessage()
    {
        try {
            $url = env('APP_PYTHON_URL');
            $question = $this->message;
            $full_url = $url . '/query/chat-bot/MyData/' . $question;
            $response = Http::get($full_url);

            $responseData = $response->json();

            $chat_history = new UserChat();
            $chat_history->session_id = $this->session;
            $chat_history->question = $question;
            $chat_history->answer = $responseData['result'];
            $chat_history->save();
            $this->message = '';

            Log::info($this->session . ' : ' . 'User : ' . $question . ' | Bot : ' . $responseData['result']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
