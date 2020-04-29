<form action="{{ $route }}" method="POST">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn pt-0">
        <i {{ $attributes->merge(['class' => "far fa-trash-alt text-gray-700"]) }} ></i>
    </button>

</form>