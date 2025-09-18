<?php

   use App\Http\Controllers\CompanyController;
   use Illuminate\Support\Facades\Route;

   
   Route::get('/', function () {
       return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
   });

   Route::middleware(['auth'])->group(function () {
       Route::get('/dashboard', function () {
           return view('dashboard');
       })->name('dashboard');

       Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
       Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
       Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
       Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
       Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update');
       Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');
       Route::post('/companies/{company}/set-active', [CompanyController::class, 'setActive'])->name('companies.set-active');
   });

   require __DIR__.'/auth.php';
