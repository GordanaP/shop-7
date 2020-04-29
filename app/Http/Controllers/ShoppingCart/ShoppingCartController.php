<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Product;
use Illuminate\View\View;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\QuantityRequest;

class ShoppingCartController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items = ShoppingCart::content();

        return view('carts.index')->with([
            'items' => $items,
            // 'coupon_value' => ShoppingCart::coupon()['value'],
            // 'discount' => ShoppingCart::coupon()['discount'],
            // 'tax_rate' => config('cart.tax_rate') * 100,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \App\Http\Requests\QuantityRequest $request
     * @param  \App\Product  $product
     */
    public function store(QuantityRequest $request, Product $product): RedirectResponse
    {
        ShoppingCart::add($product, $request->validated()['quantity'] ?? 1);

        return back()->with('success', 'The product has been added to cart.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \App\Http\Requests\QuantityRequest $request
     * @param  \App\Product  $product
     */
    public function update(QuantityRequest $request, Product $product)
    {
        ShoppingCart::update($product, $request->validated()['quantity']);

        return back()->with('success', 'The cart has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     */
    public function destroy(Product $product): RedirectResponse
    {
        ShoppingCart::remove($product->id);

        return back()->with('success', 'The product has been removed from cart.');
    }

    /**
     * Remove all specified resources from storage.
     */
    public function empty(): RedirectResponse
    {
        ShoppingCart::empty();

        return redirect()->route('welcome')
            ->with('success', 'Your cart is empty.');
    }
}
