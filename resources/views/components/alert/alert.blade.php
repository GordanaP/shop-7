<div class="alert alert-{{ $type }} text-center tracking-wide"
role="alert">
    @if ($type == 'success')
        {{ Session::get('success') }}
    @elseif($type == 'danger')
        <ul>
            @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
        </ul>
    @endif
</div>
