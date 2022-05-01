<?php

use App\Http\Controllers\DeleteUserController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\CreateWorkEntryController;
use App\Http\Controllers\DeleteWorkEntryController;
use App\Http\Controllers\GetAllUsersController;
use App\Http\Controllers\GetUserByIdController;
use App\Http\Controllers\GetWorkEntriesByUserIdController;
use App\Http\Controllers\GetWorkEntryByIdController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\UpdateWorkEntryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//User
Route::get('/user/all', GetAllUsersController::class);
Route::get('/user/{id}', GetUserByIdController::class);
Route::put('/user/{id}', UpdateUserController::class);
Route::post('/user/create', CreateUserController::class);
Route::delete('/user/{id}', DeleteUserController::class);

//WorkEntry
Route::get('/workentry/user/{user_id}', GetWorkEntriesByUserIdController::class);
Route::get('/workentry/{id}', GetWorkEntryByIdController::class);
Route::put('/workentry/{id}', UpdateWorkEntryController::class);
Route::post('/workentry/create', CreateWorkEntryController::class);
Route::delete('/workentry/{id}', DeleteWorkEntryController::class);
