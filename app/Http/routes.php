<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/**
 *默认起始欢迎页--使用闭包
 */
Route::get('/', function () {
    return view('welcome');
});

//登陆业务（认证路由）
Route::get('auth/login','Auth\AuthController@getLogin');
Route::post('auth/login','Auth\AuthController@postLogin');
Route::get('auth/logout','Auth\AuthController@getLogout');

//注册业务
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

/**
 *task业务路由，需要有用户认证（Auth）,在控制器中使用中间件
 */
Route::get('/tasks', 'TaskController@index');//显示列表
Route::post('/task', 'TaskController@store');//添加页面
Route::delete('/task/{task}', 'TaskController@destroy');//删除请求