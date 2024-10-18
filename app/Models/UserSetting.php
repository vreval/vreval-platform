<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserSetting extends Model
{
    use HasUlids;

    protected $casts = [
        'value' => 'array'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('authUserOnly', function (Builder $builder) {
            $builder->where('user_id', Auth::user()->id);
        });
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setCurrentProject(Project $project)
    {
        $this->value = [
            'id' => $project->id
        ];

        $this->save();
    }
}
