<x-layouts.app>

<div class="mx-4 mt-4 mb-2">
    <x-alert.success />
    <section class="scrolling-banner">
        <h2 class="text-gray-700">
            This weekend - up to 15% off on the selected products!
        </h2>
    </section>
</div>

<div class="mx-4 p-4 mt-1" style="background-color: #E9ECF3;">
    <header>
        <section class="my-jumbotron text-center bg-teal-600" style="height: 300px">
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
    </header>

    <div class="album py-5 bg-white">
        <div class="mx-4">
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