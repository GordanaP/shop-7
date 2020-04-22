<x-layouts.app>

    <div class="mt-4">
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
                        <h4 class="font-light mb-2 text-2xl">
                            {{ Str::ucfirst($product->title ) }}
                        </h4>

                        <p class="font-medium text-base mb-3">
                            {{ $product->price }}
                        </p>

                        <p class="text-base text-gray-500 mb-3 lg:w-4/5">
                            {{ $product->description }}
                        </p>

                        <p class="mb-4">
                            <span class="uppercase text-gray-700 text-xs
                            tracking-wider">
                                Categories:
                            </span>

                            <x-product.categories-list
                                :productCategories="$product->categories"
                            />
                        </p>
                    </div>

                    <div class="lg:w-1/3">
                        <x-cart.add-item :product="$product" />
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>