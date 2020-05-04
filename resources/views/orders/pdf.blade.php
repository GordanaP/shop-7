<x-invoice.layout >

    @section('order-number', '#'.$order->order_number)

    @section('payment-date', $order->date())

    @section('billing-details')
        <x-invoice.address :related="$order->user->customer" />
    @endsection

    @section('order-details')

        @foreach ($order->products as $item)
            <x-invoice.order-item :item="$item" />
        @endforeach

        <x-invoice.order-price :order="$order" />

    @endsection

    @section('shipping-details')
        <x-invoice.address :related="$order->shipping" />
    @endsection

</x-invoice.layout>