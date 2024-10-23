<?php

namespace App\Models;

use App\Models\Scopes\UserProjectScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy(UserProjectScope::class)]
class Environment extends Model
{
    use HasUlids, HasFactory;

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function (Environment $environment) {
            $environment->project_id = UserSetting::currentProject();
        });
    }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function assets(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Asset::class);
    }

    public function markers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Marker::class);
    }
}
