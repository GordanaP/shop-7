<x-layouts.app>
    @section('links')
        <style>
            body { background: #eee; }
            span { font-size:15px; }
        </style>
    @endsection

    <div class="container mt-8">
        <div class="row">
            <x-home.card
                title="My Profile"
                icon="fa-user-alt"
            >
                Lorem ipsum dolor sit amet, id quo eruditi eloquentiam.
                Assum decore te sed. Elitr scripta ocurreret qui ad.
            </x-home.card>

            <x-home.card
                title="My Orders"
                icon="fa-shopping-bag"
                :route="route('users.orders.index', Auth::user())"
            >
                Lorem ipsum dolor sit amet, id quo eruditi eloquentiam.
                Assum decore te sed. Elitr scripta ocurreret qui ad.
            </x-home.card>

            <x-home.card
                title="Address Book"
                icon="fa-map"
            >
                Lorem ipsum dolor sit amet, id quo eruditi eloquentiam.
                Assum decore te sed. Elitr scripta ocurreret qui ad.
            </x-home.card>
        </div>
    </div>
</x-layouts.app>
