<form action="{{ $updateShipping }}"
method="POST">

    @csrf
    @method('PUT')

    <button type="submit" class="btn btn-link text-base text-petroleum
    hover:text-red-dark hover:no-underline">
        Make default
    </button>

</form>