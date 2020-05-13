<x-layouts.app>

    <div class="p-4">

        <h2 class="mb-10">The test page</h2>

        {{ App\User::find(5)->products->load('currentPromotions')->count() ? 'yes' : 'no' }}

        @php
            $products = App\User::first()->products->load('currentPromotions')
        @endphp

        @foreach ($products as $product)
            <p>
                <a href="{{ route('products.show', $product) }}">
                    {{ $product->title }}
                </a>
                {{ $product->rate->rating_id }}
            </p>
        @endforeach

        {{ App\Product::find(5)->orders->where('user_id', 2) }}


    </div>

</x-layouts.app>

{{-- <x-layouts.app>

    <div class="p-4">

        <h2 class="mb-10">The test page</h2>


        /**
         * The products favorited by the user.
         */
        public function favorites(): BelongsToMany
        {
            return $this->belongsToMany(Product::class, 'product_user')->with('promotions');
        }

        /**
         * The user toggles favoriting the product.
         *
         * @param  \App\Product $product
         */
        public function togglesFavoriting($product)
        {
            $this->favorites()->toggle($product->id);
        }


        /**
         * The users who favorited the product.
         */
        public function users(): BelongsToMany
        {
            return $this->belongsToMany(User::class);
        }

        /**
         * Determine if the product is favorited by the given user.
         *
         * @param  \App\User  $user
         */
        public function isFavoritedBy($user): bool
        {
            return $this->users->where('id', $user->id)->count();
        }


        /**
         * User Product Favorite
         */
        Route::middleware('auth')->get('users/{user}/products/favorites',
            'User\UserProductFavoriteController@index')
            ->name('users.products.favorites.index');
        Route::middleware('auth')->get('users/{user}/products/favorites/list',
            'User\UserProductFavoriteAjaxController')
            ->name('users.products.favorites.list');
        Route::middleware('auth')->put('users/{user}/products/{product}/favorites',
            'User\UserProductFavoriteController@update')
            ->name('users.products.favorites.update');
    </div>

</x-layouts.app>

<x-layouts.master>
    @section('links')
        @include('partials.datatables._links')
    @endsection

    <x-main.page-header title="My favorites" />

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
                        @if ($user->favorites)
                            <table class="table text-gray-600 mb-3 ordered-items"
                            id="tableFavorites">
                                <thead class="bg-bs-gray">
                                    <th width="10%">Product</th>
                                    <th width="30%"></th>
                                    <th></th>
                                </thead>

                                <tbody></tbody>
                            </table>
                        @else
                            <h2 class="text-center mb-4">
                                You have no any favorites at present.
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

            var tableFavorites = $('#tableFavorites');
            var customerProductsFavoritesUrl = @json(route('users.products.favorites.list', Auth::user()));

            var datatable = tableFavorites.DataTable({
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
                    "url": customerProductsFavoritesUrl,
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
                            return '<div class="w-4/5"><a href="' + row.links.show_product + '" class="uppercase-semibold text-xs hover:text-petroleum hover:no-underline mb-1">'+data+'</a><p class="text-gray-500 text-xs">'+row.subtitle+'</p></div>'
                        },
                    },
                    {
                        render: function(data, type, row, meta) {
                            return '<button type="button" id="unfavoriteProductBtn" data-product="' + row.slug + '" class="focus:outline-none"><i class="fa fa-heart text-red-carmin hover:text-red-carmin-h" aria-hidden="true"></i></button>';
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
            });
        </script>

        <script>

            $(document).on('click', '#unfavoriteProductBtn', function() {

                var productSlug = $(this).attr('data-product');
                var userId = @json(Auth::id());
                var userProductUnfavoriteUrl = '/users/'+userId+'/products/'+ productSlug +'/favorites'

                $.ajax({
                    url: userProductUnfavoriteUrl,
                    type: 'PUT',
                })
                .done(function(response) {
                    datatable.ajax.reload();
                });
            });

        </script>
    @endsection
</x-layouts.master>

<form action="{{ route('users.products.favorites.update', [$user, $product]) }}"
method="POST">

    @csrf
    @method('PUT')

    <button type="submit" class="focus:outline-none">
        <i class="fa fa-heart {{ $product->isFavoritedBy($user)
            ? 'text-red-carmin' : 'text-gray-400'}} hover:text-red-carmin-h"
            aria-hidden="true"
        ></i>
    </button>
</form> --}}