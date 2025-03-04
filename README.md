# О проекте

Проект реализующий консольную artisan-команду в Laravel для работы с интервалами.


# Установка

1. Клонирование репозитория:
git clone https://github.com/Evgstaroverov/EdTask.git

2.  Переход в директорию с репозиторием:
```bash
cd EdTask
```

3. Установка зависимостей:
```bash
composer install
```

4. Переименование файла .env.example в .env:

5. Генерация ключа приложения:
```bash
php artisan key:generate
```

6. Указание параметров подключения к базе данных в .env

7. Запуск миграции и сидеров:
```bash
php artisan migrate --seed
```


# Использование

Команда, извлекающая из БД интервалы, пересекающиеся с интервалом [N, M].
Пример команды:
```bash
php artisan intervals:list --left=15 --right=30
```


# Структура проекта(частично)

- app/Console/Commands/IntervalsList.php: Код команды intervals:list.
- database/migrations/: Миграции для создания таблицы intervals.
- database/seeders/IntervalsTableSeeder.php: Сидер для заполнения таблицы случайными данными.
- routes/console.php: Консольные маршруты (если используются).
- .env: Файл конфигурации окружения.


