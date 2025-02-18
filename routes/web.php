<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/about', [IndexController::class, 'about'])->name('about');
Route::get('/history', [IndexController::class, 'history'])->name('history');
Route::get('/politics', [IndexController::class, 'politics'])->name('politics');


Route::get('/place/{place}', [PlaceController::class, 'show'])->name('place.show');
//Route::get('/participant', [PlaceController::class, 'participant'])->name('participant');
Route::get('/participant/{participant}', [PlaceController::class, 'participant'])
    ->name('participant.show');
Route::post('/stories', [StoryController::class, 'storeUserStory'])->name('stories.store');
