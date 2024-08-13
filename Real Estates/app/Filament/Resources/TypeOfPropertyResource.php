<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeOfPropertyResource\Pages;
use App\Filament\Resources\TypeOfPropertyResource\RelationManagers;
use App\Models\TypeOfProperty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypeOfPropertyResource extends Resource
{
    protected static ?string $model = TypeOfProperty::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    public static function getModelLabel(): string
    {
        return __('Category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Categories');
    }
  
    public static function getNavigationGroup(): ?string
    {
        return __('Add a property type');
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('property_type')
                    ->label(__('Property type'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(2000),
                Forms\Components\Textarea::make('description')
                    ->label(__('Description'))
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('property_type')
                    ->label(__('Property type'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Updated at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->recordTitle(__('Category')),
                Tables\Actions\DeleteAction::make()
                    ->action(function ($data, $record) {

                        // Check if the category has related staff members
                        if ($record->properties()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title(__('Cannot Delete Category'))
                                ->body(__('This category has related property/ies and cannot be deleted.'))
                                ->send();

                            return;
                        }

                        $record->delete();
                    })
                    ->recordTitle(__('Category')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTypeOfProperties::route('/'),
        ];
    }
}
