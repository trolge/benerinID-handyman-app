<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - benerin.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; color: #111827; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 2rem 0; }
        .auth-container { background: #ffffff; padding: 2.5rem; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); width: 100%; max-width: 450px; transition: box-shadow 0.3s ease; }
        .auth-container:hover { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
        .brand { font-size: 1.5rem; font-weight: 700; color: #1a56db; text-align: center; margin-bottom: 0.5rem; display: flex; align-items: center; justify-content: center; gap: 8px;}
        .brand span { color: #111827; }
        .subtitle { text-align: center; color: #6b7280; margin-bottom: 2rem; font-size: 0.95rem; }
        .form-group { margin-bottom: 1.25rem; }
        .form-row { display: flex; gap: 1rem; }
        .form-row .form-group { flex: 1; margin-bottom: 0; }
        .form-row-container { margin-bottom: 1.25rem; display: flex; flex-direction: column; gap: 1.25rem; }
        @media (min-width: 640px) {
            .form-row-container { flex-direction: row; }
        }
        label { display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.5rem; color: #374151; }
        input[type="email"], input[type="password"], input[type="text"], input[type="tel"], select { width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s, box-shadow 0.2s; font-family: inherit; }
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
        ul { list-style: none; padding: 0; margin-left: 1rem; }
        ul li { list-style-type: disc; }
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
        <p class="subtitle">Join the handyman marketplace</p>

        @if ($errors->any())
            <div class="error-msg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com">
            </div>

            <div class="form-row-container">
                <div class="form-group">
                    <label for="PhoneNumber">Phone Number</label>
                    <input type="tel" id="PhoneNumber" name="PhoneNumber" value="{{ old('PhoneNumber') }}" placeholder="+1 234 567 890">
                </div>
                <div class="form-group">
                    <label for="Role">I am a...</label>
                    <select id="Role" name="Role" required>
                        <option value="customer" {{ old('Role') == 'customer' ? 'selected' : '' }}>Customer</option>
                        <option value="handyman" {{ old('Role') == 'handyman' ? 'selected' : '' }}>Handyman (Pro)</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Min 8 characters">
            </div>

            <button type="submit" class="btn-primary">
                Create Account
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5c-1.1 0-2 .9-2 2v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
            </button>
        </form>

        <div class="auth-links">
            <p>Already have an account? <a href="{{ route('login') }}">Log in here</a></p>
        </div>
    </div>
</body>
</html>
