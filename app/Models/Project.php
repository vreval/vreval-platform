<?php

namespace App\Models;

use App\Models\Scopes\UserProjectScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasUlids;

    protected static function boot(): void
    {
        parent::boot();

        self::created(function (Project $project) {
            when(Auth::check(), function () use ($project) {
                $project->users()->attach(Auth::user());
            });
        });

        static::addGlobalScope('userProjectsOnly', function (Builder $builder) {
            $builder->whereHas('users', function ($query) {
                $query->where('users.id', Auth::id());
            });
        });
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function forms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Form::class);
    }

    public function assets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Asset::class);
    }

    public function environments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Environment::class);
    }

    public function markers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Marker::class);
    }

    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Task::class);
    }
}
