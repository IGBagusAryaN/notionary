@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="md:flex justify-between">
        <h1 class="text-2xl font-bold mb-6">All Posts</h1>

        <form method="GET" action="{{ route('posts.index') }}" class="mb-6 flex items-center gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search posts..."
                class="p-2 border rounded w-full dark:bg-gray-700 dark:border-gray-600" />

            <button type="submit"
                class="!bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center gap-2">
                <span>Search</span>
                <svg id="spinner" class="hidden animate-spin h-5 w-5 text-white"
                    xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </button>
        </form>
    </div>

    @if ($posts->isEmpty())
        <div class="text-center text-gray-500 dark:text-gray-400 py-10">
            Tidak ada post yang ditemukan.
        </div>
    @else
        <div class="grid md:grid-cols-2 gap-6">
            @foreach ($posts as $post)
                <div
                    class="bg-white p-4 rounded shadow hover:shadow-lg transition dark:bg-gray-800 dark:border dark:border-gray-700">
                    <h2 class="text-xl font-semibold">{{ $post['title'] }}</h2>
                    <p class="text-gray-600 mt-2 line-clamp-3 dark:text-gray-300">{{ $post['body'] }}</p>
                    <a href="{{ route('posts.show', $post['id']) }}" class="text-blue-500 mt-3 inline-block">Read more →</a>
                </div>
            @endforeach
        </div>

        <div class="mb-20 mt-8">
            {{ $posts->withQueryString()->links() }}
        </div>
    @endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const spinner = document.getElementById('spinner');
        const button = form.querySelector('button[type="submit"]');

        if (form && spinner && button) {
            form.addEventListener('submit', function () {
                spinner.classList.remove('hidden');
                button.disabled = true;
                button.classList.add('opacity-50', 'cursor-not-allowed');
            });
        }
    });
</script>
@endpush
