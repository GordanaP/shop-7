@foreach ($products->chunk(3) as $chunk)
    <div class="row">
        @foreach ($chunk as $product)
            <x-product-card
                :product="$product"
            />
        @endforeach
    </div>
@endforeach