<div class="col-md-4">
    <div class="box-part bg-white text-center py-16 px-4 shadow-sm">
        <i class="fa {{ $icon }} fa-4x text-teal-400"
        aria-hidden="true"></i>

        <h4 class="text-2xl font-semibold mt-2">
            {{ $title }}
        </h4>

        <div class="text my-6">
            <span>
                {{ $slot }}
            </span>
        </div>

        <a href="#" class="text-teal-500 hover:text-teal-600">
            View
        </a>
    </div>
</div>