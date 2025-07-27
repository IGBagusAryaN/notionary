@extends('layouts.app')

@section('title', $user['name'])

@section('content')
<div class="text-gray-800 dark:text-white">
  <h1 class="text-3xl font-bold mb-6">Profile</h1>
  <p class="text-gray-800 dark:text-gray-400 mb-8">View all your profile details here.</p>

  <div class="grid md:grid-cols-3 gap-8 mb-12">
    <div class="dark:bg-gray-800 p-6 rounded-xl border dark:border-gray-700 flex flex-col items-center">
      <img src="https://api.dicebear.com/7.x/adventurer/svg?seed={{ urlencode($user['name']) }}" class="w-40 h-40 rounded-full mb-4 border-4 border-gray-200 dark:border-gray-600" alt="Profile Image">
      <h2 class="text-xl font-bold dark:text-white">{{ $user['name'] }}</h2>
    </div>

    <div class="md:col-span-2 dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
      <div class="grid md:grid-cols-2 gap-4 text-sm">
        <p><span class="dark:text-gray-400">Username:</span> {{ $user['username'] }} </p>
        <p><span class="dark:text-gray-400">Email:</span> {{ $user['email'] }}</p>
        <p><span class="dark:text-gray-400">Phone:</span> {{ $user['phone'] }} </p>
        <p><span class="dark:text-gray-400">Website:</span><a href="http://{{ $user['website'] }}" target="_blank" class="text-blue-500"> {{ $user['website'] }}</a></p>
        <p><span class="dark:text-gray-400">Company:</span> {{ $user['company']['name'] }}</p>
        <p>
          <span class="dark:text-gray-400">Availability:</span>
          <span class="text-green-500 font-semibold ml-1">✔ Available for Collaboration</span>
        </p>
      </div>

      <div class="mt-24 text-sm">
        <p class="">
          <span class="text-gray-800 dark:text-gray-400">Badges:</span>
          <span class="text-cyan-400 font-medium">🏅 Top Collaborator</span>
        </p>
      </div>
    </div>
  </div>
@endsection
