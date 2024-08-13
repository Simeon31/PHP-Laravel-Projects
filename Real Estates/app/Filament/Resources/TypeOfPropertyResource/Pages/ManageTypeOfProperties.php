<?php

namespace App\Filament\Resources\TypeOfPropertyResource\Pages;

use App\Filament\Resources\TypeOfPropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTypeOfProperties extends ManageRecords
{
    protected static string $resource = TypeOfPropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
