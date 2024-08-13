<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\TypeOfProperty;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $recordTitleAttribute = 'property_name';

    public static function getGloballySearchableAttributes(): array
    {
        return ['property_name', 'address', 'typeOfProperty.property_type', 'price'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Type' => $record->typeOfProperty->property_type,
        ];
    }
    protected static ?string $navigationIcon = 'heroicon-o-plus';
   
    public static function getModelLabel(): string
    {
        return __('Property');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Properties');
    }
  
    public static function getNavigationGroup(): ?string
    {
        return __('Create a new property');
    }
    
    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Tabs::make(__("Create a property"))->tabs([
                    Tab::make(__('Property details'))->schema([
                        Forms\Components\TextInput::make('property_name')
                            ->label(__('Property'))
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(2000),
                        Forms\Components\TextInput::make('address')
                            ->label(__('Address'))
                            ->required()
                            ->suffixIcon('heroicon-o-map-pin')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bedrooms')
                            ->label(__('Bedrooms'))
                            ->required()
                            ->minValue(1)
                            ->numeric(),
                        Forms\Components\TextInput::make('bathrooms')
                            ->label(__('Bathrooms'))
                            ->required()
                            ->minValue(1)
                            ->numeric(),
                        Forms\Components\TextInput::make('floor')
                            ->label(__('Floor'))
                            ->required()
                            ->minValue(1)
                            ->numeric(),
                    ])->columns(1),
                    Tab::make(__('Additional details'))->schema([
                        Forms\Components\TextInput::make('parking_spots')
                            ->label(__('Parking spots'))
                            ->required()
                            ->numeric(),
                        Forms\Components\RichEditor::make('description')
                            ->label(__('Description'))
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('area')
                            ->label(__('Area'))
                            ->required()
                            ->minValue(1)
                            ->numeric(),
                        Forms\Components\TextInput::make('price')
                            ->label(__('Price'))
                            ->required()
                            ->minValue(1)
                            ->numeric()
                            ->suffixIcon('heroicon-o-currency-dollar'),
                        Forms\Components\Radio::make('is_parking_available')
                            ->label(__('Is parking available'))
                            ->boolean(trueLabel: __('Yes'), falseLabel: __('No'))
                            ->inline()
                            ->inlineLabel(false)
                            ->required(),
                        Forms\Components\TextInput::make('safety')
                            ->label(__('Safety'))
                            ->required(),
                        Forms\Components\TextInput::make('payment_process')
                            ->label(__('Payment Process'))
                            ->required()
                            ->suffixIcon('heroicon-o-credit-card')
                            ->maxLength(255),
                        Forms\Components\Select::make('category_id')
                            ->label(__('Category'))
                            ->options(TypeOfProperty::all()->pluck('property_type', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\FileUpload::make('image_url')
                            ->label(__('Upload an Image'))
                            ->imageCropAspectRatio('4:3')
                            ->imageResizeTargetWidth(1920)
                            ->imageResizeTargetHeight(1200)
                            ->image()
                            ->maxSize(5000)
                            ->openable()
                            ->downloadable()
                            ->required(),

                    ])->columns(1)
                ])->columns(8)

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('property_name')
                    ->label(__('Property'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('typeOfProperty.property_type')
                    ->label(__('Category'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label(__('Address'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('area')
                    ->label(__('Area'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('Price'))
                    ->money()
                    ->searchable()
                    ->sortable(),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function ($data, $record) {
                        // Check if the property has related posts
                        if ($record->posts()->exists()) {
                            Notification::make()
                                ->danger()
                                ->title(__('Cannot Delete Property'))
                                ->body(__('This property has related post/s and cannot be deleted.'))
                                ->send();
                            return;
                        }

                        // Check if the property is a featured property
                        if ($record->featuredProperty()->exists()) {
                            Notification::make()
                                ->danger()
                                ->title(__('Cannot Delete Property'))
                                ->body(__('This property has a related featured property and cannot be deleted.'))
                                ->send();
                            return;
                        }

                        if ($record->bestDealProperties()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title(__('Cannot Delete Property'))
                                ->body(__('This property has related best deal property and cannot be deleted.'))
                                ->send();
                            return;
                        }

                        $record->delete();

                        Notification::make()
                            ->success()
                            ->title(__('Property Deleted Successfully'))
                            ->send();
                    }),
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
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'view' => Pages\ViewProperty::route('/{record}'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
