<?php

namespace App\Filament\Resources\StaffRolesResource\Pages;

use App\Filament\Resources\StaffRolesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageStaffRoles extends ManageRecords
{
    protected static string $resource = StaffRolesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
