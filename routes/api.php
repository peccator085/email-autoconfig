<?php

use App\Http\Controllers\ExchangeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;


Route::post("/autodiscover/autodiscover.xml", 'ExchangeController');
Route::post("/Autodiscover/Autodiscover.xml", 'ExchangeController');
