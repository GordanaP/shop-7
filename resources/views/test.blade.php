<x-layouts.app>

    @section('links')

    @endsection

    <div class="mx-4 mt-4 mb-2">
        <h2 class="text-gray-700">
            The test page
        </h2>
    </div>

    <div class="mx-4 p-4 mt-1" style="background-color: #E9ECF3;">

        <div style="background: #F8FAFC;">
            <div class="row">
                <div class="col-md-3">
                    Filters
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-3" style="box-shadow: 0 0 16px rgba(0,0,0,0.3);">

                                <a href="#">
                                    <img
                                        src="{{ asset('images/demo_product_1.jpg') }}"
                                        class="card-img-top img-fluid relative"
                                    />

                                    <div class="absolute rounded-full px-1
                                    py-2 bg-warning p-1 right-0 top-0
                                    text-lg font-semibold uppercase">
                                        <p>-10%</p>
                                    </div>
                                </a>

                                <div class="mx-3 mb-3 mt-2 flex flex-col justify-between"
                                style="min-height:200px">
                                    <div>
                                        @for ($i = 0; $i < 5 ; $i++)
                                            <i class="fa fa-star text-warning"></i>
                                        @endfor
                                        <h4 class="mb-2 mt-1">
                                            <a href="#" class="hover:text-teal-500 no-underline">
                                                Product One Title
                                            </a>
                                        </h4>
                                        <p class="card-text text-muted mb-3">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        </p>
                                    </div>

                                    <div>
                                        <p class="mb-2 text-lg">
                                            <span class="line-through font-semibold mr-2">
                                                $32.85
                                            </span>
                                            <span class="text-teal-400 font-semibold">
                                                $29.99
                                            </span>
                                        </p>
                                        <form action="#" method="POST">
                                            @csrf

                                            <button class="btn btn-sm btn-block rounded-full
                                            text-white text-base bg-teal-400 hover:bg-teal-500">
                                                <i class="fa fa-shopping-cart mr-2"
                                                aria-hidden="true"></i>
                                                Add to cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="bg-white rounded-t-lg
                                rounded-b-lg flex flex-col justify-between pb-4"
                                style="height: 450px; box-shadow: 0 0 16px rgba(0,0,0,0.3)">

                                <img src="{{ asset('images/demo_product.jpg') }}"
                                class="f-full rounded-t-lg">

                                <div class="px-3 pb-6">
                                    <div>
                                        @for ($i = 0; $i < 5 ; $i++)
                                            <i class="fa fa-star text-warning"></i>
                                        @endfor
                                        <h4 class="mb-2 mt-1">Product Two Title</h4>
                                        <p class="text-gray-700">Lorem ipsum dolor
                                        sit amet, consectetur adipisicing elit.</p>
                                    </div>
                                </div>

                                <div class="px-3">
                                    <p class="mb-2 text-lg font-semibold">
                                        <span class="line-through">$32.99</span>
                                        <span class="text-teal-500">$28.99</span>
                                    </p>
                                    <button class="btn btn-sm btn-block rounded-full
                                    text-white text-base bg-teal-400 hover:bg-teal-500">
                                        <i class="fa fa-shopping-cart mr-3"
                                        aria-hidden="true"></i>
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="bg-white">
                                Rasa
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>

