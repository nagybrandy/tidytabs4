<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::get('/expenses', [ExpenseController::class, 'index']); // List all items
Route::get('/expenses/{id}', [ExpenseController::class, 'show']); // Get a single item
Route::post('/expenses', [ExpenseController::class, 'store']); // Create a new item
Route::put('/expenses/{id}', [ExpenseController::class, 'update']); // Update an item
Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']); // Delete an item
