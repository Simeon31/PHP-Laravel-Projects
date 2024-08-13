<?php

namespace App\Filament\Resources\FeaturedPropertyResource\Pages;

use App\Filament\Resources\FeaturedPropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFeaturedProperties extends ManageRecords
{
    protected static string $resource = FeaturedPropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
