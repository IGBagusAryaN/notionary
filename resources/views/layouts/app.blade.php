<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Laravel API App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    @notifyCss
</head>

<body class="bg-white dark:bg-[#1d1d1d] font-sans dark:text-white">
    @include('components.navbar')
    <x-notify::notify />

    @if (session('notify.message'))
        <script>
            notify('{{ session('notify.message') }}', '{{ session('notify.type') }}');
        </script>
    @endif

    <main class="container max-w-6xl mx-auto  px-4 pt-8">
        @yield('content')
    </main>


    @notifyJs
    <script>
        const FAV_KEY = 'favoritePosts';

        function toggleFavorite(postId) {
            let favs = JSON.parse(localStorage.getItem(FAV_KEY)) || [];

            if (favs.includes(postId)) {
                favs = favs.filter(id => id !== postId);
                document.getElementById(`fav-btn-${postId}`).innerText = 'Add to Favorites';
            } else {
                favs.push(postId);
                document.getElementById(`fav-btn-${postId}`).innerText = 'Remove Favorite';
            }

            localStorage.setItem(FAV_KEY, JSON.stringify(favs));
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

        document.addEventListener("DOMContentLoaded", () => {
            let favs = JSON.parse(localStorage.getItem(FAV_KEY)) || [];

            favs.forEach(id => {
                const btn = document.getElementById(`fav-btn-${id}`);
                if (btn) {
                    btn.innerText = 'Remove Favorite';
                }
            });
        });
    </script>
    <script>
        const theme = localStorage.getItem('theme');
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        }

        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }
    </script>
    <script src="//unpkg.com/alpinejs" defer></script>


</body>

</html>
