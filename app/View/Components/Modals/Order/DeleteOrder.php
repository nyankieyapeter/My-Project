<?php

namespace App\View\Components\Modals\Order;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteOrder extends Component
{
    /**
     * Create a new component instance.
     */
    public $order;

    public function __construct($order)
    {
        return $this->order = $order;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.order.delete-order');
    }
}
