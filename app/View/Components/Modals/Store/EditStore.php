<?php

namespace App\View\Components\Modals\Store;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditStore extends Component
{
    /**
     * Create a new component instance.
     */
    public $store;

    public function __construct($store)
    {

       return $this->store = $store;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.store.edit-store');
    }
}
