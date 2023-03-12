<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 认证路由
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth:student'], function () {
    // 学校详情
    Route::get('school', 'SchoolController@studentSchool');

    // 教师列表
    Route::get('teachers', 'SchoolTeacherController@studentList');

    // 关注
    Route::put('teachers/{teacher}/follow', 'FollowController@follow');

    // 取关
    Route::put('teachers/{teacher}/unfollow', 'FollowController@unfollow');
});
