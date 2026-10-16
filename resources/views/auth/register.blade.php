<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUHUAN – Create Account</title>
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

        .card {
            width: 100%;
            max-width: 960px;
            background: var(--navy2);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1.3fr;
            box-shadow: 0 32px 80px rgba(0,0,0,0.5), 0 0 0 1px rgba(201,168,76,0.08);
            animation: fadeUp .55s ease both;
        }

        @keyframes fadeUp {
            from { opacity:0; transform: translateY(24px); }
            to   { opacity:1; transform: translateY(0); }
        }

        /* ── LEFT PANEL (navy + gold) ── */
        .left {
            background: linear-gradient(160deg, #0d1922 0%, #111e2c 60%, #0a1219 100%);
            padding: 48px 40px;
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

        .left-body { flex: 1; padding: 44px 0 28px; }

        .left-body h1 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            line-height: 1.25;
            color: var(--white);
            margin-bottom: 10px;
        }
        .left-body h1 span { color: var(--gold); }

        .left-body > p {
            color: var(--muted);
            font-size: 13.5px;
            line-height: 1.65;
            margin-bottom: 32px;
        }

        .feature-list { list-style: none; display: flex; flex-direction: column; gap: 14px; }

        .feature-list li {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 13px 15px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px;
            transition: border-color .2s;
        }
        .feature-list li:hover { border-color: rgba(201,168,76,0.25); }

        .feat-icon {
            width: 30px; height: 30px;
            background: rgba(201,168,76,0.12);
            border-radius: 8px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            margin-top: 2px;
        }
        .feat-icon svg { width: 14px; height: 14px; fill: var(--gold); }

        .feat-text strong { display: block; font-size: 13px; color: var(--white); font-weight: 600; margin-bottom: 2px; }
        .feat-text span   { font-size: 12px; color: var(--muted); line-height: 1.5; }

        .left-footer { font-size: 12px; color: rgba(138,155,176,0.6); }

        /* ── RIGHT PANEL (cream / white card) ── */
        .right {
            background: var(--cream);
            padding: 44px 48px;
            display: flex;
            flex-direction: column;
        }

        /* Step Progress */
        .step-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .step-info .step-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 4px;
        }
        .step-info h2 {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            color: var(--navy);
        }

        .step-dots {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .step-dot {
            height: 6px;
            border-radius: 99px;
            background: #dde3ec;
            transition: all .3s ease;
        }
        .step-dot.active   { background: var(--gold); width: 24px; }
        .step-dot.done     { background: var(--gold); width: 8px; opacity: .5; }
        .step-dot.inactive { width: 8px; }

        /* Steps */
        .step { display: none; flex-direction: column; gap: 0; }
        .step.active { display: flex; animation: stepIn .3s ease both; }

        @keyframes stepIn {
            from { opacity:0; transform: translateX(16px); }
            to   { opacity:1; transform: translateX(0); }
        }

        /* Form Elements - fixed alignment */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 20px;
            width: 100%;
        }

        label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #4a5568;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 12px 14px;
            background: #fff;
            border: 1.5px solid #dde3ec;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--navy);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        input:focus, select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.15);
        }

        /* Fix double eye icon issue (hide browser defaults) */
        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }

        .input-wrap { position: relative; display: flex; align-items: center; }
        .input-wrap input { padding-right: 44px; }
        .eye-btn {
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

        /* Enhanced Upload Zone & Preview */
        .upload-container {
            position: relative;
            margin-bottom: 24px;
        }
        .upload-zone {
            border: 2px dashed #cbd5e1;
            border-radius: 20px;
            padding: 40px 24px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 220px;
            position: relative;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }
        .upload-zone:hover {
            border-color: var(--gold);
            background: #fffdfa;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(201,168,76,0.1);
        }
        .upload-zone.drag-over {
            border-color: var(--gold);
            background: rgba(201,168,76,0.04);
            transform: scale(1.01);
        }
        .upload-zone.has-file { 
            border-style: solid; 
            border-color: #e2e8f0; 
            background: #ffffff;
            cursor: default;
        }
        
        .upload-zone input[type="file"] {
            position: absolute; inset: 0;
            opacity: 0; cursor: pointer;
            width: 100%; height: 100%;
            z-index: 5;
        }
        .upload-zone.has-file input[type="file"] { pointer-events: none; }
        
        .upload-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            transition: all 0.3s ease;
        }
        .upload-placeholder.hidden { display: none; opacity: 0; }

        .upload-icon-wrapper {
            width: 68px; height: 68px;
            background: rgba(201,168,76,0.1);
            border-radius: 50%;
            display: grid;
            place-items: center;
            margin-bottom: 4px;
            transition: all 0.3s ease;
            color: var(--gold);
        }
        .upload-zone:hover .upload-icon-wrapper { 
            transform: translateY(-5px);
            background: var(--gold);
            color: var(--navy);
        }
        .upload-icon-wrapper svg { width: 30px; height: 30px; fill: currentColor; }
        
        .upload-text {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .upload-text strong { font-size: 16px; color: var(--navy); font-weight: 700; }
        .upload-text span { font-size: 13px; color: #64748b; }

        /* Integrated ID Preview */
        #id-preview-container {
            display: none;
            flex-direction: column;
            align-items: center;
            width: 100%;
            animation: previewIn 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            z-index: 10;
        }
        #id-preview-container.show { display: flex; }
        
        @keyframes previewIn {
            from { opacity: 0; transform: scale(0.96); }
            to { opacity: 1; transform: scale(1); }
        }

        .preview-card {
            width: 100%;
            max-width: 340px;
            background: #fff;
            border-radius: 18px;
            padding: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 12px 30px rgba(0,0,0,0.06);
            margin-bottom: 20px;
            position: relative;
        }
        
        .preview-box {
            width: 100%;
            aspect-ratio: 1.6 / 1;
            border-radius: 12px;
            overflow: hidden;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .preview-box img {
            width: 100%; height: 100%;
            object-fit: cover;
        }
        .preview-box .file-icon-placeholder {
            font-size: 48px;
        }

        .file-details {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 340px;
            padding: 12px 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }
        .file-meta {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .file-meta-icon {
            width: 40px; height: 40px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            display: grid;
            place-items: center;
            color: var(--gold);
            flex-shrink: 0;
        }
        .file-meta-icon svg { width: 20px; height: 20px; fill: currentColor; }
        .file-name-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            overflow: hidden;
        }
        #id-filename-text { font-size: 13.5px; color: var(--navy); font-weight: 700; max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .file-size-text { font-size: 11px; color: #64748b; font-weight: 500; }

        .remove-file-btn {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: #fff;
            color: #ef4444;
            border: 1px solid #fee2e2;
            cursor: pointer;
            display: grid;
            place-items: center;
            transition: all 0.2s;
            flex-shrink: 0;
            pointer-events: auto;
        }
        .remove-file-btn:hover { 
            background: #ef4444; 
            color: #fff;
            border-color: #ef4444;
            transform: scale(1.05);
        }
        .remove-file-btn svg { width: 18px; height: 18px; fill: currentColor; }

        .id-types-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 12px;
            display: block;
        }
        .id-types {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 28px;
        }
        .id-tag {
            font-size: 11.5px;
            padding: 6px 14px;
            border-radius: 10px;
            background: #ffffff;
            color: #475569;
            border: 1px solid #e2e8f0;
            font-weight: 500;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            cursor: pointer;
            user-select: none;
        }
        .id-tag:hover {
            border-color: var(--gold);
            color: var(--gold);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(201,168,76,0.1);
        }
        .id-tag.selected {
            background: var(--gold);
            color: var(--navy);
            border-color: var(--gold);
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(201,168,76,0.25);
        }


        /* Terms */
        .terms-box {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            font-size: 13px;
            color: #475569;
            line-height: 1.6;
            margin-top: 4px;
            background: #ffffff;
            padding: 18px;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
            transition: all 0.2s;
        }
        .terms-box:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }
        .terms-box input[type="checkbox"] {
            width: 18px; height: 18px;
            accent-color: var(--gold);
            flex-shrink: 0;
            margin-top: 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .terms-box label {
            text-transform: none;
            letter-spacing: 0;
            font-weight: 400;
            margin-bottom: 0;
            cursor: pointer;
            user-select: none;
        }

        /* Buttons */
        .btn-row {
            display: flex;
            gap: 12px;
            margin-top: 28px;
        }

        .btn-back {
            flex: 0 0 auto;
            padding: 13px 22px;
            background: transparent;
            color: #6b7a8d;
            border: 1.5px solid #dde3ec;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: border-color .2s, color .2s;
        }
        .btn-back:hover { border-color: var(--gold); color: var(--gold); }

        .btn-next, .btn-submit {
            flex: 1;
            padding: 13px;
            background: var(--gold);
            color: var(--navy);
            border: none;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 4px 20px rgba(201,168,76,0.3);
        }
        .btn-next:hover, .btn-submit:hover {
            background: var(--gold2);
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(201,168,76,0.4);
        }

        .login-link {
            text-align: center;
            font-size: 13.5px;
            color: #6b7a8d;
            margin-top: 20px;
        }
        .login-link a {
            color: var(--gold);
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover { text-decoration: underline; }

        .field-error {
            font-size: 12px;
            color: var(--error);
            margin-top: 6px;
        }
        .password-feedback { font-size: 12px; margin-top: 7px; line-height: 1.45; }
        .password-feedback.error { color: var(--error); }
        .password-feedback.success { color: var(--success); }
        .password-feedback .feedback-icon { display: inline-block; width: 16px; font-weight: 700; }
        .password-feedback ul { list-style: none; padding: 0; margin: 0; }
        .password-invalid { border-color: var(--error) !important; }
        .password-valid { border-color: var(--success) !important; }

        @media (max-width: 700px) {
            .card { grid-template-columns: 1fr; }
            .left { display: none; }
            .right { padding: 36px 24px; }
            .form-row { grid-template-columns: 1fr; gap: 0; }
        }
    </style>
</head>
<body>

<div class="card">

    <!-- LEFT PANEL  -->
    <div class="left">
        <a href="/" class="logo">
            <div class="logo-icon">B</div>
            <span class="logo-text">BUHU<span>AN</span></span>
        </a>

        <div class="left-body">
            <h1>Join Barangay<br><span>BUHUAN</span></h1>
            <p>Register as a resident of Barangay Buhuan to access online barangay services.</p>
            <ul class="feature-list">
                <li>
                    <div class="feat-icon"><svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg></div>
                    <div class="feat-text"><strong>Identity Verification</strong><span>Submit a valid ID for admin verification before your account is approved.</span></div>
                </li>
                <li>
                    <div class="feat-icon"><svg viewBox="0 0 24 24"><path d="M12 2L4 6v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V6l-8-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg></div>
                    <div class="feat-text"><strong>One-Time Registration</strong><span>Register once and access all barangay services through your account.</span></div>
                </li>
                <li>
                    <div class="feat-icon"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg></div>
                    <div class="feat-text"><strong>Admin Approval</strong><span>Barangay staff reviews and approves your account before activation.</span></div>
                </li>
            </ul>
        </div>
        <p class="left-footer">Barangay Buhuan · Calapan City, Oriental Mindoro · © 2026</p>
    </div>

    <!-- RIGHT PANEL-->
    <div class="right">

        <div class="step-header">
            <div class="step-info">
                <p class="step-label" id="step-label">Step 1 of 3</p>
                <h2 id="step-title">Account Setup</h2>
            </div>
            <div class="step-dots" id="step-dots">
                <div class="step-dot active" data-step="1"></div>
                <div class="step-dot inactive" data-step="2"></div>
                <div class="step-dot inactive" data-step="3"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="register-form">
            @csrf

            <!-- STEP 1: Personal Info -->
            <div class="step active" id="step-1">
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        @error('first_name') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <p class="field-error">{{ $message }}</p> @enderror
                    <p id="email-availability-feedback" class="field-error" aria-live="polite" style="display:none;"></p>
                </div>

                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="tel" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" required>
                    @error('contact_number') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="address">Home Address in Barangay Buhuan</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" required>
                    @error('address') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="btn-row">
                    <button type="button" class="btn-next" id="step-1-continue" onclick="checkEmailAndContinue()">Continue →</button>
                </div>
            </div>

            <!-- STEP 2: Password -->
            <div class="step" id="step-2">
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <input type="password" id="password" name="password" required>
                        <button type="button" class="eye-btn" onclick="togglePassword('password', this)">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                        </button>
                    </div>
                    <div id="password-feedback" class="password-feedback" aria-live="polite" style="display:none;"></div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-wrap">
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                        <button type="button" class="eye-btn" onclick="togglePassword('password_confirmation', this)">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                        </button>
                    </div>
                    <div id="password-confirmation-feedback" class="password-feedback" aria-live="polite" style="display:none;"></div>
                </div>

                <div style="background:#fff8ec; border:1px solid #f0d98a; border-radius:10px; padding:12px 14px;">
                    <p style="font-size:12px; color:#7a6020;">Password must be at least <strong>8 characters</strong> and include uppercase, lowercase, a number, and a special character.</p>
                </div>

                <div class="btn-row">
                    <button type="button" class="btn-back" onclick="goToStep(1)">← Back</button>
                    <button type="button" class="btn-next" onclick="continueFromPasswordStep()">Continue →</button>
                </div>
            </div>

            <!-- STEP 3: Valid ID Upload -->
            <div class="step" id="step-3">
                <div class="form-group" style="margin-bottom: 24px;">
                    <label>Verify Your Identity</label>
                    <p style="font-size: 13px; color: #64748b; margin-bottom: 16px; margin-top: -4px;">Please provide a clear photo of any government-issued ID for account verification.</p>
                    
                    <div class="upload-container">
                        <div class="upload-zone" id="upload-zone">
                            <input type="file" name="valid_id" id="valid_id" accept="image/*,.pdf">
                            
                            <!-- Placeholder state -->
                            <div class="upload-placeholder" id="upload-placeholder">
                                <div class="upload-icon-wrapper">
                                    <svg viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11zM8 15.01l1.41 1.41L11 14.84V19h2v-4.16l1.59 1.59L16 15.01 12.01 11 8 15.01z"/></svg>
                                </div>
                                <div class="upload-text">
                                    <strong>Click or drag to upload ID</strong>
                                    <span>JPG, PNG, or PDF (Max 5MB)</span>
                                </div>
                            </div>

                            <!-- Preview state -->
                            <div id="id-preview-container">
                                <div class="preview-card">
                                    <div class="preview-box">
                                        <img id="id-img" src="" alt="ID Preview">
                                        <div id="id-pdf-placeholder" class="file-icon-placeholder" style="display:none;">📄</div>
                                    </div>
                                </div>
                                <div class="file-details">
                                    <div class="file-meta">
                                        <div class="file-meta-icon">
                                            <svg viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm-1 7V3.5L18.5 9H13z"/></svg>
                                        </div>
                                        <div class="file-name-group">
                                            <span id="id-filename-text">filename.jpg</span>
                                            <span class="file-size-text" id="id-filesize-text">1.2 MB</span>
                                        </div>
                                    </div>
                                    <button type="button" class="remove-file-btn" onclick="removeFile()" title="Remove file">
                                        <svg viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <span class="id-types-label">Select ID Type being uploaded:</span>
                    <div class="id-types" id="id-type-selector">
                        <div class="id-tag" data-value="PhilSys ID">PhilSys ID</div>
                        <div class="id-tag" data-value="Driver's License">Driver's License</div>
                        <div class="id-tag" data-value="Passport">Passport</div>
                        <div class="id-tag" data-value="Voter's ID">Voter's ID</div>
                        <div class="id-tag" data-value="SSS / GSIS">SSS / GSIS</div>
                        <div class="id-tag" data-value="PhilHealth">PhilHealth</div>
                        <div class="id-tag" data-value="UMID">UMID</div>
                        <div class="id-tag" data-value="Barangay ID">Barangay ID</div>
                    </div>
                    <input type="hidden" name="id_type" id="id_type" value="{{ old('id_type') }}">
                    <div id="id-type-error" class="field-error" style="display:none; margin-bottom: 20px;">Please select the type of ID you are uploading.</div>
                    
                    <div id="id-error" class="field-error" style="display:none; margin-bottom: 20px;">Please upload a valid government-issued ID.</div>
                </div>

                <div class="terms-box">
                    <input type="checkbox" id="terms" name="terms">
                    <label for="terms">I confirm that the ID submitted is valid and government-issued. I also agree to the <a href="#" style="color:var(--gold); font-weight:600;">Terms & Privacy Policy</a> of BUHUAN.</label>
                </div>
                <div id="terms-error" class="field-error" style="display:none;">You must agree to the terms and verify your ID before proceeding.</div>

                <div class="btn-row">
                    <button type="button" class="btn-back" onclick="goToStep(2)">← Back</button>
                    <button type="submit" class="btn-submit">Create Account</button>
                </div>
            </div>
        </form>

        <p class="login-link">Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>

    </div>
</div>

<script>
    // Step navigation
    const stepLabels = ['Account Setup', 'Set Password', 'Verify Identity'];
    let currentStep = 1;
    let passwordValidationRequested = false;
    let confirmationValidationRequested = false;
    let emailCheckInProgress = false;

    const emailInput = document.getElementById('email');
    const emailAvailabilityFeedback = document.getElementById('email-availability-feedback');
    emailInput.addEventListener('input', () => {
        emailAvailabilityFeedback.textContent = '';
        emailAvailabilityFeedback.style.display = 'none';
        emailInput.classList.remove('password-invalid');
    });

    async function checkEmailAndContinue() {
        if (emailCheckInProgress || !validateStep(1)) return;
        if (!emailInput.checkValidity()) {
            emailInput.classList.add('password-invalid');
            emailAvailabilityFeedback.textContent = 'Please enter a valid email address.';
            emailAvailabilityFeedback.style.display = 'block';
            return;
        }

        const enteredEmail = emailInput.value.trim();
        const continueButton = document.getElementById('step-1-continue');
        emailCheckInProgress = true;
        continueButton.disabled = true;
        emailAvailabilityFeedback.style.display = 'none';
        try {
            const response = await fetch(`{{ route('register.email-availability') }}?email=${encodeURIComponent(enteredEmail)}`, {
                headers: { 'Accept': 'application/json' },
            });
            if (!response.ok) throw new Error('Email availability check failed');
            const result = await response.json();
            if (enteredEmail !== emailInput.value.trim()) return;

            if (!result.available) {
                emailInput.classList.add('password-invalid');
                emailAvailabilityFeedback.textContent = 'This email address is already in use. Please enter another email address.';
                emailAvailabilityFeedback.style.display = 'block';
                return;
            }

            emailInput.classList.remove('password-invalid');
            goToStep(2);
        } catch (error) {
            emailInput.classList.add('password-invalid');
            emailAvailabilityFeedback.textContent = 'Unable to verify this email address right now. Please try again.';
            emailAvailabilityFeedback.style.display = 'block';
        } finally {
            emailCheckInProgress = false;
            continueButton.disabled = false;
        }
    }

    const passwordRules = [
        { test: value => value.length >= 8, message: 'Password must contain at least 8 characters.' },
        { test: value => /[A-Z]/.test(value), message: 'Password must include at least one uppercase letter.' },
        { test: value => /[a-z]/.test(value), message: 'Password must include at least one lowercase letter.' },
        { test: value => /[0-9]/.test(value), message: 'Password must include at least one number.' },
        { test: value => /[!@#$%^&*]/.test(value), message: 'Password must include at least one special character (!@#$%^&*).' },
    ];

    function validatePassword(showEmpty = false) {
        const input = document.getElementById('password');
        const feedback = document.getElementById('password-feedback');
        const missing = passwordRules.filter(rule => !rule.test(input.value));
        input.classList.remove('password-invalid', 'password-valid');
        feedback.replaceChildren();
        if (!input.value && !showEmpty) { feedback.style.display = 'none'; return false; }
        feedback.style.display = 'block';
        if (missing.length) {
            input.classList.add('password-invalid');
            feedback.className = 'password-feedback error';
            const list = document.createElement('ul');
            missing.forEach(rule => {
                const item = document.createElement('li');
                const icon = document.createElement('span');
                icon.className = 'feedback-icon'; icon.textContent = '⚠';
                item.append(icon, document.createTextNode(rule.message)); list.append(item);
            });
            feedback.append(list);
            return false;
        }
        input.classList.add('password-valid');
        feedback.className = 'password-feedback success';
        feedback.textContent = '✓ Password meets all requirements.';
        return true;
    }

    function validatePasswordConfirmation(showEmpty = false) {
        const password = document.getElementById('password');
        const confirmation = document.getElementById('password_confirmation');
        const feedback = document.getElementById('password-confirmation-feedback');
        const passwordValid = passwordRules.every(rule => rule.test(password.value));
        confirmation.classList.remove('password-invalid', 'password-valid');
        feedback.replaceChildren();
        if (!confirmation.value && !showEmpty) { feedback.style.display = 'none'; return false; }
        feedback.style.display = 'block';
        if (password.value !== confirmation.value) {
            confirmation.classList.add('password-invalid');
            feedback.className = 'password-feedback error';
            const icon = document.createElement('span');
            icon.className = 'feedback-icon'; icon.textContent = '⚠';
            feedback.append(icon, document.createTextNode('Passwords do not match.'));
            return false;
        }
        if (passwordValid) {
            confirmation.classList.add('password-valid');
            feedback.className = 'password-feedback success';
            feedback.textContent = '✓ Passwords match.';
            return true;
        }
        feedback.style.display = 'none';
        return false;
    }

    document.getElementById('password').addEventListener('input', () => {
        validatePassword(passwordValidationRequested);
        if (confirmationValidationRequested || document.getElementById('password_confirmation').value) {
            validatePasswordConfirmation(confirmationValidationRequested);
        }
    });
    document.getElementById('password_confirmation').addEventListener('input', () => {
        confirmationValidationRequested = true;
        validatePasswordConfirmation();
    });

    function continueFromPasswordStep() {
        passwordValidationRequested = true;
        confirmationValidationRequested = true;
        const passwordValid = validatePassword(true);
        const confirmationValid = validatePasswordConfirmation(true);
        if (passwordValid && confirmationValid) goToStep(3);
    }

    function updateDots(step) {
        document.querySelectorAll('.step-dot').forEach((dot, i) => {
            dot.className = 'step-dot';
            if (i + 1 < step) dot.classList.add('done');
            else if (i + 1 === step) dot.classList.add('active');
            else dot.classList.add('inactive');
        });
        document.getElementById('step-label').textContent = `Step ${step} of 3`;
        document.getElementById('step-title').textContent = stepLabels[step - 1];
    }

    function validateStep(step) {
        if (step === 1) {
            const fields = ['first_name', 'last_name', 'email', 'contact_number', 'address'];
            let valid = true;
            fields.forEach(f => {
                const input = document.getElementById(f);
                if (!input.value.trim()) {
                    input.style.borderColor = 'var(--error)';
                    valid = false;
                } else {
                    input.style.borderColor = '#dde3ec';
                }
            });
            return valid;
        }
        if (step === 2) {
            passwordValidationRequested = true;
            confirmationValidationRequested = true;
            const passwordValid = validatePassword(true);
            const confirmationValid = validatePasswordConfirmation(true);
            return passwordValid && confirmationValid;
        }
        return true;
    }

    function goToStep(step) {
        if (step > currentStep) {
            if (!validateStep(currentStep)) return;
        }
        
        document.getElementById(`step-${currentStep}`).classList.remove('active');
        currentStep = step;
        document.getElementById(`step-${currentStep}`).classList.add('active');
        updateDots(step);
        document.querySelector('.right').scrollTop = 0;
    }

    // File handling
    const fileInput = document.getElementById('valid_id');
    const placeholder = document.getElementById('upload-placeholder');
    const previewContainer = document.getElementById('id-preview-container');
    const zone = document.getElementById('upload-zone');
    const idImg = document.getElementById('id-img');
    const pdfPlaceholder = document.getElementById('id-pdf-placeholder');

    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        placeholder.classList.add('hidden');
        previewContainer.classList.add('show');
        zone.classList.add('has-file');
        document.getElementById('id-filename-text').textContent = file.name;
        document.getElementById('id-filesize-text').textContent = formatBytes(file.size);
        document.getElementById('id-error').style.display = 'none';

        if (file.type.startsWith('image/')) {
            idImg.style.display = 'block';
            pdfPlaceholder.style.display = 'none';
            const reader = new FileReader();
            reader.onload = ev => {
                idImg.src = ev.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            idImg.style.display = 'none';
            pdfPlaceholder.style.display = 'block';
        }
    });

    function removeFile() {
        fileInput.value = '';
        placeholder.classList.remove('hidden');
        previewContainer.classList.remove('show');
        zone.classList.remove('has-file');
        idImg.src = '';
    }

    // Drag & drop visual
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', () => zone.classList.remove('drag-over'));

    // ID Type Selection
    const idTypeInput = document.getElementById('id_type');
    const idTags = document.querySelectorAll('#id-type-selector .id-tag');

    idTags.forEach(tag => {
        tag.addEventListener('click', function() {
            idTags.forEach(t => t.classList.remove('selected'));
            this.classList.add('selected');
            idTypeInput.value = this.dataset.value;
            document.getElementById('id-type-error').style.display = 'none';
        });
    });

    // Handle old id_type value
    if (idTypeInput.value) {
        const activeTag = document.querySelector(`#id-type-selector .id-tag[data-value="${idTypeInput.value}"]`);
        if (activeTag) activeTag.classList.add('selected');
    }

    // Toggle password visibility
    function togglePassword(fieldId, btn) {
        const input = document.getElementById(fieldId);
        const isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        btn.querySelector('svg').innerHTML = isText
            ? '<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>'
            : '<path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46A11.804 11.804 0 001 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>';
    }

    // Final Validation
    document.getElementById('register-form').addEventListener('submit', function(e) {
        let valid = true;
        
        // Check ID File
        if (!fileInput.files.length) {
            document.getElementById('id-error').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('id-error').style.display = 'none';
        }

        // Check ID Type
        if (!idTypeInput.value) {
            document.getElementById('id-type-error').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('id-type-error').style.display = 'none';
        }

        // Check Terms
        if (!document.getElementById('terms').checked) {
            document.getElementById('terms-error').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('terms-error').style.display = 'none';
        }

        if (!valid) {
            e.preventDefault();
            // Scroll to the first error
            const firstError = document.querySelector('.field-error[style*="block"]');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
</script>
</body>
</html>
