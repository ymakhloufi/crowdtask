<?php

Illuminate\Support\Facades\Auth::routes();

Route::get('/', 'HomeController@dashboard');
