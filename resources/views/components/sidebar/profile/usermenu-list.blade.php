
<div class="profile-usermenu list-group list-group-flush
text-lg tracking-tight mt-8">

    <x-sidebar.profile.usermenu-list-item
        :title="Auth::user()->customer ? 'My profile' : 'Create profile'"
        :route="Auth::user()->customer
        ? route('users.customers.edit', [Auth::user(), Auth::user()->customer])
        : route('users.customers.create', Auth::user())"
    />

    <x-sidebar.profile.usermenu-list-item
        :route="route('users.orders.index', Auth::user())"
        request="users/*/orders"
        title="My orders"
    />

    <x-sidebar.profile.usermenu-list-item
        :route="route('users.ratings.index', Auth::user())"
        request="users/*/ratings"
        title="My ratings"
    />

    <x-sidebar.profile.usermenu-list-item
        :route="route('users.favorites.index', Auth::user())"
        request="users/*/favorites"
        title="My favorites"
    />

    <x-sidebar.profile.usermenu-list-item
        :route="route('users.shippings.index', Auth::user())"
        request="users/*/shippings"
        title="My address book"
    />

</div>