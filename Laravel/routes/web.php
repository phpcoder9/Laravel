<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
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

Route::get('/',[AuthController::class,'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/auth-store',[AuthController::class,'authStore'])->name('auth.store');
Route::get('/forgot-password',[ForgotPasswordController::class,'index'])->name('forgot-password');

Route::group(['middleware'=>'auth'],function (){
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
});

Route::get('/password',function (){
    return Hash::make('12345678');
});

Route::get('/store-role',function(Request $request){
    Role::create(['name'=>'writer']);
    return "true";
});


Route::get('/store-permission',function(Request $request){
    Permission::create(['name'=>'read']);
    return "true";
});

Route::get('/assign-permission',function(){
    $role = Role::find(1);
    $permission = Permission::find(1);
    $role->givePermissionTo($permission);
    // $permission->assignRole($role); this code also works
    return true;
});

Route::get('/remove-permission',function(){
    $role = Role::find(1);
    $permission = Permission::find(1);
    $role->revokePermissionTo($permission);  
    //$permission->removeRole($role);  this code also work
    return true;
});


Route::get('/update-permission',function(){
    $role = Role::find(1);
    $permission = Permission::find(1);
    $role->syncPermissions($permission);   
    // $permission->syncRoles($roles); this code also works
    return true;
});
