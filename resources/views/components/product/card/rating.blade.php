@authNotRated($product)
    <form action="{{ route('users.products.ratings.store', [$user, $product]) }}" method="POST">

        @csrf
@endauthNotRated

        @for ($i = 0; $i < 5 ; $i++)
            <button name="rating" value="{{ $i+1 }}">
                <i class="fa fa-star
                    {{ $product->avgRating() <= $i ? 'text-gray-700' : 'text-warning' }}
                    @authNotRated($product)
                        hover:text-yellow-500
                    @endauthNotRated
                "></i>
            </button>
        @endfor

        @if ($product->isRatedByUser($user))
            <span class="ml-2 text-gray-600">
                Your rate: {{ $product->userRating($user) }} / 5
            </span>
        @endif
@authNotRated($product)
    </form>

@endauthNotRated