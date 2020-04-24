<x-layouts.app>

@php
  // $product =  \App\Product::first();
  // $product =  \App\Product::find(2);
  $product =  \App\Product::find(3);
@endphp

<h1 class="my-4">Product Image Test</h1>

<div class="row">
    @foreach ($product->images as $image)
    <div class="col-md-3">
        <div class="card mb-4 box-shadow">
            <img src="{{ $product->thumbnailImage($image) }}">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group mx-auto">
                        <form action="{{ route('products.images.destroy', [$product, $image]) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-secondary rounded-none">
                                Delete
                            </button>
                        </form>

                        <form action="{{ route('products.images.update', [$product, $image]) }}"
                            method = "POST">

                            @csrf
                            @method('PATCH')

                            <button type="submit" name="status_key" value='main'
                            class="btn btn-sm rounded-none
                            {{ $image->is_main ? 'btn-info text-white' : 'btn-outline-info' }}">
                                Main
                            </button>
                        </form>
                    </div>
                </div>

                <form action="{{ route('products.images.update', [$product, $image]) }}"
                method="POST" enctype="multipart/form-data" >

                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <input type="file" name="image" />
                    </div>

                    <button type="submit" class="btn btn-warning">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

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
</form>
</x-layouts.app>