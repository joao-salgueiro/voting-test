<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\Option;
use App\Models\Vote;

class VoteController extends Controller
{
    public function store(Request $request, Poll $poll)
{
    $request->validate([
        'option_id' => 'required|exists:options,id',
    ]);

    $option = Option::where('id', $request->option_id)
        ->where('poll_id', $poll->id)
        ->firstOrFail();

    Vote::create([
        'option_id' => $option->id,
    ]);

    $poll->load(['options' => function ($query) {
        $query->withCount('votes');
    }]);

    return redirect()->route('polls.show', $poll)->with('success', 'Ok! Vote registered successfully.');
}
}
