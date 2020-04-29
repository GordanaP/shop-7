<img
    src="{{ $image }}"
    id="{{ $id ?? null }}"
    {{ $attributes->merge(['class' => 'img-fluid']) }}
    alt="Product image"
/>