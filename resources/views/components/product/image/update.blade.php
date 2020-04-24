<form
action="{{ route('products.images.update', [$product, $image]) }}"
method="POST"
enctype="multipart/form-data" >

    @csrf
    @method('PATCH')

    <div class="form-group">
        <input type="file" name="image" />
    </div>

    <button type="submit" class="btn btn-block btn-sm btn-warning">
        Change
    </button>
</form>