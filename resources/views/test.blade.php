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

