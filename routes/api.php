<?php

use App\Http\Controllers\Api\SaleApiController;
use Illuminate\Support\Facades\Route;

Route::get('/sales/{code_sale}',[SaleApiController::class,'show']);
