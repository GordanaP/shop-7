<div id="billingAddress" class="mb-4">
    <x-checkout.address
        type="billing"
        :address="optional(Auth::user())->customer"
    />

    <div class="mt-2">
        <div class="form-check form-check-inline mt-2">
            <input class="form-check-input" type="checkbox"
                id="displayShipping"
                value="@hasDefault on @else off @endhasDefault"
                onclick="toggleVisibility('#shippingAddress')"
                @hasDefault checked @endhasDefault
            >
            <label class="form-check-label" for="displayShipping">
                Different shipping address
            </label>
        </div>
    </div>

    <p class="displayShipping invalid-feedback text-error"></p>
</div>

<div id="shippingAddress" class="@hasNoDefault hidden @endhasNoDefault mb-6">
    <x-checkout.address
        type="shipping"
        :address="Auth::check() ? Auth::user()->findDefaultShipping()->first() : ''"
    />
</div>