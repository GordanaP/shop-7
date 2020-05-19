<div class="bg-white shadow-sm">
    <div class="form-group mb-0">
        <div class="row px-4">
            <label for="{{ $type }}Name" class="col-sm-2 col-form-label text-gray-600">
                <span class="lg:float-right">Name</span>
            </label>
            <div class="col-sm-10 mb-0 ">
                <input type="text" class="form-control-plaintext text-gray-800"
                id="{{ $type }}Name"
                placeholder="Name"
                value="{{ optional($address)->name }}">

                <p class="{{ $type }}-name invalid-feedback text-error"></p>
            </div>
        </div>
    </div>

    <div class="form-group mb-0">
        <div class="row px-4">
            <label for="{{ $type }}Line1" class="col-sm-2 col-form-label text-gray-600">
                <span class="lg:float-right">Address</span>
            </label>
            <div class="col-sm-10 mb-0">
                <input type="text" class="form-control-plaintext text-gray-800"
                id="{{ $type }}Line1"
                placeholder="Street address"
                value="{{ optional($address)->street_address }}">

                <p class="{{ $type }}-address-line1 invalid-feedback text-error"></p>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6 pl-2 mb-0">
            <div class="row px-4">
                <label for="{{ $type }}City" class="col-sm-4 col-form-label text-gray-600">
                    <span class="lg:float-right">City</span>
                </label>
                <div class="col-sm-8 mb-0">
                    <input type="text" class="form-control-plaintext text-gray-800"
                    id="{{ $type }}City"
                    placeholder="City"
                    value="{{ optional($address)->city ?? null }}">

                    <p class="{{ $type }}-address-city invalid-feedback text-error"></p>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6 mb-0">
            <div class="row px-4">
                <label for="{{ $type }}Postal_code" class="col-sm-2 col-form-label text-gray-600">
                    <span class="lg:float-right">ZIP</span>
                </label>
                <div class="col-sm-10 mb-0">
                    <input type="text" class="form-control-plaintext text-gray-800"
                    id="{{ $type }}Postal_code"
                    placeholder="Postal code"
                    value="{{ optional($address)->postal_code ?? null }}">

                    <p class="{{ $type }}-address-postal_code invalid-feedback text-error"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group mb-0">
        <div class="row px-4">
            <label for="{{ $type }}Country" class="col-sm-2 col-form-label text-gray-600">
                <span class="lg:float-right">Country</span>
            </label>
            <div class="col-sm-10 mb-0 pr-0" style="padding-left: 12px">
                <select class="form-control-plaintext w-full text-gray-500"
                    id="{{ $type }}Country"
                >
                    <option value="">Select a country</option>
                    @foreach (App::make("country-list")->all as $name => $code)
                        <option value="{{ $code }}"
                            {{ selected($code, strtolower(optional($address)->country)) }}
                        >
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                <p class="{{ $type }}-address-country invalid-feedback text-error"></p>
            </div>
        </div>
    </div>

    <div class="form-group mb-0">
        <div class="row px-4">
            <label for="{{ $type }}Phone" class="col-sm-2 col-form-label text-gray-600">
                <span class="lg:float-right">Phone</span>
            </label>
            <div class="col-sm-10 mb-0">
                <input type="text" class="form-control-plaintext text-gray-800"
                id="{{ $type }}Phone"
                placeholder="Phone"
                value="{{ optional($address)->phone ?? null }}">

                <p class="{{ $type }}-phone invalid-feedback text-error"></p>
            </div>
        </div>
    </div>

    @if ($type == 'billing')
        <div class="form-group mb-0">
            <div class="row px-4">
                <label for="{{ $type }}Email" class="col-sm-2 col-form-label text-gray-600">
                    <span class="lg:float-right">Email</span>
                </label>
                <div class="col-sm-10 mb-0">
                    <input type="text" class="form-control-plaintext text-gray-800"
                    id="{{ $type }}Email"
                    placeholder="example@domain.com"
                    value="{{ optional($address)->email ?? null }}">

                    <p class="{{ $type }}-email invalid-feedback text-error"></p>
                </div>
            </div>
        </div>
    @endif
</div>