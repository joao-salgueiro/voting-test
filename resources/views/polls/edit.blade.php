@extends('layouts.app')

@section('title', 'Create Poll')

@section('content')
    <h1>Poll Edit (only for super users)</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('polls.update', $poll->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Poll Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Start</label>
                <input type="datetime-local" name="start" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">End</label>
                <input type="datetime-local" name="end" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Options</label>
            <div id="options">
                <input type="text" name="options[]" class="form-control mb-2" placeholder="Option 1" required>
                <input type="text" name="options[]" class="form-control mb-2" placeholder="Option 2" required>
                <input type="text" name="options[]" class="form-control mb-2" placeholder="Option 3" required>
            </div>
            <button type="button" class="btn btn-secondary btn-sm" onclick="addOption()">Add Option</button>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>

    <script>
        function addOption() {
            const container = document.getElementById('options');
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'options[]';
            input.className = 'form-control mb-2';
            input.placeholder = 'Nova opção';
            container.appendChild(input);
        }
    </script>
@endsection