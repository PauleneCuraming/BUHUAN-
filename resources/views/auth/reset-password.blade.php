<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUHUAN – Reset Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:   #0f1923;
            --navy2:  #162030;
            --gold:   #c9a84c;
            --gold2:  #e0bc6e;
            --cream:  #f5f0e8;
            --white:  #ffffff;
            --muted:  #8a9bb0;
            --border: #2a3a4e;
            --error:  #e07070;
            --success:#6fcf97;
        }

        body {
            min-height: 100vh;
            background: var(--navy);
            font-family: 'DM Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background-image:
                radial-gradient(ellipse 80% 60% at 10% 80%, rgba(201,168,76,0.07) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 90% 10%, rgba(201,168,76,0.05) 0%, transparent 60%);
        }

        /* ── CARD ── */
        .card {
            width: 100%;
            max-width: 900px;
            background: var(--navy2);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            box-shadow: 0 32px 80px rgba(0,0,0,0.5), 0 0 0 1px rgba(201,168,76,0.08);
            animation: fadeUp .55s ease both;
        }

        @keyframes fadeUp {
            from { opacity:0; transform: translateY(24px); }
            to   { opacity:1; transform: translateY(0); }
        }

        /* ── LEFT PANEL ── */
        .left {
            background: linear-gradient(160deg, #0d1922 0%, #111e2c 60%, #0a1219 100%);
            padding: 56px 44px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .left::before {
            content: '';
            position: absolute;
            bottom: -60px; left: -60px;
            width: 260px; height: 260px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201,168,76,0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo-icon {
            width: 42px; height: 42px;
            background: var(--gold);
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 18px;
            color: var(--navy);
            flex-shrink: 0;
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            color: var(--white);
            letter-spacing: 1px;
        }
        .logo-text span { color: var(--gold); }

        .left-body { flex: 1; padding: 48px 0 32px; }

        .left-body h1 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            line-height: 1.2;
            color: var(--white);
            margin-bottom: 12px;
        }
        .left-body h1 span { color: var(--gold); }

        .left-body p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.65;
            margin-bottom: 36px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 16px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px;
            margin-bottom: 16px;
        }

        .feat-icon {
            width: 32px; height: 32px;
            background: rgba(201,168,76,0.12);
            border-radius: 8px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            font-size: 16px;
        }

        .feat-text strong { display: block; font-size: 13px; color: var(--white); font-weight: 600; margin-bottom: 2px; }
        .feat-text span   { font-size: 12px; color: var(--muted); line-height: 1.5; }

        .left-footer { font-size: 12px; color: rgba(138,155,176,0.6); }

        /* ── RIGHT PANEL ── */
        .right {
            background: var(--cream);
            padding: 56px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 10px;
        }

        .right h2 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            color: var(--navy);
            margin-bottom: 6px;
        }

        .right > p {
            font-size: 13.5px;
            color: #6b7a8d;
            margin-bottom: 24px;
        }

        /* Alert */
        .alert {
            padding: 14px 16px;
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .alert-danger {
            background: #fff5f5;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        /* Form */
        .form-group { margin-bottom: 18px; }

        label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #4a5568;
            margin-bottom: 8px;
        }

        .input-wrap { position: relative; }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 13px 16px;
            background: #fff;
            border: 1.5px solid #dde3ec;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--navy);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.15);
        }

        .eye-btn {
            position: absolute;
            right: 14px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            cursor: pointer; padding: 0;
            color: #94a3b8;
            display: grid; place-items: center;
        }
        .eye-btn svg { width: 18px; height: 18px; }

        .btn-primary {
            width: 100%;
            padding: 14px;
            background: var(--gold);
            color: var(--navy);
            border: none;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .5px;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 20px rgba(201,168,76,0.35);
            margin-top: 12px;
        }
        .btn-primary:hover {
            background: var(--gold2);
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(201,168,76,0.45);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .card { grid-template-columns: 1fr; }
            .left { display: none; }
            .right { padding: 40px 28px; }
        }
    </style>
</head>
<body>

<div class="card">
    <!-- LEFT -->
    <div class="left">
        <a href="/" class="logo">
            <div class="logo-icon">B</div>
            <span class="logo-text">BUHU<span>AN</span></span>
        </a>

        <div class="left-body">
            <h1>New<span> Credentials</span></h1>
            <p>You're almost there. Set a new, strong password to secure your resident account.</p>

            <div class="feature-item">
                <div class="feat-icon">🛡️</div>
                <div class="feat-text">
                    <strong>Strong Security</strong>
                    <span>Use a mix of letters, numbers, and symbols for better protection.</span>
                </div>
            </div>

            <div class="feature-item">
                <div class="feat-icon">✅</div>
                <div class="feat-text">
                    <strong>Instant Access</strong>
                    <span>Once reset, you can immediately sign in with your new password.</span>
                </div>
            </div>
        </div>

        <p class="left-footer">Barangay Buhuan · Online Service Management · © 2026</p>
    </div>

    <!-- RIGHT -->
    <div class="right">
        <p class="right-label">Security</p>
        <h2>Reset Password</h2>
        <p>Set your new account password below.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <span>⚠️</span>
                <div>
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email', $request->email) }}" required autofocus readonly>
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <div class="input-wrap">
                    <input type="password" id="password" name="password"
                           placeholder="••••••••" required>
                    <button type="button" class="eye-btn" onclick="togglePassword('password', this)">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-wrap">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           placeholder="••••••••" required>
                    <button type="button" class="eye-btn" onclick="togglePassword('password_confirmation', this)">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-primary">Reset Password</button>
        </form>
    </div>
</div>

<script>
function togglePassword(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const isText = input.type === 'text';
    input.type = isText ? 'password' : 'text';
    btn.querySelector('svg').innerHTML = isText
        ? '<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>'
        : '<path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46A11.804 11.804 0 001 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>';
}
</script>

</body>
</html>
