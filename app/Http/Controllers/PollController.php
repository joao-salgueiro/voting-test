<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\Option;


class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polls = Poll::withCount('options')->get();
        return view('polls.index', compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('polls.creation_dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Poll $poll)
    {    
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'options' => 'required|array|min:3',
            'options.*' => 'required|string|max:255',
        ]);
    
        $poll = Poll::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
        ]);
    
        foreach ($request->options as $text) {
            $poll->options()->create(['text' => $text]);
        }
    
        return redirect()->route('polls.index')->with('success', 'Enquete criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Poll $poll)
    {
        $poll->load(['options' => function ($query) {
            $query->withCount('votes');
        }]);

        $now = now();
        $isExpired = $now->gt($poll->end);

        return view('polls.list_dashboard', compact('poll', 'isExpired'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $poll = Poll::with('options')->findOrFail($id);

        return view('polls.edit', compact('poll'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $poll = Poll::with('options')->findOrFail($id);

            // Validação básica
            $request->validate([
                'title' => 'required|string|max:255',
                'start' => 'required|date',
                'end' => 'required|date|after:start',
                'options' => 'required|array|min:3',
                'options.*' => 'required|string|max:255',
            ]);

            // Atualiza dados da poll
            $poll->update([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
            ]);

            // Atualiza opções existentes ou cria novas
            foreach ($request->options as $optionId => $optionText) {
                if (is_numeric($optionId)) {
                    // Atualiza opção existente
                    $option = $poll->options->where('id', $optionId)->first();
                    if ($option) {
                        $option->update(['text' => $optionText]);
                    }
                } else {
                    // Cria nova opção (quando o índice não é numérico)
                    $poll->options()->create(['text' => $optionText]);
                }
            }

            return redirect()->route('polls.show', $poll)->with('success', 'Poll updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $poll = Poll::findOrFail($id);

        $poll->delete();

        return redirect()->route('polls.index')->with('success', 'Poll deleted successfully.');
    }
}
