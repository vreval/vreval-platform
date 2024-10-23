<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;

class TaskWizard extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = TaskResource::class;

    protected static string $view = 'filament.resources.task-resource.pages.task-wizard';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Introduction')
                        ->schema([]),
                    Wizard\Step::make('Forms')
                        ->schema([]),
                    Wizard\Step::make('Markers')
                        ->schema([]),
                    Wizard\Step::make('Assets')
                        ->schema([]),
                    Wizard\Step::make('Environments')
                        ->schema([]),
                    Wizard\Step::make('Tasks')
                        ->schema([]),
                ])
            ]);
    }
}
