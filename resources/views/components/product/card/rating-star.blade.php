<i class="fa fa-star

    {{ $product->avgRating() <= $i ? 'text-gray-400' : 'text-gray-600' }}

    @authNotRated($product)
        hover:text-gray-800
    @endauthNotRated

"></i>