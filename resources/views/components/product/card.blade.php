@section('links')
    <style type="text/css">
        .product-card { box-shadow: 0 0 16px rgba(0,0,0,0.3); }
        .product-card-body { min-height:220px }
        .rating-box { direction: rtl; }
        /*.rating-box button { font-size: 20px; }*/
        .rating-box button:hover { color: #4a5568; cursor: pointer }
        .b1:hover ~ button { color: #4a5568; }
        .b2:hover ~ button { color: #4a5568; }
        .b3:hover ~ button { color: #4a5568; }
        .b4:hover ~ button { color: #4a5568; }
        .b5:hover ~ button { color: #4a5568; }
    </style>
@endsection

<div class="col-md-4">
    <div class="card product-card mb-10">
        <x-product.card.image :product="$product" />

        <div class="product-card-body mx-3 mb-3 mt-2 flex flex-col justify-between">
            <div>
                <div class="mb-2">
                    @auth
                        <form action="{{ route('users.products.ratings.update', [Auth::user(), $product]) }}" method="POST">

                            @csrf
                            @method('PUT')
                    @endauth
                            <div class="flex items-center">
                                <div class="rating-box">
                                    @for ($i = 5; $i>0 ; $i--)
                                        <button
                                            name="rating"
                                            value="{{ $i }}"
                                            class="b{{ $i }} {{ (Auth::check() ? $product->userRating(Auth::user()) : $product->avgRating()) >= $i ? 'text-gray-700' : 'text-gray-400' }}"
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

                <x-product.card.title :product="$product" />
            </div>

            <div>
                <x-product.card.price
                    :productIsBeingPromoted="$product->isCurrentlyBeingPromoted()"
                    :regularPrice="Present::price($product->price_in_cents)"
                    :promotionalPrice="Present::price($product->promotional_price_in_cents)"
                />

                <x-cart.add-item
                    :product="$product"
                    class="btn-sm text-base"
                />
            </div>
        </div>
    </div>
</div>