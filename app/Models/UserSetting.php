<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserSetting extends Model
{
    use HasUlids;

    protected $casts = [
        'value' => 'array'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('authUserOnly', function (Builder $builder) {
            $builder->where('user_id', Auth::id());
        });
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function currentProject(): string
    {
        return Cache::remember('current_project', 600, function () {
            return UserSetting::where('name', 'current_project')
                ->firstOrFail()
                ->value['id'];
        });
    }

    public static function setCurrentProject(Project $project): void
    {
        UserSetting::updateOrCreate(
            ['name' => 'current_project'],
            ['value' => ['id' => $project->id]]
        );

        Cache::put('current_project', $project->id);
    }
}
