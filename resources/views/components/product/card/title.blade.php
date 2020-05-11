<h4 class="mb-2 mt-1">
    <a href="{{ route('products.show', $product) }}"
    class="hover:text-red-dark hover:no-underline">
        {{ $product->title }}
    </a>
</h4>
<p class="card-text text-gray-600 mb-3">
    {{ $product->subtitle }}
</p>