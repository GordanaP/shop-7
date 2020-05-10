@foreach ($product->images as $image)
    <div class="flex flex-col justify-between">
        <div class="1/4 mb-2">

            <x-product.card.image
                :product="$product"
                id="mainImage"
                class="rounded-sm thumbnail"
            />

        </div>
    </div>
@endforeach