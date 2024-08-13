<?php

namespace App\Filament\Resources\PropertyGalleryResource\Pages;

use App\Filament\Resources\PropertyGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPropertyGallery extends EditRecord
{
    protected static string $resource = PropertyGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
