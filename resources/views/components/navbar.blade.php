<nav x-data="{ open: false }">
    <div class="max-w-6xl mx-auto px-4 py-6 flex justify-between items-center text-gray-900 dark:text-white">
           <div class="flex items-center gap-10">
            <a href="{{ route('home') }}" class="block w-40">
                <img src="/assets/logo.svg" alt="Logo" class="block dark:hidden w-40">
                <img src="/assets/logo-darktheme.svg" alt="Dark Logo" class="hidden dark:block w-40">
            </a>

            <ul class="space-x-4 hidden md:flex items-center">
                <li>
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'text-gray-700 font-semibold' : 'text-gray-400' }} text-sm hover:underline dark:text-white">Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('posts.index') }}"
                        class="{{ request()->routeIs('posts.index') ? 'text-gray-700 font-semibold' : 'text-gray-400' }} text-sm hover:underline dark:text-white">Posts
                    </a>
                </li>
                <li>
                    <a href="{{ route('posts.favorites') }}"
                        class="{{ request()->routeIs('posts.favorites') ? 'text-gray-700 font-semibold' : 'text-gray-400' }} text-sm hover:underline dark:text-white">Favorites
                    </a>
                </li>
                <li>
                    {{-- Temporary user show --}}
                    <a href="{{ route('users.show', 1) }}"
                        class="{{ request()->routeIs('users.show', 1) ? 'text-gray-700 font-semibold' : 'text-gray-400' }} text-sm hover:underline dark:text-white">
                        Profile
                    </a>
                </li>
            </ul>
        </div>
        <div class="flex items-center gap-2">
            {{-- Theme Icon --}}
            <span id="theme-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" id="sun-icon"
                    class="size-6 dark:hidden">
                    <path
                        d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
                </svg>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" id="moon-icon"
                    class="size-6 hidden dark:inline text-white">
                    <path fill-rule="evenodd"
                        d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z"
                        clip-rule="evenodd" />
                </svg>
            </span>

            {{-- Toggle --}}
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" id="dark-toggle" class="sr-only" onchange="toggleTheme()" />
                <div class="w-10 h-5 bg-gray-300 rounded-full dark:bg-gray-600 transition-colors duration-300">
                    <div
                        class="dot absolute left-0.5 top-0.5 w-4 h-4 bg-white rounded-full transition-transform duration-300 dark:translate-x-5">
                    </div>
                </div>
            </label>
                <!-- Hamburger -->
            <button @click="open = !open" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6 text-gray-700 dark:text-white" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-5" class="md:hidden px-4 pb-4 origin-top transform">
        <ul class="flex flex-col gap-2 text-gray-700 dark:text-white">
            <li>
                <a href="{{ route('home') }}"
                    class="block py-2 px-3 rounded hover:bg-gray-200 dark:hover:bg-gray-800 {{ request()->routeIs('home') ? 'font-semibold' : '' }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('posts.index') }}"
                    class="block py-2 px-3 rounded hover:bg-gray-200 dark:hover:bg-gray-800 {{ request()->routeIs('posts.index') ? 'font-semibold' : '' }}">
                    Posts
                </a>
            </li>
            <li>
                <a href="{{ route('posts.favorites') }}"
                    class="block py-2 px-3 rounded hover:bg-gray-200 dark:hover:bg-gray-800 {{ request()->routeIs('posts.index') ? 'font-semibold' : '' }}">
                    Favorites
                </a>
            </li>
            <li>
                <a href="{{ route('users.show', 1) }}"
                    class="block py-2 px-3 rounded hover:bg-gray-200 dark:hover:bg-gray-800 {{ request()->routeIs('users.show', 1) ? 'font-semibold' : '' }}">
                    Profile
                </a>
            </li>
        </ul>
    </div>
</nav>
