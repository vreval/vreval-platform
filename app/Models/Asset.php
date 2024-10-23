<?php

namespace App\Models;

use App\Models\Scopes\UserProjectScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy(UserProjectScope::class)]
class Asset extends Model
{
    use HasUlids, HasFactory;

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function (Asset $asset) {
            $asset->project_id = UserSetting::currentProject();
        });
    }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function environments(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Environment::class);
    }
}
