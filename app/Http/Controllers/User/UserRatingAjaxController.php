<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class UserRatingAjaxController extends Controller
{
    public function __invoke(User $user)
    {
        $ratedProducts = $user->ratedProducts->load('currentPromotions');

        return ProductResource::collection($user->ratedProducts);
    }
}
