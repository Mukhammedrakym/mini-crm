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
            padding: 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #fff;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .error {
            color: #dc2626;
            font-size: 13px;
            margin-bottom: 8px;
        }
        .success {
            color: #16a34a;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="widget">
    <form id="ticket-form" enctype="multipart/form-data">
        <div class="error" id="errors"></div>

        <input name="name" placeholder="Имя" required>
        <input name="phone" placeholder="Телефон (+7...)" required>
        <input name="email" placeholder="Email" required>
        <input name="subject" placeholder="Тема" required>
        <textarea name="message" placeholder="Сообщение" required></textarea>

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

    errorsEl.innerHTML = '';
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
            submitBtn.disabled = false;
            return;
        }

        form.reset();
        successEl.style.display = 'block';
    } catch (e) {
        errorsEl.textContent = 'Ошибка сети. Попробуйте позже.';
    } finally {
        submitBtn.disabled = false;
    }
});
</script>

</body>
</html>
