<x-layouts.app>
    @php
      $product =  \App\Product::first();
    @endphp
    <div class="mt-4">
        <h1 class="mb-4">Product Image Test</h1>


        <div class="col-md-4">

            <div class="row class mb-2">
                @foreach ($product->images as $image)
                    <div class="col-md-3">
                        <img src="{{ $product->getImage($image) }}">
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
        </div>
    </div>
</x-layouts.app>