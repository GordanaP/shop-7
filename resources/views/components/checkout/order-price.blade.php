<div class="flex justify-between my-2">
    <div class="text-gray-700">
        {{ $title }}
        @if ($title == 'Tax')
            ({{ config('cart.tax_rate') * 100 }}%)
        @endif
    </div>
    <div class="font-bold text-teal-500">
        {{ Str::withCurrency($slot) }}
    </div>
</div>