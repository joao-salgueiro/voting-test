@extends('layouts.app')

@section('content')
    <h1>{{ $poll->title }}</h1>
    <p><strong>Period:</strong> 
        <a>Started at: </a> {{ \Carbon\Carbon::parse($poll->start)->format('Y-m-d H:i') }}
        <a>Until: </a> {{ \Carbon\Carbon::parse($poll->end)->format('Y-m-d H:i') }}
    </p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($isExpired ?? false)
        <div class="alert alert-danger">
            This poll has ended and voting is no longer possible.
        </div>
    @else
        <form action="{{ route('polls.vote', $poll) }}" method="POST">
            @csrf
            @foreach ($poll->options as $option)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option_id" value="{{ $option->id }}" id="option{{ $option->id }}">
                    <label class="form-check-label" for="option{{ $option->id }}">
                        {{ $option->text }}
                    </label>
                </div>
            @endforeach
            <br>
            <button type="submit" class="btn btn-primary mt-3" onclick="this.disabled=true; this.form.submit();" >Vote</button>
           
        </form>
    @endif
    <br>
    <div class="bg-dark text-light p-3 rounded">
        @foreach ($poll->options as $option)
            <p style="color: orange">{{ $option->text }} Votes: {{ $option->votes_count }}</p>
        @endforeach
    </div>
@endsection