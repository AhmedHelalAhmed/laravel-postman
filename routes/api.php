<?php

use App\Http\Controllers\API\Repository\IndexingRepositoryController;
use App\Http\Controllers\API\Repository\SyncRepositoryController;
use App\Http\Controllers\API\Token\GeneratingTokenController;
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
Route::group(['prefix'=>'users'],function(){
    Route::post('generate-tokens',[GeneratingTokenController::class,'__invoke'])
        ->name('users.generate-tokens');
});


Route::group(['prefix'=>'github','middleware'=>'auth:sanctum'],function(){

    Route::get('repositories',[IndexingRepositoryController::class,'__invoke'])
        ->name('github.repositories.index');

    Route::get('sync-repositories',[SyncRepositoryController::class,'__invoke'])
        ->name('github.repositories.sync');
});
