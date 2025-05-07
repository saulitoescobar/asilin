<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompanyController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('employees', EmployeeController::class);
Route::resource('companies', CompanyController::class);

Route::delete('companies/{document}/deleteDocument', [CompanyController::class, 'deleteDocument'])->name('companies.deleteDocument');


