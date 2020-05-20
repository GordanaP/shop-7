<?php

namespace App\Http\Controllers\Shipping;

use App\Shipping;
use Illuminate\Http\Request;
use App\Utilities\Orders\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class ShippingController extends Controller
{
    /**
     * The address.
     *
     * @var App\Utilities\Orders\Address
     */
    private $address;

    /**
     * Make a new class instance.
     *
     * @param App\Utilities\Orders\Address $address
     */
    public function __construct(Address $address)
    {
        $this->address = $address;

    }

    /**
     * Store the address into the session.
     *
     * @param  App\Shipping|null $shipping
     */
    public function store(Shipping $shipping = null): RedirectResponse
    {
        //

        return redirect()->route('checkouts.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AddressRequest  $request
     * @param  \App\Shipping  $shipping
     */
    public function update(AddressRequest $request, Shipping $shipping): RedirectResponse
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
