<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserFavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\User  $user
     */
    public function index(User $user): View
    {
        return view('favorites.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Product $product)
    {
        $user->togglesFavoriting($product);

        if($request->ajax()) {
            return response([
                'success' => 'Thank you for rating the product.'
            ]);
        } else {
            return back();
        }
    }

}
