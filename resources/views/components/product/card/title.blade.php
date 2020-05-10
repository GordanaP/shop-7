<h4 class="mb-2 mt-1">
    <a href="{{ route('products.show', $product) }}"
    class="hover:text-teal-500 no-underline">
        {{ $product->title }}
    </a>
</h4>
<p class="card-text text-muted mb-3">
    {{ $product->subtitle }}
</p>