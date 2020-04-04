<form action="{{ route('shopping.cart.store', $product) }}" method="POST">

    @csrf

    @if (Request::route('product'))
        <div class="form-group">
            <input type="text" name="quantity" id="quantity"
            class="form-control text-center mt-4" value="1">
        </div>
    @endif

    <button type="submit"
        {{ Request::route('product') ? '' : $attributes->merge(['class' => 'btn-sm']) }}>
        <i class="fas fa-shopping-cart fa-sm"></i> Add to cart
    </button>
</form>