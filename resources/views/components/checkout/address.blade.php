<div class="form-group">
    <input type="text" class="form-control"
    id="{{ $type }}Name"
    name="{{ $type }}-name"
    placeholder="Name"
    value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->name ?? '' : '' }}">

    <p class="{{ $type }}-name text-xs text-red-500"></p>
</div>

<div class="form-group">
    <input type="text" class="form-control"
    id="{{ $type }}Line1"
    name="{{ $type }}-address-line1"
    placeholder="Street address"
    value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->street_address ?? '' : ''}}">

    <p class="{{ $type }}-address-line1 text-xs text-red-500"></p>
</div>

<div class="form-group">
    <input type="text" class="form-control"
    id="{{ $type }}Postal_code"
    name="{{ $type }}-address-postal_code"
    placeholder="Postal Code"
    value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->postal_code ?? '' : ''}}">

    <p class="{{ $type }}-address-postal_code text-xs text-red-500"></p>
</div>

<div class="form-group">
    <input type="text" class="form-control"
    id="{{ $type }}City"
    name="{{ $type }}-address-city"
    placeholder="City"
    value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->city ?? '' : '' }}">

    <p class="{{ $type }}-address-city text-xs text-red-500"></p>
</div>

<div class="form-group">
    <input type="text" class="form-control"
    id="{{ $type }}Country"
    name="{{ $type }}-address-country"
    placeholder="Country"
    value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->country ?? '' : '' }}">

    <p class="{{ $type }}-address-country text-xs text-red-500"></p>
</div>

<div class="form-group">
    <input type="text" class="form-control"
    id="{{ $type }}Phone"
    name="{{ $type }}-phone"
    placeholder="Phone Number"
    value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->phone ?? '' : '' }}">

    <p class="{{ $type }}-phone text-xs text-red-500"></p>
</div>

@if ($type == 'billing')
    <div class="form-group">
        <input type="text" class="form-control"
        id="{{ $type }}Email"
        name="{{ $type }}-email"
        placeholder="E-mail address"
        value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->email ?? '' : '' }}">

        <p class="{{ $type }}-email text-xs text-red-500"></p>
    </div>
@endif