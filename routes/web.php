<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// lead

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('create/lead', [App\Http\Controllers\LeadController::class, 'createlead']);
Route::get('view/lead', [App\Http\Controllers\LeadController::class, 'viewlead']);
Route::post('lead/insert', [App\Http\Controllers\LeadController::class, 'leadInsert']);
Route::post('link/insert', [App\Http\Controllers\LeadController::class, 'linkInsert']);
Route::post('comment/insert', [App\Http\Controllers\LeadController::class, 'commentInsert']);
Route::post('event/insert', [App\Http\Controllers\LeadController::class, 'eventInsert']);
Route::post('task/insert', [App\Http\Controllers\LeadController::class, 'taskInsert']);
Route::post('lead/update', [App\Http\Controllers\LeadController::class, 'leadUpdate']);
Route::get('lead/file', [App\Http\Controllers\LeadController::class, 'leadFileGet']);
Route::get('lead/update/from', [App\Http\Controllers\LeadController::class, 'leadupdatefrom']);

// client
Route::get('client/show', [App\Http\Controllers\ClientController::class, 'clientShow']);
Route::get('client/view', [App\Http\Controllers\ClientController::class, 'viewClient']);


// contact
Route::get('contact/show', [App\Http\Controllers\ContactController::class, 'contactShow']);



// invoice
Route::get('invoice/show', [App\Http\Controllers\InvoiceController::class, 'invoiceShow']);