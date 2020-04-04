<form action="{{ route('shopping.cart.store', $product) }}" method="POST">

    @csrf

    <button type="submit" class="btn btn-sm btn-success">
        <i class="fas fa-shopping-cart fa-sm"></i> Add to cart
    </button>
</form>