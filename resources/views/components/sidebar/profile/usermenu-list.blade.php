<div class="profile-usermenu list-group list-group-flush
text-lg tracking-tight mt-8">

    <x-sidebar.profile.usermenu-list-item
        :route="route('home')"
        request="/"
        title="Home"
    />

    @if (! Auth::user()->customer)
        <x-sidebar.profile.usermenu-list-item
            :route="route('users.customers.create', Auth::user())"
            request="users/*/customers/create"
            title="Create profile"
        />
    @endif

    @if (Auth::user()->customer)

        <x-sidebar.profile.usermenu-list-item
            :route="route('users.customers.edit', [Auth::user(), Auth::user()->customer])"
            request="users/*/customers/*/edit"
            title="My profile"
        />

        <x-sidebar.profile.usermenu-list-item
            :route="route('users.shippings.index', Auth::user())"
            request="users/*/shippings"
            title="My address book"
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

    @endif

</div>