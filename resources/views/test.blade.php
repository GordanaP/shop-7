<x-layouts.app>

    @section('links')

    @endsection

    @php
        $product = \App\Product::find(2);
        $user = Auth::user();
    @endphp

    <div class="p-4">

        <x-alert.message />

        <h2 class="mb-10">The test page</h2>

        <form action="{{ route('users.products.ratings.store', [Auth::user(), $product]) }}" method="POST">

            @csrf

            <x-error :errors="$errors" field="star" />

            @for ($i = 0; $i < 5; $i++)
                <button class="submit" name="rating" value="{{ $i + 1}}">Submit</button>
            @endfor
        </form>

    </div>



</x-layouts.app>

