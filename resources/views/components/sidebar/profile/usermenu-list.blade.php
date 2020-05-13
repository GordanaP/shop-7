<div class="profile-usermenu list-group list-group-flush
text-lg tracking-tight mt-8">

    <x-sidebar.profile.usermenu-list-item title="My profile" />

    <x-sidebar.profile.usermenu-list-item
        :route="route('users.orders.index', Auth::user())"
        request="users/*/orders"
        title="My orders"
    />

    <x-sidebar.profile.usermenu-list-item
        :route="route('users.products.ratings.index', Auth::user())"
        request="users/*/products/ratings"
        title="My ratings"
    />

    <x-sidebar.profile.usermenu-list-item
        :route="route('users.favorites.index', Auth::user())"
        request="users/*/favorites"
        title="My favorites"
    />

    <x-sidebar.profile.usermenu-list-item title="My address book" />

</div>