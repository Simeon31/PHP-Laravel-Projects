<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffRolesResource\Pages;
use App\Filament\Resources\StaffRolesResource\RelationManagers;
use App\Models\StaffCategory;
use App\Models\StaffRoles;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class StaffRolesResource extends Resource
{
    protected static ?string $model = StaffRoles::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('Role');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Roles');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Staff');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label(__('Category'))
                    ->required()
                    ->native(false)
                    ->placeholder(__('Select a category'))
                    ->live()
                    ->options(StaffCategory::all()->pluck('category', 'id')),
                Forms\Components\Select::make('role')
                    ->label(__('Role'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->placeholder(__('Select a role'))
                    ->options(function (callable $get) {
                        $categoryId = (int)$get('category_id');
                        // $categoryName = StaffCategory::find($categoryId)?->category;

                        if ($categoryId === 1) {
                            return [
                                __('Agent') => __('Agent'),
                            ];
                        } else if ($categoryId === 2) {
                            return [
                                __('Manager') => __('Manager'),
                                __('Supervisor') => __('Supervisor'),
                            ];
                        } else {
                            return [];
                        }
                    })
                    ->disabled(fn(Forms\Get $get): bool => !filled($get('category_id'))),
                Forms\Components\Textarea::make('description')
                    ->label(__('Description'))
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('role')
                    ->label(__('Role'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.category')
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
                    ->recordTitle(__('Role')),
                Tables\Actions\DeleteAction::make()
                    ->action(function ($data, $record) {

                        if ($record->member()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title(__('Cannot Delete Role'))
                                ->body(__('This role has related member/s and cannot be deleted.'))
                                ->send();

                            return;
                        }

                        $record->delete();

                        Notification::make()
                            ->success()
                            ->title(__('Role Deleted Successfully'))
                            ->send();
                    })
                    ->recordTitle(__('Role')),
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
            'index' => Pages\ManageStaffRoles::route('/'),
        ];
    }
}
