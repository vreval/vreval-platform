<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormResource\Pages;
use App\Filament\Resources\FormResource\RelationManagers;
use App\Models\Form as VrevalForm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormResource extends Resource
{
    protected static ?string $model = VrevalForm::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationParentItem = 'Tasks';
    protected static ?int $navigationSort = 101;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\Repeater::make('pages')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Builder::make('fields')
                            ->blocks([
                                Forms\Components\Builder\Block::make('heading')
                                    ->schema([Forms\Components\TextInput::make('text')]),
                                Forms\Components\Builder\Block::make('text')
                                    ->schema([Forms\Components\Textarea::make('text')]),
                                Forms\Components\Builder\Block::make('rating')
                                    ->schema([
                                        Forms\Components\TextInput::make('question'),
                                        Forms\Components\Toggle::make('is_required'),
                                        Forms\Components\Select::make('size')
                                            ->options([2,3,4,5,6,7]),
                                        Forms\Components\Select::make('symbols')
                                            ->options([
                                                'none' => 'Don\'t show symbols',
                                                'asc' => '1,2,3',
                                                'desc' => '3,2,1',
                                            ]),
                                        Forms\Components\TextInput::make('label_a'),
                                        Forms\Components\TextInput::make('label_b'),
                                    ]),
                                Forms\Components\Builder\Block::make('options')
                                    ->schema([
                                        Forms\Components\TextInput::make('question'),
                                        Forms\Components\Toggle::make('is_required'),
                                        Forms\Components\Toggle::make('is_shuffled'),
                                        Forms\Components\Repeater::make('options')
                                            ->schema([
                                                Forms\Components\TextInput::make('option')
                                            ])
                                    ]),
                                Forms\Components\Builder\Block::make('multiple_choice')
                                    ->schema([
                                        Forms\Components\TextInput::make('question'),
                                        Forms\Components\Toggle::make('is_required'),
                                        Forms\Components\Toggle::make('is_shuffled'),
                                        Forms\Components\Repeater::make('options')
                                            ->schema([
                                                Forms\Components\TextInput::make('option')
                                            ])
                                    ]),
                            ])
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
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForm::route('/create'),
            'edit' => Pages\EditForm::route('/{record}/edit'),
        ];
    }
}
