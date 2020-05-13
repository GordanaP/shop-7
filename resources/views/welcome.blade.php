<x-layouts.app>

<div class="mx-4 mt-4 mb-2">
    <x-alert.message />

    <section class="scrolling-banner">
        <h2 class="text-gray-700">
            This weekend - up to 15% off on the selected products!
        </h2>
    </section>
</div>

{{-- {{ Auth::user()->favorites->load('currentPromotions') }} --}}
{{-- {{ Auth::user()->favorites->load('currentPromotions')->where('id', 1)->first() }} --}}


<div class="mx-4 p-4 mt-1 bg-custom-gray">
    <header>
        <x-main.jumbotron />
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