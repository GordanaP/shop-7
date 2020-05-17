<x-layouts.app>

    <x-main.page-header title="My address book" />

    <main>
        <div class="mx-4 p-4 bg-custom-gray">
            <div class="row">
                <div class="col-md-3">
                    <x-sidebar.profile.card />
                </div>

                <div class="col-md-9">
                    <div class="bg-white p-4 h-full">
                        <div class="mb-4">
                            <a href="{{ route('users.shippings.create', Auth::user()) }}"
                            class="btn-red-dark-r hover:bg-red-dark-h hover:no-underline text-white">
                                <i class="fa fa-plus mr-2" aria-hidden="true"></i>
                                New shipping
                            </a>
                        </div>

                        @foreach (Auth::user()->allAddresses()->chunk(4) as $chunk)
                            <div class="row mb-4">
                                @foreach ($chunk as $address)
                                    <div class="col-md-3 mb-4">
                                        <x-address.card
                                            :address="$address"
                                        />
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </main>

</x-layouts.app>
