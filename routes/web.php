<?php

use App\Http\Controllers\Backend\Products\CategoryController;
use App\Http\Controllers\Role\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckPermission;

use App\Http\Controllers\Backend\Products\ProductController;
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


<<<<<<< HEAD
Route::group(["prefix" => "admin"], function () {
    Route::get('/', function () {
        return view('backend.Pages.Dashboard.index');
    });
    Route::get('/dashboard', function () {
        return view('backend.Pages.Dashboard.index');
=======
Route::group(["prefix"=>"admin"],function(){
    Route::get('/',function(){
        return view('backend.pages.dashboard.index');
    });
    Route::get('/dashboard',function(){
        return view('backend.pages.dashboard.index');
>>>>>>> 4f35d1086fa1028806122cef1378db3d3480efa9
    });
    Route::group(["prefix" => "/ecommerce"], function () {
        Route::get('/', [ProductController::class, "index"])->name("index");
        Route::get('/product-details', [ProductController::class, "show"])->name("show");
        Route::get('/orders', [OrderController::class, "index"])->name("index");
        Route::get('/cart', [ProductController::class, "index"])->name("index");
        Route::get('/checkout', [ProductController::class, "index"])->name("index");
        Route::get('/shops', [ProductController::class, "index"])->name("index");

<<<<<<< HEAD
        Route::group(["prefix" => "/product"], function () {
            Route::get('/product', [ProductController::class, "index"])->name("index");
=======
        Route::group(["prefix"=>"/product"],function(){
            Route::get('/', [ProductController::class, "index"])->name("index");
>>>>>>> 4f35d1086fa1028806122cef1378db3d3480efa9
            Route::get('/create', [ProductController::class, "create"])->name("create");
            Route::get('/create', [ProductController::class, "create"])->name("create");
            Route::get('/edit', [ProductController::class, "edit"])->name("edit");
            Route::post('/store', [ProductController::class, "store"])->name("store");
            Route::post('/update', [ProductController::class, "update"])->name("index");
            Route::post('/delete', [ProductController::class, "distroy"])->name("index");
        });
    });
    Route::prefix('/product')->group(function () {
        /*Category Route*/
        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::post('/category/delete', [CategoryController::class, 'delete'])->name('admin.category.delete');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        // Route::post('/category/update',[CategoryController::class,'update'])->name('admin.category.update');
    });
});



// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

// Role and permission routes
Route::post('/create-role', [RoleController::class, 'createRole'])->name('createRole');
Route::post('/create-permission', [RoleController::class, 'createPermission'])->name('createPermission');
Route::put('/update-permission/{id}', [RoleController::class, 'permissionUpdate'])->name('updatePermission');
Route::get('/delete-permission/{id}', [RoleController::class, 'deletePermission'])->name('permissions.delete');

Route::post('/assign-permission-to-role', [RoleController::class, 'assignPermissionToRole'])->name('assignPermissionToRole');
Route::post('/assign-user-to-role', [RoleController::class, 'assignUserToRole'])->name('assignUserToRole');
Route::get('/role-index', [RoleController::class, 'roleIndex'])->name('roleIndex');
Route::get('/permission-index', [RoleController::class, 'permissionIndex'])->name('permissionIndex');
Route::get('/role-has-permissions/{id}', [RoleController::class, 'hasPermissionsPage'])->name('hasPermissionsPage');

Route::get('/role-has-permissions/{id}', [RoleController::class, 'saveRolePermissions'])->name('saveRolePermissions');

//customers routes
Route::resource('customers', CustomerController::class);

//routes as middleware

Route::middleware(['auth', 'role:super_admin'])->group(function () {
});

Route::middleware(['auth', 'role:seller'])->group(function () {
});


//role and base routes
// Route::get('/admin/dashboard', [YourController::class, 'dashboard'])
//     ->middleware(['auth', 'role:admin']);

// Route::get('/dashboard', [YourController::class, 'dashboard'])
//     ->middleware(['auth', 'permission:view_dashboard']);