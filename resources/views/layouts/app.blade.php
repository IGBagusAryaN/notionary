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
@stack('scripts')
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
