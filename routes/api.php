<?php

use App\Domain\Controllers\V1\AuthController;
use App\Domain\Controllers\V1\CompanyController;
use App\Domain\Controllers\V1\EmployeeController;
use App\Domain\Controllers\V1\LetterController;
use App\Domain\Controllers\V1\StatisticsController;
use App\Domain\Controllers\V1\SubscriptionController;
use App\Domain\Controllers\V1\TestController;
use App\Domain\Controllers\V1\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('/user', UserController::class);
    Route::get('/available-roles', [UserController::class, 'getAvailableRoles']);

    Route::get('company/statistics', [CompanyController::class, 'statistics']);
    Route::apiResource('/company', CompanyController::class);

    Route::get('letter/statistics', [LetterController::class, 'statistics']);
    Route::get('letter/total', [LetterController::class, 'total']);
    Route::apiResource('/letter', LetterController::class);

    Route::group(['controller' => EmployeeController::class], function () {
        Route::get('emails', 'emails');
        Route::post('employee/{employee}', 'upload');
        Route::post('employee/import', 'import');
        Route::patch('employees', 'bulkDestroy');
        Route::put('employees', 'bulkUpdate');
        Route::get('employee/media', 'getMedia');
        Route::delete('employee/media/{media}', 'deleteMedia');
        Route::get('/statuses', 'statuses');
        Route::get('/races', 'races');
    });

    Route::apiResource('/employee', EmployeeController::class);
    Route::apiResource('/test', TestController::class);
    Route::apiResource('/subscription', SubscriptionController::class);
    Route::get('/statistics/daily', [StatisticsController::class, 'daily']);
    Route::get('/statistics/total', [StatisticsController::class, 'total']);
    Route::get('/statistics/today', [StatisticsController::class, 'today']);

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::fallback(function () {
    return response(['message' => 'Page does not exist'], JsonResponse::HTTP_NOT_FOUND);
});
