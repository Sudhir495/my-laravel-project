<?php

   use App\Http\Controllers\CompanyController;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Route;

   Route::middleware('auth:sanctum')->group(function () {
       Route::get('/user', function (Request $request) {
           return $request->user();
       });

       Route::apiResource('companies', CompanyController::class)->except(['show']);
       Route::post('companies/{company}/set-active', [CompanyController::class, 'setActive']);
   });