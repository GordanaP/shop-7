@foreach ($query as $key => $value)
    <ol  id="filtersList" class="list-disc list-inside mb-0">
        <li class="{{ QueryManager::makeActiveClass($key, $filter)}} text-lg">
            <a  href="{{ route('welcome', QueryManager::build([$filter => $key])) }}"
                class="leading-relaxed text-base">
                {{ ucwords($value) }}
            </a>
        </li>
    </ol>
@endforeach


