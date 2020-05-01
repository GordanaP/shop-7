<x-layouts.master>

    @section('links')
        @include('partials.datatables._links')

        <style>
            table.ordered-items tbody td.no-border { border-top: none; }
            table.ordered-items, table.ordered-items thead th,
            table.ordered-items tbody td {
                border-color:  #edf2f7 !important
            }

            .profile-usermenu a.active {
                color: #4fd1c5;
                font-weight: 500;
                background-color: #f8fafd;
                border-left: 2px solid #4fd1c5;
                border-bottom: 1px solid #f0f5fa;
                border-top: 1px solid #f0f5fa;
            }

            .profile-usermenu a {
                border-bottom: 1px solid #f0f5fa;
            }

            .profile-usermenu:hover {
                background-color: #fafcfd;
            }

        </style>
    @endsection

    <div class="mx-4 p-4 mt-4" style="background-color: #E9ECF3;">
        <div class="row">
            <div class="col-md-3">
                <x-sidebar.customer-card
                    :customerName="Auth::user()->name"
                    :ordersIndexRoute="route('users.orders.index', Auth::user())"
                />
            </div>
            <div class="col-md-9">
                <div class="bg-white p-4 h-full">
                    <table class="table text-gray-700 mb-3 ordered-items"
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
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        @include('partials.datatables._scripts')

        <script>

            var tableOrders = $('#tableOrders');
            var customerOrdersUrl = @json(route('users.orders.list', Auth::user()));

            var datatable = tableOrders.DataTable({
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