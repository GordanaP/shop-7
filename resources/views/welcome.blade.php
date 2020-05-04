<x-layouts.app>

    @section('links')
        <style type="text/css">
            .page-item.active .page-link{
                background: #38b2ac;
                border: 1px solid #38b2ac;
            }

            #filtersList li.active { color: #38b2ac; font-weight: 500;}
        </style>
    @endsection

    <div class="my-4">
        <x-alert.success />
        <section class="jumbotron text-center">
            <div class="container text-white">
                <h1 class="jumbotron-heading">Album example</h1>
                <p class="lead">Something short and leading about the collection
                below—its contents, the creator, etc. Make it short and sweet,
                but not too short so folks don't simply skip over it entirely.</p>
                <p>
                    <a href="#" class="btn btn-warning my-2">Main call to action</a>
                    <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <x-filters.all :filters="$filters" />
                    </div>

                    <div class="col-md-9">
                        <x-product.album.display :products="$products" />

                        <div class="float-right mt-4">
                            {{ $products->appends(Request::query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>