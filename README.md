# Dual Task Project

## Используемые технологии

### Backend
- Laravel 10.x - PHP фреймворк
- Filament 3.x - Админ-панель и панель управления
- Laravel Shopping Cart - Система корзины покупок
- MySQL - База данных

### Frontend
- Blade - Шаблонизатор
- Tailwind CSS - Утилитарный CSS фреймворк
- Alpine.js - JavaScript фреймворк
- Heroicons - Набор иконок

## Требования
- PHP 8.1 или выше
- Composer
- Node.js и NPM
- MySQL 5.7 или выше

## Установка

1. Клонируйте репозиторий:
```bash
git clone [url-репозитория]
cd [repo-name]
```

2. Установите PHP зависимости:
```bash
composer install
```

3. Установите JavaScript зависимости:
```bash
npm install
```

4. Скопируйте файл окружения:
```bash
cp .env.example .env
```

5. Настройте файл .env:
- Установите параметры подключения к базе данных:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Сгенерируйте ключ приложения:
```bash
php artisan key:generate
```

7. Выполните миграции и заполните базу данных начальными данными:
```bash
php artisan migrate --seed
```

8. Скомпилируйте frontend assets:
```bash
npm run dev
```

9. Запустите локальный сервер:
```bash
php artisan serve
```

## Доступ к приложению

После установки приложение будет доступно по адресу: `http://localhost:8000`

### Тестовые учетные записи

1. Администратор:
- Email: admin@example.com
- Пароль: password

2. Пользователь:
- Email: user@example.com
- Пароль: password

## Основные функции

- Управление товарами через админ-панель
- Управление категориями через админ-панель
- Система заказов с отслеживанием статусов:
  - Новый
  - В обработке
  - Выполнен
  - Отменён
- Управление пользователями
- Корзина покупок с автоматическим расчётом

## Админ-панель (Filament)

Доступ к админ-панели: `http://localhost:8000/admin`

Возможности админ-панели:
- Управление заказами (просмотр, изменение статуса, указание причины отмены)
- Управление товарами и категориями
- Просмотр информации о пользователях

## Структура проекта

- `app/Models` - Модели приложения
- `app/Http/Controllers` - Контроллеры
- `database/migrations` - Миграции базы данных
- `database/seeders` - Сидеры для заполнения базы данных
- `routes` - Маршруты приложения
- `resources/views` - Шаблоны представлений

## Поддержка

При возникновении вопросов или проблем, создайте issue в репозитории проекта.
