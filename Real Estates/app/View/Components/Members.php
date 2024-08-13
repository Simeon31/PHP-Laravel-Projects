<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Members extends Component
{
    public $member;

    /**
     * Create a new component instance.
     *
     * @param  mixed $member
     * @return void
     */
    public function __construct($member)
    {
        $this->member = $member;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.members');
    }
}
