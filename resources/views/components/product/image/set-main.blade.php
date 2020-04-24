<form
    action="{{ route('products.images.update', [$product, $image]) }}"
    method = "POST"
>

    @csrf
    @method('PATCH')

    <button type="submit"
        name="status_key"
        value='main'
        class="btn btn-sm rounded-none
        {{ $image->is_main ? 'btn-info text-white' : 'btn-outline-info' }}"
    >
        Main
    </button>

</form>