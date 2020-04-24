<form
action="{{ route('products.images.store', $product) }}"
method="POST"
enctype="multipart/form-data"
class="border border-gray-500 p-4" >

    @csrf

    <div class="flex items-center justify-center">
        <input type="file" name="images[]" multiple="" />

        <button type="submit" class="btn bg-teal-400 text-white">
            Submit
        </button>
    </div>
</form>