<?php

namespace App\Http\Controllers\Shipping;

use App\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\RedirectResponse;

class ShippingController extends Controller
{
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
