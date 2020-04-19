<!-- Order items -->
<div class="bg-white px-4">
    <x-checkout.order-items :items="$items"/>
</div>

<!-- Order price -->
<div class="bg-white px-4 py-4 border-t border-t-gray-100 text-lg h-full">
    <div class="px-4 py-2 bg-bs-gray">
        <x-checkout.order-price title="Subtotal">
            {{ $subtotal }}
        </x-checkout.order-price>

        <x-checkout.order-price title="Tax">
            {{ $taxAmount }}
        </x-checkout.order-price>

        <x-checkout.order-price title="Shipping costs">
            {{ $shippingCosts }}
        </x-checkout.order-price>
    </div>

    <div class="px-4 pt-4">
        <div class="flex justify-between text-2xl text-black">
            <div class="tracking-wide">Total</div>
            <div>
                {{ Str::withCurrency($total) }}
            </div>
        </div>
    </div>
</div>
