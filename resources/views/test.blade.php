<x-layouts.app>

    @section('links')
        <style type="text/css">
            .profile-card {
                min-height: 425px;
                box-shadow: 0 0 16px rgba(0,0,0,0.3);
            }
            .profile-card-img {
                height: 150px;
            }
            .profile-card-img img {
                width: 150px;
                height: 150px;
                top: 47%;
                transition-duration: 0.4s;
                transition-property: transform;
            }
            img:hover {
                transform: scale(1.1);
            }
        </style>
    @endsection

    <div class="container mt-4">

        <h1 class="mb-4">This is a test file.</h1>

        <div class="lg:w-1/4">
            <x-sidebar.profile.card />
        </div>
    </div>

</x-layouts.app>
