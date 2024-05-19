<?php

namespace App\View\Components\Modals\Product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditProduct extends Component
{
    /**
     * Create a new component instance.
     */

    public $product;

    public function __construct($product)
    {
       return $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.product.edit-product');
    }
}
