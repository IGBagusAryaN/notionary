@extends('layouts.app')

@section('title', 'Favorite Posts')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Your Favorite Posts</h1>

    <div id="favorite-list" class="space-y-4 text-sm">
        <p>Loading favorites...</p>
    </div>
@endsection
<script>
    const FAV_KEY = 'favoritePosts';

    async function loadFavorites() {
        const favs = JSON.parse(localStorage.getItem(FAV_KEY)) || [];
        const container = document.getElementById('favorite-list');
        container.innerHTML = '';

        if (favs.length === 0) {
            container.innerHTML = '<p>You have no favorite posts.</p>';
            return;
        }

        for (let id of favs) {
            const res = await fetch(`https://jsonplaceholder.typicode.com/posts/${id}`);
            const post = await res.json();

            const item = document.createElement('div');
            item.className = 'border rounded p-4 relative dark:bg-gray-800 dark:border-gray-700 group';
            item.innerHTML = `
          <button onclick="removeFavorite(${post.id}, this)"
                  class="absolute top-2 right-2 bg-red-500 text-white text-xs px-3 py-1 rounded hover:bg-red-600 transition  group-hover:block">
            Remove
          </button>

          <h2 class="font-bold text-md mb-2">${post.title}</h2>
          <p class="text-gray-700 dark:text-gray-200 text-sm">${post.body}</p>
        `;
            container.appendChild(item);
        }
    }

    function removeFavorite(postId, btn) {
        let favs = JSON.parse(localStorage.getItem(FAV_KEY)) || [];
        favs = favs.filter(id => id !== postId);
        localStorage.setItem(FAV_KEY, JSON.stringify(favs));

        const postEl = btn.closest('div');
        if (postEl) postEl.remove();

        const container = document.getElementById('favorite-list');
        if (container && container.children.length === 0) {
            container.innerHTML = '<p>You have no favorite posts.</p>';
        }
    }

    document.addEventListener('DOMContentLoaded', loadFavorites);
</script>
