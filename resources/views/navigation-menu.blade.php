<nav x-data="{ open: false }" style="z-index: 700;"
    class="sticky top-0 container md:mx-auto sm:px-6 lg:px-8 bg-white shadow-lg shadow-gray-400 mx-auto">
    <!-- Primary Navigation Menu -->
    <div class="container mx-auto px-4 lg:px-8 relative">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-jet-application-mark class="block h-7 md:h-9 w-auto" />
                    </a>
                    <h1 class="ml-1 md:ml-3 font-semibold text-red-600 text-md md:text-xl"><a
                            href="{{ route('home') }}">WebMarket</a></h1>

                    @livewire('menu')

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center">

                @auth
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            @auth()
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-600 bg-white focus:outline-none transition">
                                    {{ Auth::user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                            @endauth

                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @role('admin')
                            <x-jet-dropdown-link href="{{ route('admin.index') }}">
                                Admin
                            </x-jet-dropdown-link>
                            @endrole


                            <x-jet-dropdown-link href="{{ route('aPersonal') }}">
                                Área Personal
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
                @else
                <a href="{{ route('login') }}" class="text-sm text-red-600">{{__('Log in')}}</a>
                <a href="{{ route('register') }}" class="ml-4 text-sm text-red-600">{{__('Register')}}</a>
                @endauth

                <div class="px-2 py-4 sm:block">
                    @livewire('icono-carrito')
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center justify-end sm:hidden">
                @auth
                <div>
                    <button @click="open = ! open" class="text-red-500 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                    </button>
                </div>
                @else
                <a href="{{ route('login') }}" class="text-xs text-red-600">{{__('Log in')}}</a>
                <a href="{{ route('register') }}" class="ml-2 text-xs text-red-600">{{__('Register')}}</a>
                @endauth

                @livewire('icono-carrito')
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden mx-4">

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 mr-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                </div>
                @endif
                @auth()
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                @endauth

            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                    :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @role('admin')
                <x-jet-responsive-nav-link href="{{ route('admin.index') }}"
                    :active="request()->routeIs('admin.index')">
                    Admin
                </x-jet-responsive-nav-link>
                @endrole


                <x-jet-responsive-nav-link href="{{ route('aPersonal') }}" :active="request()->routeIs('aPersonal')">
                    Área Personal
                </x-jet-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
