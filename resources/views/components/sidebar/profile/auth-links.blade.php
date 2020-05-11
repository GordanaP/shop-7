<div class="p-4">
    <p class="mb-1 text-center">
        <span>
            Returning customer?
        </span>
        <a href="{{ route('login') }}" class="font-semibold
        text-petroleum hover:text-petroleum-h hover:no-underline">
            Sign in
        </a>
    </p>
    <p class="mb-0 text-center">
        New customer?
        <a href="{{ route('register') }}" class="font-semibold
        text-petroleum hover:text-petroleum-h hover:no-underline">
            Sign up
        </a>
    </p>
    <p class="text-center my-2">OR</p>
    <p class="text-center">
        <a href="{{ route('checkouts.index') }}" class="font-semibold
        text-red-dark hover:text-red-dark-h hover:no-underline">
            Continue as a guest
        </a>
    </p>
</div>