<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'v1'], function()
{
    Route::resource('ibima','IbimaController',[
        'except'=>['create','edit']
    ]);

    Route::post('/user/register',[
        'uses'=>'AuthController@store'
    ]);

    Route::post('user/signin',[
        'uses'=>'AuthController@signin'
    ]);
});

