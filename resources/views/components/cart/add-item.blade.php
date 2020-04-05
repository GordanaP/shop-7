@props(['product'])

<form action="{{ route('shopping.cart.store', $product) }}" method="POST">

    @csrf

    @if (Request::route('product'))
        <div class="form-group">
            <input type="text" name="quantity" id="quantity"
            class="form-control text-center mt-4" value="1">

            <x-error field="quantity" />
        </div>
    @endif

    <button
        type="submit"
        {{ $attributes->merge(['class' => 'btn btn-success w-full rounded-full']) }}
    >
        <i class="fas fa-shopping-cart fa-sm"></i> Add to cart
    </button>
</form>