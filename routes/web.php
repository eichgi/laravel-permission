<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create-role', function () {
    Role::create(['name' => 'admin']);
});

Route::get('/create-permission', function () {
    Permission::create(['name' => 'universal']);
});

Route::get('/assign-role-to-user', function () {
    $user = User::find(1);
    $user->assignRole('admin');
});

Route::get('assign-permission-to-user', function () {
    $user = User::find(2);
    $user->givePermissionTo('universal');
});

Route::get('/assign-permission-to-role', function () {
    $role = Role::find(1);
    $role->givePermissionTo('universal');
});

Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/admin', function () {
        dd('Eres administrador');
    });

});