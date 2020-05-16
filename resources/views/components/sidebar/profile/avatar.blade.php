<div>
    <div class="profile-card-img bg-gray-200 rounded-t-lg mb-20">
        <img src="{{ asset('images/guest_avatar.svg') }}"
        class="rounded-full p-1 relative mx-auto border-8 border-white" />
    </div>

    @auth
        <h3 class="text-center font-medium text-gray-600">
            {{-- {{ optional(Auth::user()->c->nameustomer)->name ?? Auth::user()->name }} --}}
            {{ Auth::user()->customer->name }}
        </h3>
    @else
        <h3 class="text-center font-medium text-gray-600">Guest</h3>
    @endauth
</div>