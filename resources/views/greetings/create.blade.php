@extends('layout')

@section('content')
    <h1>Greetings Sender</h1>

    <form action="{{ route('greetings.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="to" class="form-label">To</label>
            <input type="email" class="form-control" id="to" name="to" placeholder="Email Address" value="{{ old('to') }}" required>

            @error('to')
                <span class="error invalid-feedback d-inline">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="3" placeholder="Type your message here..." required>{{ old('message') }}</textarea>

            @error('message')
                <span class="error invalid-feedback d-inline">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Send</button>
    </form>
@endsection