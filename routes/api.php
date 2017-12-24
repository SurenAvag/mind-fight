<?php

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

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {

    Route::post('login', 'AuthController@login');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('me', 'AuthController@me');
        Route::post('logout', 'AuthController@logout');

        Route::resource('question', 'QuestionController', ['except' => ['create', 'edit']]);
        Route::resource('answer', 'AnswerController', ['except' => ['index', 'create', 'edit']]);
        Route::resource('user', 'UserController', ['except' => ['create', 'edit']]);
    });
});
