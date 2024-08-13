<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffResource\Pages;
use App\Filament\Resources\StaffResource\RelationManagers;
use App\Models\Staff;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StaffResource\RelationManagers\StaffPropertiesRelationManager;
use App\Models\StaffRoles;
use App\Rules\UniqueImage;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use App\Rules\UniqueProperty;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Rinvex\Country\CountryLoader;

class StaffResource extends Resource
{
    protected static ?string $model = Staff::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $recordTitleAttribute = 'first_name';

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'first_name',
            'last_name',
            'staffRole.role',
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            __('Full Name') => $record->first_name . ' ' . $record->last_name,
            __('Role') => $record->staffRole->role,
        ];
    }
    public static function getModelLabel(): string
    {
        return __('Member');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Members');
    }
  
    public static function getNavigationGroup(): ?string
    {
        return __('Staff');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make("Create a Member")->tabs([
                    Tab::make(__('General'))->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label(__('First name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('middle_name')
                            ->label(__('Middle name'))
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('last_name')
                            ->label(__('Last name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Radio::make('gender')
                            ->label(__('Choose a gender'))
                            ->options([
                                'Male' => __("Male"),
                                'Female' => __("Female")
                            ])
                            ->required(),
                        Forms\Components\Select::make('country')
                            ->label(__('Country'))
                            ->placeholder('Choose a country')
                            ->required()
                            ->searchable()
                            ->options(function () {

                                // Loading countries from the `countries-list` package
                                $countries = CountryLoader::countries();

                                $countryCodes = array_keys($countries);
                                $countryNames = array_map(function ($country) {
                                    return $country['name'];
                                }, $countries);

                                return array_combine($countryCodes, $countryNames);
                            }),
                        Forms\Components\TextInput::make('city/town')
                            ->label(__('City/Town'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('date_of_birth')
                            ->label(__('Date of birth'))
                            ->required(),
                        Forms\Components\FileUpload::make('image_url')
                            ->label(__('Upload an Image'))
                            ->imageCropAspectRatio('3:2')
                            ->imageResizeTargetWidth(1920)
                            ->imageResizeTargetHeight(1200)
                            ->image()
                            ->imageCropAspectRatio(true)
                            ->imageEditor()
                            ->maxSize(5000),
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('Active'))
                            ->onColor('success')
                            ->offColor('danger')
                            ->inline(false)
                            ->required(),
                        Forms\Components\TextInput::make('phone_number')
                            ->label(__('Phone number'))
                            ->tel()
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->label(__('Address'))
                            ->required()
                            ->maxLength(255),
                    ])->columns(1),
                    Tab::make(__('Additional Info'))->schema([
                        Forms\Components\Select::make('staffProperties')
                            ->required()
                            ->label(__('Properties'))
                            ->searchable()
                            ->preload()
                            ->placeholder(__('Select a property'))
                            ->multiple()
                            ->relationship('staffProperties', 'property_name'),
                        Forms\Components\Select::make('staffCategories')
                            ->required()
                            ->label(__('Categories'))
                            ->placeholder(__('Select a category'))
                            ->searchable()
                            ->preload()
                            ->multiple()
                            ->relationship('staffCategories', 'category')
                            ->live(),
                        Forms\Components\Select::make('role_id')
                            ->label(__('Role'))
                            ->required()
                            ->placeholder(__('Select a role'))
                            ->disabled(fn(Forms\Get $get): bool => !filled($get('staffCategories')))
                            ->options(StaffRoles::all()->pluck('role', 'id')),
                        Forms\Components\TextInput::make('email')
                            ->label(__('Email'))
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('education_training')
                            ->required()
                            ->label(__('Education/Training'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('years_of_experience')
                            ->label(__('Years of Experience'))
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(60),
                    ])->columns(1)
                ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label(__('Image'))
                    ->circular(),
                Tables\Columns\TextColumn::make('first_name')
                    ->label(__('First name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->label(__('Middle name'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('last_name')
                    ->label(__('Last name'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('Status'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('staffRole.role')
                    ->label(__('Role'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label(__('Phone number'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label(__('Address'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('education_training')
                    ->label(__('Education/Training'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('years_of_experience')
                    ->label(__("Years of experience"))
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Updated at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
        return [
            StaffPropertiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStaff::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'view' => Pages\ViewStaff::route('/{record}'),
            'edit' => Pages\EditStaff::route('/{record}/edit'),
        ];
    }
}
