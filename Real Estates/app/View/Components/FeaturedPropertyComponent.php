<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\FeaturedProperty;

class FeaturedPropertyComponent extends Component
{
    /**
     * Create a new component instance.
     */

     public $property;

     public function __construct()
     {
         $this->property = FeaturedProperty::getActiveFeaturedProperty();
     }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.featured-property');
    }
}
