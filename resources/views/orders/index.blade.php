<x-layouts.master>

    @section('links')
        @include('partials.datatables._links')
    @endsection

    <div class="container mt-4 border border-lightgray bg-white p-4">
        <div class="row">
            <div class="col-md-3">
                <div class="box-part text-center bg-white text-2xl py-16 px-4">
                    <i class="fa fa-cubes fa-4x text-teal-400"
                    aria-hidden="true"></i>

                    <h4 class="text-2xl font-semibold mt-4">
                        My orders
                    </h4>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-body shadow-sm">
                    <table class="table text-gray-700 mb-3"
                    id="tableOrders">
                        <thead>
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