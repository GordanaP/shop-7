<div class="col-md-4">
    <div class="card product-card mb-10">
        <x-product.card.image :product="$product" />

        <div class="product-card-body mx-3 mb-3 mt-2 flex flex-col justify-between">
            <div>
                <x-product.card.rating-box
                    :user="Auth::user()"
                    :product="$product"
                />

                <form action="{{ route('users.products.favorites.update', [Auth::user(), $product]) }}"
                method="POST">

                    @csrf
                    @method('PUT')

                    <button type="submit" class="focus:outline-none">
                        <i class="fa fa-heart {{ $product->isFavoritedBy(Auth::user())
                            ? 'text-red-carmin' : 'text-gray-400'}} hover:text-red-carmin-h"
                            aria-hidden="true"
                        ></i>
                    </button>
                </form>

                <x-product.card.title :product="$product" />
            </div>

            <div>
                <x-product.card.price
                    :productIsBeingPromoted="$product->isCurrentlyBeingPromoted()"
                    :regularPrice="Present::price($product->price_in_cents)"
                    :promotionalPrice="Present::price($product->promotional_price_in_cents)"
                />

                <x-cart.add-item
                    :product="$product"
                    class="btn-sm text-base"
                />
            </div>
        </div>
    </div>
</div>