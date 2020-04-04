<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Product;
use Illuminate\Http\Request;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;

class ShoppingCartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Request $request
     * @param  \App\Product  $product
     */
    public function store(Request $request, Product $product)
    {
        ShoppingCart::add($product, $request->quantity ?? 1);

        return back();
    }

    /**
     * Remove all specified resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function empty()
    {
        ShoppingCart::empty();

        return back();
    }
}
