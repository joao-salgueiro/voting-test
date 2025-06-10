<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Auth; // Importa para usar o logout


Route::get('/', function () {
    return redirect()->route('polls.index');
});

// IMPORTANTE: A rota abaixo está definindo view diretamente, pode ser redundante porque você já tem resource polls.
// Se quiser que /polls chame o PollController@index, pode remover esta rota e usar só o resource.
Route::get('/polls', function () {
    return view('polls.index');
});

Route::resource('polls', PollController::class);

Route::post('polls/{poll}/vote', [VoteController::class, 'store'])->name('polls.vote');

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::resource('options', OptionController::class)->only(['edit', 'update', 'destroy']);
});

Route::get('/test-admin', function () {
    dd(Gate::allows('admin')); // true ou false
});

Route::get('login', function () {
    return view('auth.login'); 
})->name('login');

Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

Route::post('logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');