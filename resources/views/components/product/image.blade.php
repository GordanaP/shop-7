@props(['product'])

<img
    src="{{ $product->mainImage() }}"
    id="{{ $id ?? null }}"
    {{ $attributes->merge(['class' => 'img-fluid relative']) }}
    alt="Product image"
/>

{{ $slot }}