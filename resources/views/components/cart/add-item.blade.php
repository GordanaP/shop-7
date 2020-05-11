@props(['product'])

<form action="{{ route('shopping.cart.store', $product) }}" method="POST">

    @csrf

    @if (Request::route('product'))
        <div class="form-group">
            <input type="text" name="quantity" id="quantity"
            class="form-control text-center mt-4" value="1">

            <x-error :errors="$errors" field="quantity" />
        </div>
    @endif

    <button type="submit"
        {{ $attributes->merge(['class' => 'btn rounded-full bg-red-dark hover:bg-red-dark-h text-white w-full']) }}
    >
        <i class="fas fa-shopping-cart fa-sm mr-2"></i>
        <span class="uppercase tracking-wide text-xs">Add to cart</span>
    </button>
</form>