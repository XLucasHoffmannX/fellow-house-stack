<?php

use Illuminate\Support\Facades\Route;

Route::get('/api', function(){
    return response()->json((object)["msg" => 'teste']);
});

Route::get('/', function () {
    return view('welcome');
});