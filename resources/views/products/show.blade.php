<x-layouts.app>

@section('links')
    <style type="text/css">
        .product--info { position: relative }
        .product--info::before {
            content: ""; position: absolute; border: 1px solid #eee;
            left: -2rem;  top: 1px; bottom: 1px
        }
    </style>
@endsection

<x-partials.page-header title="{{ $product->title }}">
    <x-alert.success />
</x-partials.page-header>

<div class="mx-4 p-4 mt-1" style="background-color: #E9ECF3;">

    <div class="card card-body p-12">

        <div class="row">
            <div class="col-md-5">
                <x-product.card.image
                    :product="$product"
                    id="mainImage"
                    class="rounded-lg"
                />
            </div>

            <div class="col-md-1 pr-10">
                <x-product.thumbnails :product="$product" />
            </div>

            <div class="col-md-6 lg:pl-6">
                <div class="product--info h-full">
                    <div class="caption">
                        <x-product.card.rating
                            :user="Auth::user()"
                            :product="$product"
                        />

                        <h4 class="font-light mb-2 text-2xl">
                            {{ Str::ucfirst($product->title ) }}
                        </h4>

                        <x-product.card.price
                            :productIsBeingPromoted="$product->isCurrentlyBeingPromoted()"
                            :promotionName="Present::promotionFullName($product)"
                            :regularPrice="Present::price($product->price_in_cents)"
                            :promotionalPrice="Present::price($product->promotional_price_in_cents)"
                        />

                        <p class="text-base text-gray-500 lg:w-4/5 mt-3">
                            {{ $product->description }}
                        </p>

                        <x-product.categories-list :product="$product" />
                    </div>

                    <div class="lg:w-1/3 mt-4">
                        <x-cart.add-item :product="$product" />
                    </div>
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