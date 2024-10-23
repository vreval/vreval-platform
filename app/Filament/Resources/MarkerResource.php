<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarkerResource\Pages;
use App\Filament\Resources\MarkerResource\RelationManagers;
use App\Models\Marker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MarkerResource extends Resource
{
    protected static ?string $model = Marker::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationParentItem = 'Tasks';
    protected static ?int $navigationSort = 102;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\Section::make('Placement')
                    ->columns(['sm' => 3])
                    ->schema([
                        Forms\Components\TextInput::make('position_x')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('position_y')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('position_z')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('rotation_x')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('rotation_y')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('rotation_z')
                            ->required()
                            ->numeric(),
                    ]),
                Forms\Components\Section::make('CAD meta data')
                    ->description('This section shows computer generated meta data that comes from CAD software.')
                    ->columns(['sm' => 3])
                    ->schema([
                        Forms\Components\TextInput::make('cad_id')
                            ->label('CAD ID')
                            ->disabled()
                            ->columnSpan(3),
                        Forms\Components\TextInput::make('survey_point_x')
                            ->disabled()
                            ->numeric(),
                        Forms\Components\TextInput::make('survey_point_y')
                            ->disabled()
                            ->numeric(),
                        Forms\Components\TextInput::make('survey_point_z')
                            ->disabled()
                            ->numeric(),
                    ]),
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
            'index' => Pages\ListMarkers::route('/'),
            'create' => Pages\CreateMarker::route('/create'),
            'edit' => Pages\EditMarker::route('/{record}/edit'),
        ];
    }
}
