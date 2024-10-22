<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasUlids;

    protected $casts = [
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
