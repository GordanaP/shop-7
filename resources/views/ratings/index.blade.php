<x-layouts.master>
    @section('links')
        @include('partials.datatables._links')
    @endsection

    <x-main.page-header title="My ratings" />

    <main>
        <div class="mx-4 p-4 bg-custom-gray">
            <div class="row">
                <div class="col-md-3">
                    <div class="profile-sidebar">
                        <x-sidebar.profile.card />
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="bg-white p-4 h-full">
                        @if ($user->hasRatedAnyProduct())
                            <table class="table text-gray-600 mb-3 ordered-items"
                            id="tableRatings">
                                <thead class="bg-bs-gray">
                                    <th width="10%">Product</th>
                                    <th width="30%"></th>
                                    <th width="20%">Your Rating</th>
                                    <th width="20%">Avg Rating</th>
                                </thead>

                                <tbody></tbody>
                            </table>
                        @else
                            <h2 class="text-center mb-4">
                                You have not rated any product yet.
                            </h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <x-rating.modal />
    </main>

    @section('scripts')
        @include('partials.datatables._scripts')

        <script>

            var tableRatings = $('#tableRatings');
            var customerProductsRatingsUrl = @json(route('users.products.ratings.list', Auth::user()));

            var datatable = tableRatings.DataTable({
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
                    "url": customerProductsRatingsUrl,
                    "type": "GET"
                },
                "deferRender": true,
                "columns": [
                    {
                        data: 'main_img',
                        render: function(data, type, row, meta) {
                            return '<img src="'+data+'" class="w-full rounded-sm" />'
                        },
                    },
                    {
                        data: 'name',
                        render: function(data, type, row, meta) {
                            return '<div class="w-4/5"><a href="' + row.links.show_product + '" class="uppercase-semibold text-xs hover:text-petroleum-h hover:no-underline mb-1">'+data+'</a><p class="text-gray-500 text-xs">'+row.subtitle+'</p></div>'
                        },
                    },
                    {
                        data: 'rating',
                        render: function(data, type, row, meta) {
                            var activeClass = 'text-red-medium';
                            return getRatingStars(data, activeClass)+'<p class="mt-1"><a href="#" class="hover:no-underline" id="openRatingModal" data-name="'+row.name+'" data-rating="'+ row.rating +'" data-product="'+row.slug+'">Change</a></p>';
                        },
                    },
                    {
                        data: 'avg_rating',
                        render: function(data, type, row, meta) {
                            var activeClass = 'text-gray-800';
                            return getRatingStars(data, activeClass);
                        },
                    },
                ],
                columnDefs: [
                    {
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    },
                ],
                "order": [
                    [ 2, "desc" ]
                ],
            });

        </script>

        <script>
            $(document).on('click','#openRatingModal', function(e) {
                e.preventDefault();

                var ratingModal = $('#ratingModal');
                var productName = $(this).attr('data-name');
                var productSlug = $(this).attr('data-product');
                var productRating = $(this).attr('data-rating');
                var userId = @json(Auth::id());
                var userProductRatingShowUrl = '/users/'+userId+'/products/'+productSlug+'/ratings';

                ratingModal.modal('show');
                $('.modal-title').text(productName);
                checkRadioValue(productRating)

                $("input:radio").change(function(){
                    var rating = $( this ).val();
                    $('#updateRatingBtn').val(rating);
                });

                $(document).on('click', '#updateRatingBtn', function() {
                    var rating = $(this).val()
                    var userProductRatingUpdateUrl = '/users/'+userId+'/products/'+ productSlug +'/ratings'

                    $.ajax({
                        url: userProductRatingUpdateUrl,
                        type: 'PUT',
                        data: {
                            rating: rating
                        }
                    })
                    .done(function(response) {
                        ratingModal.modal('hide');
                        datatable.ajax.reload();
                    })
                    .fail(function(response) {
                        console.log("error");
                    });
                });
            });
        </script>
    @endsection
</x-layouts.master>