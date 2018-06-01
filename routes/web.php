<?php

Illuminate\Support\Facades\Auth::routes();

Route::get('/', 'HomeController@dashboard');
Route::get('/users/{user}', '\Yama\User\UserController@show');
