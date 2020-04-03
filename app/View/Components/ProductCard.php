<?php

namespace App\View\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    /**
     * The product.
     *
     * @var \App\Product
     */
    public $product;

    /**
     * Create a new component instance.
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.product.card');
    }
}
