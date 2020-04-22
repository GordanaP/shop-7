@props(['productCategories'])

@foreach ($productCategories as $category)
    <a href="{{ route('welcome',
    QueryManager::build(['category' => $category->slug])) }}"
    class="text-gray-500">
        {{ Str::toList($category->name, $loop) }}
    </a>
@endforeach