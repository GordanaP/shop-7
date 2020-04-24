<div class="bg-gray-100 p-4">
    @foreach ($product->images->chunk(2) as $chunk)
        <div class="row">
            @foreach ($chunk as $image)
            <div class="col-md-6">
                <div class="card mb-4 box-shadow">

                    <x-product.image
                        :image="$product->thumbnailImage($image)"
                    />

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