<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Обратная связь</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: system-ui, sans-serif;
            background: transparent;
            margin: 0;
        }
        .widget {
            max-width: 420px;
            padding: 18px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        }
        .widget-title {
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 12px;
        }
        .label {
            display: block;
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 4px;
        }
        input, textarea {
            width: 100%;
            padding: 9px 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            box-sizing: border-box;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(147, 197, 253, 0.35);
        }
        textarea { min-height: 90px; resize: vertical; }
        .help { font-size: 12px; color: #6b7280; margin-top: -6px; margin-bottom: 10px; }
        button {
            width: 100%;
            padding: 10px;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.15s ease;
        }
        button:hover { background: #1e40af; }
        button:disabled { opacity: .7; cursor: default; }
        .error {
            color: #991b1b;
            background: #fee2e2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 8px;
            font-size: 13px;
            margin-bottom: 10px;
        }
        .success {
            color: #166534;
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 8px;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="widget">
    <div class="widget-title">Обратная связь</div>

    <form id="ticket-form" enctype="multipart/form-data">
        <div class="error" id="errors" style="display:none;"></div>

        <label class="label">Имя</label>
        <input name="name" placeholder="Имя" required>

        <label class="label">Телефон</label>
        <input name="phone" type="tel" placeholder="+7..." required>
        <div class="help">Формат: +77001234567</div>

        <label class="label">Email</label>
        <input name="email" type="email" placeholder="Email" required>

        <label class="label">Тема</label>
        <input name="subject" placeholder="Тема" required>

        <label class="label">Сообщение</label>
        <textarea name="message" placeholder="Сообщение" required></textarea>

        <label class="label">Файлы</label>
        <input type="file" name="files[]" multiple>

        <button type="submit">Отправить</button>
    </form>

    <div class="success" id="success" style="display:none;">
        Заявка отправлена
    </div>
</div>

<script>
document.getElementById('ticket-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const errorsEl = document.getElementById('errors');
    const successEl = document.getElementById('success');

    errorsEl.textContent = '';
    errorsEl.style.display = 'none';
    successEl.style.display = 'none';
    submitBtn.disabled = true;

    const data = new FormData(form);

    try {
        const response = await fetch('/api/tickets', {
            method: 'POST',
            body: data,
            headers: { 'Accept': 'application/json' }
        });

        const result = await response.json();

        if (!response.ok) {
            errorsEl.innerHTML = Object.values(result.errors || { error: result.message })
                .flat()
                .join('<br>');
            errorsEl.style.display = 'block';
            submitBtn.disabled = false;
            return;
        }

        form.reset();
        successEl.style.display = 'block';
    } catch (e) {
        errorsEl.textContent = 'Ошибка сети. Попробуйте позже.';
        errorsEl.style.display = 'block';
    } finally {
        submitBtn.disabled = false;
    }
});
</script>

</body>
</html>