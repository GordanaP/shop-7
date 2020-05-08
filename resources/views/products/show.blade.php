<x-layouts.app>

    <div class="mt-4">
        <x-alert.success />

        <div class="card card-body p-12">
            <div class="row">
                <div class="col-md-5">
                    <x-product.image
                        :image="$product->mainImage()"
                        id="mainImage"
                        class="rounded-lg"
                    />
                </div>

                <div class="col-md-1">
                    <x-product.thumbnails :product="$product" />
                </div>

                <div class="col-md-6 lg:pl-6">
                    <div class="caption">
                        <x-product.categories-list :product="$product" />

                        <h4 class="font-light mb-2 text-2xl">
                            {{ Str::ucfirst($product->title ) }}
                        </h4>

                        <p class="font-medium text-base mb-3">
                            {{ Present::price($product->price_in_cents) }}
                        </p>

                        <p class="text-base text-gray-500 lg:w-4/5">
                            {{ $product->description }}
                        </p>
                    </div>

                    <div class="lg:w-1/3 mt-4">
                        <x-cart.add-item :product="$product" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            var mainImage = $('#mainImage');
            var thumbnails = $('.thumbnail');

            thumbnails.switchToMainImage(mainImage);

        </script>
    @endsection

</x-layouts.app>