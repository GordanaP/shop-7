<div class="text-teal-400 my-1">
    @foreach ($product->categories as $category)
        <a href="{{ route('welcome', QueryManager::build(['category' => $category->slug])) }}">
            {{ Str::toList($category->name, $loop) }}
        </a>
    @endforeach
</div>