<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class UserProductRatingAjaxController extends Controller
{
    public function __invoke(User $user)
    {
        $products = $user->products->load('currentPromotions');

        return ProductResource::collection($user->products);
    }
}
