<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\UserSetting;
use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProjectSelect extends Component implements HasForms
{
    use InteractsWithForms;

    public $project;
    public string $userSetting;

    public function mount(): void
    {
        $this->userSetting = UserSetting::currentProject();

        $this->form->fill([
            'project' => $this->userSetting
        ]);
    }

    public function render(): View
    {
        return view('livewire.project-select');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('project')
                ->label('Current project')
                ->selectablePlaceholder(false)
                ->options(Project::query()->pluck('name', 'projects.id'))
                ->reactive()
                ->afterStateUpdated(function ($set, $state) {
                    UserSetting::setCurrentProject(Project::findOrFail($state));
                    $this->dispatch('refresh-page');
                })
        ]);
    }
}
