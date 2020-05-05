<x-invoice.layout >

    @section('order-number', '#'.$order->order_number)

    @section('payment-date', $order->date())

    @section('billing-details')
        <x-invoice.address
            :related="$billing ?? $order->user->customer"
        >
            <div>Email: {{ ($billing ?? $order->user->customer)['email'] }}</div>
        </x-invoice.address>
    @endsection

    @section('order-details')

        @foreach ($order->products as $item)
            <x-invoice.order-item :item="$item" />
        @endforeach

        <x-invoice.order-price :order="$order" />

    @endsection

    @section('shipping-details')
        <x-invoice.address
            :related="isset($shipping) ? $shipping : ($billing ?? $order->shipping)"
        />
    @endsection

</x-invoice.layout>