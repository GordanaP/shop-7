<x-layouts.app>

    <x-alert.message />

    @if (ShoppingCart::isNotEmpty())
        <div class="float-right mb-2">
            <x-product.go-shopping-btn />
        </div>

        <div class="clearfix"></div>

        <div class="bg-white p-4 border mb-2">
            <table class="table border mb-0 ordered-items">
                <thead>
                    <th width="15%">Item</th>
                    <th width="25%"></th>
                    <th class="text-center" width="20%">Price</th>
                    <th class="text-center" width="15%">Qty</th>
                    <th class="text-right" width="15%">Subtotal</th>
                    <th class="text-right"><i class="fa-fa-cog"></i></th>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                        <x-cart.item :item="$item" />
                    @endforeach

                    <x-cart.price />

                </tbody>
            </table>
        </div>

        <div class="float-right mb-2">
            <x-cart.empty />
            <a href="#" class="btn btn-primary rounded-full">
                Proceed to checkout
            </a>
        </div>
    @else
        <h2 class="text-center mb-4">Your cart is empty at present.</h2>
        <div class="text-center">
            <x-product.go-shopping-btn />
        </div>
    @endif

</x-layouts.app>