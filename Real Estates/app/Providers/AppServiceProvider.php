<?php

namespace App\Providers;

use App\Models\Property;
use App\View\Components\BestDealPropertyComponent;
use App\View\Components\FeaturedPropertyComponent;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      
    }
}
