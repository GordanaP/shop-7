<div class="profile-sidebar">
    <div class="profile-avatar">
        <x-sidebar.profile-avatar
            :profileName="Auth::user()->customer->name"
        />
    </div>

    <div class="profile-usermenu list-group list-group-flush text-lg tracking-tight">
        <x-sidebar.profile-list-item title="My profile" />

        <x-sidebar.profile-list-item
            :route="route('users.orders.index', Auth::user())"
            request="users/*/orders"
            title="My orders"
        />

        <x-sidebar.profile-list-item title="My address book" />

        <x-sidebar.profile-list-item
            :route="route('shopping.cart.index')"
            request="shopping-cart/*"
            title="My cart"
        />
    </div>
</div>