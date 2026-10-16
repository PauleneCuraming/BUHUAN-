<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUHUAN</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
 
        :root {
            --navy:    #0b1f3a;
            --navy2:   #122a50;
            --gold:    #c8973a;
            --gold-lt: #e3b96a;
            --cream:   #f5f0e8;
            --white:   #ffffff;
            --gray:    #6b7a90;
            --light:   #edf1f7;
        }
 
        html { scroll-behavior: smooth; }
 
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--navy);
            color: var(--white);
            overflow-x: hidden;
        }
 
        /* ── NOISE TEXTURE OVERLAY ── */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 0; opacity: 0.4;
        }
 
        /* ── NAV ── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.2rem 5%;
            background: rgba(11, 31, 58, 0.85);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(200, 151, 58, 0.18);
        }
 
        .nav-brand {
            display: flex; align-items: center; gap: 0.75rem;
            text-decoration: none;
        }
 
        .nav-logo {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--gold), var(--gold-lt));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem; font-weight: 800;
            color: var(--navy);
        }
 
        .nav-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem; font-weight: 700;
            color: var(--white);
            letter-spacing: 0.04em;
        }
 
        .nav-title span { color: var(--gold); }
 
        .nav-links {
            display: flex; align-items: center; gap: 1rem;
        }
 
        .btn-outline {
            padding: 0.55rem 1.4rem;
            border: 1.5px solid rgba(200,151,58,0.55);
            border-radius: 8px;
            color: var(--gold-lt);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem; font-weight: 500;
            text-decoration: none;
            transition: all 0.25s ease;
            background: transparent;
            cursor: pointer;
        }
 
        .btn-outline:hover {
            background: rgba(200,151,58,0.12);
            border-color: var(--gold-lt);
        }
 
        .btn-primary {
            padding: 0.55rem 1.4rem;
            background: linear-gradient(135deg, var(--gold), var(--gold-lt));
            border: none; border-radius: 8px;
            color: var(--navy);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem; font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 18px rgba(200,151,58,0.28);
        }
 
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(200,151,58,0.42);
        }
 
        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            position: relative;
            display: flex; align-items: center;
            padding: 8rem 5% 5rem;
            overflow: hidden;
        }
 
        /* decorative circles */
        .hero::after {
            content: '';
            position: absolute;
            width: 700px; height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(200,151,58,0.10) 0%, transparent 70%);
            right: -150px; top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }
 
        .hero-grid {
            width: 100%; max-width: 1200px; margin: 0 auto;
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 4rem; align-items: center;
        }
 
        .hero-badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.35rem 1rem;
            background: rgba(200,151,58,0.12);
            border: 1px solid rgba(200,151,58,0.3);
            border-radius: 50px;
            font-size: 0.78rem; font-weight: 500;
            color: var(--gold-lt);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            animation: fadeUp 0.7s ease both;
        }
 
        .hero-badge::before {
            content: '';
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--gold);
            animation: pulse 1.8s ease infinite;
        }
 
        @keyframes pulse {
            0%,100% { opacity:1; transform:scale(1); }
            50% { opacity:0.5; transform:scale(1.4); }
        }
 
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 6vw, 5rem);
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -0.02em;
            margin-bottom: 1.4rem;
            animation: fadeUp 0.7s 0.1s ease both;
        }
 
        .hero-title .accent { color: var(--gold); }
 
        .hero-subtitle {
            font-size: 1.05rem; font-weight: 300;
            color: rgba(255,255,255,0.65);
            line-height: 1.75;
            margin-bottom: 2.4rem;
            max-width: 480px;
            animation: fadeUp 0.7s 0.2s ease both;
        }
 
        .hero-cta {
            display: flex; gap: 1rem; flex-wrap: wrap;
            animation: fadeUp 0.7s 0.3s ease both;
        }
 
        .btn-hero {
            padding: 0.85rem 2rem;
            background: linear-gradient(135deg, var(--gold), var(--gold-lt));
            border: none; border-radius: 10px;
            color: var(--navy);
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem; font-weight: 700;
            text-decoration: none; cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 6px 28px rgba(200,151,58,0.35);
        }
 
        .btn-hero:hover { transform: translateY(-2px); box-shadow: 0 10px 36px rgba(200,151,58,0.5); }
 
        .btn-hero-ghost {
            padding: 0.85rem 2rem;
            background: transparent;
            border: 1.5px solid rgba(255,255,255,0.25);
            border-radius: 10px;
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem; font-weight: 500;
            text-decoration: none; cursor: pointer;
            transition: all 0.25s ease;
        }
 
        .btn-hero-ghost:hover { background: rgba(255,255,255,0.07); border-color: rgba(255,255,255,0.45); }
 
        /* ── HERO VISUAL ── */
        .hero-visual {
            position: relative;
            animation: fadeUp 0.7s 0.25s ease both;
        }
 
        .hero-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 20px;
            padding: 2rem;
            backdrop-filter: blur(10px);
        }
 
        .hero-card-header {
            display: flex; align-items: center; gap: 0.75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
 
        .card-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }
 
        .card-icon.gold { background: rgba(200,151,58,0.2); }
        .card-icon.blue { background: rgba(59,130,246,0.2); }
        .card-icon.green { background: rgba(34,197,94,0.2); }
 
        .card-label { font-size: 0.85rem; color: rgba(255,255,255,0.5); }
        .card-value { font-size: 1rem; font-weight: 600; color: var(--white); }
 
        .service-list { display: flex; flex-direction: column; gap: 0.75rem; }
 
        .service-item {
            display: flex; align-items: center; gap: 1rem;
            padding: 0.85rem 1rem;
            background: rgba(255,255,255,0.04);
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.07);
            transition: all 0.2s ease;
        }
 
        .service-item:hover {
            background: rgba(200,151,58,0.08);
            border-color: rgba(200,151,58,0.2);
        }
 
        .service-dot {
            width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0;
        }
 
        .dot-gold { background: var(--gold); }
        .dot-blue { background: #60a5fa; }
        .dot-green { background: #4ade80; }
        .dot-purple { background: #c084fc; }
 
        .service-name { font-size: 0.9rem; font-weight: 500; flex: 1; }
 
        .status-badge {
            font-size: 0.72rem; font-weight: 600;
            padding: 0.2rem 0.65rem; border-radius: 50px;
        }
        .status-available { background: rgba(74,222,128,0.15); color: #4ade80; }
        .status-online    { background: rgba(96,165,250,0.15); color: #60a5fa; }
 
        /* floating stats */
        .stat-float {
            position: absolute;
            background: rgba(11,31,58,0.9);
            border: 1px solid rgba(200,151,58,0.25);
            border-radius: 12px;
            padding: 0.75rem 1.1rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }
 
        .stat-float.top-right { top: -20px; right: -20px; }
        .stat-float.bottom-left { bottom: -20px; left: -20px; }
 
        .stat-num { font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; color: var(--gold); }
        .stat-lbl { font-size: 0.72rem; color: rgba(255,255,255,0.5); }
 
        /* ── SERVICES SECTION ── */
        .services {
            padding: 9rem 5%;
            background: var(--cream);
            position: relative;
            overflow: hidden;
        }
 
        .services::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--navy) 0%, var(--gold) 50%, var(--navy) 100%);
            z-index: 2;
            opacity: 0.6;
        }

        .services::after {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(var(--gold) 0.5px, transparent 0.5px);
            background-size: 40px 40px;
            opacity: 0.04;
            pointer-events: none;
        }
 
        .svc-head { 
            margin-bottom: 6rem; 
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
 
        .section-label {
            font-size: 0.75rem; font-weight: 800;
            letter-spacing: 0.25em; text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1.2rem;
            position: relative;
            display: inline-block;
            padding: 0.4rem 1.2rem;
            background: rgba(200, 151, 58, 0.08);
            border-radius: 4px;
        }
 
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.4rem, 5vw, 3.6rem);
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 1.5rem;
            line-height: 1.1;
            letter-spacing: -0.01em;
        }
 
        .section-subtitle {
            color: var(--gray);
            font-size: 1.1rem; font-weight: 400;
            max-width: 800px;
            line-height: 1.8;
            opacity: 0.9;
        }
 
        .features-two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2.5rem;
            max-width: 1260px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
 
        .feat-block {
            background: var(--white);
            border-radius: 28px;
            border: 1px solid rgba(11,31,58,0.05);
            overflow: hidden;
            box-shadow: 0 12px 45px -12px rgba(11,31,58,0.08);
            transition: all 0.5s cubic-bezier(0.2, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .feat-block:hover {
            transform: translateY(-12px);
            box-shadow: 0 35px 70px -15px rgba(11,31,58,0.14);
            border-color: rgba(200,151,58,0.3);
        }
 
        .feat-header {
            padding: 3.5rem 3.5rem 2.5rem;
            background: linear-gradient(135deg, rgba(245,240,232,0.4), transparent);
            border-bottom: 1px solid rgba(11,31,58,0.03);
        }
 
        .feat-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.72rem; font-weight: 800;
            letter-spacing: 0.12em; text-transform: uppercase;
            padding: 0.5rem 1rem; border-radius: 8px;
            margin-bottom: 1.8rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.04);
        }
 
        .tag-doc  { background: #f0f4ff; color: #3b82f6; border: 1px solid rgba(59,130,246,0.1); }
        .tag-appt { background: #f0fdf4; color: #22c55e; border: 1px solid rgba(34,197,94,0.1); }
 
        .feat-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem; font-weight: 800;
            color: var(--navy); margin-bottom: 1rem;
            line-height: 1.3;
        }
 
        .feat-desc {
            font-size: 0.98rem; color: var(--gray);
            line-height: 1.8;
            opacity: 0.95;
        }
 
        .doc-pills {
            padding: 0 3.5rem 2.5rem;
            display: flex; flex-wrap: wrap; gap: 10px;
        }
 
        .dpill {
            background: var(--white);
            border: 1.5px solid #edf2f7;
            border-radius: 12px;
            font-size: 0.82rem; color: var(--navy2);
            padding: 0.6rem 1.1rem; font-weight: 600;
            transition: all 0.3s cubic-bezier(0.2, 1, 0.3, 1);
            display: flex; align-items: center; gap: 8px;
            cursor: default;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }

        .dpill::before {
            content: ''; width: 6px; height: 6px; border-radius: 50%;
            background: var(--gold); flex-shrink: 0;
        }

        .dpill:hover {
            border-color: var(--gold);
            background: var(--navy);
            color: var(--white);
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 8px 20px rgba(11,31,58,0.15);
        }
 
        .feat-steps {
            padding: 3rem 3.5rem 4rem;
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
            position: relative;
            background: rgba(245,240,232,0.15);
            flex: 1;
        }

        .feat-steps::before {
            content: '';
            position: absolute;
            left: 4.6rem;
            top: 4rem;
            bottom: 6rem;
            width: 2px;
            background: linear-gradient(to bottom, var(--gold) 0%, var(--navy) 30%, transparent 100%);
            opacity: 0.15;
        }
 
        .fstep {
            display: flex; align-items: flex-start; gap: 1.8rem;
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .fstep:hover {
            transform: translateX(6px);
        }
 
        .fstep-num {
            width: 36px; height: 36px; border-radius: 12px;
            background: var(--navy);
            color: var(--gold);
            font-size: 0.9rem; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 5px 15px rgba(11,31,58,0.2);
            border: 2px solid transparent;
        }

        .feat-block:hover .fstep-num {
            background: var(--navy2);
            transform: rotate(8deg) scale(1.1);
            border-color: rgba(200, 151, 58, 0.4);
        }
 
        .fstep-label {
            font-size: 1.1rem; font-weight: 700;
            color: var(--navy); margin-bottom: 8px;
            line-height: 1.4;
        }
 
        .fstep-sub {
            font-size: 0.92rem; color: var(--gray);
            line-height: 1.75;
            opacity: 0.9;
        }
 
        @media (max-width: 1024px) {
            .features-two-col { gap: 2rem; }
            .feat-block { border-radius: 24px; }
            .feat-header, .doc-pills, .feat-steps { padding-left: 2.5rem; padding-right: 2.5rem; }
            .feat-steps::before { left: 3.6rem; }
        }

        @media (max-width: 900px) {
            .features-two-col { grid-template-columns: 1fr; max-width: 650px; }
            .services { padding: 7rem 5%; }
            .feat-steps::before { left: 4.6rem; }
        }
 
        @media (max-width: 768px) {
            .hero-grid { grid-template-columns: 1fr; }
            .hero-visual { display: none; }
            .stat-float { display: none; }
            .steps::before { display: none; }
        }

        /* ── HOW IT WORKS ── */
        .how {
            padding: 8rem 5%;
            background: var(--navy2);
            position: relative; overflow: hidden;
        }
 
        .how::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px; border-radius: 50%;
            background: radial-gradient(circle, rgba(200,151,58,0.07) 0%, transparent 70%);
            left: -100px; bottom: -100px;
        }
 
        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem; max-width: 1200px; margin: 0 auto;
            position: relative;
        }
 
        .steps::before {
            content: '';
            position: absolute;
            top: 30px; left: calc(12.5% + 15px); right: calc(12.5% + 15px);
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(200,151,58,0.4), transparent);
        }
 
        .step {
            text-align: center;
            padding: 2rem 1rem;
        }
 
        .step-num {
            width: 64px; height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-lt));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem; font-weight: 800; color: var(--navy);
            margin: 0 auto 1.5rem;
            box-shadow: 0 8px 30px rgba(200,151,58,0.3);
            transition: transform 0.3s ease;
        }

        .step:hover .step-num { transform: scale(1.1) translateY(-5px); }
 
        .step-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem; font-weight: 700;
            color: var(--white); margin-bottom: 0.75rem;
        }
 
        .step-desc {
            font-size: 0.9rem; color: rgba(255,255,255,0.55);
            line-height: 1.7;
        }
 
        /* ── FOOTER ── */
        footer {
            background: #07152a;
            padding: 4rem 5%;
            border-top: 1px solid rgba(200,151,58,0.15);
        }
 
        .footer-inner {
            max-width: 1200px; margin: 0 auto;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 2rem;
        }
 
        .footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem; font-weight: 700;
            color: var(--white);
        }
 
        .footer-brand span { color: var(--gold); }
 
        .footer-text {
            font-size: 0.88rem; color: rgba(255,255,255,0.4);
        }
 
        .footer-sub {
            font-size: 0.8rem; color: rgba(255,255,255,0.25);
            margin-top: 0.4rem;
        }
 
        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        {!! file_get_contents(public_path('css/buhuan.css')) !!}
    </style>
</head>

<body>

    @yield('content')

</body>
</html>