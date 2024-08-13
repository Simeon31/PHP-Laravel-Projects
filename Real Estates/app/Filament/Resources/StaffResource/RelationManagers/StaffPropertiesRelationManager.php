<?php

namespace App\Filament\Resources\StaffResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StaffPropertiesRelationManager extends RelationManager
{
    protected static string $relationship = 'staffProperties';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('property_name')
                    ->required()
                    ->label(__('Property'))
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('property_name')
            ->recordTitle(__('Property'))
            ->heading(__('Properties'))
            ->columns([
                Tables\Columns\TextColumn::make('property_name')
                ->label(__('Property')),
                Tables\Columns\TextColumn::make('staff.first_name')
                ->label(__('Member')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
               
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
