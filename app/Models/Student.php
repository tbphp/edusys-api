<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends AuthModel
{
    use SoftDeletes;

    protected $hidden = [
        'password', 'school_id', 'deleted_at',
    ];

    protected $casts = [
        'school_id' => 'int',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
