<div class="col-md-4">
    <div class="card mb-3 box-shadow">

        <a href="{{ route('products.show', $product) }}">
            <x-product.image
                :product="$product"
                class="card-img-top"
            >
                @if ($product->isCurrentlyBeingPromoted())
                    <div class="absolute rounded-full px-1 py-2 bg-warning p-1 right-0 top-0
                        text-lg font-semibold uppercase">
                        <p>{{ $product->currentPromotion()->name() }}</p>
                    </div>
                @endif

            </x-product.image>
        </a>

        <div class="card-body">
            <h5 class="font-semibold mb-3">
                <a href="{{ route('products.show', $product) }}">
                    {{ $product->title }}
                </a>
            </h5>
            <p class="card-text text-muted mb-3">
                {{ $product->subtitle }}
            </p>

            <div class="flex justify-between items-end">
                <div class="btn-group">
                    <x-cart.add-item
                        :product="$product"
                        class="btn-sm"
                    />
                </div>

                <div >
                    <x-product.price
                        :productIsBeingPromoted="$product->isCurrentlyBeingPromoted()"
                        :regularPrice="Present::price($product->price_in_cents)"
                        :promotionalPrice="Present::price($product->promotional_price_in_cents)"
                    />
                </div>
            </div>
        </div>
    </div>
</div>