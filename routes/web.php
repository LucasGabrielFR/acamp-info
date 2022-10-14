<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/people', [PersonController::class, 'index']);
Route::get('admin/person/create', [PersonController::class, 'create'])->name('person.create');
