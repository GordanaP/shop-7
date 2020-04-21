<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Filters\ProductFiltersMap;

class ProductFiltersMapComposer
{
    /**
     * Compose the view containing the product filters map.
     *
     * @param  Illuminate\View\View  $view
     */
    public function compose(View $view)
    {
        $view->with([
            'filters' => ProductFiltersMap::filters()
        ]);
    }
}