<?php

namespace App\Filament\Resources\PropertyResource\Pages;

use App\Filament\Resources\PropertyResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditProperty extends EditRecord
{
    protected static string $resource = PropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make()
                ->action(function ($data, $record) {

                    if ($record->posts()->count() > 0) {
                        Notification::make()
                            ->danger()
                            ->title('Cannot Delete Property')
                            ->body('This property has related post/s and cannot be deleted.')
                            ->send();

                        return;
                    }

                    if ($record->featuredProperty()->exists()) {
                        Notification::make()
                            ->danger()
                            ->title('Cannot Delete Property')
                            ->body('This property has related featured property and cannot be deleted.')
                            ->send();
                        return;
                    }

                    if ($record->bestDealProperties()->count() > 0) {
                        Notification::make()
                            ->danger()
                            ->title('Cannot Delete Property')
                            ->body('This property has related best deal property and cannot be deleted.')
                            ->send();

                        return;
                    }

                    $record->delete();

                    Notification::make()
                        ->success()
                        ->title('Property Deleted Successfully')
                        ->send();
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
