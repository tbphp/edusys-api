<?php

namespace App\Http\Controllers;

use App\Enums\GuardEnum;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * 粉丝数
     *
     * @return array
     */
    public function fansCount()
    {
        /** @var Teacher $teacher */
        $teacher = Auth::guard(GuardEnum::TEACHER)->user();

        $count = $teacher->fans()->count();

        return compact('count');
    }

    /**
     * 粉丝列表
     */
    public function fans()
    {
        /** @var Teacher $teacher */
        $teacher = Auth::guard(GuardEnum::TEACHER)->user();

        return $teacher->fans()->latest('id')->with('school')->paginate();
    }

    /**
     * 关注
     *
     * @return void
     */
    public function follow(Teacher $teacher)
    {
        /** @var Student $student */
        $student = Auth::guard(GuardEnum::STUDENT)->user();

        $student->followers()->syncWithoutDetaching([$teacher->id]);
    }

    public function unfollow(Teacher $teacher)
    {
        /** @var Student $student */
        $student = Auth::guard(GuardEnum::STUDENT)->user();

        $student->followers()->detach($teacher);
    }
}
