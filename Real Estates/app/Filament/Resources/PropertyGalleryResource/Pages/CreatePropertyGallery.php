<?php

namespace App\Filament\Resources\PropertyGalleryResource\Pages;

use App\Filament\Resources\PropertyGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePropertyGallery extends CreateRecord
{
    protected static string $resource = PropertyGalleryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
