<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        :root {
            --bg-color: #0f172a;
            --card-bg: #1e293b;
            --accent: #6366f1;
            --accent-hover: #4f46e5;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #334155;
            --input-bg: #0f172a;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 420px;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 28px 24px;
            text-align: center;
        }

        .card-header h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .card-header p {
            margin: 6px 0 0;
            font-size: 13px;
            color: #e0e7ff;
            opacity: 0.9;
        }

        .card-body {
            padding: 24px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 13px;
            color: var(--text-muted);
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
            color: var(--text-main);
            outline: none;
            transition: all 0.2s ease;
        }

        .form-group input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
        }

        .btn-submit {
            width: 100%;
            background-color: var(--accent);
            color: #ffffff;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: background-color 0.2s ease;
        }

        .btn-submit:hover {
            background-color: var(--accent-hover);
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.15);
            border: 1px solid #10b981;
            color: #34d399;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .alert-error {
            background-color: rgba(239, 68, 68, 0.15);
            border: 1px solid #ef4444;
            color: #f87171;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h2>Registration Form</h2>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="full_name">Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" value="{{ old('full_name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a secure password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
            </div>

            <button type="submit" class="btn-submit">Register</button>
        </form>
    </div>
</div>

</body>
</html>