<?php

namespace App\Models;

use App\Models\Scopes\UserProjectScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

#[ScopedBy(UserProjectScope::class)]
class Form extends Model
{
    use HasUlids;

    protected $casts = [
        'pages' => 'array'
    ];

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function (Form $form) {
            $form->project_id = UserSetting::currentProject();
        });
    }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
