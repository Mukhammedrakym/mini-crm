<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            background: #f3f4f6;
            color: #111827;
            margin: 0;
            line-height: 1.5;
        }
        .container {
            max-width: 1200px;
            margin: 32px auto;
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        }
        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 16px;
        }
        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            margin-bottom: 14px;
        }
        .table-wrap {
            overflow: auto;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        th, td {
            padding: 12px 14px;
            border-bottom: 1px solid #f1f5f9;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #f9fafb;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #6b7280;
            position: sticky;
            top: 0;
            z-index: 1;
        }
        tr:hover td { background: #f8fafc; }
        a { color: #2563eb; text-decoration: none; }
        .badge {
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .02em;
            display: inline-block;
        }
        .badge.new { background: #e0f2fe; color: #0369a1; }
        .badge.in_progress { background: #fef3c7; color: #92400e; }
        .badge.done { background: #dcfce7; color: #166534; }
        .actions { display: flex; gap: 8px; }
        .alert {
            padding: 10px 36px 10px 12px;
            border-radius: 8px;
            margin-bottom: 12px;
            position: relative;
            background: #ecfeff;
            border: 1px solid #67e8f9;
        }
        .alert-success {
            background: #dcfce7;
            border-color: #bbf7d0;
            color: #166534;
        }
        .alert-close {
            position: absolute;
            top: 6px;
            right: 8px;
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            color: inherit;
        }
        .error { background: #fee2e2; border-color: #fecaca; }
        .btn {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #fff;
            cursor: pointer;
            transition: 0.15s ease;
        }
        .btn:hover { background: #f9fafb; }
        .btn-primary { background: #2563eb; color: #fff; border-color: #2563eb; }
        .btn-primary:hover { background: #1e40af; }
        select, input {
            padding: 8px 10px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #fff;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(147, 197, 253, 0.35);
        }
        .row { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
        .muted { color: #6b7280; font-size: 12px; }
        .section {
            padding: 16px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #fafafa;
            margin-bottom: 14px;
        }
        .section-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #6b7280;
            margin: 0 0 8px;
        }
        .kv { display: grid; grid-template-columns: 140px 1fr; gap: 6px 12px; }
        .kv .label { color: #6b7280; }
        .file-list { margin: 0; padding-left: 18px; }
        .message { white-space: pre-wrap; }
        .nowrap { white-space: nowrap; }
        .pagination { margin-top: 12px; display: flex; gap: 8px; align-items: center; }
    </style>
</head>
<script>
    document.addEventListener('click', function (e) {
        if (e.target && e.target.hasAttribute('data-close')) {
            e.target.closest('.alert')?.remove();
        }
    });

    setTimeout(function () {
        document.querySelectorAll('.alert-success').forEach(function (el) {
            el.remove();
        });
    }, 4500);
</script>
<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>