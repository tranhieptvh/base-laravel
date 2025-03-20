<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $message = "Testing debugger!"; // Set breakpoint here
    $data = [
        'name' => 'Test User',
        'time' => now()
    ];
    
    return view('welcome', ['message' => $message, 'data' => $data]);
});