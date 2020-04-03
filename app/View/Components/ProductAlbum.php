<?php

namespace App\View\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class ProductAlbum extends Component
{
    /**
     * The products.
     *
     * @var \Illuminate\Support\Collection
     */
    public $products;

    /**
     * Create a new component instance.
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.product.album');
    }
}
