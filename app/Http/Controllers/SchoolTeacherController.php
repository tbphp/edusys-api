<?php

namespace App\Http\Controllers;

use App\Enums\ErrCode;
use App\Enums\GuardEnum;
use App\Enums\SchoolStatusEnum;
use App\Exceptions\CException;
use App\Http\Requests\SchoolTeacherStoreRequest;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class SchoolTeacherController extends Controller
{
    /**
     * 验证学校管理员权限
     *
     * @param School $school
     * @return void
     */
    protected function _checkOwner(School $school)
    {
        // 检查状态
        if (SchoolStatusEnum::NORMAL !== $school->status) {
            throw new CException('该学校状态异常');
        }

        // 验证管理员
        if (!$school->is_owner) {
            throw new CException(ErrCode::HTTP_AUTHORIZATION);
        }
    }

    public function index(School $school)
    {
        $this->_checkOwner($school);

        return $school->teachers()
            ->latest('id')
            ->paginate(request('per_page'));
    }

    public function store(SchoolTeacherStoreRequest $request, School $school)
    {
        $this->_checkOwner($school);

        $teacher = Teacher::where('username', $request->input('username'))->first();
        if (empty($teacher)) {
            throw new CException(ErrCode::DATA_NOT_FOUND, '您查询的邮箱不存在');
        }

        $exists = $school->teachers()->where('id', $teacher->id)->first();
        if ($exists) {
            throw new CException('该老师已经在学校里面，不能重复邀请');
        }

        $school->teachers()->attach($teacher);
    }

    public function destroy(School $school, int $teacher)
    {
        $this->_checkOwner($school);

        if (Auth::id() === $teacher) {
            throw new CException('不能移除自己');
        }

        $school->teachers()->detach($teacher);
    }

    public function studentList()
    {
        /** @var Student $student */
        $student = Auth::guard(GuardEnum::STUDENT)->user();

        $result = $student->school
            ->teachers()
            // 通过当前学生id预加载
            ->with(['fans' => function (BelongsToMany $query) use ($student) {
                $query->where('students.id', $student->id);
            }])
            ->paginate(request('per_page'));

        // 判断是否关注教师
        $result->map(function (Teacher $teacher) use ($student) {
            $teacher['is_followed'] = $teacher->fans->isNotEmpty();
            $teacher['is_owner'] = $teacher->id === $student->school->owner_id;
            unset($teacher['fans']);
        });

        return $result;
    }
}
