<?php

use App\Http\Controllers\Backend\Products\CategoryController;
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
})->name('admin.dashboard');

Route::prefix('admin/product')->group(function(){
    /*Category Route*/
 Route::get('/category',[CategoryController::class,'index'])->name('admin.category.index');
 Route::post('/category/store',[CategoryController::class,'store'])->name('admin.category.store');
 Route::post('/category/delete',[CategoryController::class,'delete'])->name('admin.category.delete');
 Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit');
// Route::post('/category/update',[CategoryController::class,'update'])->name('admin.category.update');
});
// Role and permission routes
Route::post('/create-role', [RoleController::class,'createRole'])->name('createRole');
Route::post('/create-permission', [RoleController::class,'createPermission'])->name('createPermission');
Route::post('/assign-permission-to-role', [RoleController::class,'assignPermissionToRole'])->name('assignPermissionToRole');
Route::post('/assign-user-to-role', [RoleController::class,'assignUserToRole'])->name('assignUserToRole');
Route::get('/role-index', [RoleController::class,'roleIndex'])->name('roleIndex');
Route::get('/permission-index', [RoleController::class,'permissionIndex'])->name('permissionIndex');
