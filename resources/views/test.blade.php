<x-layouts.app>

@php

  // $product =  \App\Product::first();
  // $product =  \App\Product::find(2);
  $product =  \App\Product::find(3);
  //
  $product->images->count();
@endphp

<div class="container">
    <div class="bg-white px-12 py-8 mt-4">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-2 uppercase-semibold">Edit product</p>

                <form action="#" method="POST"
                class="p-4" style="border: 1px solid #f0f5fa">

                    @csrf

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title"
                        class="form-control"
                        placeholder="Enter name"
                        value="{{ old('name', $product->title) }}" />
                    </div>

                    <div class="form-group">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle"
                        class="form-control"
                        placeholder="Enter name"
                        value="{{ old('subtitle', $product->subtitle) }}" />
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description"
                        class="form-control" rows="3"
                        placeholder="Enter description"
                        >{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Price ({{ config('cart.currency') }})</label>
                        <input type="text" name="price_in_cents" id="priceInCents"
                        class="form-control"
                        placeholder="00.00"
                        value="{{ old('price_in_cents', $product->price_in_cents) }}" />
                    </div>

                    <div class="form-group">
                        <button class="btn btn-block bg-teal-400 text-white">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <p class="mb-2 uppercase-semibold">Manage images</p>

                <x-product.album.manage :product="$product" />
            </div>
        </div>
    </div>
</div>

</x-layouts.app>