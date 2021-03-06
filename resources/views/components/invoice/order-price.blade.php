<x-invoice.price-row
    class="border-t-gray text-semibold"
    title="Subtotal"
    :price="Present::price($order->subtotal_in_cents)"
/>

@if ($order->coupon)
    <x-invoice.price-row :discount="$order->getCoupon()['discount']">
        @slot('title')
            <p class="mt-0 mb-1">Discount</p>
            <p class="m-0 font-12">{{ $order->getCoupon()['name'] }}</p>
        @endslot
    </x-invoice.price-row>
@endif


<x-invoice.price-row
    title="Tax"
    :taxRate="Present::taxRate()"
    :price="Present::price($order->tax_amount_in_cents)"
/>

<x-invoice.price-row
    title="Shipping & Handling"
    :price="Present::price($order->shipping_costs_in_cents)"
/>

<x-invoice.price-row
    class="text-semibold uppercase mt-3"
    title="Total"
    :price="Present::price($order->total_in_cents)"
/>
