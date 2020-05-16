<x-layouts.app>

    @section('links')
        <style>
            .invalid-feedback { display: inline-block; }
        </style>
    @endsection
    <x-main.page-header title="New shipping address">
        <x-alert.success />
    </x-main.page-header>

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
                        <p class="text-sm mb-4 ml-24 text-gray-600">All fields marked with * are required.</p>
                        <div class="w-4/5 mx-auto py-4 px-12 bg-bs-gray">

                            <form action="{{ route('users.shippings.store', Auth::user()) }}"
                            method="POST">

                                @csrf

                                <x-shipping.form buttonTitle="Submit"/>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    @section('scripts')
        <script>

            clearErrorOnTriggeringAnEvent()

        </script>
    @endsection
</x-layouts.app>
