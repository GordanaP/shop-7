<div class="bg-white h-full pb-2 border border-gray-200 shadow-sm">

    <div class="text-gray-600
        @if (Auth::user()->isDefaultShipping($address))
            flex-between-center
        @endif" style="height: 36px" >

        @if (Auth::user()->isDefaultShipping($address))
            <div class="bg-gray-100 px-3 py-2 uppercase-xs-wider">
                default
            </div>
        @endif

        <div class="float-right py-2 mr-2 text-gray-500">

            <x-address.delete-form
                :billingAddress="Auth::user()->isBillingAddress($address)"
                :deleteBilling="route('users.customers.destroy', [ Auth::user(), $address ])"
                :deleteShipping="route('shippings.destroy', $address)"
            />

            <x-address.edit-link
                :billingAddress="Auth::user()->isBillingAddress($address)"
                :editBilling="route('users.customers.edit', [Auth::user(), $address])"
                :editShipping="route('users.shippings.edit', [Auth::user(), $address])"
            />

        </div>
    </div>

    <x-address.details
        :billingAddress="Auth::user()->isBillingAddress($address)"
        :address="$address"
    />

    @if (Request::get('select') == 1)
        <div class="text-center">
            <form action="{{ route('shippings.store', ! Auth::user()->isBillingAddress($address) ? $address : '') }}" method="POST">

                @csrf

                <button class="btn btn-sm px-4 rounded-full bg-petroleum
                hover:bg-petroleum-h text-white text-base">
                    Select
                </button>

            </form>
        </div>
    @else
        @if (! Auth::user()->isDefaultShipping($address))
            <div class="text-center">
                <x-address.default-form
                    :address="$address"
                    :updateShipping="route('users.shippings.update', [Auth::user(),
                        ! Auth::user()->isBillingAddress($address) ? $address : ''])"
                />
            </div>
        @endif
    @endif

</div>
