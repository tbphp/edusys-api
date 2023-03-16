<?php

namespace App\Admin\Actions\Post;

use App\Enums\SchoolStatusEnum;
use App\Models\School;
use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;

class Reject extends RowAction
{
    public $name = '<span class="text text-danger">拒绝</span>';

    public function handle(School $school, Request $request)
    {
        if ($school->status == SchoolStatusEnum::PENDDING) {
            $school->update([
                'status' => SchoolStatusEnum::REJECTED,
                'reject_reason' => $request->input('reject_reason'),
            ]);
            return $this->response()->success('Success message.')->refresh();
        }

        return $this->response()->error('操作失败');
    }

    public function form()
    {
        $this->text('reject_reason', '拒绝原因');
    }
}
