<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends AuthModel
{
    public function schools(): BelongsToMany
    {
        return $this->belongsToMany(School::class);
    }

    /**
     * 粉丝学生
     *
     * @return BelongsToMany
     */
    public function fans(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'follows')->withTimestamps();
    }
}
