<?php

namespace App\Models;

use App\Enums\SchoolStatusEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class School extends Model
{
    use SoftDeletes;

    protected $hidden = [
        'owner_id',
    ];

    protected $casts = [
        'owner_id' => 'int',
        'status' => 'int',
    ];

    protected $appends = [
        'status_text',
    ];

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function getStatusTextAttribute(): string
    {
        if (empty($this->attributes['status'])) {
            return '';
        }

        return SchoolStatusEnum::getDescription($this->attributes['status']);
    }

    /**
     * 是否管理员
     *
     * @return bool
     */
    public function getIsOwnerAttribute(): bool
    {
        if (empty($this->attributes['owner_id'])) {
            return false;
        }

        if (Auth::guest()) {
            return false;
        }

        $user = Auth::user();

        if ($user instanceof Teacher) {
            if ($this->attributes['owner_id'] == $user->id) {
                return true;
            }
        }

        return false;
    }
}
