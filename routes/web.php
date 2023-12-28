<?php

use App\Http\Controllers\Role\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/dashboard',function(){
    return view('backend.Pages.Dashboard.index');
});

// Role and permission routes
Route::post('/create-role', [RoleController::class,'createRole'])->name('createRole');
Route::post('/create-permission', [RoleController::class,'createPermission'])->name('createPermission');
Route::post('/assign-permission-to-role', [RoleController::class,'assignPermissionToRole'])->name('assignPermissionToRole');
Route::post('/assign-user-to-role', [RoleController::class,'assignUserToRole'])->name('assignUserToRole');
Route::get('/role-index', [RoleController::class,'roleIndex'])->name('roleIndex');
Route::get('/permission-index', [RoleController::class,'permissionIndex'])->name('permissionIndex');
