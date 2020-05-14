<div class="col-md-3">
    <div class="bg-white text-lg text-center py-12 px-4">
        <i class="fa {{ $icon }} fa-4x text-teal-400"
        aria-hidden="true"></i>

        <h4 class="text-2xl font-semibold mt-4">
            {{ $title }}
        </h4>

        <div class="text my-6">
            <span>
                {{ $slot }}
            </span>
        </div>

        <a href="{{ $route ?? null }}" class="text-teal-500 hover:text-teal-600">
            View
        </a>
    </div>
</div>