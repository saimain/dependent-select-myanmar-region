<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {

    $regions = Http::get('http://myancity.devsm.net/api/regions')->json();

    return view('welcome', compact('regions'));
});
