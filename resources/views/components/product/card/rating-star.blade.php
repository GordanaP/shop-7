<i class="fa fa-star

    {{ (Auth::check() ? $product->userRating(Auth::user()) : $product->avgRating()) <= $i ? 'text-gray-400' : 'text-gray-600' }}
"></i>