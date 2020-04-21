<ol class="list-disc list-inside">
    @foreach ($categories as $category)
        <li class="leading-relaxed font-light text-lg">
            <a href="">
                {{ ucfirst($category->name) }} ({{ $category->products->count() }})
            </a>
        </li>
    @endforeach
</ol>