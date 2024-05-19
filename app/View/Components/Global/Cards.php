<?php

namespace App\View\Components\Global;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cards extends Component
{
    /**
     * Create a new component instance.
     */

    public $todaySales;

    public function __construct($todaySales)
    {
        return $this->todaySales = $todaySales;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.global.cards');
    }
}
