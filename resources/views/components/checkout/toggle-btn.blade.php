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

<x-errors.client field="displayShipping" />
