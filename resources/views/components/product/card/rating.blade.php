    <div class="mb-2">
    @auth
        <form action="{{ route('users.products.ratings.update', [$user, $product]) }}" method="POST">

            @csrf
            @method('PUT')
    @endauth

            @for ($i = 0; $i < 5 ; $i++)
                <button name="rating" value="{{ $i+1 }}">

                    <x-product.card.rating-star
                        :i="$i"
                        :product="$product"
                    />

                </button>
            @endfor

            @if ($product->isRatedByUser($user))
                <span class="ml-2 text-gray-600">
                    Avg: {{ Present::rating($product->avgRating()) }}
                </span>
            @endif

    @auth
        </form>
    @endauth
</div>