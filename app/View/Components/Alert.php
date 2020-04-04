<?php

namespace App\View\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * The product.
     *
     * @var \App\Product
     */
    public $type;

    /**
     * Create a new component instance.
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.alert');
    }
}
