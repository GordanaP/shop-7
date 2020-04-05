<x-layouts.app>

    <x-alert.success />

    <div class="card card-body p-12">
        <div class="row">
            <div class="col-md-6">
                <div>
                     <img class="img-fluid rounded-lg"
                     src="{{ asset('images/demo_product_1.jpg') }}"
                     alt="Product image">
                </div>
            </div>
            <div class="col-md-6 lg:pl-6">
                <div class="caption">
                    <h4 class="font-light my-2 text-lg">
                        {{ ucfirst($product->title ) }}
                    </h4>

                    <p class="font-medium text-sm">
                        {{ $product->price }}
                    </p>

                    <p class="text-sm text-gray-500 mt-2 lg:w-4/5">
                        {{ $product->description }}
                    </p>
                </div>

                <div class="lg:w-1/3 mt-2">
                    <x-cart.add-item :product="$product" />
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>