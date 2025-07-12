@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <a href="{{ route('posts.index') }}" class="text-blue-500 hover:underline">← Back to Posts</a>
        <button onclick="toggleFavorite({{ $post['id'] }})"
         class="favorite-btn bg-blue-600 hover:bg-blue-800 text-sm px-2 py-1 rounded">
         <span id="fav-btn-{{ $post['id'] }}" class="text-white">Add to Favorites</span>
     </button>
    </div>


    <div class="bg-white p-6 rounded shadow dark:bg-gray-800 dark:border dark:border-gray-700">
        <h1 class="text-2xl font-bold mb-2">{{ $post['title'] }}</h1>
        <p class="text-gray-700 dark:text-gray-200">{{ $post['body'] }}</p>
    </div>

    <div class="my-8 ">
        <h2 class="text-xl font-semibold mb-4">Comments ({{ count($comments) }})</h2>

        <div class="space-y-4">
            @forelse ($comments as $comment)
                <div class="bg-gray-100 p-4 rounded shadow-sm dark:bg-gray-700 dark:border dark:border-gray-600">
                    <p class="text-sm font-semibold">{{ $comment['name'] }} (<a href="mailto:{{ $comment['email'] }}"
                            class="text-blue-500">{{ $comment['email'] }}</a>)</p>
                    <p class="text-gray-800 mt-2 dark:text-gray-200">{{ $comment['body'] }}</p>
                </div>
            @empty
                <p class="text-gray-500">No comments found.</p>
            @endforelse
        </div>
    </div>
@endsection
