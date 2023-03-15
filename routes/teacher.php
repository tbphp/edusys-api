<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 开放路由
|--------------------------------------------------------------------------
*/
Route::post('register', 'AuthController@teacherRegister');

/*
|--------------------------------------------------------------------------
| 认证路由
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:teacher', 'scope:teacher']], function () {
    // 学校管理
    Route::apiResource('schools', 'SchoolController');

    // 学校老师管理
    Route::apiResource('schools.teachers', 'SchoolTeacherController')
        ->except(['show', 'update']);

    // 学校学生管理
    Route::apiResource('schools.students', 'SchoolStudentController')
        ->except('show');
    Route::put('schools/{school}/students/{student}/reset_password', 'SchoolStudentController@resetPassword');

    // 粉丝
    Route::get('fans', 'FollowController@fans');
    Route::get('fans/count', 'FollowController@fansCount');

    // 发送消息
    Route::post('messages', 'MessageController@store');
});
