<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif; background:#f7f7f7; }
        .container { max-width: 1200px; margin: 24px auto; background:#fff; padding: 20px; border-radius: 8px; }
        table { width:100%; border-collapse: collapse; }
        th, td { padding:10px; border-bottom:1px solid #eee; text-align:left; }
        th { background:#fafafa; }
        a { color:#2563eb; text-decoration:none; }
        .badge { padding:4px 8px; border-radius: 12px; font-size: 12px; }
        .badge.new { background:#e0f2fe; }
        .badge.in_progress { background:#fde68a; }
        .badge.done { background:#bbf7d0; }
        .actions { display:flex; gap:8px; }
        .alert { padding:10px; background:#ecfeff; border:1px solid #67e8f9; border-radius:6px; margin-bottom:12px; }
        .error { background:#fee2e2; border-color:#fecaca; }
        .btn { padding:8px 12px; border-radius:6px; border:1px solid #ddd; background:#fff; cursor:pointer; }
        .btn-primary { background:#2563eb; color:#fff; border-color:#2563eb; }
        .btn-danger { background:#ef4444; color:#fff; border-color:#ef4444; }
        select, input { padding:8px; border-radius:6px; border:1px solid #ddd; }
        .row { display:flex; gap:12px; align-items:center; }
        .muted { color:#6b7280; font-size:12px; }
    </style>
</head>
<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>
