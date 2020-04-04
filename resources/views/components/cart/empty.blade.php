<form action="{{ route('shopping.cart.empty') }}" method="POST" class="inline">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-outline-secondary rounded-full" >
        Empty cart
    </button>
</form>