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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', 'Auth\LoginController@login')->middleware('guest')->name('login')  ;

Auth::routes();

Route::get('/invitations/confirm' , 'AcceptInvitationController@showAcceptForm')->name('invitations.show') ;
Route::post('/invitations/confirm' , 'AcceptInvitationController@accept')->name('invitations.confirm') ;

Route::get('/' , 'Auth\LoginController@showLoginForm')->middleware('guest') ;


Route::get('/home', 'Admin\DashboardController@index')->name('home');
Route::group(['namespace' => 'Admin', 'middleware' => ['auth','role.admin'] ] , function(){

    /* Users*/
    Route::get('/manage/admins' , 'AdminController@allAdmins');
    Route::get('/manage/staffs' , 'StaffsController@allStaffs')->name('admin.manage.staffs') ;
    Route::post('/manage/staffs' , 'StaffsController@createStaff');
    Route::post('/manage/admins' , 'AdminController@createAdmin');
    Route::get('manage/staffs/{id}' , 'StaffsController@editStaff');
    Route::get('manage/admins/{id}' , 'AdminController@editAdmin');

    Route::get('manage/tasks' , 'TasksController@index')->name('admin.manage.tasks.list') ;
    Route::post('tasks' , 'TasksController@store')->name('admin.manage.tasks.store');
    Route::get('tasks/{id}' , 'TasksController@show')->name('admin.manage.tasks.show');
    Route::delete('tasks' , 'TasksController@index')->name('admin.manage.tasks.delete');
});

Route::group(['namespace' => 'Staff', 'prefix' => 'staff',   'middleware' => ['auth','role.staff'] ] , function(){
    Route::get('tasks' , 'TasksController@index');
    Route::post('tasks' , 'TasksController@store');
    Route::get('tasks/{id}' , 'TasksController@show');
    Route::get('tasks' , 'TasksController@index');
});


Route::get('/logout' , 'Auth\LoginController@logout')->middleware('auth') ;
