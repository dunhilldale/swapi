<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // or a blade that mounts the Vue app
});

Route::get('/people', function () {
    return view('people'); // create resources/views/people.blade.php that mounts PeopleList Vue component
});
