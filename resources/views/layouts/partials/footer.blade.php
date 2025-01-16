<div class="bg-gray-800 text-white mt-12">
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-4">Music House</h3>
                <p class="text-gray-300">Ваш путь в мир музыки начинается здесь</p>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-4">Навигация</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">О нас</a></li>
                    <li><a href="{{ route('catalog') }}" class="text-gray-300 hover:text-white">Каталог</a></li>
                    <li><a href="{{ route('contacts') }}" class="text-gray-300 hover:text-white">Где нас найти?</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-4">Контакты</h3>
                <ul class="space-y-2 text-gray-300">
                    <li>Телефон: +7 (XXX) XXX-XX-XX</li>
                    <li>Email: info@musichouse.ru</li>
                    <li>Адрес: г. Москва, ул. Примерная, д. 1</li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} Music House. Все права защищены.</p>
        </div>
    </div>
</div> 