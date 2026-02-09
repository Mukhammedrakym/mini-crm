# Mini CRM – Tickets Widget (Laravel 12)

Мини-CRM для приёма и обработки заявок с сайта через iframe-виджет.  
Проект реализован в рамках тестового задания.

---

## Стек
- PHP 8.4
- Laravel 12
- MySQL 8
- Docker / docker-compose
- Blade
- spatie/laravel-permission
- spatie/laravel-medialibrary

---

## Запуск проекта

### 1. Клонирование
```bash
git clone <repository-url>
cd mini-crm
```

### 2. Запуск контейнеров
```bash
docker compose up -d
```

### 3. Установка зависимостей и сборка frontend
```bash
docker compose run --rm node npm install
docker compose run --rm node npm run build
```

### 4. Миграции и сиды
```bash
docker compose exec app php artisan migrate --seed
docker compose exec app php artisan storage:link
```


## ENV настройки

1) Скопировать шаблон:
cp .env.example .env

2) Сгенерировать ключ:
```bash
docker compose exec app php artisan key:generate
```

3) Минимальные переменные:
APP_URL=http://localhost:8080
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=mini_crm
DB_USERNAME=root
DB_PASSWORD=root


## Тестовые пользователи

### Admin
```bash
email: admin@test.kz
password: password
```

### Manager
```bash
email: manager@test.kz
password: password
```

## Виджет обратной связи

### Страница:
```bash
GET /widget
```

### Форма:
- имя
- телефон
- email
- тема
- сообщение
- файлы

Отправка происходит через API:

```bash
POST /api/tickets
```

### Пример встраивания через iframe

```bash
<iframe
  src="http://localhost:8080/widget"
  width="400"
  height="600"
  style="border:none">
</iframe>
```

## Админ-панель

Доступна только авторизованным пользователям с ролями ```admin``` или ```manager```.

### Функционал:

* список заявок
* фильтрация по:
    * статусу
    * дате
    * email
    * телефону
* просмотр заявки
* скачивание файлов
* смена статуса заявки

Маршруты:

```bash
/admin/tickets
/admin/tickets/{id}
```

## API

### Создание заявки

```bash
POST /api/tickets
```

Пример запроса (curl):
```bash
curl -X POST http://localhost:8080/api/tickets \
  -H "Accept: application/json" \
  -F "name=Example Name" \
  -F "phone=+77777777771" \
  -F "email=example@test.kz" \
  -F "subject=Example subject" \
  -F "message=Example message"
```

### Статистика заявок

```bash
GET /api/tickets/statistics?period=day|week|month
```

Пример ответа:
```bash
{
  "data": {
    "period": "day",
    "from": "2026-02-09",
    "to": "2026-02-09",
    "total": 203,
    "by_status": {
      "done": 63,
      "in_progress": 64,
      "new": 76
    }
  }
}
```

## Архитектурные решения

* Вся бизнес-логика вынесена в Service layer
* Контроллеры максимально тонкие
* Валидация через FormRequest
* Статусы заявок реализованы через Enum
* Файлы хранятся через spatie/laravel-medialibrary
* Статистика реализована с использованием Carbon + Eloquent scopes
* Репозитории не используются, так как логика простая и не переиспользуется
* Создание заявки выполняется в транзакции (Customer + Ticket + Media) для атомарности и консистентности данных
* - Проект покрыт базовыми feature‑тестами (создание заявки, лимит, статистика)