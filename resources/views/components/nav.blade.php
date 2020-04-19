<nav class="navbar navbar-expand-md navbar-light shadow-sm
border-b border-yellow-300">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <div class="flex">
                <img src="{{ asset('images/logo.svg') }}" width="30" class="mr-2">
                {{ config('app.name', 'Laravel') }}
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @if (ShoppingCart::isNotEmpty())
                    <li>
                        <a href="{{ route('checkouts.index') }}" class="nav-link">
                            <span class="text-teal-500">Checkout</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('shopping.cart.index') }}" class="nav-link">
                        <div class="relative">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            <span class="custom-badge bg-yellow-300 absolute
                            transform translate-x-0 -translate-y-2" style="left: 50%;">
                                {{ ShoppingCart::itemsCount() }}
                            </span>
                        </div>
                    </a>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link"
                        href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle"
                        href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right"
                        aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}"
                            method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>