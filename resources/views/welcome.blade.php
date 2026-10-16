@extends('layouts.app')

@section('content')
<style>
    /* Landing page service cards only; all other public-page styles remain unchanged. */
    .hero-subtitle, #services .section-subtitle, #services .feat-desc, #services .fstep-sub, #how .section-subtitle, #how .step-desc, .footer-sub, .footer-text { text-align:justify; text-justify:inter-word; }
    body { background:#0b1f3a; }
    nav { background:rgba(11,31,58,.9); border-bottom-color:rgba(212,167,44,.2); }
    .hero { background:linear-gradient(135deg,#0b1f3a 0%,#102744 58%,#142c49 100%); }
    #services { padding:50px 5% 58px; background:linear-gradient(180deg,#faf8f2 0%,#f2eee5 100%); }
    #services .svc-head { display:grid; grid-template-columns:minmax(0,1.1fr) minmax(260px,.9fr); column-gap:44px; row-gap:12px; max-width:1020px; margin:0 auto 28px; text-align:left; align-items:center; }
    #services .section-label { grid-column:1 / -1; justify-self:start; margin:0; padding:6px 11px; border:1px solid rgba(200,151,58,.22); border-radius:999px; color:#876318; background:#fff7e3; font-size:10px; letter-spacing:.14em; }
    #services .section-title { margin:0; color:#162338; font-size:clamp(1.65rem,3vw,2.15rem); letter-spacing:-.025em; line-height:1.2; }
    #services .section-subtitle { max-width:unset; margin:0; padding-left:22px; border-left:2px solid #d4a72c; color:#687486; font-size:14px; line-height:1.7; }
    #services .features-two-col { width:100%; max-width:1020px; grid-template-columns:repeat(2,minmax(0,1fr)); gap:20px; align-items:stretch; }
    #services .feat-block { position:relative; overflow:hidden; border:1px solid #e5dfd2; border-radius:16px; background:#fffefa; box-shadow:0 8px 22px rgba(22,35,56,.07); transition:transform .22s ease,box-shadow .22s ease,border-color .22s ease; }
    #services .feat-block::before { position:absolute; z-index:2; top:0; left:0; right:0; height:4px; content:''; background:linear-gradient(90deg,#d4a72c,#edcf7b); }
    #services .feat-block:nth-child(2)::before { background:linear-gradient(90deg,#467cb5,#8db9df); }
    #services .feat-block:hover { transform:translateY(-4px); border-color:#d9c68e; box-shadow:0 16px 34px rgba(22,35,56,.11); }
    #services .feat-header { min-height:164px; padding:21px 23px 17px; background:linear-gradient(145deg,#fffefa 0%,#fffaf0 100%); border-bottom:1px solid #eee8dc; }
    #services .feat-block:nth-child(2) .feat-header { background:linear-gradient(145deg,#fffefa 0%,#f5f8fa 100%); }
    #services .feat-tag { gap:7px; margin-bottom:12px; padding:6px 9px; border-radius:8px; font-size:9px; letter-spacing:.08em; box-shadow:none; }
    #services .feat-tag svg { width:16px; height:16px; fill:none; stroke:currentColor; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; }
    #services .tag-doc { color:#83610e; border-color:#f0dfaa; background:#fff7e3; }
    #services .tag-appt { color:#315b85; border-color:#d7e6f3; background:#edf5fc; }
    #services .feat-title { margin-bottom:8px; color:#162338; font-size:clamp(1.2rem,1.7vw,1.4rem); line-height:1.3; }
    #services .feat-desc { max-width:58ch; color:#687486; font-size:13px; line-height:1.65; }
    #services .doc-pills { gap:6px; padding:13px 23px 16px; border-top:1px solid #f0ede7; background:#fff; }
    #services .dpill { padding:5px 8px; border:1px solid #e8e3d9; border-radius:7px; background:#faf9f6; color:#445166; font-size:10px; box-shadow:none; }
    #services .dpill::before { width:5px; height:5px; }
    #services .dpill:hover { transform:none; border-color:#d4a72c; background:#fff7e3; color:#664d0a; box-shadow:none; }
    #services .feat-steps { flex:1; gap:11px; padding:17px 23px 19px; background:#f9f7f1; }
    #services .feat-steps::before { top:35px; bottom:42px; left:43px; width:1px; background:#d9c98f; opacity:.55; }
    #services .fstep { gap:11px; padding:5px 0; }
    #services .fstep:hover { transform:translateX(2px); }
    #services .fstep-num { width:27px; height:27px; border:2px solid #fff; border-radius:50%; background:#f1dfaa; color:#634b0c; font-size:11px; box-shadow:0 2px 6px rgba(22,35,56,.1); }
    #services .feat-block:hover .fstep-num { transform:none; background:#e8d18b; border-color:#fff; }
    #services .fstep-label { margin-bottom:2px; color:#24334a; font-size:13px; line-height:1.4; }
    #services .fstep-sub { color:#788395; font-size:11px; line-height:1.5; }
    @media (max-width: 1024px) {
        #services { padding:46px 5%; }
        #services .feat-header, #services .doc-pills, #services .feat-steps { padding-left:20px; padding-right:20px; }
        #services .feat-steps::before { left:37px; }
    }
    @media (max-width: 900px) {
        #services .features-two-col { grid-template-columns:repeat(2,minmax(0,1fr)); gap:20px; }
    }
    @media (max-width: 600px) {
        #services { padding:40px 5%; }
        #services .svc-head { margin-bottom:22px; }
        #services .section-subtitle { font-size:13px; }
        #services .features-two-col { grid-template-columns:1fr; max-width:650px; gap:18px; }
        #services .feat-header { min-height:0; }
        #services .feat-header, #services .doc-pills, #services .feat-steps { padding-left:17px; padding-right:17px; }
        #services .feat-steps::before { left:34px; }
    }
    @media (max-width: 700px) {
        #services .svc-head { grid-template-columns:1fr; gap:10px; }
        #services .section-label { grid-column:1; }
        #services .section-subtitle { padding:0; border:0; }
    }
    /* How It Works section only. */
    #how { padding:66px 5% 72px; background:linear-gradient(135deg,#0d2038 0%,#142944 54%,#19334f 100%); text-align:center; }
    #how::before { width:480px; height:480px; left:auto; right:-140px; bottom:-190px; background:radial-gradient(circle,rgba(212,167,44,.15) 0%,rgba(212,167,44,.035) 38%,transparent 72%); }
    #how .how-head { max-width:780px; margin:0 auto 34px; }
    #how .section-label { margin-bottom:12px; padding:7px 13px; border:1px solid rgba(227,185,106,.38); border-radius:999px; color:#f2d587 !important; background:rgba(212,167,44,.12); font-size:10px; letter-spacing:.16em; }
    #how .section-title { max-width:760px; margin:0 auto 12px; color:#fff !important; font-size:clamp(1.9rem,3.6vw,2.5rem); letter-spacing:-.025em; line-height:1.2; }
    #how .section-subtitle { max-width:700px; margin:0 auto; color:rgba(255,255,255,.78) !important; font-size:15px; line-height:1.7; }
    #how .steps { width:100%; grid-template-columns:repeat(4,minmax(0,1fr)); gap:18px; max-width:1160px; margin:0 auto; }
    #how .steps::before { display:none; }
    #how .step { position:relative; min-width:0; min-height:220px; padding:23px 21px; border:1px solid #eee8dc; border-top:3px solid #d4a72c; border-radius:14px; background:#fffefa; text-align:left; box-shadow:0 12px 28px rgba(4,12,24,.22); transition:transform .2s ease,box-shadow .2s ease,border-color .2s ease; }
    #how .step::before { display:none; }
    #how .step:hover { transform:translateY(-4px); border-color:#e8d18b; box-shadow:0 17px 32px rgba(4,12,24,.3); }
    #how .step-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:18px; }
    #how .step-num { width:42px; height:42px; margin:0; border:0; border-radius:50%; background:linear-gradient(145deg,#f0d987,#d4a72c); color:#162338; font:700 16px 'DM Sans',sans-serif; box-shadow:0 5px 13px rgba(170,125,20,.2); }
    #how .step:hover .step-num { transform:translateY(-1px); }
    #how .step-icon { width:42px; height:42px; display:grid; place-items:center; border:1px solid #f0dfaa; border-radius:13px; background:#fff7e3; color:#876318; }
    #how .step:nth-child(2) .step-icon { background:#edf5fc; color:#4778a5; }
    #how .step:nth-child(3) .step-icon { background:#e7f4ec; color:#43815c; }
    #how .step:nth-child(4) .step-icon { background:#f3eef9; color:#8066a4; }
    #how .step-icon svg { width:20px; height:20px; fill:none; stroke:currentColor; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; }
    #how .step-title { margin-bottom:9px; color:#162338; font:700 16px 'DM Sans',sans-serif; line-height:1.4; }
    #how .step-desc { color:#626f82; font-size:13px; line-height:1.7; }
    footer { background:#091a30; border-top-color:rgba(212,167,44,.2); }
    @media (max-width: 900px) {
        #how { padding:56px 5%; }
        #how .steps { grid-template-columns:repeat(2,minmax(0,1fr)); max-width:1160px; gap:16px; }
    }
    @media (max-width: 600px) {
        #how { padding:46px 5%; }
        #how .section-subtitle { font-size:14px; }
        #how .how-head { margin-bottom:25px; }
        #how .steps { grid-template-columns:1fr; gap:11px; }
        #how .step { min-height:0; padding:19px; }
        #how .step-top { margin-bottom:14px; }
        #how .step-num, #how .step-icon { width:36px; height:36px; }
    }
</style>
<nav>
    <a href="#" class="nav-brand">
        <div class="nav-logo">B</div>
        <span class="nav-title"><span>BUHU</span>AN</span>
    </a>
    <div class="nav-links">
        <a href="{{ route('login') }}" class="btn-outline">Log In</a>
        <a href="{{ route('register') }}" class="btn-primary">Register</a>
    </div>
</nav>
 
<section class="hero">
    <div class="hero-grid">
 
        <div class="hero-left">
            <div class="hero-badge">Barangay Buhuan &mdash; Oriental Mindoro</div>
            <h1 class="hero-title">
                Welcome to<br>
                <span class="accent">BUHUAN</span>
            </h1>
            <p class="hero-subtitle">
                An Online Barangay Service Management System that brings Barangay Buhuan's services directly to you — request documents, schedule appointments, and track your transactions anytime, anywhere.
            </p>
            <div class="hero-cta">
                <a href="{{ route('register') }}" class="btn-hero">Get Started</a>
                <a href="#services" class="btn-hero-ghost">Explore Services</a>
            </div>
        </div>
 
        <div class="hero-visual">
            <div class="hero-card">
                <div class="hero-card-header">
                    <div class="card-icon gold">🏛️</div>
                    <div>
                        <div class="card-label">Barangay Buhuan</div>
                        <div class="card-value">Online Services Portal</div>
                    </div>
                </div>
                <div class="service-list">
                    <div class="service-item">
                        <div class="service-dot dot-gold"></div>
                        <span class="service-name">📄 Barangay Clearance</span>
                        <span class="status-badge status-available">Available</span>
                    </div>
                    <div class="service-item">
                        <div class="service-dot dot-blue"></div>
                        <span class="service-name">📋 Indigency Certificate</span>
                        <span class="status-badge status-available">Available</span>
                    </div>
                    <div class="service-item">
                        <div class="service-dot dot-green"></div>
                        <span class="service-name">📅 Appointment Scheduling</span>
                        <span class="status-badge status-online">Online</span>
                    </div>
                    <div class="service-item">
                        <div class="service-dot dot-purple"></div>
                        <span class="service-name">📦 Request Tracking</span>
                        <span class="status-badge status-online">Online</span>
                    </div>
                </div>
            </div>
 
            <div class="stat-float top-right">
                <div class="stat-num">24/7</div>
                <div class="stat-lbl">Online Access</div>
            </div>
            <div class="stat-float bottom-left">
                <div class="stat-num">Fast</div>
                <div class="stat-lbl">Document Processing</div>
            </div>
        </div>
 
    </div>
</section>
 
<section class="services" id="services">
 
    <div class="svc-head">
        <div class="section-label">Barangay Services</div>
        <h2 class="section-title">What You Can Do on BUHUAN</h2>
        <p class="section-subtitle">BUHUAN covers two core service areas for Barangay Buhuan residents: requesting official barangay documents and scheduling appointments with barangay officials. All transactions are tracked online from submission to completion.</p>
    </div>
 
    <div class="features-two-col">
 
        <div class="feat-block">
            <div class="feat-header">
                <div class="feat-tag tag-doc"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h6"/></svg> Document Request &amp; Tracking</div>
                <h3 class="feat-title">Request Barangay Documents Online</h3>
                <p class="feat-desc">Submit official document requests from home and track each request from submission through processing to pickup — no need to visit the barangay hall just to follow up on your request.</p>
            </div>
            
            <div class="feat-steps">
                <div class="fstep">
                    <div class="fstep-num">1</div>
                    <div class="fstep-body">
                        <div class="fstep-label">Submit your request online</div>
                        <p class="fstep-sub">Fill out the request form and upload any required supporting documents through your resident account.</p>
                    </div>
                </div>
                <div class="fstep">
                    <div class="fstep-num">2</div>
                    <div class="fstep-body">
                        <div class="fstep-label">Admin reviews and processes</div>
                        <p class="fstep-sub">Barangay staff verify your identity and submitted details, then prepare the document on their end.</p>
                    </div>
                </div>
                <div class="fstep">
                    <div class="fstep-num">3</div>
                    <div class="fstep-body">
                        <div class="fstep-label">Get notified when ready for pickup</div>
                        <p class="fstep-sub">You receive an email notification once your document is approved and available for pickup at the barangay hall.</p>
                    </div>
                </div>
            </div>

            <div class="doc-pills">
                <span class="dpill">Barangay Clearance</span>
                <span class="dpill">Certificate of Indigency</span>
                <span class="dpill">Certificate of Residency</span>
                <span class="dpill">Barangay Identification</span>
            </div>
        </div>
 
        <div class="feat-block">
            <div class="feat-header">
                <div class="feat-tag tag-appt"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18M8 14h.01M12 14h.01M16 14h.01"/></svg> Appointment Scheduling</div>
                <h3 class="feat-title">Schedule Appointments with Barangay Officials</h3>
                <p class="feat-desc">Book a time slot to meet with barangay officials for concerns, consultations, or follow-ups. Available schedules are managed and published by the barangay administrator.</p>
            </div>

            <div class="feat-steps">
                <div class="fstep">
                    <div class="fstep-num">1</div>
                    <div class="fstep-body">
                        <div class="fstep-label">Browse available time slots</div>
                        <p class="fstep-sub">View open appointment schedules set by the barangay and choose a date and time that works for you.</p>
                    </div>
                </div>
                <div class="fstep">
                    <div class="fstep-num">2</div>
                    <div class="fstep-body">
                        <div class="fstep-label">State your concern</div>
                        <p class="fstep-sub">Briefly describe the purpose of your appointment so barangay officials can prepare in advance.</p>
                    </div>
                </div>
                <div class="fstep">
                    <div class="fstep-num">3</div>
                    <div class="fstep-body">
                        <div class="fstep-label">Receive email confirmation</div>
                        <p class="fstep-sub">A confirmation email is sent once the barangay approves your appointment booking.</p>
                    </div>
                </div>
                <div class="fstep">
                    <div class="fstep-num">4</div>
                    <div class="fstep-body">
                        <div class="fstep-label">Show up at your scheduled time</div>
                        <p class="fstep-sub">Visit the barangay hall at your confirmed date and time — no more waiting in unscheduled queues.</p>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
</section>
 
<section class="how" id="how">
    <div class="how-head">
        <div class="section-label">How It Works</div>
        <h2 class="section-title">Simple Steps to Get Started</h2>
        <p class="section-subtitle">Getting barangay services has never been easier. Follow these steps.</p>
    </div>
 
    <div class="steps">
        <div class="step">
            <div class="step-top"><div class="step-num">1</div><span class="step-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="9" cy="8" r="4"/><path d="M2.5 21a6.5 6.5 0 0 1 13 0M19 8v6M16 11h6"/></svg></span></div>
            <div class="step-title">Create Account</div>
            <p class="step-desc">Register with your personal details and submit verification documents for admin approval.</p>
        </div>
        <div class="step">
            <div class="step-top"><div class="step-num">2</div><span class="step-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3M12 14v3"/></svg></span></div>
            <div class="step-title">Log In Securely</div>
            <p class="step-desc">Access your personalized dashboard using secure login credentials.</p>
        </div>
        <div class="step">
            <div class="step-top"><div class="step-num">3</div><span class="step-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v18h16V8zM14 2v6h6M8 13h8M8 17h5"/></svg></span></div>
            <div class="step-title">Request or Schedule</div>
            <p class="step-desc">Submit a document request or book an appointment at your convenience.</p>
        </div>
        <div class="step">
            <div class="step-top"><div class="step-num">4</div><span class="step-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 9a6 6 0 0 0-12 0c0 6-2.5 7-3 9h18c-.5-2-3-3-3-9M10 21h4"/><path d="m9 14 2 2 4-4"/></svg></span></div>
            <div class="step-title">Track & Receive</div>
            <p class="step-desc">Monitor the status of your request and get notified once it's ready for pickup.</p>
        </div>
    </div>
</section>

<footer>
    <div class="footer-inner">
        <div>
            <div class="footer-brand"><span>BUHU</span>AN</div>
            <div class="footer-sub">Online Barangay Service Management System</div>
        </div>
        <div style="text-align:right;">
            <div class="footer-text">Barangay Buhuan &middot; Oriental Mindoro, Philippines</div>
            <div class="footer-sub">&copy; 2026 BUHUAN. All rights reserved.</div>
        </div>
    </div>
</footer>
