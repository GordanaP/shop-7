<x-layouts.master>

    @section('links')
        @include('partials.datatables._links')

        <style>
            .dt-button.inverse-dark { background: rgba(62, 75, 91, 0.2); border: 1px solid rgba(62, 75, 91, 0);}
            .dt-button.inverse-dark:hover { color: white; background: #3e4b5b !important; border: 1px solid #3e4b5b9f7aea;}
            .dt-button.delete-checked {display: none; background: #f56565; border: 1px solid #f565655 !important; }
            .dt-button.delete-checked:hover {background: #e53e3e !important; border: 1px solid #f565655 !important;}
            .admin-table { color: #718096 !important; border-bottom-color: #ebedf2 !important}
            .admin-table th { font-weight: 400 !important; color: #718096 !important; font-size: 0.75rem !important;}
            .admin-table td { padding-left: 18px !important}
            .dataTables_filter input { border: 1px solid #ebedf2 !important; height: 32px !important; padding: 4px 8px!important; }
            .dataTables_filter label {  margin-bottom: 0px !important }
            .dataTables_length select { height: 32px !important; padding: 4px 8px!important; margin-bottom: 0px !important; margin-left: 0px !important; padding-left: 0px }
            .dataTables_length label {  margin-bottom: 0px !important }
            .dataTables_wrapper .row .col-sm-6 { margin: auto; }
        </style>
    @endsection

    <div class="container mt-4">
        <div class="card card-body">
            <table class="table bg-white text-gray-700" id="tableOrders">
                <thead>
                    <th>#</th>
                    <th>Order Number</th>
                    <th>Date</th>
                    <th>Total ($)</th>
                    <th>Ship To</th>
                    <th></th>
                </thead>

                <tbody></tbody>
            </table>
        </div>
    </div>

    @section('scripts')
        @include('partials.datatables._scripts')

        <script>

            var records = 'Orders';
            var recordsUrl = @json(route('users.orders.list', Auth::user()));

            var datatable = $('#tableOrders').DataTable({
                "ajax": {
                    "url": recordsUrl,
                    "type": "GET"
                },
                "deferRender": true,
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                } ],
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
                        render: function(data, type, row, meta) {
                            return data
                        },
                    },
                    {
                        data: 'ship_to',
                        render: function(data, type, row, meta) {
                            return data.name;
                        },
                    },
                    {
                        render: function(data, type, row, meta) {
                          return '<a href="#" class="text-teal-500">View</a>'
                        },
                    }
                ],
                responsive: true,
                // columnDefs: [
                //     { responsivePriority: 1, targets: 0 },
                //     { responsivePriority: 2, targets: 1 },
                //     { responsivePriority: 3, targets: 2 },
                //     // {
                //     //     targets: table(records).columnIndex(),
                //     //     className: 'dt-body-right'
                //     // },
                //     // {
                //     //     targets: [4, 5, 6],
                //     //     className: 'dt-body-center'
                //     // },
                // ],
                "order": [
                    [ 1, "desc" ]
                ],
            });

            datatable.on( 'order.dt search.dt', function () {
                    datatable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    } );
                } ).draw();


        </script>
    @endsection

</x-layouts.master>