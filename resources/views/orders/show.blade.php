<x-layouts.master>
    <x-partials.page-header
        title="My orders"
        :variable="'#'.$order->order_number"
    />

    <main>
        <div class="mx-4 p-4" style="background-color: #E9ECF3;">
            <div class="row">
                <div class="col-md-3">
                    <x-sidebar.profile-card />
                </div>

                <div class="col-md-9">
                    <div class="bg-white p-4 h-full">
                        <div class="flex justify-between">
                            <div class="mb-1 text-base">
                                <span class="font-medium">Date:</span>
                                <span class="text-gray-600">{{ $order->date() }}</span>
                            </div>

                            <x-pdf.create :route="route('invoices.pdf', $order)" />
                        </div>
                        <table class="table border mb-2 ordered-items">
                            <thead>
                                <th width="12%">Item</th>
                                <th width="25%"></th>
                                <th class="text-center" width="25%">Price</th>
                                <th class="text-center" width="15%">Qty</th>
                                <th class="text-right" width="15%">Subtotal</th>
                                <th></th>
                            </thead>

                            <tbody>
                                @foreach ($order->products->load('images', 'currentPromotions') as $item)
                                    <x-cart.item :item="$item" />
                                @endforeach

                                <tr>
                                    <x-cart.subtotal
                                        :subtotal="Present::price($order->subtotal_in_cents)"
                                        :colspan="4"
                                        class="pb-0"
                                    />
                                </tr>

                                @if ($order->coupon)
                                    <x-coupon.show-discount
                                        :couponName="$order->getCoupon()['name']"
                                        :discount="$order->getCoupon()['discount']"
                                    />
                                @endif

                                <x-cart.prices
                                    :taxRate="Present::taxRate()"
                                    :taxAmount="Present::price($order->tax_amount_in_cents)"
                                    :shippingCosts="Present::price($order->shipping_costs_in_cents)"
                                    :grandTotal="Present::price($order->total_in_cents)"
                                />
                            </tbody>
                        </table>

                        <p class="font-medium">Ship to:</p>
                        <div class="text-gray-600 text-sm">
                            <x-order.shipping-address
                                :shipping="$order->shipping"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layouts.master>