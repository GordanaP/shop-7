<form action="{{ route('shopping.cart.remove', $item) }}" method="POST">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn pt-0">
        <i class="far fa-lg fa-trash-alt text-gray-700"></i>
    </button>

</form>