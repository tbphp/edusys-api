<?php

namespace App\Admin\Actions\Post;

use App\Enums\SchoolStatusEnum;
use App\Libs\Chat;
use App\Models\AuthModel;
use App\Models\OfflineMessage;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;

class Message extends RowAction
{
    /** @var int 站内消息 */
    const TYPE_INTERNAL = 1;

    /** @var int Line消息 */
    const TYPE_LINE = 2;

    public $name = '发消息';

    public function handle(AuthModel $user, Request $request)
    {
        $types = $request->input('types');

        foreach ($types as $type) {
            if ($type == self::TYPE_INTERNAL) {
                (new Chat)->send($user, $request->input('message'), OfflineMessage::TYPE_SYSTEM);
            } elseif ($type == self::TYPE_LINE) {
                line_message($user, $request->input('message'));
            }
        }

        return $this->response()->success('Success message.')->refresh();
    }

    public function form()
    {
        /** @var Teacher|Student $user */
        $user = $this->row;
        $options = [self::TYPE_INTERNAL => '站内消息'];
        if ($user->line_id) {
            $options[self::TYPE_LINE] = 'Line消息';
        }

        $this->checkbox('types', '类型')->options($options)->default(array_keys($options))->rules('required');

        $this->textarea('message', '消息内容')->required()->rules('string|max:500');
    }
}
