<div class="form-group">
    <input type="text" class="form-control"
    id="{{ $type }}Name"
    name="{{ $type }}_name"
    placeholder="Name"
    value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->name ?? '' : '' }}">
</div>

<div class="form-group">
    <input type="text" class="form-control"
    id="{{ $type }}Line1"
    name="{{ $type }}_line1"
    placeholder="Street address"
    value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->street_address ?? '' : ''}}">
</div>

<div class="form-group">
    <input type="text" class="form-control"
    id="{{ $type }}Postal_code"
    name="{{ $type }}_postal_code"
    placeholder="Postal Code"
    value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->postal_code ?? '' : ''}}">
</div>

<div class="form-group">
    <input type="text" class="form-control"
    id="{{ $type }}City"
    name="{{ $type }}_city"
    placeholder="City"
    value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->city ?? '' : '' }}">
</div>

<div class="form-group">
    <input type="text" class="form-control"
    id="{{ $type }}Country"
    name="{{ $type }}_country"
    placeholder="Country"
    value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->country ?? '' : '' }}">
</div>

<div class="form-group">
    <input type="text" class="form-control"
    id="{{ $type }}Phone"
    name="{{ $type }}_phone"
    placeholder="Phone Number"
    value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->phone ?? '' : '' }}">
</div>

@if ($type == 'billing')
    <div class="form-group">
        <input type="text" class="form-control"
        id="{{ $type }}Email"
        name="{{ $type }}_email"
        placeholder="E-mail address"
        value="{{ $type == 'billing' && Auth::check() ? optional(Auth::user()->customer)->email ?? '' : '' }}">
    </div>
@endif