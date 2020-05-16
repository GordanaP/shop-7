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

                                <div class="form-group">
                                    <label for="name">Name<x-misc.asterisks /></label>
                                    <input type="text"
                                    name="name" id="name"
                                    class="form-control"
                                    placeholder="Enter name"
                                    value="{{ old('name') }}" />

                                    <x-error field="name" />
                                </div>

                                <div class="form-group">
                                    <label for="streetAddress">Street Address<x-misc.asterisks /></label>
                                    <input type="text"
                                    name="street_address" id="streetAddress"
                                    class="form-control"
                                    placeholder="Enter street address"
                                    value="{{ old('street_address') }}" />

                                    <x-error field="street_address" />
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postalCode">Postal code<x-misc.asterisks /></label>
                                            <input type="text"
                                            name="postal_code" id="postalCode"
                                            class="form-control"
                                            placeholder="Enter postal code"
                                            value="{{ old('postal_code') }}" />

                                            <x-error field="postal_code" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">City<x-misc.asterisks /></label>
                                            <input type="text"
                                            name="city" id="city"
                                            class="form-control"
                                            placeholder="Enter city"
                                            value="{{ old('city') }}" />

                                            <x-error field="city" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="country">Country<x-misc.asterisks /></label>
                                    <select class="form-control"
                                        name="country" id="country">
                                        <option value="">Select a country</option>
                                        @foreach (App::make("country-list")->all as $name => $code)
                                            <option value="{{ $code }}">
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <x-error field="country" />
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone<x-misc.asterisks /></label>
                                            <input type="text"
                                            name="phone" id="phone"
                                            class="form-control"
                                            placeholder="Enter phone"
                                            value="{{ old('phone`') }}" />

                                            <x-error field="phone" />
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email<x-misc.asterisks /></label>
                                            <input type="text" name="email" id="email"
                                            class="form-control"
                                            placeholder="example@domain.com"
                                            value="{{ old('email') }}" />

                                            <x-error field="email" />
                                        </div>
                                    </div> --}}
                                </div>

                                <div class="form-group mt-2">
                                    <button type="submit"
                                    class="btn rounded-full bg-red-dark
                                    hover:bg-red-dark-h text-white px-12 float-right">
                                        Submit
                                    </button>

                                </div>
                                <div class="clearfix"></div>
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
