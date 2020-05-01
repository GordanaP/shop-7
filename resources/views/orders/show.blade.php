<x-layouts.master>

    @section('links')
        <style>
            table.ordered-items tbody td.no-border { border-top: none; }
        </style>
    @endsection

    <div class="container mt-4 border border-lightgray bg-white p-4">
        <div class="row">
            <div class="col-md-3">
                <h5 class="font-medium mb-2">Order Details</h5>

                <div class="text-sm">
                    <div class="mb-1">
                        No:
                        <span class="text-gray-600">#{{ $order->order_number }}</span>
                    </div>
                    <div class="mb-1">
                        Date:
                        <span class="text-gray-600">{{ $order->date() }}</span>
                    </div>
                    <div>Ship to:</div>
                    <div class="text-gray-600">
                            <x-order.shipping-address
                                :shipping="$order->shipping ?? $order->user->customer"
                            />
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <table class="table border mb-2 ordered-items">
                    <thead>
                        <th width="12%">Item</th>
                        <th width="25%"></th>
                        <th class="text-center" width="25%">Price</th>
                        <th class="text-center" width="15%">Qty</th>
                        <th class="text-right" width="15%">Subtotal</th>
                        <th class="text-right"><i class="fa-fa-cog"></i></th>
                    </thead>

                    <tbody>
                        @foreach ($order->products as $item)
                            <x-cart.item :item="$item" />
                        @endforeach

                        <tr>
                            <x-cart.subtotal
                                :subtotal="$order->subtotal()"
                                :colspan="4"
                                class="pb-0"
                            />
                        </tr>

                        <x-cart.prices
                            :taxRate="config('cart.tax_rate') * 100"
                            :taxAmount="$order->taxAmount()"
                            :shippingCosts="$order->shippingCosts()"
                            :grandTotal="$order->total()"
                        />
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-layouts.master>