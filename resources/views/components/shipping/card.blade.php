<div class="bg-white h-full pb-6 border border-gray-200 shadow-sm">

    <div class="@if ($shipping->is_default) flex justify-between items-center @endif
    text-gray-600" style="height: 36px" >
        @if ($shipping->is_default)
            <div class="bg-gray-100 px-3 py-2 uppercase text-xs tracking-wider">
                default
            </div>
        @endif
        <div class="float-right py-2 mr-2 text-gray-500">
            <i class="far fa-trash-alt mr-1" aria-hidden="hidden"></i>
            <i class="far fa-edit" aria-hidden="hidden"></i>
        </div>
    </div>

    <div class="px-3 my-4 text-lg">
        <h5 class="mb-2 font-medium">{{ $shipping->name }}</h5>

        <div class="text-gray-500 text-sm">
            <p class="mb-0">{{ $shipping->street_address }}</p>

            <p class="mb-0">{{ $shipping->postal_code }} {{ $shipping->city }}</p>

            <p class="mb-1">{{ $shipping->countryName() }}, {{ $shipping->country }}</p>

            <p class="mb-0">
                <i class="fa fa-mobile-alt" aria-hidden="true"></i>
                {{ $shipping->phone }}
            </p>
        </div>
    </div>

    @if (! $shipping->is_default)
        <div class="text-center">
            <form action="#" method="POST">

                @csrf

                <button type="submit" class="btn btn-link text-base text-petroleum hover:text-red-dark hover:no-underline">
                    Make default
                </button>
            </form>
        </div>
    @endif
</div>
