<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/people', [PersonController::class, 'index'])->name('people.index');
Route::get('admin/person/create', [PersonController::class, 'create'])->name('person.create');
Route::post('admin/person/create',[PersonController::class, 'store'])->name('person.store');
Route::get('admin/person/view/{id}',[PersonController::class, 'view'])->name('person.view');
