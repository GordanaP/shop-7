<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use Illuminate\Http\RedirectResponse;

class UserRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('ratings.index', compact('user'));
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
    public function show(User $user, Product $product)
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
     * @return \Illuminate\Http\Response
     */
    public function update(RatingRequest $request, User $user, Product $product)
    {
        $product->toggleUserRating($user, $request->validated()['rating']);

        if($request->ajax()) {
            return response([
                'success' => 'Thank you for rating the product.'
            ]);
        } else {
            return back()->with('success', 'Thank you for rating the product.');
        }
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
