<x-layouts.app>

    <x-main.page-header title="Home" />

    <div class="mx-4 p-4 mt-8 bg-custom-gray"">
        <div class="row mb-4">
            <x-home.card
                title="My Profile"
                icon="fa-user-alt"
                type="profile"
            />

            <x-home.card
                title="Address Book"
                icon="fa-map-marked"
                :route="route('users.shippings.index', Auth::user())"
            />

            <x-home.card
                title="My Orders"
                icon="fa-cubes"
                :route="route('users.orders.index', Auth::user())"
            />

            <x-home.card
                title="My Favorites"
                icon="fa-heart"
                :route="route('users.favorites.index', Auth::user())"
            />
        </div>

        <div class="row">
            <x-home.card
                title="My Ratings"
                icon="fa-star"
                :route="route('users.ratings.index', Auth::user())"
            />
        </div>
    </div>
</x-layouts.app>
