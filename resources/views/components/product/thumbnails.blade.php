@foreach ($product->images as $image)
    <div class="flex flex-col justify-between">
        <div class="1/4 mb-2">

            <x-product.image
                :image="$product->thumbnailImage($image)"
                class="rounded-sm thumbnail"
            />

        </div>
    </div>
@endforeach