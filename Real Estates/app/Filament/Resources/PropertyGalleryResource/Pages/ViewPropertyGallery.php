<?php

namespace App\Filament\Resources\PropertyGalleryResource\Pages;

use App\Filament\Resources\PropertyGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPropertyGallery extends ViewRecord
{
    protected static string $resource = PropertyGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
