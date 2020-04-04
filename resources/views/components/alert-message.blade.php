@if ($errors->any())

    <x-alert type="danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>

@elseif(Session::has('success'))

    <x-alert type="success">
        {{ Session::get('success') }}
    </x-alert>

@endif
