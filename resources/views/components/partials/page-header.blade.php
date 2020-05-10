<header>
    <div class="mx-4 mt-4 mb-2">
        {{ $slot }}

        <div class=" flex justify-between">
            <h3 class="text-teal-400 font-medium">
                {{ $title ?? null }} {{ $variable ?? null }}
            </h3>

            <x-product.go-shopping-btn :route="route('welcome')" />
        </div>
    </div>
</header>