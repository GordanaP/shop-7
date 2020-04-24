<x-layouts.app>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

{{-- <div class="text-center">
    <div class="form-check form-check-inline">
        <input class="form-check-input"
        type="radio"
        name="main_image"
        value="{{ $image->id }}" {{ $image->is_main ? 'checked' : '' }}>
        @if ($image->is_main)
            <label class="form-check-label">
                Main image
            </label>
        @endif
    </div>
</div>

<img src="{{ $product->thumbnailImage($image) }}">

<div class="text-center">
    <div class="form-check form-check-inline">
        <input class="form-check-input"
        type="checkbox"
        name="delete_images[]"
        value="{{ $image->id }}">
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <button type="submit" name="manage_image" class="btn btn-danger btn-block"
            value="delete"
        >
            Delete
        </button>
    </div>
</div> --}}
{{--
<form action="{{ route('products.images.store', $product) }}"
method="POST" enctype="multipart/form-data"
class="border border-gray-500 p-4">

    @csrf

    <div class="form-group">
        <input type="file" name="images[]" multiple="" />
    </div>

    <button type="submit" class="btn btn-warning">
        Submit
    </button>
</form> --}}