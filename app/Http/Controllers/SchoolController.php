<?php

namespace App\Http\Controllers;

use App\Enums\ErrCode;
use App\Enums\GuardEnum;
use App\Enums\SchoolStatusEnum;
use App\Exceptions\CException;
use App\Http\Requests\SchoolRequest;
use App\Models\School;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    protected function _teacher(): Teacher
    {
        return Auth::guard(GuardEnum::TEACHER)->user();
    }

    public function index()
    {
        $teacher = $this->_teacher();
        $result = $teacher->schools()->paginate();

        // 判断登录用户是否管理员
        $result->map(function (School $school) use ($teacher) {
            $school->makeVisible(['status', 'reject_reason']);
            $school->append('is_owner', 'status_text');
        });

        return $result;
    }

    public function store(SchoolRequest $request)
    {
        School::create([
            'name' => $request->input('name'),
            'owner_id' => $this->_teacher()->id,
            'status' => SchoolStatusEnum::PENDDING,
        ]);
    }

    public function show(School $school)
    {
        // 详情只展示正常状态
        if (SchoolStatusEnum::NORMAL !== $school->status) {
            throw new ModelNotFoundException;
        }

        $school->append('is_owner');

        return $school;
    }

    public function update(SchoolRequest $request, School $school)
    {
        // 验证管理员
        if ($school->owner_id !== $this->_teacher()->id) {
            throw new CException(ErrCode::HTTP_AUTHORIZATION);
        }

        $school->update(['name' => $request->input('name')]);
    }

    public function destroy(School $school)
    {
        // 验证管理员
        if ($school->owner_id !== $this->_teacher()->id) {
            throw new CException(ErrCode::HTTP_AUTHORIZATION);
        }

        DB::transaction(function () use ($school) {
            $school->teachers()->detach();
            $school->students()->delete();
            $school->delete();
        });
    }
}
