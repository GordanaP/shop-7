@section('links')
    <style type="text/css">
        .product-card { box-shadow: 0 0 16px rgba(0,0,0,0.3); }
        .product-card-body { min-height:220px }
    </style>
@endsection

<div class="col-md-4">
    <div class="card product-card mb-10">

        <x-product.card.image :product="$product" />

        <div class="product-card-body mx-3 mb-3 mt-2 flex flex-col
        justify-between">
            <div>
                <x-product.card.rating
                    :user="Auth::user()"
                    :product="$product"
                />

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