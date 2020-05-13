<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class UserProductRatingAjaxController extends Controller
{
    public function __invoke(User $user)
    {
        return ProductResource::collection($user->ratings);
    }
}
