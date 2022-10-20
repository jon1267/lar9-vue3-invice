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
Route::post('/save-invoice', [InvoiceController::class, 'saveInvoice']);
Route::get('/show-invoice/{id}', [InvoiceController::class, 'showInvoice']);
Route::get('/edit-invoice/{id}', [InvoiceController::class, 'editInvoice']);
Route::delete('/delete-invoice-items/{id}', [InvoiceController::class, 'deleteInvoiceItems']);
Route::post('/update-invoice/{id}', [InvoiceController::class, 'updateInvoice']);
