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
use App\Http\Controllers\ArchivoController;
//---------------------------------------------------------------//

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ForgotPasswordController;


//---------------------------------------------------------------//
Route::post('/upload', [ArchivoController::class, 'subirArchivo'])->name('upload');
//--------------------------------------------------------------//

Route::post('forget-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forget.password.post');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');



//--------------------------CategoryEvent---------------------------------//
Route::get('category_event-list', [Category_eventController::class, 'getList']);
//Route::get('category/filtros', [Category_eventController::class, 'filtros']);
Route::apiResource('category', Category_eventController::class);
Route::post('category/', [Category_eventController::class, 'store']);
Route::put('category/update/{id}', [Category_eventController::class, 'update']);
Route::delete('category/{id}', [Category_eventController::class, 'destroy']);
Route::post('category/{id}', [Category_eventController::class, 'update']);
Route::post('category/update/{id}', [Category_eventController::class, 'update']);
//---------------------------------------------------------------//


//--------------------------Event----------------------------------//
Route::get('events', [EventController::class, 'index']);
Route::get('events/promoter/{id}', [EventController::class, 'promoterEvents']);
Route::post('events/', [EventController::class, 'store']);
Route::put('events/update/{id}', [EventController::class, 'update']);
Route::delete('events/{id}', [EventController::class, 'destroy']);
Route::get('events/show/{id}', [EventController::class, 'show']);
//---------------------------------------------------------------//


//--------------------------Group----------------------------------//
Route::get('group', [GroupController::class, 'index']);
Route::post('group/', [GroupController::class, 'store']);
Route::put('group/update/{id}', [GroupController::class, 'update']);
Route::delete('group/{id}', [GroupController::class, 'destroy']);
Route::post('group/{id}', [GroupController::class, 'update']);
Route::post('group/update/{id}', [GroupController::class, 'update']);
//---------------------------------------------------------------//


//--------------------------GroupUser----------------------------//
Route::get('groupuser', [GroupUserController::class, 'index']);
Route::post('groupuser/', [GroupUserController::class, 'store']);
Route::put('groupuser/update/{id}', [GroupUserController::class, 'update']);
Route::delete('groupuser/{id}', [GroupUserController::class, 'destroy']);
Route::post('groupuser/{id}', [GroupUserController::class, 'update']);
Route::post('groupuser/update/{id}', [GroupUserController::class, 'update']);
//---------------------------------------------------------------//


//--------------------------Messages-----------------------------//
Route::get('message', [MessagesController::class, 'index']);
Route::post('message/', [MessagesController::class, 'store']);
Route::put('message/update/{id}', [MessagesController::class, 'update']);
Route::delete('message/{id}', [MessagesController::class, 'destroy']);
Route::post('message/{id}', [MessagesController::class, 'update']);
Route::post('message/update/{id}', [MessagesController::class, 'update']);
//---------------------------------------------------------------//




Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('posts', PostController::class);
    //Route::apiResource('categories', CategoryController::class);
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
    //Route::get('category-list', [CategoryController::class, 'getList']);
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


//Route::get('category-list', [CategoryController::class, 'getList']);
Route::get('get-posts', [PostController::class, 'getPosts']);
Route::get('get-category-posts/{id}', [PostController::class, 'getCategoryByPosts']);
Route::get('get-post/{id}', [PostController::class, 'getPost']);
