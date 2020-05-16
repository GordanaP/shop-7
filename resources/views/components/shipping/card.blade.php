<div class="bg-white h-full pb-2 border border-gray-200 shadow-sm">

    <div class="text-gray-600
        @if (Auth::user()->isDefaultShipping($address))
            flex justify-between items-center
        @endif" style="height: 36px" >

        @if (Auth::user()->isDefaultShipping($address))
            <div class="bg-gray-100 px-3 py-2 uppercase text-xs tracking-wider">
                default
            </div>
        @endif

        <div class="float-right py-2 mr-2 text-gray-500">
            <i class="far fa-trash-alt mr-1" aria-hidden="hidden"></i>
            <i class="far fa-edit" aria-hidden="hidden"></i>
        </div>
    </div>


    <div class="px-3 mb-6
        @if (Auth::user()->isBillingAddress($address))
            my-4 @else mt-12 @endif">

        @if (Auth::user()->isBillingAddress($address))
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

    @if (! Auth::user()->isDefaultShipping($address))
        <div class="text-center">
            <form action="{{ route('users.shippings.update', [Auth::user(),
            ! Auth::user()->isBillingAddress($address) ? $address : '']) }}"
            method="POST">

                @csrf
                @method('PUT')

                <button type="submit" class="btn btn-link text-base text-petroleum
                hover:text-red-dark hover:no-underline">
                    Make default
                </button>
            </form>
        </div>
    @endif
</div>
