
<x-layouts.app>
    <x-main.page-header title="My shopping cart">
        <x-alert.message />
    </x-main.page-header>

    <main>
        <div class="mx-4 p-4 mt-1 bg-custom-gray">
            <div class="row">
                <div class="col-md-3">
                    <div class="profile-sidebar">
                        <x-sidebar.profile.card />
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="bg-white p-4 h-full">
                        @if (ShoppingCart::isNotEmpty())
                            <x-cart.table />
                        @else
                            <h2 class="text-center mb-4">
                                Your cart is empty at present.
                            </h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layouts.app>