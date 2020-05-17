<x-layouts.app>

    <x-main.page-header title="edit profile">
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

                            <form action="{{ route('users.customers.update',
                            [Auth::user(), Auth::user()->customer]) }}"
                            method="POST">

                                @csrf
                                @method('PUT')

                                <x-shipping.form
                                    :address="$customer"
                                    buttonTitle="Save changes"
                                />

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
