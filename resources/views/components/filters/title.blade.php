<div class="flex items-baseline">
    <span class="uppercase font-medium text-base tracking-wide mb-2 mr-4">
        {{ ucfirst($filter) }}
    </span>

    @if (QueryManager::detects($filter))
        <a href="{{ route('welcome', QueryManager::remove($filter)) }}"
        class="text-sm text-gray-600 hover:no-underline hover:text-gray-800">
            &times; Remove filter
        </a>
    @endif
</div>
