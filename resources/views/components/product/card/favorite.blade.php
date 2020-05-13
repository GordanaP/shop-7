<form action="{{ route('users.favorites.update', [$user, $product]) }}"
method="POST">

    @csrf
    @method('PUT')

    <button type="submit" class="focus:outline-none">
        <i class="fa fa-heart {{ $product->isFavoritedBy($user)
            ? 'text-red-carmin' : 'text-gray-400'}} hover:text-red-carmin-h"
            aria-hidden="true"
        ></i>
    </button>
</form>