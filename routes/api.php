<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/all-invoices', [InvoiceController::class, 'invoices']);
Route::get('/search-invoice', [InvoiceController::class, 'searchInvoice']);
Route::get('/create-invoice', [InvoiceController::class, 'createInvoice']);
Route::get('/customers', [CustomerController::class, 'customers']);
Route::get('/products', [ProductController::class, 'products']);
