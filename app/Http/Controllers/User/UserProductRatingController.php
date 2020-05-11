<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Rating;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class UserProductRatingController extends Controller
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
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Illuminate\Request  $request
     */
    public function store(Request $request, User $user, Product $product)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RatingRequest  $request
     * @param  \App\User  $user
     * @param  \App\Product  $product
     */
    public function update(RatingRequest $request, User $user, Product $product)
    {
        $product->toggleUserRating($user, $request->validated()['rating']);

        return back()->with('success', 'Thank you for rating the product.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
