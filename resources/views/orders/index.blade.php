<x-layouts.master>
    @section('links')
        @include('partials.datatables._links')
    @endsection

    <x-partials.page-header title="My orders" />

    <main>
        <div class="mx-4 p-4" style="background-color: #E9ECF3;">
            <div class="row">
                <div class="col-md-3">
                    <div class="profile-sidebar">
                        <x-sidebar.profile.card />
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="bg-white p-4 h-full">
                        @if (Auth::user()->orders->count())
                            <table class="table text-gray-600 mb-3 ordered-items"
                            id="tableOrders">
                                <thead class="bg-bs-gray">
                                    <th>#</th>
                                    <th width="20%">Order #</th>
                                    <th width="20%">Date</th>
                                    <th width="20%">Total ($)</th>
                                    <th>Ship To</th>
                                    <th></th>
                                </thead>

                                <tbody></tbody>
                            </table>
                        @else
                            <h2 class="text-center mb-4">
                                You have no any order at present.
                            </h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    @section('scripts')
        @include('partials.datatables._scripts')

        <script>

            var tableOrders = $('#tableOrders');
            var customerOrdersUrl = @json(route('users.orders.list', Auth::user()));

            var datatable = tableOrders.DataTable({
                dom: "<'row'<'col-sm-3'l><'col-sm-6'B><'col-sm-3'f>>"
                +"<'row'<'col-sm-12'tr>>"
                +"<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf fa-lg"></i>',
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print fa-lg"></i>',
                    },
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy fa-lg"></i>',
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel fa-lg"></i>',
                    },
                ],
                "ajax": {
                    "url": customerOrdersUrl,
                    "type": "GET"
                },
                "deferRender": true,
                "columns": [
                    {
                        render: function(data, type, row, meta) {
                            return ''
                        },
                    },
                    {
                        data: 'order_number',
                    },
                    {
                        data: 'date',
                    },
                    {
                        data: 'total',
                    },
                    {
                        data: 'ship_to',
                        render: function(data, type, row, meta) {
                            return data.name;
                        },
                    },
                    {
                        data: 'links',
                        render: function(data, type, row, meta) {
                          return '<a href="' + data.show_order + '" class="text-teal-500">View</a>'
                        },
                    }
                ],
                responsive: true,
                columnDefs: [
                    {
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    },
                    { responsivePriority: 1, targets: 2 },
                    { responsivePriority: 2, targets: 3 },
                ],
                "order": [
                    [ 2, "desc" ]
                ],
            });

            counterFirstColumn (datatable)

        </script>
    @endsection
</x-layouts.master>