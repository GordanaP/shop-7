<div>{{ $related->name}}</div>
<div>{{ $related->street_address }}</div>
<div>{{ $related->postal_code }} {{ $related->city }}</div>
<div>
    {{ App::make('country-list')->key(strtolower($related->country)) }},
    {{ $related->country }}
</div>
<div>Phone: {{ $related->phone }}</div>
@if ($related->email)
    <div>Email: {{ $related->email }}</div>
@endif
