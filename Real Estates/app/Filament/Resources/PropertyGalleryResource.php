<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyGalleryResource\Pages;
use App\Filament\Resources\PropertyGalleryResource\RelationManagers;
use App\Filament\Resources\PropertyGalleryResource\RelationManagers\PropertyImagesRelationManager;
use App\Models\Property;
use App\Models\PropertyGallery;
use App\Rules\UniqueImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\ValidationException;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PropertyGalleryResource extends Resource
{
    protected static ?string $model = PropertyGallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    public static function getModelLabel(): string
    {
        return __('Property Image');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Property Images');
    }
  
    public static function getNavigationGroup(): ?string
    {
        return __('Create a new property');
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('property_id')
                            ->required()
                            ->label(__('Property'))
                            ->searchable()
                            ->placeholder(__('Select a property'))
                            ->unique(ignoreRecord: true)
                            ->options(Property::all()->pluck('property_name', 'id')),
                        Forms\Components\FileUpload::make('promo_image')
                            ->image()
                            ->directory('promo image')
                            ->openable()
                            ->downloadable()
                            ->label(__('Promo Image'))
                            ->imageCropAspectRatio('4:3')
                            ->imageResizeTargetWidth(1920)
                            ->imageResizeTargetHeight(1200)
                            ->maxSize(5000)
                            ->required(),
                        Forms\Components\FileUpload::make('image_url')
                            ->image()
                            ->label(__('Images'))
                            ->preserveFilenames()
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                return (string) str($file->getClientOriginalName())->prepend(now()->timestamp);
                            })
                            ->directory('gallery')
                            ->reorderable()
                            ->downloadable()
                            ->openable()
                            ->imageCropAspectRatio('4:3')
                            ->imageResizeTargetWidth(1920)
                            ->imageResizeTargetHeight(1200)
                            ->maxSize(5000)
                            ->multiple()
                            ->required(),
                    ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('promo_image')
                    ->label(__('Promo image')),
                Tables\Columns\TextColumn::make('propertyImages.property_name')
                    ->label(__('Property'))
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPropertyGalleries::route('/'),
            'create' => Pages\CreatePropertyGallery::route('/create'),
            'view' => Pages\ViewPropertyGallery::route('/{record}'),
            'edit' => Pages\EditPropertyGallery::route('/{record}/edit'),
        ];
    }
}
