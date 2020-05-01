<div class="px-4 pt-4 pb-12 bg-white">
    <div class="text-center mt-8">
        <div class="text-2xl mx-auto w-1/2">
            <i class="fa fa-user-alt fa-4x text-gray-600 mb-2"
            aria-hidden="true"></i>
        </div>

        <div class="font-medium mb-2 mt-2 text-gray-500" style="font-size: 20px">
            {{ $customerName }}
        </div>
    </div>
</div>

<div class="profile-usermenu list-group list-group-flush text-lg tracking-tight">
    <a href="#" class="list-group-item list-group-item-action py-2
    text-gray-600">
        My profile
    </a>
    <a href="{{ $ordersIndexRoute }}"
    class="list-group-item list-group-item-action py-2 text-gray-600
    {{ Request::is('users/*/orders') ? 'active' : '' }}"
    >
        My orders
    </a>
    <a href="#" class="list-group-item list-group-item-action py-2 text-gray-600">
        My address book
    </a>
    <a href="{{ route('shopping.cart.index') }}"
    class="list-group-item list-group-item-action py-2 text-gray-600
    {{ Request::is('shopping-cart/*') ? 'active' : '' }}"
    >
        My cart
    </a>
</div>