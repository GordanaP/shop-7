<x-layouts.app>

    <div class="container mt-4">

        <x-alert.success />

        <form action="{{ route('tests.store') }}" method="POST">

            @csrf

            <button type="submit" class="btn btn-primary">
                Handle post payment
            </button>
        </form>
    </div>

</x-layouts.app>