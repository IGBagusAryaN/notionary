@extends('layouts.app')

@section('title', $post ? 'Edit Post' : 'Create Post')

@section('content')
    <h1 class="text-2xl font-bold mb-4 dark:text-white">
        {{ $post ? 'Edit Post' : 'Create New Post' }}
    </h1>

    <form method="POST" action="{{ $post ? route('posts.update', $post['id']) : route('posts.store') }}" class="space-y-5 dark:text-white">
        @csrf
        @if ($post)
            @method('PUT')
        @endif

        <div>
            <label class="block text-sm font-semibold mb-1" for="title">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $post['title'] ?? '') }}"
                class="w-full p-2 border rounded focus:outline-none dark:border-gray-600 dark:bg-gray-800  focus:ring focus:border-blue-400 @error('title') border-red-500 @enderror">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1" for="body">Content</label>
            <textarea id="body" name="body" rows="5"
                class="w-full p-2 border rounded dark:border-gray-600 dark:bg-gray-800 focus:outline-none focus:ring focus:border-blue-400 @error('body') border-red-500 @enderror">{{ old('body', $post['body'] ?? '') }}</textarea>
            @error('body')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" class="!bg-bluePrimary hover:!bg-blue-800 text-white font-medium px-5 py-2 rounded w-full md:!w-auto">
                {{ $post ? 'Update Post' : 'Create Post' }}
            </button>
        </div>
    </form>
@endsection
