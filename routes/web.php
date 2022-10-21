<?php

use App\Http\Controllers\AcampTypeController;
use App\Http\Controllers\ForayController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

//People Routes
Route::get('admin/people', [PersonController::class, 'index'])->name('people.index');
Route::get('admin/person/create', [PersonController::class, 'create'])->name('person.create');
Route::post('admin/person/create',[PersonController::class, 'store'])->name('person.store');
Route::get('admin/person/{id}',[PersonController::class, 'view'])->name('person.view');
Route::delete('admin/person/{id}',[PersonController::class, 'delete'])->name('person.delete');
Route::get('admin/person/edit/{id}',[PersonController::class, 'edit'])->name('person.edit');
Route::put('admin/person/edit/{id}',[PersonController::class, 'update'])->name('person.update');

//AcampType Routes
Route::get('admin/camp/types', [AcampTypeController::class, 'index'])->name('acamp-type.index');
Route::get('admin/camp/types/create', [AcampTypeController::class, 'create'])->name('acamp-type.create');
Route::post('admin/camp/types/create', [AcampTypeController::class, 'store'])->name('acamp-type.store');
Route::get('admin/camp/types/view/{id}', [AcampTypeController::class, 'view'])->name('acamp-type.view');
Route::get('admin/camp/types/edit/{id}', [AcampTypeController::class, 'edit'])->name('acamp-type.edit');
Route::put('admin/camp/types/edit/{id}',[AcampTypeController::class, 'update'])->name('acamp-type.update');
Route::delete('admin/camp/types/{id}', [AcampTypeController::class, 'delete'])->name('acamp-type.delete');

//Forays Routes
Route::get('admin/forays', [ForayController::class, 'index'])->name('forays.index');
Route::get('admin/forays/create', [ForayController::class, 'create'])->name('foray.create');
Route::post('admin/forays/create', [ForayController::class, 'store'])->name('foray.store');
Route::get('admin/forays/view/{id}', [ForayController::class, 'view'])->name('foray.view');
Route::get('admin/forays/edit/{id}', [ForayController::class, 'edit'])->name('foray.edit');
Route::put('admin/forays/edit/{id}', [ForayController::class, 'update'])->name('foray.update');
Route::delete('admin/forays/{id}', [ForayController::class, 'delete'])->name('foray.delete');
