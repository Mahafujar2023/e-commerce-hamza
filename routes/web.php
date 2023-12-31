<?php

use App\Http\Controllers\Backend\Products\CategoryController;
use App\Http\Controllers\Role\RoleController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\CustomerController;


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

Route::group(["prefix"=>"admin"],function(){
    Route::get('/',function(){
        return view('backend.Pages.Dashboard.index');
    });
    Route::get('/dashboard',function(){
        return view('backend.Pages.Dashboard.index');
    });
    Route::group(["prefix"=>"/ecommerce"],function(){
        Route::get('/', [ProductController::class, "index"])->name("index");
        Route::get('/product-details', [ProductController::class, "show"])->name("show");
        Route::get('/orders', [OrderController::class, "index"])->name("index");
        Route::get('/customers', [CustomerController::class, "index"])->name("index");
        Route::get('/cart', [ProductController::class, "index"])->name("index");
        Route::get('/checkout', [ProductController::class, "index"])->name("index");
        Route::get('/shops', [ProductController::class, "index"])->name("index");

        Route::group(["prefix"=>"/product"],function(){
            Route::get('/product', [ProductController::class, "index"])->name("index");
            Route::get('/create', [ProductController::class, "create"])->name("create");
            Route::get('/create', [ProductController::class, "create"])->name("create");
            Route::get('/edit', [ProductController::class, "edit"])->name("edit");
            Route::post('/store', [ProductController::class, "store"])->name("store");
            Route::post('/update', [ProductController::class, "update"])->name("index");
            Route::post('/delete', [ProductController::class, "distroy"])->name("index");
        });
    });
});
Route::get("admin/category/index",[CategoryController::class,"index"]);

// Role and permission routes
Route::post('/create-role', [RoleController::class,'createRole'])->name('createRole');
Route::post('/create-permission', [RoleController::class,'createPermission'])->name('createPermission');
Route::post('/assign-permission-to-role', [RoleController::class,'assignPermissionToRole'])->name('assignPermissionToRole');
Route::post('/assign-user-to-role', [RoleController::class,'assignUserToRole'])->name('assignUserToRole');
Route::get('/role-index', [RoleController::class,'roleIndex'])->name('roleIndex');
Route::get('/permission-index', [RoleController::class,'permissionIndex'])->name('permissionIndex');
