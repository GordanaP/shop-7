<div class="col-md-3">
    <div class="bg-white text-lg text-center py-12 px-4 h-full shadow">
        <i class="fa {{ $icon }} fa-4x text-teal-400"
        aria-hidden="true"></i>

        <h4 class="text-2xl font-semibold mt-4 mb-8">
            {{ $title }}
        </h4>

        @if ( ($type ?? null) == 'profile')
            @if (! Auth::user()->customer)
                <a href="{{ route('users.customers.create', Auth::user()) }}"
                class="btn px-8 py-1 bg-red-dark hover:bg-red-dark-h text-lg
                text-white rounded-none">
                    Create
                </a>
            @else
                <a href="{{ route('users.customers.edit', [Auth::user(), Auth::user()->customer]) }}"
                class="px-2 py-1 border border-text-petroleum rounded-none mt-2">
                    Edit
                </a>
            @endif
        @else
            <a href="{{ $route ?? null }}" class="text-teal-500 hover:text-teal-600">
                View
            </a>
        @endif
    </div>
</div>