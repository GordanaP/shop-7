<span class="flex justify-between">
    <form action="{{ route('shopping.cart.update', $item) }}"
        method="POST">

        @csrf
        @method('PATCH')

        <div class="mx-auto flex">
            <div class="form-group">
                <input type="text" name="quantity" id="quantity"
                class="form-control text-center"
                value="{{ $item->quantity }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>

    </form>
</span>