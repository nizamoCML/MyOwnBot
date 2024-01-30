<div>
    <div class="page-content-wrapper py-3" id="chat-wrapper">
        <div class="container">
            @php
                $session = \App\Models\UserSession::where('id', $current_session->id)->first()->end_time;
                $current = date('Y-m-d H:i:s');
                if ($session < $current) {
                    return redirect()->route('welcome');
                }
            @endphp

            <div wire:poll class="chat-content-wrap">

                <div wire:ignore class="alert custom-alert-2 alert-success alert-dismissible fade show" role="alert">
                    Chatbot: Hello, I am <b>Example</b>. Please type your question. - {{ $current_session->created_at->diffForHumans() ?? '' }}
                </div>

                @forelse ($chat_history as $chat)
                    @if ($chat->question)
                        <div class="alert custom-alert-2 alert-primary alert-dismissible fade show" role="alert">
                            User: {{ $chat->question ?? '' }}- {{ $chat->created_at->diffForHumans() ?? '' }}
                        </div>
                    @endif
                    @if ($chat->answer)
                        <div class="alert custom-alert-2 alert-success alert-dismissible fade show" role="alert">
                            Chatbot: {{ $chat->answer ?? '' }} - {{ $chat->created_at->diffForHumans() ?? '' }}
                        </div>
                    @endif
                @empty
                @endforelse
            </div>
        </div>
    </div>

    <form wire:submit.prevent="sendMessage">
        <input class="form-control mb-2" type="text" placeholder="Type here..." wire:model="message">

        <button class="btn btn-primary w-100" type="submit">
            Send
        </button>
    </form>
</div>
