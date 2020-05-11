<div class="mb-2">
    @auth
        <form action="{{ route('users.products.ratings.update', [$user, $product]) }}" method="POST">

            @csrf
            @method('PUT')
    @endauth
            <div class="flex items-center">
                <div class="rating mr-2">
                    @for ($i = 0; $i < 5 ; $i++)
                        <button name="rating" value="{{ $i+1 }}" class="text-lg
                        {{ (Auth::check() ? $product->userRating(Auth::user()) : $product->avgRating()) <= $i ? 'text-gray-400' : 'text-gray-700' }}
                        ">
                            <span>&#9733;</span>
                        </button>
                    @endfor
                </div>

                @if ($product->isRatedByUser($user))
                    <div class="ml-2 text-gray-600">
                        Avg: {{ Present::rating($product->avgRating()) }}
                    </div>
                @endif
            </div>
    @auth
        </form>
    @endauth
</div>