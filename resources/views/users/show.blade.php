@extends('layouts.app')

@section('title', $user['name'])

@section('content')

  <div class="bg-white p-6 rounded shadow mb-6 dark:bg-gray-800 dark:border dark:border-gray-700">
    <h1 class="text-2xl font-bold mb-2 text-white">{{ $user['name'] }}</h1>
    <p class="text-gray-600 dark:text-gray-200"><strong>Username:</strong> {{ $user['username'] }}</p>
    <p class="text-gray-600 dark:text-gray-200"><strong>Email:</strong> {{ $user['email'] }}</p>
    <p class="text-gray-600 dark:text-gray-200"><strong>Phone:</strong> {{ $user['phone'] }}</p>
    <p class="text-gray-600 dark:text-gray-200"><strong>Website:</strong> <a href="http://{{ $user['website'] }}" target="_blank" class="text-blue-500">{{ $user['website'] }}</a></p>
    <p class="text-gray-600 dark:text-gray-200"><strong>Company:</strong> {{ $user['company']['name'] }}</p>
  </div>

@endsection
