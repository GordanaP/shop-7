<div class="bg-white shadow-sm rounded-sm p-4 {{ $class ?? null }}">

    <a href="{{ $link }}" class="text-petroleum underline hover:text-red-dark">Change</a>
    <p class="font-medium">{{ $address->name }}</p>
    <p>{{ $address->street_address }}</p>
    <p>{{ $address->postal_code }} {{ $address->city }}</p>
    <p>{{ $address->country }}</p>
    <p>{{ $address->phone }}</p>
    <p>{{ $address->email }}</p>
</div>