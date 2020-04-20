<div id="card-element" class="shadow-sm">
    <!-- Elements will create input elements here -->
</div>

<!-- We'll put the error messages in this element -->
<div id="card-errors" role="alert"></div>

<button class="btn btn-block text-lg font-bold
text-white bg-teal-500 mt-3">
    <span class="tracking-wider mr-2">Pay</span>
    {{ Str::withCurrency($total) }}
</button>
