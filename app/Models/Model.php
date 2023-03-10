<?php
/**
 * 公共模型
 */

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @return string[]
     */
    public function getHidden(): array
    {
        return array_merge([
            'password',
            'deleted_at',
            'pivot',
        ], $this->hidden);
    }

    protected function serializeDate(DateTimeInterface $date): int
    {
        return $date->getTimestamp();
    }
}
