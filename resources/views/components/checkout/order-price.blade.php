<div class="flex justify-between my-2">
    <div class="text-gray-700">
        {{ $title }}
        @if ($title == 'Tax')
            ({{ Present::taxRate() }})
        @endif
    </div>
    <div class="font-bold text-teal-500">
        {{ $slot }}
    </div>
</div>