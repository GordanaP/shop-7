<div class="col-md-4">
    <div class="card mb-3 box-shadow">
        <img src="http://lorempixel.com/200/120/food/3/" class="card-img-top"
        alt="Card image cap">
        <div class="card-body">
            <h5 class="font-semibold mb-3">
                <a href="#">
                    {{ $product->title }}
                </a>
            </h5>
            <p class="card-text text-muted mb-3">
                {{ $product->subtitle }}
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <x-cart.add-item :product="$product" />
                </div>

                <div>{{ $product->price }}</div>
            </div>
        </div>
    </div>
</div>