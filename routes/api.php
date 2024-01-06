<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PeopleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('people')->group(function () {
    Route::get('/',  [PeopleController::class, 'getAllPeoples']);
    Route::post('/',  [PeopleController::class, 'registerPeople']);
    Route::put('/{people}',  [PeopleController::class, 'editPeople']);
    Route::delete('/{people}',  [PeopleController::class, 'deletePeople']);
});

Route::prefix('contact')->group(function () {
    Route::delete('/{id}',  [ContactController::class, 'deleteContact']);
});
