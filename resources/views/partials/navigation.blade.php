<header x-data="{ isOpen: false }" class="bg-purple-700 mb-4 sm:flex sm:justify-between sm:items-center xl:h-20">
    <div class="flex justify-between items-center">
        <div class="p-4">
            <a href="{{ route('landing-page') }}">
                <h1 class="text-white font-bold text-3xl xl:text-4xl">Cake Street</h1>
            </a>
        </div>
        <div class="p-4 sm:hidden">
            <button type="submit" @click="isOpen = !isOpen" class="block text-white focus:outline-none">
                <svg class="w-6 h-6 fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                    <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
    <div :class="isOpen ? 'block' : 'hidden'" class="px-4 sm:flex">
        <a href="{{ route('shop.index') }}" class="block py-1 text-white hover:underline sm:mr-4 xl:text-lg">Shop</a>
        @guest
        <a href="{{ route('register') }}" class="block py-1 text-white hover:underline sm:mr-4 xl:text-lg">Signup</a>
        <a href="{{ route('login') }}" class="block py-1 text-white hover:underline sm:mr-4 xl:text-lg">Login</a>
        @else
        <a href="{{ route('users.edit') }}" class="block py-1 text-white hover:underline sm:mr-4 xl:text-lg">My
            Account</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                {{ __('Logout') }}
            </x-dropdown-link>
        </form>
        @endguest
        <a href="{{ route('cart.index') }}" class="flex items-center py-1 text-white sm:mr-4 xl:text-lg">
            <span>Cart</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                </path>
            </svg>
            @if (Cart::instance('default')->count() > 0)
            <span class="text-sm">({{ Cart::instance('default')->count() }})</span>
            @endif
        </a>
    </div>
</header>