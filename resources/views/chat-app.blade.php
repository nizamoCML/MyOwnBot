@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chatbot</div>

                <div class="card-body">
                    <livewire:chat-bot-component :session="$session_id" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
