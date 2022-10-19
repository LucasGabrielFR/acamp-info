<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/people', [PersonController::class, 'index'])->name('people.index');
Route::get('admin/person/create', [PersonController::class, 'create'])->name('person.create');
Route::post('admin/person/create',[PersonController::class, 'store'])->name('person.store');
Route::get('admin/person/{id}',[PersonController::class, 'view'])->name('person.view');
Route::delete('admin/person/{id}',[PersonController::class, 'delete'])->name('person.delete');
Route::get('admin/person/edit/{id}',[PersonController::class, 'edit'])->name('person.edit');
Route::put('admin/person/edit/{id}',[PersonController::class, 'update'])->name('person.update');
