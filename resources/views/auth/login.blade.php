<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUHUAN – Sign In</title>
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
            --input-bg: #1c2d3f;
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
            font-size: 36px;
            line-height: 1.2;
            color: var(--white);
            margin-bottom: 8px;
        }
        .left-body h1 span { color: var(--gold); }

        .left-body p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.65;
            margin-bottom: 36px;
        }

        .feature-list { list-style: none; display: flex; flex-direction: column; gap: 16px; }

        .feature-list li {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 16px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px;
            transition: border-color .2s;
        }
        .feature-list li:hover { border-color: rgba(201,168,76,0.25); }

        .feat-icon {
            width: 32px; height: 32px;
            background: rgba(201,168,76,0.12);
            border-radius: 8px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            margin-top: 2px;
        }
        .feat-icon svg { width: 15px; height: 15px; fill: var(--gold); }

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

        /* Notice */
        .notice {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #fff8ec;
            border: 1px solid #f0d98a;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 24px;
        }
        .notice svg { width: 16px; height: 16px; fill: #c9a030; flex-shrink: 0; margin-top: 1px; }
        .notice p { font-size: 12.5px; color: #7a6020; line-height: 1.55; }

        /* Form */
        .form-group { margin-bottom: 18px; }

        label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #4a5568;
            margin-bottom: 7px;
        }

        .input-wrap { position: relative; display: flex; align-items: center; }
        .input-wrap input { padding-right: 44px; }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
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

        /* Fix double eye icon issue (hide browser defaults) */
        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }

        .input-wrap .eye-btn {
            position: absolute;
            right: 12px;
            background: none; border: none;
            cursor: pointer; padding: 6px;
            color: #94a3b8;
            display: grid; place-items: center;
            border-radius: 50%;
            transition: background .2s;
        }
        .eye-btn:hover { background: rgba(0,0,0,0.05); }
        .eye-btn svg { width: 18px; height: 18px; display: block; fill: currentColor; }

        .row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .checkbox-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #4a5568;
            cursor: pointer;
        }
        .checkbox-wrap input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--gold);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 13px;
            color: var(--gold);
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link:hover { text-decoration: underline; }

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
            transition: background .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 4px 20px rgba(201,168,76,0.35);
        }
        .btn-primary:hover {
            background: var(--gold2);
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(201,168,76,0.45);
        }
        .btn-primary:active { transform: translateY(0); }

        .divider {
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            margin: 20px 0;
            position: relative;
        }
        .divider::before, .divider::after {
            content: '';
            position: absolute;
            top: 50%; width: 40%;
            height: 1px;
            background: #dde3ec;
        }
        .divider::before { left: 0; }
        .divider::after  { right: 0; }

        .register-link {
            text-align: center;
            font-size: 13.5px;
            color: #6b7a8d;
        }
        .register-link a {
            color: var(--gold);
            font-weight: 600;
            text-decoration: none;
        }
        .register-link a:hover { text-decoration: underline; }

        /* ── RESPONSIVE ── */
        @media (max-width: 680px) {
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
            <h1>Welcome back to<br><span>BUHUAN</span></h1>
            <p>Sign in to manage your barangay document requests and appointments online.</p>

            <ul class="feature-list">
                <li>
                    <div class="feat-icon">
                        <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    </div>
                    <div class="feat-text">
                        <strong>Email Notifications</strong>
                        <span>Updates on requests and appointments sent to your inbox.</span>
                    </div>
                </li>
                <li>
                    <div class="feat-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                    </div>
                    <div class="feat-text">
                        <strong>Verified Access</strong>
                        <span>Approved by barangay administrators before access is granted.</span>
                    </div>
                </li>
                <li>
                    <div class="feat-icon">
                        <svg viewBox="0 0 24 24"><path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1s-2.4.84-2.82 2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2zm-7 0a1 1 0 110 2 1 1 0 010-2zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                    </div>
                    <div class="feat-text">
                        <strong>Track Your Requests</strong>
                        <span>Monitor document status from submission to pickup.</span>
                    </div>
                </li>
            </ul>
        </div>

        <p class="left-footer">Barangay Buhuan · Calapan City, Oriental Mindoro · © 2026</p>
    </div>

    <!-- RIGHT -->
    <div class="right">
        <p class="right-label">Portal</p>
        <h2>Sign in to your account</h2>
        <p>Enter your registered email and password to continue.</p>

        <div class="notice">
            <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
            <p>Your account must be approved by a barangay administrator before you can sign in.</p>
        </div>

        {{-- Laravel form --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email"
                       placeholder="yourname@email.com"
                       value="{{ old('email') }}" required autofocus>
                @error('email')
                    <small style="color:var(--error);font-size:12px;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <input type="password" id="password" name="password"
                           placeholder="Enter your password" required>
                    <button type="button" class="eye-btn" onclick="togglePassword('password', this)">
                        <svg id="eye-icon-password" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <small style="color:var(--error);font-size:12px;">{{ $message }}</small>
                @enderror
            </div>

            <div class="row-between">
                <label class="checkbox-wrap" style="text-transform:none;letter-spacing:0;font-weight:400;">
                    <input type="checkbox" name="remember" id="remember">
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="btn-primary">Sign In</button>
        </form>

        <div class="divider">or</div>

        <p class="register-link">
            Don't have an account? 
            <a href="{{ route('register') }}">Create a resident account</a> 
            <span style="display:block; font-size:12px; margin-top:4px; opacity:0.8;">It's free and only takes a few minutes</span>
        </p>
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