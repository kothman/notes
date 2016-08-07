<?php

use App\Http\Controllers\NotebookController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/', function () {
        return redirect('/notebooks');
    });
    Route::get('/notebooks', 'HomeController@index');

    NotebookController::routes();
    NoteController::routes();    
    UserController::routes();
    AdminController::routes();
});