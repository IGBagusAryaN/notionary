@extends('layouts.app')

<body class="bg-white dark:bg-[#1d1d1d] font-sans ">

    @section('title', 'Home')

    @section('content')
        <section class="grid grid-cols-1 lg:grid-cols-2 items-center justify-items-center gap-8">
            <lottie-player src="/lottie/blog.json" background="transparent" speed="1"
                class="w-[300px] h-[300px]  lg:w-[500px] lg:h-[500px]" loop autoplay>
            </lottie-player>

            <div class="flex flex-col gap-10">
                <div>
                    <h1 class="text-[32px] lg:text-[48px] font-bold mb-4 dark:text-white">Where Ideas Become Stories🚀</h1>
                    <p class="text-gray-600 dark:text-white">Whether you're a passionate writer, a curious reader, or just
                        someone with ideas to
                        share — Notionary provides the tools you need to write freely, discover inspiring posts, and build
                        meaningful connections in a vibrant digital space.</p>
                </div>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('posts.index') }}"
                        class="px-5 py-3 border border-gray-200 rounded-md w-full lg:!w-auto text-center hover:bg-bluePrimary hover:text-white dark:text-white">
                        View blogs
                    </a>
                    <a href="#posts"
                        class="px-5 py-3 border border-gray-200 rounded-md w-full lg:!w-auto text-center bg-bluePrimary text-white hover:bg-blue-900 dark:text-white">
                        Your posts
                    </a>
                </div>
            </div>
        </section>
        <section class="mt-20" id="posts">
            <div class="flex flex-col lg:!flex-row lg:justify-between lg:items-center my-10">
                <h2 class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-white">
                    Posts by {{ $user['name'] }}
                </h2>
                <a href="{{ route('posts.create') }}"
                    class="px-5 py-3 border border-gray-200 rounded-md w-full lg:!w-auto mt-5 lg:mt-0 text-center flex justify-center items-center gap-2 cursor-pointer hover:bg-bluePrimary hover:text-white dark:text-white">
                    Create Posts
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            <div
                class="overflow-x-auto bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-md shadow">
                <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-200">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts->sortBy('title')->values() as $index => $post)
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="px-4 py-3">{{ $index + 1 + ($posts->currentPage() - 1) * $posts->perPage() }}
                                </td>
                                <td class="px-4 py-3 font-medium truncate max-w-36 lg:max-w-full">{{ $post['title'] }}</td>
                                <td class="px-4 py-3 flex gap-2 items-center">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('posts.edit', $post['id']) }}"
                                        class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded hidden lg:inline-flex items-center">
                                        Edit
                                    </a>
                                    <!-- Icon edit mobile -->
                                    <a href="{{ route('posts.edit', $post['id']) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white rounded p-2 lg:hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-5">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                            <path
                                                d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>

                                    </a>

                                    {{-- Tombol Delete --}}
                                    <form action="{{ route('posts.destroy', $post['id']) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus post ini?')" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <!-- Tombol teks desktop -->
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-500 hover:bg-red-700 text-white rounded hidden lg:inline-flex items-center">
                                            Delete
                                        </button>
                                        <!-- Icon delete mobile -->
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white rounded p-2 lg:hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="size-5">
                                                <path fill-rule="evenodd"
                                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                    No posts found for this user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 text-center">
                {{ $posts->withQueryString()->links() }}
            </div>
        </section>
        <footer class="bg-gray-100 dark:bg-gray-800 py-8 mt-24 rounded-t-lg">
            <div class="max-w-7xl mx-auto px-4 flex flex-col lg:flex-row justify-between items-center gap-6">
                <a href="{{ route('home') }}" class="block w-40">
                    <img src="/assets/logo.svg" alt="Logo" class="block dark:hidden w-40">
                    <img src="/assets/logo-darktheme.svg" alt="Dark Logo" class="hidden dark:block w-40">
                </a>

                <!-- Navbar List -->
                <ul class="flex gap-6 text-sm text-gray-700 dark:text-gray-300">
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
                </ul>
            </div>

            <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                &copy; {{ date('Y') }} Notionary. All rights reserved.
            </div>
        </footer>



    @endsection



</body>
