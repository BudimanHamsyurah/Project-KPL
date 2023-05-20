<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartureController;
use App\Http\Controllers\UserArrivalController;
use App\Http\Controllers\UserDepartureController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [UserArrivalController::class, 'index']);
Route::get('/usrArrival', [UserArrivalController::class, 'index'])->name('usrArrival');
Route::get('/usrDeparture', [UserDepartureController::class, 'index'])->name('usrDeparture');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/Departure', [App\Http\Controllers\DepartureController::class, 'index'])->name('Departure');
Route::post('addShip', [HomeController::class, 'addKapal'])->name('addShip');
Route::post('addArrival', [HomeController::class, 'add_arrival'])->name('addArrival');
Route::put('/editArrival/{id}', [HomeController::class, 'edit_arrival'])->name('editArrival');
Route::put('/processArrival/{id}', [HomeController::class, 'process_arrival'])->name('processArrival');
Route::put('/finishArrival/{id}', [HomeController::class, 'finish_arrival'])->name('finishArrival');
Route::delete('/deleteArrival/{id}', [HomeController::class, 'destroy'])->name('deleteArrival');
Route::post('addDeparture', [DepartureController::class, 'add_departure'])->name('addDeparture');
Route::put('/editDeparture/{id}', [DepartureController::class, 'edit_departure'])->name('editDeparture');
Route::put('/processDeparture/{id}', [DepartureController::class, 'process_departure'])->name('processDeparture');
Route::put('/finishDeparture/{id}', [DepartureController::class, 'finish_departure'])->name('finishDeparture');
Route::delete('/deleteDeparture/{id}', [DepartureController::class, 'destroy'])->name('deleteDeparture');
