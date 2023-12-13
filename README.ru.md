![Mr.VACO Statuses Manager](https://preview.dragon-code.pro/Mr.VACO/Statuses%20Manager.svg?brand=orchid-software&pretty-title=0&github%5Brepository%5D=MrVACO%2Forchid-statuses-manager-plugin&mode=auto)

# Менеджер статусов

Позиционирую как "плагин" - управление статусами, указание статуса "по-умолчанию", использование в других плагинах.

## Установка

```bash
composer require mr-vaco/orchid-statuses-manager-plugin
```

```bash
php artisan vendor:publish -- tag=plugin-migrations
```

```bash
php artisan migrate
```

## Применение

> use MrVaco\OrchidStatusesManager\Classes\StatusClass;

#### Получить статусы по ```$slug``` группы (по-умолчанию: "full" / "base" / "short")

```php
StatusClass::LIST($slug);
```

#### Получить дефолтный статус (первый статус по ID)

```php
StatusClass::DEFAULT_ID();
StatusClass::DEFAULT_ID()->id;
StatusClass::DEFAULT_ID()->name;
StatusClass::DEFAULT_ID()->color;
```

#### Получить статус "активный" (по-умолчанию)

```php
StatusClass::ACTIVE();
StatusClass::ACTIVE()->id;
StatusClass::ACTIVE()->name;
StatusClass::ACTIVE()->color;
```

#### Получить статус "отключено" (по-умолчанию)

```php
StatusClass::DISABLED();
StatusClass::DISABLED()->id;
StatusClass::DISABLED()->name;
StatusClass::DISABLED()->color;
```

#### Получить статус "черновик" (по-умолчанию)

```php
StatusClass::DRAFT();
StatusClass::DRAFT()->id;
StatusClass::DRAFT()->name;
StatusClass::DRAFT()->color;
```

#### Получить статус по ИД

```php
StatusClass::BY_ID($id);
StatusClass::BY_ID($id)->name;
StatusClass::BY_ID($id)->color;
```
