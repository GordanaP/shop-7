<x-layouts.app>

    <div class="row" id="displayProductDetails">
        <div class="col-md-3">
            <div class="thumbnail">
                 <img class="img-fluid img-thumbnail"
                 src="https://source.unsplash.com/aob0ukAYfuI/400x300"
                 alt="Product image">
            </div>
        </div>
        <div class="col-md-9">
            <div class="caption">

                <h4 class="font-light my-2 text-lg">
                    {{ ucfirst($product->title ) }}
                </h4>

                <p class="font-medium text-sm">
                    {{ $product->price }}
                </p>

                <p class="text-xs tracking-wide text-gray-600 mt-2">
                    {{ $product->description }}
                </p>
            </div>



        </div>
    </div>

</x-layouts.app>