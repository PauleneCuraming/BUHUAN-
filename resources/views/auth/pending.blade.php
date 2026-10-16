<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUHUAN – Registration Pending</title>
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
            --success: #6fcf97;
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
        }

        .feat-icon {
            width: 32px; height: 32px;
            background: rgba(201,168,76,0.12);
            border-radius: 8px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }
        .feat-icon svg { width: 16px; height: 16px; fill: var(--gold); }

        .feat-text strong { display: block; font-size: 13px; color: var(--white); font-weight: 600; margin-bottom: 2px; }
        .feat-text span   { font-size: 12px; color: var(--muted); line-height: 1.5; }

        /* ── RIGHT PANEL ── */
        .right {
            background: var(--cream);
            padding: 56px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .success-icon {
            width: 80px; height: 80px;
            background: rgba(111, 207, 151, 0.1);
            color: var(--success);
            border-radius: 50%;
            display: grid;
            place-items: center;
            margin: 0 auto 24px;
        }
        .success-icon svg { width: 40px; height: 40px; }

        .right h2 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            color: var(--navy);
            margin-bottom: 12px;
        }

        .right p {
            font-size: 15px;
            color: #6b7a8d;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .info-box {
            background: #fff;
            border: 1.5px solid #dde3ec;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 32px;
            text-align: left;
        }

        .info-item {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }
        .info-item:last-child { margin-bottom: 0; }

        .info-dot {
            width: 8px; height: 8px;
            background: var(--gold);
            border-radius: 50%;
            margin-top: 6px;
            flex-shrink: 0;
        }

        .info-content strong {
            display: block;
            font-size: 13px;
            color: var(--navy);
            margin-bottom: 2px;
        }
        .info-content span {
            font-size: 12.5px;
            color: #6b7a8d;
        }

        .btn-primary {
            display: inline-block;
            width: 100%;
            padding: 14px;
            background: var(--gold);
            color: var(--navy);
            text-decoration: none;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .5px;
            transition: background .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 4px 20px rgba(201,168,76,0.35);
        }
        .btn-primary:hover {
            background: var(--gold2);
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(201,168,76,0.45);
        }

        @media (max-width: 680px) {
            .card { grid-template-columns: 1fr; }
            .left { display: none; }
            .right { padding: 40px 28px; }
        }
    </style>
</head>
<body>

<div class="card">
    <div class="left">
        <a href="/" class="logo">
            <div class="logo-icon">B</div>
            <span class="logo-text">BUHU<span>AN</span></span>
        </a>

        <div class="left-body">
            <h1>Almost <span>there!</span></h1>
            <p>Your account has been successfully created and is now waiting for administrator review.</p>

            <ul class="feature-list">
                <li>
                    <div class="feat-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                    </div>
                    <div class="feat-text">
                        <strong>Manual Verification</strong>
                        <span>We verify each resident to ensure the security of our community.</span>
                    </div>
                </li>
                <li>
                    <div class="feat-icon">
                        <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    </div>
                    <div class="feat-text">
                        <strong>Email Notification</strong>
                        <span>You will receive an email as soon as your account is approved.</span>
                    </div>
                </li>
            </ul>
        </div>

        <p style="font-size: 12px; color: rgba(138,155,176,0.6);">Barangay Buhuan · © 2026</p>
    </div>

    <div class="right">
        <div class="success-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>
        <h2>Registration Successful!</h2>
        <p>Thank you for registering with BUHUAN. Your account is currently <strong>pending approval</strong> by a barangay administrator.</p>

        <div class="info-box">
            <div class="info-item">
                <div class="info-dot"></div>
                <div class="info-content">
                    <strong>What happens next?</strong>
                    <span>An administrator will review your submitted ID and details.</span>
                </div>
            </div>
            <div class="info-item">
                <div class="info-dot"></div>
                <div class="info-content">
                    <strong>How long does it take?</strong>
                    <span>Approval typically takes 1-2 business days.</span>
                </div>
            </div>
        </div>

        <a href="{{ route('login') }}" class="btn-primary">Back to Login</a>
    </div>
</div>

</body>
</html>
