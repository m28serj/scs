#Тестовое задание для Simple Cloud Solutions#

## Развертывание

1. Клонируем репозиторий
```php
git clone https://github.com/m28serj/scs.git
```
2. Подтягиваем зависимости
```php
cd scs && composer install
```
3. Редактируем конфигурацию базы данных (.env / app/config/database.php)

3. Миграции и начальные данные
```php
php artisan migrate && php artisan db:seed
```
