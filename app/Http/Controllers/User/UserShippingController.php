<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Shipping;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CheckoutRequest;

class UserShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user): View
    {
        return view('shippings.index')->with([
            'user' => $user ?? Auth::user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('shippings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(AddressRequest $request, User $user)
    {
        $user->addShippingAddress($request->validated());

        return back()->with('success', 'The new shipping address has been added to your address book');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     */
    public function show(User $user): View
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     */
    public function edit(User $user, Shipping $shipping): View
    {
        return view('shippings.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     */
    public function update(Request $request, User $user, Shipping $shipping = null)
    {
        $user->manageDefaultShipping($shipping);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     */
    public function destroy(User $user): RedirectResponse
    {
        //
    }
}
