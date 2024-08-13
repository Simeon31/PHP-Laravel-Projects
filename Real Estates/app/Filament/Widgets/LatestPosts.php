<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\PostResource;
use App\Filament\Resources\PropertyResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Property;

class LatestPosts extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('Most Recent Publications'))
            ->query(
                PostResource::getEloquentQuery()->with('property')
            )
            ->defaultPaginationPageOption(5)
            ->defaultSort(column: 'published_at', direction: 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('property_id')
                    ->label(__('Property'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record->property->property_name ?? 'Unknown Property';
                    })
                    ->url(fn($record) => PropertyResource::getUrl('edit', ['record' => $record->property_id]))
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('Status'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('Published at'))
                    ->dateTime()
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
            ]);
    }
}
