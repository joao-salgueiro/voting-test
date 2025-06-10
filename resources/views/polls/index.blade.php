@extends('layouts.app')

@section('title', 'Polls list')

@section('content')
    <h1>Polls</h1>
    @can('admin')
        <a href="{{ route('polls.create') }}" class="btn btn-primary mb-3">Create a new poll</a>
    @endcan
    <div class="list-group">
        <div class="list-group">
            @foreach ($polls as $poll)
                <a href="{{ route('polls.show', $poll) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $poll->title }}</strong><br>
                        <small>{{ $poll->start }} - {{ $poll->end }}</small>
                    </div>
                    <span class="badge bg-secondary">
                        @php
                            $now = now();
                            if (!$poll->start || !$poll->end) {
                                echo 'Invalid';
                            } elseif ($now->lt($poll->start)) {
                                echo 'Not Finished';
                            } elseif ($now->gt($poll->end)) {
                                echo 'Finished';
                            } else {
                                echo 'Active';
                            }
                        @endphp
                        
                        @can('admin')
                        
                        <div>
                            <a href="{{ route('polls.edit', $poll) }}" class="btn btn-warning">
                                ✏️ Edit
                            </a>
                        
                            <form action="{{ route('polls.destroy', $poll) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this poll?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                        @endcan
                    </span>
                </a>
            @endforeach
        </div>
    </div>
@endsection