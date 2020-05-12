<form action="{{ $route }}" method="POST">

    @csrf
    @method('PATCH')

    <div class="mx-auto flex">
        <div class="form-group">
            <input type="text" name="quantity"
            class="form-control text-center"
            value="{{ $item->quantity }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn">
                <i class="fas fa-sync-alt text-gray-700"></i>
            </button>
        </div>
    </div>

</form>
