<?php

namespace App\Models;

use App\Models\Scopes\UserProjectScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy(UserProjectScope::class)]
class Task extends Model
{
    use HasUlids;

    protected $casts = [
        'environments' => 'array',
        'properties' => 'array'
    ];

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function (Task $task) {
            $task->project_id = UserSetting::currentProject();
        });
    }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function marker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Marker::class);
    }

    public function form(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}
