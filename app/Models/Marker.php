<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    use HasUlids, HasFactory;

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function (Marker $marker) {
            $marker->project_id = UserSetting::currentProject();
        });
    }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function environment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Environment::class);
    }

    public function task(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Task::class);
    }
}
