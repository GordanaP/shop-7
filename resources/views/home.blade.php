<x-layouts.app>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Checkout -->
                        <form action="{{ route('tests.store') }}" method = "POST" id="testForm">

                            @csrf

                            <div id="billingAddress" class="mb-2">
                                <div class="card card-body">
                                    <x-checkout.address type="billing" />
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox"
                                    id="displayShipping"
                                    value="off"
                                    onclick="toggleVisibility('#shippingAddress')"
                                    >
                                    <label class="form-check-label" for="displayShipping">
                                        Different shipping address
                                    </label>
                                </div>

                                <div class="displayShipping invalid-feedback text-xs text-red-500"></div>

                            </div>

                            <div id="shippingAddress" class="hidden">
                                <p>Shipping details</p>
                                <div class="card card-body">
                                    <x-checkout.address type="shipping" />
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning btn-block"
                            id="submitPaymentBtn">
                                Submit
                            </button>

                        </form>

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
