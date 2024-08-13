<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{

    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            Stat::make(label: __('Total Visits'), value: "100k")
            ->description(description: 'Increase')
            ->descriptionIcon(icon: 'heroicon-m-arrow-trending-up')
            ->color(color: 'success'),

            Stat::make(label: __('Sales'), value: '10k')
            ->description(description: 'Decrease')
            ->descriptionIcon(icon: 'heroicon-m-arrow-trending-down')
            ->color(color: 'danger')
        ];
    }
}
