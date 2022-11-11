<?php

use App\Http\Controllers\AcampTypeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CampController;
use App\Http\Controllers\ForayController;
use App\Http\Controllers\ObservationController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Login Route
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.auth');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'auth.session'])->group(function () {
    //Dashboard Route
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    //People Routes
    Route::get('admin/people', [PersonController::class, 'index'])->name('people.index');
    Route::get('admin/person/create', [PersonController::class, 'create'])->name('person.create');
    Route::post('admin/person/create', [PersonController::class, 'store'])->name('person.store');
    Route::get('admin/person/{id}', [PersonController::class, 'view'])->name('person.view');
    Route::delete('admin/person/{id}', [PersonController::class, 'delete'])->name('person.delete');
    Route::get('admin/person/edit/{id}', [PersonController::class, 'edit'])->name('person.edit');
    Route::put('admin/person/edit/{id}', [PersonController::class, 'update'])->name('person.update');

    //Camp Routes
    Route::get('admin/camp', [CampController::class, 'index'])->name('camp.index');
    Route::get('admin/camp/create', [CampController::class, 'create'])->name('camp.create');
    Route::post('admin/camp/create', [CampController::class, 'store'])->name('camp.store');
    Route::get('admin/camp/view/{id}', [CampController::class, 'view'])->name('camp.view');
    Route::get('admin/camp/edit/{id}', [CampController::class, 'edit'])->name('camp.edit');
    Route::put('admin/camp/edit/{id}', [CampController::class, 'update'])->name('camp.update');
    Route::delete('admin/camp/{id}', [CampController::class, 'delete'])->name('camp.delete');
    Route::delete('admin/camper/{id}', [CampController::class, 'deleteCamper'])->name('camp.delete-camper');
    Route::delete('admin/servant/{id}', [CampController::class, 'deleteServant'])->name('camp.delete-servant');
    Route::post('admin/camper/group', [CampController::class, 'changeGroup'])->name('camper.change-group');
    Route::post('admin/servant/sector', [CampController::class, 'changeSector'])->name('servant.change-sector');
    Route::get('admin/camp/{id}/noCampers', [CampController::class, 'noCampers'])->name('camp.no-campers');
    Route::get('admin/camp/{id}/noServants', [CampController::class, 'noServants'])->name('camp.no-servants');
    Route::post('admin/camp/{id}/noCampers', [CampController::class, 'noCampersSearch'])->name('camp.no-campers-search');
    Route::post('admin/camp/{id}/noServants', [CampController::class, 'noServantsSearch'])->name('camp.no-servants-search');
    Route::post('admin/camp/{id}/addCampers', [CampController::class, 'addCampers'])->name('camp.add-campers');
    Route::post('admin/camp/{id}/addServants', [CampController::class, 'addServants'])->name('camp.add-servants');

    //Camper Routes
    Route::get('admin/campers', [PersonController::class, 'campers'])->name('campers.index');

    //AcampType Routes
    Route::get('admin/camp/types', [AcampTypeController::class, 'index'])->name('acamp-type.index');
    Route::get('admin/camp/types/create', [AcampTypeController::class, 'create'])->name('acamp-type.create');
    Route::post('admin/camp/types/create', [AcampTypeController::class, 'store'])->name('acamp-type.store');
    Route::get('admin/camp/types/view/{id}', [AcampTypeController::class, 'view'])->name('acamp-type.view');
    Route::get('admin/camp/types/edit/{id}', [AcampTypeController::class, 'edit'])->name('acamp-type.edit');
    Route::put('admin/camp/types/edit/{id}', [AcampTypeController::class, 'update'])->name('acamp-type.update');
    Route::delete('admin/camp/types/{id}', [AcampTypeController::class, 'delete'])->name('acamp-type.delete');

    //Forays Routes
    Route::get('admin/forays', [ForayController::class, 'index'])->name('forays.index');
    Route::get('admin/forays/create', [ForayController::class, 'create'])->name('foray.create');
    Route::post('admin/forays/create', [ForayController::class, 'store'])->name('foray.store');
    Route::get('admin/forays/view/{id}', [ForayController::class, 'view'])->name('foray.view');
    Route::get('admin/forays/edit/{id}', [ForayController::class, 'edit'])->name('foray.edit');
    Route::put('admin/forays/edit/{id}', [ForayController::class, 'update'])->name('foray.update');
    Route::delete('admin/forays/{id}', [ForayController::class, 'delete'])->name('foray.delete');

    //Observation Routes
    Route::post('admin/observation/create', [ObservationController::class, 'store'])->name('observation.store');
});


Route::get('/', function () {
    return redirect('/login');
});
