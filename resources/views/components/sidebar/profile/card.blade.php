<div class="profile-sidebar">

    <div class="profile-card bg-white rounded-t-lg
    rounded-b-lg flex flex-col justify-between">

        <x-sidebar.profile.avatar />

        @auth
            <x-sidebar.profile.usermenu-list />
        @endauth

        @guest
            <x-sidebar.profile.auth-links />
        @endguest

    </div>

</div>