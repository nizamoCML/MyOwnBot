@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chatbot</div>

                <div class="card-body">
                    <h6 class="mb-3">Please enter your name for asking question</h6>
                    <form action="{{ route('front-session.send-session') }}" method="POST">
                        @csrf
                        <input class="form-control mb-3" type="text" placeholder="Enter your name" name="name" required>
                        <button class="btn btn-primary w-100" type="submit">Continue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
