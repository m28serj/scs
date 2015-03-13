#Тестовое задание для Simple Cloud Solutions#

## Развертывание

Клонируем репозиторий
```php
git clone https://github.com/m28serj/scs.git
```
Подтягиваем зависимости
```php
cd scs && composer install
```
Редактируем конфигурацию базы данных (.env | app/config/database.php)

## Миграции и начальные данные
```php
php artisan migrate && php artisan db:seed
```
