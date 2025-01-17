<nav class="container mx-auto px-4 py-4">
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-8">
            <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">Music House</a>
            
            <div class="hidden md:flex space-x-4">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">О нас</a>
                <a href="{{ route('catalog') }}" class="text-gray-600 hover:text-gray-900">Каталог</a>
                <a href="{{ route('contacts') }}" class="text-gray-600 hover:text-gray-900">Где нас найти?</a>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            @auth
                <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-gray-900">Корзина</a>
                <a href="{{ route('orders.index') }}" class="text-gray-600 hover:text-gray-900">Мои заказы</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-600 hover:text-gray-900">Выход</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Вход</a>
                <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900">Регистрация</a>
            @endauth
        </div>
    </div>
</nav> 