<?php

namespace App\Http\Controllers\Shipping;

use App\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\RedirectResponse;

class ShippingController extends Controller
{
    public function store(Request $request, Shipping $shipping = null)
    {
        // return $shipping;
        if($shipping) {
            \Session::forget('is_billing');
            \Session::put('shipping_id', $shipping->id);
        } else {
            \Session::forget('shipping_id');
            \Session::put('is_billing', 1);
        }

        return redirect()->route('checkouts.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AddressRequest  $request
     * @param  \App\Shipping  $shipping
     */
    public function update(AddressRequest $request, Shipping $shipping)
    {
        $shipping->update($request->validated());

        return back()->with('success', 'The shipping address has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipping  $shipping
     */
    public function destroy(Shipping $shipping): RedirectResponse
    {
        $shipping->delete();

        return back()->with('success', 'The shipping address has been deleted.');
    }
}
