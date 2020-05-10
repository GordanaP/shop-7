<div class="bg-gray-100 p-4">
    @foreach ($product->images->chunk(2) as $chunk)
        <div class="row">
            @foreach ($chunk as $image)
            <div class="col-md-6">
                <div class="card mb-4 box-shadow">

                    <a href="{{ route('products.show', $product) }}">
                        <img
                            src="{{ $product->mainImage() }}"
                            id="{{ $id ?? null }}"
                            class="card-img-top img-fluid relative"
                            alt="Product image"
                        />

                        @if (Request::is('/') && $product->isCurrentlyBeingPromoted())
                            <div class="absolute rounded-full px-1 py-2 bg-warning
                            right-0 top-0 text-lg font-semibold uppercase">
                                <p>{{ $product->currentPromotion()->name() }}</p>
                            </div>
                        @endif
                    </a>

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group mx-auto">
                                <x-product.image.delete
                                    :product="$product"
                                    :image="$image"
                                />

                                <x-product.image.set-main
                                    :product="$product"
                                    :image="$image"
                                />

                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-xs">
                        <x-product.image.update
                            :product="$product"
                            :image="$image"
                        />
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endforeach

    @if ($product->images->count() < 4)
        <div class="row">
            <div class="col-md-12">
                <x-product.image.add
                    :product="$product"
                />
            </div>
        </div>
    @endif
</div>