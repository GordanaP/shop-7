<form
    action="{{ route('products.images.destroy', [$product, $image]) }}"
    method="POST"
>

    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-sm btn-secondary rounded-none">
        Delete
    </button>

</form>