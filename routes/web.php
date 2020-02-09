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

Route::get('/home', 'HomeController@index')->name('web-app');

Route::get('/invitations/confirm' , 'AcceptInvitationController@showAcceptForm')->name('invitations.show') ;
Route::post('/invitations/confirm' , 'AcceptInvitationController@accept')->name('invitations.confirm') ;

Route::get('/' , 'ReactAppController@index');
