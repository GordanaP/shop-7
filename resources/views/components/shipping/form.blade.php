<div class="form-group">
    <label for="name">Name<x-misc.asterisks /></label>
    <input type="text"
    name="name" id="name"
    class="form-control"
    placeholder="Enter name"
    value="{{ old('name', optional($address ?? null)->name) }}" />

    <x-error field="name" />
</div>

<div class="form-group">
    <label for="streetAddress">Street Address<x-misc.asterisks /></label>
    <input type="text"
    name="street_address" id="streetAddress"
    class="form-control"
    placeholder="Enter street address"
    value="{{ old('street_address', optional($address ?? null)->street_address) }}" />

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
            value="{{ old('postal_code', optional($address ?? null)->postal_code) }}" />

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
            value="{{ old('city', optional($address ?? null)->city) }}" />

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
            <option value="{{ $code }}"
                {{ selected($code, old('country', optional($address ?? null)->country)) }}
            >
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
            value="{{ old('phone', optional($address ?? null)->phone) }}" />

            <x-error field="phone" />
        </div>
    </div>

    @if (Route::currentRouteName() == 'users.customers.create'
    || Route::currentRouteName() == 'users.customers.edit')
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email<x-misc.asterisks /></label>
                <input type="text" name="email" id="email"
                class="form-control"
                placeholder="example@domain.com"
                value="{{ old('email', optional($address ?? null)->email) }}" />

                <x-error field="email" />
            </div>
        </div>
    @endif
</div>

@if (Route::currentRouteName() == 'users.shippings.create'
|| Route::currentRouteName() == 'users.shippings.edit')
    <div class="form-check form-check-inline">
      <label class="form-check-label">Set as default address:</label>
    </div>

    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="is_default" value="1"
        {{ checked(1, old('is_default', optional($address ?? null)->is_default)) }}
      >
      <label class="form-check-label">Yes</label>
    </div>

    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="is_default" value="0"
        {{ checked(0, old('is_default', optional($address ?? null)->is_default)) }}
      >
      <label class="form-check-label">No</label>
    </div>

    <x-error field="is_default" />
@endif

<div class="form-group mt-2">
    <button type="submit"
    class="btn rounded-full bg-red-dark
    hover:bg-red-dark-h text-white px-12 float-right">
        {{ $buttonTitle }}
    </button>
</div>

<div class="clearfix"></div>