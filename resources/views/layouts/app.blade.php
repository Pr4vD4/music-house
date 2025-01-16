<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music House - {{ $title ?? 'Главная' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="">
    <div class="flex flex-col min-h-screen">
        <!-- Шапка -->
        <header class="bg-white shadow">
            @include('layouts.partials.header')
        </header>
        
        <!-- Основной контент -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Подвал -->
        <footer>
            @include('layouts.partials.footer')
        </footer>
    </div>
    
    @stack('scripts')
</body>
</html> 