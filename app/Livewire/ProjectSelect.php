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
    public UserSetting $userSetting;

    public function mount(): void
    {
        $this->userSetting = UserSetting::where('name', 'current_project')->firstOrFail();

        $this->form->fill([
            'project' => $this->userSetting->value['id']
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
                ->label('Change project')
                ->selectablePlaceholder(false)
                ->options(Project::query()->pluck('name', 'projects.id'))
                ->reactive()
                ->afterStateUpdated(function ($set, $state) {
                    $this->userSetting->setCurrentProject(Project::findOrFail($state));
                    $this->dispatch('refresh-page');
                })
        ]);
    }
}
