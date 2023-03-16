<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends AuthModel
{
    public function schools(): BelongsToMany
    {
        return $this->belongsToMany(School::class);
    }

    public function ownerSchools(): HasMany
    {
        return $this->hasMany(School::class, 'owner_id');
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
