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
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('isAdmin');

    //People Routes
    Route::get('admin/people', [PersonController::class, 'index'])->name('people.index')->middleware('isAdmin');
    Route::get('admin/person/create', [PersonController::class, 'create'])->name('person.create')->middleware('isAdmin');
    Route::post('admin/person/create', [PersonController::class, 'store'])->name('person.store')->middleware('isAdmin');
    Route::get('admin/person/{id}', [PersonController::class, 'view'])->name('person.view')->middleware('isAdmin');
    Route::delete('admin/person/{id}', [PersonController::class, 'delete'])->name('person.delete')->middleware('isAdmin');
    Route::get('admin/person/edit/{id}', [PersonController::class, 'edit'])->name('person.edit')->middleware('isAdmin');
    Route::put('admin/person/edit/{id}', [PersonController::class, 'update'])->name('person.update')->middleware('isAdmin');
    Route::get('person', [PersonController::class, 'personal'])->name('personal');
    Route::get('person/edit', [PersonController::class, 'personalEdit'])->name('personal.edit');
    Route::put('person/edit/{id}', [PersonController::class, 'personalUpdate'])->name('personal.update');


    //Camp Routes
    Route::get('admin/camp', [CampController::class, 'index'])->name('camp.index')->middleware('isAdmin');
    Route::get('admin/camp/create', [CampController::class, 'create'])->name('camp.create')->middleware('isAdmin');
    Route::post('admin/camp/create', [CampController::class, 'store'])->name('camp.store')->middleware('isAdmin');
    Route::get('admin/camp/view/{id}', [CampController::class, 'view'])->name('camp.view')->middleware('isAdmin');
    Route::get('admin/camp/edit/{id}', [CampController::class, 'edit'])->name('camp.edit')->middleware('isAdmin');
    Route::put('admin/camp/edit/{id}', [CampController::class, 'update'])->name('camp.update')->middleware('isAdmin');
    Route::delete('admin/camp/{id}', [CampController::class, 'delete'])->name('camp.delete')->middleware('isAdmin');
    Route::delete('admin/camper/{id}', [CampController::class, 'deleteCamper'])->name('camp.delete-camper')->middleware('isAdmin');
    Route::delete('admin/servant/{id}', [CampController::class, 'deleteServant'])->name('camp.delete-servant')->middleware('isAdmin');
    Route::post('admin/camper/group', [CampController::class, 'changeGroup'])->name('camper.change-group')->middleware('isAdmin');
    Route::post('admin/servant/sector', [CampController::class, 'changeSector'])->name('servant.change-sector')->middleware('isAdmin');
    Route::post('admin/servant/hierarchy', [CampController::class, 'changeHierarchy'])->name('servant.change-hierarchy')->middleware('isAdmin');
    Route::get('admin/camp/{id}/noCampers', [CampController::class, 'noCampers'])->name('camp.no-campers')->middleware('isAdmin');
    Route::get('admin/camp/{id}/noServants', [CampController::class, 'noServants'])->name('camp.no-servants');
    Route::post('admin/camp/{id}/noCampers', [CampController::class, 'noCampersSearch'])->name('camp.no-campers-search')->middleware('isAdmin');
    Route::post('admin/camp/{id}/noServants', [CampController::class, 'noServantsSearch'])->name('camp.no-servants-search')->middleware('isAdmin');
    Route::post('admin/camp/{id}/addCampers', [CampController::class, 'addCampers'])->name('camp.add-campers')->middleware('isAdmin');
    Route::post('admin/camp/addCamper', [CampController::class, 'addCamper'])->name('camp.add-camper');
    Route::post('admin/camp/addServe', [CampController::class, 'addServe'])->name('camp.add-serve');
    Route::post('admin/camp/updateServe', [CampController::class, 'updateServe'])->name('camp.update-serve')->middleware('isAdmin');
    Route::post('admin/camp/getServant', [CampController::class, 'getServant'])->name('camp.get-servant')->middleware('isAdmin');
    Route::post('admin/camp/getCamper', [CampController::class, 'getCamper'])->name('camp.get-camper')->middleware('isAdmin');
    Route::post('admin/camp/updateCamper', [CampController::class, 'updateCamper'])->name('camp.update-camper')->middleware('isAdmin');
    Route::post('admin/camp/{id}/addServants', [CampController::class, 'addServants'])->name('camp.add-servants')->middleware('isAdmin');

    //Camper Routes
    Route::get('admin/campers', [PersonController::class, 'campers'])->name('campers.index')->middleware('isAdmin');

    //AcampType Routes
    Route::get('admin/camp/types', [AcampTypeController::class, 'index'])->name('acamp-type.index')->middleware('isAdmin');
    Route::get('admin/camp/types/create', [AcampTypeController::class, 'create'])->name('acamp-type.create')->middleware('isAdmin');
    Route::post('admin/camp/types/create', [AcampTypeController::class, 'store'])->name('acamp-type.store')->middleware('isAdmin');
    Route::get('admin/camp/types/view/{id}', [AcampTypeController::class, 'view'])->name('acamp-type.view')->middleware('isAdmin');
    Route::get('admin/camp/types/edit/{id}', [AcampTypeController::class, 'edit'])->name('acamp-type.edit')->middleware('isAdmin');
    Route::put('admin/camp/types/edit/{id}', [AcampTypeController::class, 'update'])->name('acamp-type.update')->middleware('isAdmin');
    Route::delete('admin/camp/types/{id}', [AcampTypeController::class, 'delete'])->name('acamp-type.delete')->middleware('isAdmin');

    //Forays Routes
    Route::get('admin/forays', [ForayController::class, 'index'])->name('forays.index')->middleware('isAdmin');
    Route::get('admin/forays/create', [ForayController::class, 'create'])->name('foray.create')->middleware('isAdmin');
    Route::post('admin/forays/create', [ForayController::class, 'store'])->name('foray.store')->middleware('isAdmin');
    Route::get('admin/forays/view/{id}', [ForayController::class, 'view'])->name('foray.view')->middleware('isAdmin');
    Route::get('admin/forays/edit/{id}', [ForayController::class, 'edit'])->name('foray.edit')->middleware('isAdmin');
    Route::put('admin/forays/edit/{id}', [ForayController::class, 'update'])->name('foray.update')->middleware('isAdmin');
    Route::delete('admin/forays/{id}', [ForayController::class, 'delete'])->name('foray.delete')->middleware('isAdmin');

    //Observation Routes
    Route::post('admin/observation/create', [ObservationController::class, 'store'])->name('observation.store')->middleware('isAdmin');

    //User Routes
    Route::post('user/authorize', [UserController::class, 'authorizeData'])->name('user.authorize');
});

Route::get('online/form', [PersonController::class, 'online'])->name('people.online');
Route::get('/', function () {
    return redirect('/login');
});
