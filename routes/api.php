<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\ResetPasswordController;

//---------------------------------------------------------------//
use App\Http\Controllers\Api\Category_eventController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\GroupUserController;
use App\Http\Controllers\Api\MessagesController;
use App\Http\Controllers\Api\PromoterController;
//---------------------------------------------------------------//

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ForgotPasswordController;

Route::post('forget-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forget.password.post');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');



//--------------------------Event----------------------------------//
Route::get('user', [UserController::class, 'allUsers']);
Route::post('user/', [UserController::class, 'store']);
Route::put('user/update/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'destroy']);
Route::post('user/{id}', [UserController::class, 'update']);
Route::post('user/update/{id}', [UserController::class, 'update']);
//---------------------------------------------------------------//


//--------------------------Event----------------------------------//
Route::get('event', [EventController::class, 'index']);
Route::post('event/', [EventController::class, 'store']);
Route::put('event/update/{id}', [EventController::class, 'update']);
Route::delete('event/{id}', [EventController::class, 'destroy']);
Route::post('event/{id}', [EventController::class, 'update']);
Route::post('event/update/{id}', [EventController::class, 'update']);
//---------------------------------------------------------------//

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('roles', RoleController::class);
    //Route::apiResource('exercises', ExerciseController::class);
    Route::post('exercises/', [ExerciseController::class, 'store']); //Guardar
    Route::get('exercises', [ExerciseController::class, 'index']); //Listar
    Route::get('exercises/{exercise}', [ExerciseController::class, 'show']); //Mostrar
    Route::post('exercises/update/{id}', [ExerciseController::class, 'update']); //Editar

    Route::get('role-list', [RoleController::class, 'getList']);
    Route::get('role-permissions/{id}', [PermissionController::class, 'getRolePermissions']);
    Route::put('/role-permissions', [PermissionController::class, 'updateRolePermissions']);
    Route::apiResource('permissions', PermissionController::class);
    Route::get('category-list', [CategoryController::class, 'getList']);
    Route::get('/user', [ProfileController::class, 'user']);
    Route::put('/user', [ProfileController::class, 'update']);

    Route::get('abilities', function (Request $request) {
        return $request->user()->roles()->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
    });
});


Route::get('category-list', [CategoryController::class, 'getList']);
Route::get('get-posts', [PostController::class, 'getPosts']);
Route::get('get-category-posts/{id}', [PostController::class, 'getCategoryByPosts']);
Route::get('get-post/{id}', [PostController::class, 'getPost']);
