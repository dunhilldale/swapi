<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;

Route::get('/people', [CharacterController::class, 'peopleList']);
Route::post('/characters', [CharacterController::class, 'store']);
Route::delete('/characters/{id}', [CharacterController::class, 'destroy']);
Route::get('/search', [CharacterController::class, 'search']);
