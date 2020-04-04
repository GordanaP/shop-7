<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items = ShoppingCart::content();

        return view('carts.index', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Request $request
     * @param  \App\Product  $product
     */
    public function store(Request $request, Product $product): RedirectResponse
    {
        ShoppingCart::add($product, $request->quantity ?? 1);

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Request $request
     * @param  \App\Product  $product
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        ShoppingCart::update($product, $request->quantity);

        return back();
    }

    /**
     * Remove all specified resources from storage.
     */
    public function empty(): RedirectResponse
    {
        ShoppingCart::empty();

        return back();
    }
}
