<x-layouts.app>

    <x-main.page-header title="edit profile">
        <x-alert.success />
    </x-main.page-header>

    <main>
        <div class="mx-4 p-4 bg-custom-gray">
            <div class="row">
                <div class="col-md-3">
                    <x-sidebar.profile.card />
                </div>

                <div class="col-md-9">
                    <div class="bg-white p-4 h-full">

                        <x-address.save-form
                            :address="$customer"
                            :route="route('users.customers.update',
                            [Auth::user(), Auth::user()->customer])"
                            buttonTitle="Save changes"
                        />

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
