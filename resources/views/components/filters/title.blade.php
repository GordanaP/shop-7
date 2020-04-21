<div class="flex">
    <span class="uppercase font-medium text-base tracking-wide mb-2 mr-4">
        {{ ucfirst($filter) }}
    </span>

    @if (QueryManager::detects($filter))
        <small>
            <a href="{{ route('welcome', QueryManager::remove($filter)) }}"
            class="text-sm italic">
                &times; Remove filter
            </a>
        </small>
    @endif
</div>
