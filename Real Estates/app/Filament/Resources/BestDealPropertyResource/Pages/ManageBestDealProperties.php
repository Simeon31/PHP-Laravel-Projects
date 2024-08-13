<?php

namespace App\Filament\Resources\BestDealPropertyResource\Pages;

use App\Filament\Resources\BestDealPropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBestDealProperties extends ManageRecords
{
    protected static string $resource = BestDealPropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
