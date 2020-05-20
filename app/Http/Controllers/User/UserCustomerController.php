<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\RedirectResponse;

class UserCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AddressRequest  $request
     * @param  \App\User  $user
     */
    public function store(AddressRequest $request, User $user): RedirectResponse
    {
        $customer = $user->addBillingAddress($request->all());

        return redirect()->route('users.customers.edit', [Auth::user(), $customer])
            ->with('success', 'The profile has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     */
    public function edit(User $user, Customer $customer): View
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AddressRequest  $request
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     */
    public function update(AddressRequest $request, User $user, Customer $customer)
    {
        $customer->update($request->validated());

        return back()->with('success', 'The profile has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Customer $customer)
    {
        $customer->delete();

        return redirect()->route('home')
            ->with('success', 'The profile has been deleted.');

    }
}
