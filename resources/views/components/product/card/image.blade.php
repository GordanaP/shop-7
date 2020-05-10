@props(['product'])

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
