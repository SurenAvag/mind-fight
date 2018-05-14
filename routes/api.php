<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {

    Route::post('login', 'AuthController@login');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('me', 'AuthController@me');
        Route::post('logout', 'AuthController@logout');

        Route::resource('question', 'QuestionController', ['except' => ['create', 'edit']]);
        Route::resource('answer', 'AnswerController', ['except' => ['index', 'create', 'edit']]);
        Route::resource('user', 'UserController', ['except' => ['create', 'edit']]);
        Route::resource('subject', 'SubjectController', ['except' => ['create', 'edit']]);

        Route::get('game', 'GameController@getGame');
        Route::get('game/{game}', 'GameController@getGameById');
        Route::post('game/{game}/end', 'GameController@endGame');
        Route::post('game/{game}/join', 'GameController@joinToGame');

        Route::get('get-key-words-graph', 'GraphController@getKeyWordsGraph');
    });
});
