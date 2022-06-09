<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTController;
use App\Http\Controllers\UserController;




Route::group(['middleware' => 'api'], function($router) {


    Route::post('/register', [JWTController::class, 'register']);
    Route::post('/login', [JWTController::class, 'login']);
    Route::post('/logout', [JWTController::class, 'logout']);
    Route::post('/refresh', [JWTController::class, 'refresh']);
    Route::post('/profile', [JWTController::class, 'profile']);

    Route::get('/available_users', [UserController::class, 'availableUsers']);

    Route::post('/create_expense', [UserController::class, 'createExpense']);

    Route::get('/list_expenses_created_by_user', [UserController::class, 'userExpensesList']);
    
    Route::post('/split_expenses_to_borrowers', [UserController::class, 'splitExpenses']);

    Route::get('/user_due_sheet', [UserController::class, 'userDueSheet']);

    Route::get('/user_paid_sheet', [UserController::class, 'userPaidSheet']);

    Route::post('/check_balance_respective_to_user', [UserController::class, 'checkBalanceRespectiveToUser']);


});