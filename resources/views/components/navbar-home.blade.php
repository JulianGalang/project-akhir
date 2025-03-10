<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold text-blue-600 hover:text-blue-800">
            AkhdanZio
        </a>

        <!-- Icons (Cart & Order) -->
        <div class="flex items-center space-x-4">
            <!-- Cart (Only shown if logged in) -->
            @auth
                <a href="/cart" class="text-gray-600 hover:text-blue-600">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.344 2M7 13h10l3.38-7.24a1 1 0 00-.92-1.4H6.36M16 16h0a2 2 0 11-4 0m6 0a2 2 0 11-4 0"
                        />
                    </svg>
                </a>

                <!-- Order Icon (Only shown if logged in) -->
                <a href="/order" class="text-gray-600 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5" />
                    </svg>
                </a>
            @endauth

            <!-- Profile Menu (Only shown if logged in) -->
            @auth
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button" class="flex text-sm bg-black rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="https://placehold.co/40x40/purple/white?text={{ strtoupper(substr(Auth::user()->name, 0, 1)) }}" alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                               {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                              {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                            </li>
                            <li>
                               <form method="POST" action="{{ route('logout') }}">
                                   @csrf
                                   <x-dropdown-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                                       this.closest('form').submit();">
                                       {{ __('Log Out') }}
                                   </x-dropdown-link>
                               </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endauth

            <!-- Show "Login" if guest (not logged in) -->
            @guest
                <a href="/login" class="text-gray-600 hover:text-blue-600">
                    Login
                </a>
            @endguest
        </div>
    </div>
</nav>
