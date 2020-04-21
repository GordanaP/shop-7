<div>
    @foreach ($filters as $filter => $query)

        <x-filters.title :filter="$filter"/>

        <x-filters.list
            :filter="$filter"
            :query="$query"
        />

    @endforeach
</div>
