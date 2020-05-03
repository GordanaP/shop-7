<x-invoice.layout >

    @section('order-number', '#6000')

    @section('billing-details')
        <x-invoice.address />
        <div>E-mail: jane@example.com</div>
    @endsection

    @section('order-details')

        <x-invoice.order-item />

        <x-invoice.order-price />

    @endsection

    @section('shipping-details')
        <x-invoice.address />
    @endsection

</x-invoice.layout>