<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    private static function createDefaultBlock(array $records): array
    {
        return [
            Forms\Components\Toggle::make('is_skippable')
                ->columnSpan(3),
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\Select::make('form_id')
                ->label('Form')
                ->required()
                ->options($records['forms']),
            Forms\Components\Select::make('marker_id')
                ->label('Marker')
                ->required()
                ->options($records['markers']),
            Forms\Components\Select::make('environment_id')
                ->label('Environments')
                ->columnSpan(3)
                ->multiple()
                ->options($records['environments'])
        ];
    }

    public static function form(Form $form): Form
    {
        $forms = \App\Models\Form::query()->pluck('name', 'id');
        $markers = \App\Models\Marker::query()->pluck('name', 'id');
        $environments = \App\Models\Environment::query()->pluck('name', 'id');

        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\Select::make('environments')
                    ->required()
                    ->multiple()
                    ->options($environments),
                Forms\Components\Builder::make('properties')
                    ->label('Steps')
                    ->collapsible()
                    ->blocks([
                        Forms\Components\Builder\Block::make('default')
                            ->columns(['sm' => 3])
                            ->schema([
                                ...self::createDefaultBlock(compact('forms', 'markers', 'environments'))
                            ]),
                        Forms\Components\Builder\Block::make('annotation')
                            ->columns(['sm' => 3])
                            ->schema([
                                ...self::createDefaultBlock(compact('forms', 'markers', 'environments')),
                                Forms\Components\Select::make('annotation_form_id')
                                    ->label('Annotation Form')
                                    ->required()
                                    ->options($forms),
                            ]),
                        Forms\Components\Builder\Block::make('ab_test')
                            ->label('AB Test')
                            ->columns(['sm' => 3])
                            ->schema([
                                ...self::createDefaultBlock(compact('forms', 'markers', 'environments')),
                                Forms\Components\Repeater::make('Locations')
                                    ->columnSpan(3)
                                    ->columns(['sm' => 4])
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required(),
                                        Forms\Components\Select::make('marker_id')
                                            ->label('Marker')
                                            ->required()
                                            ->options($markers),
                                        Forms\Components\Select::make('form_id')
                                            ->label('Form')
                                            ->required()
                                            ->options($forms),
                                        Forms\Components\Select::make('environment_ids')
                                            ->label('Environments')
                                            ->required()
                                            ->multiple()
                                            ->options($environments),
                                    ])
                            ]),
                        Forms\Components\Builder\Block::make('wayfinding')
                            ->label('Wayfinding')
                            ->columns(['sm' => 3])
                            ->schema([
                                ...self::createDefaultBlock(compact('forms', 'markers', 'environments')),
                                Forms\Components\Repeater::make('Waypoints')
                                    ->columnSpan(3)
                                    ->columns(['sm' => 4])
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required(),
                                        Forms\Components\Select::make('marker_id')
                                            ->label('Marker')
                                            ->required()
                                            ->options($markers),
                                        Forms\Components\Select::make('form_id')
                                            ->label('Form')
                                            ->required()
                                            ->options($forms),
                                        Forms\Components\Toggle::make('is_optional')
                                    ]),
                                Forms\Components\Repeater::make('Destination')
                                    ->columnSpan(3)
                                    ->columns(['sm' => 4])
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required(),
                                        Forms\Components\Select::make('marker_id')
                                            ->label('Marker')
                                            ->required()
                                            ->options($markers),
                                        Forms\Components\Select::make('form_id')
                                            ->label('Form')
                                            ->required()
                                            ->options($forms)
                                    ])
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('wizard')
                    ->url(Pages\TaskWizard::getUrl())
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
            'wizard' => Pages\TaskWizard::route('/wizard')
        ];
    }
}
