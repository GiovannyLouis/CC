<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Smart Face Blur')</title>
    <style>
        :root {
            --bg: #0f172a;
            --surface: #1e293b;
            --surface-soft: #334155;
            --text: #f8fafc;
            --muted: #94a3b8;
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --danger: #ef4444;
            --success: #22c55e;
            --border: #334155;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            line-height: 1.5;
        }

        .container {
            max-width: 1120px;
            margin: 0 auto;
            padding: 2rem 1.25rem;
        }

        .header {
            margin-bottom: 1.75rem;
        }

        .header h1 {
            margin: 0 0 0.35rem;
            font-size: 1.75rem;
            font-weight: 700;
        }

        .header p {
            margin: 0;
            color: var(--muted);
            font-size: 0.95rem;
        }
    </style>
    @stack('styles')
</head>
<body>
    <main class="container">
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>