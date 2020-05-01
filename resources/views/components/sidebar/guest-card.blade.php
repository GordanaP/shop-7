<div class="guest-sidebar">
    <div class="px-4 py-16 bg-white">
        <div class="text-center mt-8">
            @if (Request::is('shopping-cart/*'))
                <div class="text-2xl">
                    <i class="fa fa-shopping-basket fa-4x text-gray-600 mb-2"
                    aria-hidden="true"></i>
                </div>

                <div class="font-medium mb-2 text-gray-500" style="font-size: 20px">
                        My Cart
                </div>
            @endif
        </div>
    </div>
</div>