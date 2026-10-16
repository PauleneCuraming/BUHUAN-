<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUHUAN – Forgot Password</title>
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
            margin-bottom: 32px;
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
        .alert-success {
            background: #eefdf5;
            border: 1px solid #bbf7d0;
            color: #166534;
        }
        .alert-danger {
            background: #fff5f5;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        /* Form */
        .form-group { margin-bottom: 24px; }

        label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #4a5568;
            margin-bottom: 8px;
        }

        input[type="email"] {
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
        }
        .btn-primary:hover {
            background: var(--gold2);
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(201,168,76,0.45);
        }

        .back-link {
            text-align: center;
            margin-top: 24px;
            font-size: 13.5px;
        }
        .back-link a {
            color: var(--gold);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .back-link a:hover { text-decoration: underline; }

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
            <h1>Account<span> Recovery</span></h1>
            <p>Don't worry, it happens. Follow the steps to safely regain access to your resident account.</p>

            <div class="feature-item">
                <div class="feat-icon">🔐</div>
                <div class="feat-text">
                    <strong>Secure Reset</strong>
                    <span>We use encrypted tokens to ensure only you can reset your password.</span>
                </div>
            </div>

            <div class="feature-item">
                <div class="feat-icon">📧</div>
                <div class="feat-text">
                    <strong>Email Link</strong>
                    <span>A recovery link will be sent to your registered email address.</span>
                </div>
            </div>
        </div>

        <p class="left-footer">Barangay Buhuan · Online Service Management · © 2026</p>
    </div>

    <!-- RIGHT -->
    <div class="right">
        <p class="right-label">Recovery</p>
        <h2>Forgot Password?</h2>
        <p>Enter your email and we'll send you a link to reset your password.</p>

        @if (session('status'))
            <div class="alert alert-success">
                <span>✅</span>
                <div>{{ session('status') }}</div>
            </div>
        @endif

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

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email"
                       placeholder="yourname@email.com"
                       value="{{ old('email') }}" required autofocus>
            </div>

            <button type="submit" class="btn-primary">Send Reset Link</button>
        </form>

        <div class="back-link">
            <a href="{{ route('login') }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Back to Sign In
            </a>
        </div>
    </div>
</div>

</body>
</html>
