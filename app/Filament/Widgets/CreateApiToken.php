<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class CreateApiToken extends Widget
{
    protected static string $view = 'filament.widgets.create-api-token';

    public string $plainTextToken = '';

    public function createToken(): void
    {
        $token = auth()->user()->createToken('full_access');

        $this->plainTextToken = $token->plainTextToken;
    }
}
