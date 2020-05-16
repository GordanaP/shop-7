<x-layouts.app>

    <x-main.page-header title="My address book" />

    <main>
        <div class="mx-4 p-4 bg-custom-gray">
            <div class="row">
                <div class="col-md-3">
                    <div class="profile-sidebar">
                        <x-sidebar.profile.card />
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="bg-white p-4 h-full">

                        @foreach (Auth::user()->allAddresses()->chunk(4) as $chunk)
                            <div class="row mb-4">
                                @foreach ($chunk as $address)
                                    <div class="col-md-3 mb-4">
                                        <x-shipping.card
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
