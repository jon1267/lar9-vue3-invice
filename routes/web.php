<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/invoices', [InvoiceController::class, 'invoices']);

Route::get('/{pathMatch}', function () {
    return view('welcome');
})->where('pathMatch', ".*");
