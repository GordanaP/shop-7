<x-layouts.app>
    <x-partials.page-header title="My shopping cart">
        <x-alert.message />
    </x-partials.page-header>

    <main>
        <div class="mx-4 p-4 mt-1" style="background-color: #E9ECF3;">
            <div class="row">
                <div class="col-md-3">
                    @auth
                        <x-sidebar.profile-card />
                    @else
                        <x-sidebar.guest-card />
                    @endauth
                </div>

                <div class="col-md-9">
                    <div class="bg-white p-4 h-full">
                        @if (ShoppingCart::isNotEmpty())
                            <x-cart.table />
                        @else
                            <h2 class="text-center mb-4">Your cart is empty at present.</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layouts.app>