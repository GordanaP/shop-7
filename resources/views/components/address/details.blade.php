<div class="px-3 mb-6
    @if ($billingAddress)
        my-4 @else mt-12 @endif">

    @if ($billingAddress)
        <p class="mb-1 text-petroleum underline">billing</p>
    @endif

    <h5 class="mb-2 font-medium">{{ $address->name }}</h5>

    <div class="text-gray-500 text-sm">
        <p class="mb-0">{{ $address->street_address }}</p>

        <p class="mb-0">{{ $address->postal_code }} {{ $address->city }}</p>

        <p class="mb-1">{{ $address->countryName() }}, {{ $address->country }}</p>

        <p class="mb-0">
            <i class="fa fa-mobile-alt" aria-hidden="true"></i>
            {{ $address->phone }}
        </p>
    </div>
</div>