<div class="mb-2">
    @auth
        <form action="{{ route('users.products.ratings.update', [$user, $product]) }}"
        method="POST">

            @csrf
            @method('PUT')
    @endauth
            <div class="flex items-center">
                <div class="rating-box">
                    @for ($i = 5; $i>0 ; $i--)
                        <button
                            name="rating"
                            value="{{ $i }}"
                            class="b{{ $i }} shadow-none
                            {{ (Auth::check() ? $product->userRating(Auth::user())
                                : $product->avgRating()) >= $i
                                ? 'text-gray-700' : 'text-gray-400' }}"
                        >
                            <i class="fa fa-star text-xs"></i>
                        </button>
                    @endfor
                </div>

                @auth
                @if ($product->isRatedByAnyUser() )
                    <div class="ml-2 text-gray-600">
                        Avg: {{ Present::rating($product->avgRating()) }}
                    </div>
                @endif
                @endauth
            </div>
    @auth
        </form>
    @endauth
</div>