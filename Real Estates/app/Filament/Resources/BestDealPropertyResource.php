<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BestDealPropertyResource\Pages;
use App\Filament\Resources\BestDealPropertyResource\RelationManagers;
use App\Models\BestDealProperty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Property;
use App\Models\TypeOfProperty;

class BestDealPropertyResource extends Resource
{
    protected static ?string $model = BestDealProperty::class;

    protected static ?string $navigationIcon = 'heroicon-o-plus';
    
    public static function getModelLabel(): string
    {
        return __('Best deal property');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Best deal properties');
    }
  
    public static function getNavigationGroup(): ?string
    {
        return __('Create a new property');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('property_id')
                    ->label(__('Property'))
                    ->unique(ignoreRecord: true)
                    ->options(Property::all()->pluck('property_name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label(__('Active'))
                    ->onColor('success')
                    ->offColor('danger')
                    ->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('property.property_name')
                    ->label(__('Property'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('Active'))
                    ->boolean(),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageBestDealProperties::route('/'),
        ];
    }
}
