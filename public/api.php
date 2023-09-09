<?php

use App\Domain\Controllers\V1\AuthController;
use App\Domain\Controllers\V1\CompanyController;
use App\Domain\Controllers\V1\EmployeeController;
use App\Domain\Controllers\V1\LetterController;
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
        Route::post('employee/{employee}', 'upload');
        Route::post('employee/import', 'import');
        Route::patch('employees', 'bulkDestroy');
        Route::put('employees', 'bulkUpdate');
        Route::get('employee/media', 'getMedia');
        Route::delete('employee/media/{media}', 'deleteMedia');
        Route::get('/statuses', 'statuses');
        Route::get('/races', 'races');
        Route::get('/emails', 'emails');
    });

    Route::apiResource('/employee', EmployeeController::class);
    Route::apiResource('/test', TestController::class);
    Route::apiResource('/subscription', SubscriptionController::class);

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::fallback(function () {
    return response(['message' => 'Page does not exist'], JsonResponse::HTTP_NOT_FOUND);
});
