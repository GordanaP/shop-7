<div class="p-4">
    <p class="mb-1 text-center">
        <span>
            Returning customer?
        </span>
        <a href="{{ route('login') }}"
        class="font-semibold text-teal-400 hover:text-teal-600">
            Sign in
        </a>
    </p>
    <p class="mb-0 text-center">
        New customer?
        <a href="{{ route('register') }}"
        class="font-semibold text-teal-400 hover:text-teal-600">
            Sign up
        </a>
    </p>
    <p class="text-center my-2">OR</p>
    <p class="text-center">
        <a href="{{ route('checkouts.index') }}"
        class="font-semibold text-teal-400 hover:text-teal-600">
            Continue as a guest
        </a>
    </p>
</div>