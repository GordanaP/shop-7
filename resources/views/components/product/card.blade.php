<div class="col-md-4">
    <div class="card mb-3 box-shadow">

        <a href="{{ route('products.show', $product) }}">
            <x-product.image
                :image="$product->mainImage()"
                class="card-img-top"
            />
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
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <x-cart.add-item
                        :product="$product"
                        class="btn-sm"
                    />
                </div>

                <div>{{ $product->price }}</div>
            </div>
        </div>
    </div>
</div>