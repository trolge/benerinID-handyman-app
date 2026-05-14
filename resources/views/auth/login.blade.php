<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - benerin.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; color: #111827; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .auth-container { background: #ffffff; padding: 2.5rem; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); width: 100%; max-width: 400px; transform: translateY(0); transition: box-shadow 0.3s ease; }
        .auth-container:hover { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
        .brand { font-size: 1.5rem; font-weight: 700; color: #1a56db; text-align: center; margin-bottom: 0.5rem; display: flex; align-items: center; justify-content: center; gap: 8px;}
        .brand span { color: #111827; }
        .subtitle { text-align: center; color: #6b7280; margin-bottom: 2rem; font-size: 0.95rem; }
        .form-group { margin-bottom: 1.25rem; }
        label { display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.5rem; color: #374151; }
        input[type="email"], input[type="password"], input[type="text"], select { width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s, box-shadow 0.2s; font-family: inherit; }
        input:focus, select:focus { outline: none; border-color: #1a56db; box-shadow: 0 0 0 3px rgba(26, 86, 219, 0.2); }
        .btn-primary { width: 100%; padding: 0.75rem; background-color: #1a56db; color: white; border: none; border-radius: 8px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background-color 0.2s, transform 0.1s; display: flex; justify-content: center; align-items: center; gap: 8px;}
        .btn-primary:hover { background-color: #1e40af; }
        .btn-primary:active { transform: translateY(1px); }
        .btn-primary svg { transition: transform 0.2s; }
        .btn-primary:hover svg { transform: translateX(4px); }
        .auth-links { text-align: center; margin-top: 1.5rem; font-size: 0.875rem; color: #6b7280; }
        .auth-links a { color: #1a56db; text-decoration: none; font-weight: 500; transition: color 0.2s; }
        .auth-links a:hover { color: #1e40af; text-decoration: underline; }
        .error-msg { background-color: #fee2e2; color: #b91c1c; padding: 0.75rem; border-radius: 8px; font-size: 0.875rem; margin-bottom: 1rem; border: 1px solid #f87171;}
        ul { list-style: none; padding: 0; }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="brand">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#1a56db"/>
                <path d="M2 17L12 22L22 17M2 12L12 17L22 12" stroke="#1a56db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div>benerin<span>.id</span></div>
        </div>
        <p class="subtitle">Welcome back! Please log in.</p>

        @if ($errors->any())
            <div class="error-msg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn-primary">
                Log In
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>
        </form>

        <div class="auth-links">
            <p>Don't have an account? <a href="{{ route('register') }}">Sign up here</a></p>
        </div>
    </div>
</body>
</html>
