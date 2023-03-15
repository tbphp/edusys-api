<?php

namespace App\Admin\Actions\Post;

use App\Enums\SchoolStatusEnum;
use App\Models\School;
use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;

class Approve extends RowAction
{
    public $name = '批准';

    public function handle(School $school, Request $request)
    {
        if ($school->status == SchoolStatusEnum::PENDDING) {
            $school->update([
                'status' => SchoolStatusEnum::NORMAL,
                'reject_reason' => '',
            ]);
            return $this->response()->success('Success message.')->refresh();
        }

        return $this->response()->error('操作失败');
    }
}
