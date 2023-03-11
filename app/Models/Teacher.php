<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends AuthModel
{
    public function schools(): BelongsToMany
    {
        return $this->belongsToMany(School::class);
    }
}
