<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffCategoryResource\Pages;
use App\Filament\Resources\StaffCategoryResource\RelationManagers;
use App\Models\StaffCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StaffCategoryResource extends Resource
{
    protected static ?string $model = StaffCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
        return __('Staff');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category')
                    ->label(__('Category'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->searchable()
                    ->placeholder(__('Select a category'))
                    ->options([
                        __('By Client Representation') => __('By Client Representation'),
                        __('By Area of Expertise') => __('By Area of Expertise')
                    ]),
                Forms\Components\Textarea::make('description')
                    ->label(__('Description'))
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category')
                    ->label(__('Category'))
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
                    ->recordTitle('Category'),
                Tables\Actions\DeleteAction::make()
                    ->action(function ($data, $record) {

                        if ($record->staffMember()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title(__('Cannot Delete Category'))
                                ->body(__('This category has related member/s and cannot be deleted.'))
                                ->send();
                        }

                        if ($record->roles()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title(__('Cannot Delete Category'))
                                ->body(__('This category has related role/s and cannot be deleted.'))
                                ->send();

                            return;
                        }

                        $record->delete();

                        Notification::make()
                            ->success()
                            ->title(__('Category Deleted Successfully'))
                            ->send();
                    })
                    ->recordTitle('Category'),
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
            'index' => Pages\ManageStaffCategories::route('/'),
        ];
    }
}
