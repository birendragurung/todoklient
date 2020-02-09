<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('authenticate' , ['uses' => 'Auth\ApiLoginController@authenticate']);

Route::get('/users', ['uses' => 'UserController@index', 'middleware' => 'auth:api']);

Route::group(['namespace' => 'Task', 'prefix' => '', 'middleware' => 'auth:api'] , function(){
    Route::get('tasks' ,['uses' => 'TasksController@index']);
    Route::get('tasks/todo', ['uses' => 'TasksController@todoList' ] );
    Route::get('tasks/{id}' ,['uses' => 'TasksController@show']);
    Route::post('tasks' , ['uses' => 'TasksController@store', 'middleware' => 'role.admin']);
    Route::put('tasks/{id}' , ['uses' => 'TasksController@update']);
    Route::patch('tasks/{id}/status' , ['uses' => 'TasksController@updateStatus']);
    Route::patch('tasks/{id}/assignee' , ['uses' => 'TasksController@updateAssignee', 'middleware' => 'role.admin' ]);
    Route::delete('tasks/{id}', ['uses' => 'TasksController@delete', 'middleware' => 'role.admin' ]);
});
Route::group(['namespace' => 'TaskHistory', 'middleware' => 'auth:api'  ] , function(){
    Route::get('/tasks/{id}/history' , ['uses' => 'TaskHistoryController@index']);
});
Route::post('/manage/invite', ['uses' => 'Invitation\InvitationController@invite' , 'middleware' => 'auth:api' ]);
Route::get('/staff/invitations/confirm/{token}' , ['uses' => 'Staff\StaffsController@setPassword'])->name('staffs.invitations.confirm') ;

Route::group(['namespace'  => 'Staff' ,'prefix'     => 'admin/manage-staffs' ,'middleware' => ['auth:api']] , function(){
    Route::get('/' ,['uses' => 'StaffsController@index' ]);
    Route::get('/{id}' ,['uses' => 'StaffsController@show' ]);
    Route::post('/new' ,['uses' => 'StaffsController@store' , 'middleware' => 'role.admin']);
    Route::put('/{id}' ,['uses' => 'StaffsController@update' ]);
    Route::delete('/{id}' ,['uses' => 'StaffsController@delete' , 'middleware' => 'role.admin']);
});

Route::group(['namespace'  => 'Admin' ,'prefix'     => 'admin/manage-admins' ,'middleware' => ['auth:api', 'role.admin']] , function(){
    Route::get('/' ,['uses' => 'AdminsController@index' ]);
    Route::post('/new' ,['uses' => 'AdminsController@store' ]);
    Route::put('/{id}' ,['uses' => 'AdminsController@update' ]);
    Route::delete('/{id}' ,['uses' => 'AdminsController@delete' ]);
});

Route::group(['namespace' => 'Notification' , 'prefix' => 'notifications' , 'middleware' => 'auth:api' ], function(){
    Route::get('/' , ['uses' => 'NotificationsController@index' ]);
    Route::patch('/{id}/seen' , ['uses' => 'NotificationsController@seen' ]);
});
