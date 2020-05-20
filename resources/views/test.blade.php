<x-layouts.app>

    <div class="p-4">

        <h2 class="mb-10">The test page</h2>

        @php
             $address_info = collect(Auth::user()->shippingOnCheckout())
                ->only('street_address', 'city', 'postal_code', 'country')
                ->keyBy(function($value, $key){
                    if ($key == 'street_address') {
                        return 'line 1';
                    } else {
                        return $key;
                    }
                });

        @endphp

        {{-- <p>{{ print_r(Auth::user()->stripeFormat(Auth::user()->customer)) }}</p> --}}
        <p>{{ Auth::user()->stripeFormat(Auth::user()->shippingOnCheckout())->forget('email') }}</p>
    </div>

</x-layouts.app>
