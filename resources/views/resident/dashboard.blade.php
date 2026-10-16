<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>BUHUAN &ndash; Resident Portal</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --navy:  #0f1b2d;
      --navy2: #162236;
      --navy3: #1e3050;
      --gold:  #c9a227;
      --gold2: #e6b93a;
      --gold3: #f5d780;
      --bg:    #f0ede6;
      --text:  #e8e0d0;
      --muted: #8a9bb5;
      --white: #ffffff;
      --sb:    262px;
    }

    body { font-family:'DM Sans',sans-serif; background:var(--bg); display:flex; min-height:100vh; color:#2a1f00; }

    .sidebar {
      width:var(--sb); min-height:100vh; background:var(--navy2);
      display:flex; flex-direction:column;
      position:fixed; top:0; left:0; bottom:0; z-index:100;
    }
    .sidebar::after  { content:''; position:absolute; top:0; left:0; right:0; height:3px; background:linear-gradient(90deg,var(--gold),var(--gold2),var(--gold3)); }
    .sidebar::before { content:''; position:absolute; inset:0; background:radial-gradient(ellipse at 15% 85%,rgba(201,162,39,0.09) 0%,transparent 55%); pointer-events:none; }

    .sb-logo { padding:26px 22px 20px; display:flex; align-items:center; gap:11px; border-bottom:1px solid rgba(255,255,255,0.06); }
    .sb-mark { width:38px; height:38px; background:var(--gold); border-radius:9px; display:flex; align-items:center; justify-content:center; font-family:'Playfair Display',serif; font-weight:900; font-size:17px; color:var(--navy); flex-shrink:0; }
    .sb-words { font-family:'Playfair Display',serif; font-size:17px; font-weight:700; letter-spacing:1.5px; color:var(--text); }
    .sb-words span { color:var(--gold); }
    .sb-sub { display:block; font-size:9px; font-weight:600; letter-spacing:2px; color:var(--gold); text-transform:uppercase; margin-top:1px; }

    .nav-grp { padding:16px 12px 4px; }
    .nav-grp-lbl { font-size:9px; font-weight:600; letter-spacing:2.5px; color:var(--muted); text-transform:uppercase; padding:0 10px; margin-bottom:4px; }

    .nav-lnk {
      display:flex; align-items:center; gap:11px;
      padding:10px 12px; border-radius:9px; margin-bottom:1px;
      text-decoration:none; color:var(--muted);
      font-size:13.5px; font-weight:500;
      transition:all .18s; cursor:pointer;
      border:1px solid transparent;
    }
    .nav-lnk:hover  { background:rgba(255,255,255,0.05); color:var(--text); }
    .nav-lnk.active { background:rgba(201,162,39,0.13); color:var(--gold2); border-color:rgba(201,162,39,0.22); }

    .nav-ico { width:30px; height:30px; display:flex; align-items:center; justify-content:center; font-size:15px; flex-shrink:0; }
    .nav-ico svg { width:17px; height:17px; flex:0 0 17px; }
    .logout-icon svg { width:17px; height:17px; fill:none; stroke:currentColor; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; vertical-align:middle; }
    .nav-cnt { margin-left:auto; background:var(--gold); color:var(--navy); font-size:10px; font-weight:700; padding:1px 7px; border-radius:99px; }

    .sb-foot { margin-top:auto; padding:16px 14px; border-top:1px solid rgba(255,255,255,0.06); }

    .sb-user-card {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      padding: 10px 12px;
      border-radius: 10px;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(201,162,39,0.12);
    }
    .sb-ava {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--gold3), var(--gold));
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Playfair Display', serif;
      font-size: 15px;
      font-weight: 700;
      color: var(--navy);
      flex-shrink: 0;
    }
    .sb-uinfo {
      flex: 1;
      min-width: 0;
    }
    .sb-uname {
      font-size: 12.5px;
      font-weight: 600;
      color: var(--text);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .sb-urole {
      font-size: 10px;
      color: var(--gold);
      font-weight: 500;
    }

    .logout-icon {
      background: none;
      border: none;
      color: var(--gold);
      font-size: 18px;
      cursor: pointer;
      padding: 0 8px;
      transition: color 0.2s;
    }
    .logout-icon:hover { color: #e57373; }

    /* ── MAIN ── */
    .main { margin-left:var(--sb); flex:1; display:flex; flex-direction:column; min-height:100vh; }

    .topbar { height:62px; background:var(--white); border-bottom:1px solid #e8e0d0; display:flex; align-items:center; padding:0 30px; gap:14px; position:sticky; top:0; z-index:50; }
    .tb-info { flex:1; }
    .tb-title { font-family:'Playfair Display',serif; font-size:19px; font-weight:700; color:var(--navy); }
    .tb-sub   { font-size:11.5px; color:#a0917a; margin-top:1px; }
    .tb-right { display:flex; align-items:center; gap:10px; }
    .chip { font-size:12px; color:#7a6e58; background:var(--bg); border:1px solid #ddd4be; padding:6px 13px; border-radius:8px; font-weight:500; }

    /* ── CONTENT ── */
    .content { padding:28px 30px; flex:1; overflow-y:auto; }
    .page { display:none; }
    .page.active { display:block; animation:fadeUp .35s ease both; }
    @keyframes fadeUp { from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);} }

    /* ── STAT CARDS ── */
    .stats { display:grid; grid-template-columns:repeat(3,1fr); gap:18px; margin-bottom:24px; }
    .scard { background:var(--white); border-radius:14px; border:1px solid #ede8dd; padding:20px 22px; position:relative; overflow:hidden; transition:box-shadow .2s,transform .2s; cursor:pointer; animation:fadeUp .4s ease both; }
    .scard:hover { box-shadow:0 8px 26px rgba(0,0,0,0.07); transform:translateY(-2px); }
    .scard::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; }
    .scard.c1::before { background:linear-gradient(90deg,#c9a227,#e6b93a); }
    .scard.c2::before { background:linear-gradient(90deg,#1e7e4a,#27ae60); }
    .scard.c3::before { background:linear-gradient(90deg,#0f1b2d,#1e3050); }
    .sico { width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:19px; margin-bottom:14px; }
    .sico.c1{background:rgba(201,162,39,0.12);} .sico.c2{background:rgba(30,126,74,0.1);} .sico.c3{background:rgba(15,27,45,0.07);}
    .sval { font-family:'Playfair Display',serif; font-size:38px; font-weight:900; color:var(--navy); line-height:1; margin-bottom:3px; }
    .slbl { font-size:12px; color:#8a7a5a; font-weight:500; }
    .stag { position:absolute; top:20px; right:18px; font-size:10.5px; font-weight:600; padding:2px 8px; border-radius:6px; }
    .stag.warn{background:rgba(184,134,11,0.1);color:#8a6000;} .stag.ok{background:rgba(30,126,74,0.1);color:#1e7e4a;} .stag.info{background:rgba(15,27,45,0.08);color:#1e3050;}
    .scard:nth-child(1){animation-delay:.05s;} .scard:nth-child(2){animation-delay:.1s;} .scard:nth-child(3){animation-delay:.15s;}

    /* ── PANELS ── */
    .panel { background:var(--white); border-radius:14px; border:1px solid #ede8dd; overflow:hidden; margin-bottom:18px; }
    .panel-half { background:var(--white); border-radius:14px; border:1px solid #ede8dd; overflow:hidden; }
    .row2 { display:grid; grid-template-columns:1.3fr 1fr; gap:18px; margin-bottom:18px; }

    .ph { padding:18px 22px 14px; border-bottom:1px solid #f0ebe0; display:flex; align-items:flex-start; justify-content:space-between; }
    .ph-title { font-family:'Playfair Display',serif; font-size:15px; font-weight:700; color:var(--navy); }
    .ph-sub { font-size:11.5px; color:#a0917a; margin-top:2px; }
    .ph-btn { font-size:12px; font-weight:600; color:var(--gold); background:none; border:none; cursor:pointer; padding:5px 11px; border-radius:7px; transition:background .18s; white-space:nowrap; }
    .ph-btn:hover { background:rgba(201,162,39,0.1); }

    /* ── TABLE ── */
    .tw { overflow-x:auto; }
    table { width:100%; border-collapse:collapse; }
    thead th { font-size:10px; font-weight:600; letter-spacing:1.2px; text-transform:uppercase; color:#a0917a; padding:9px 22px; text-align:left; background:#faf8f3; border-bottom:1px solid #f0ebe0; }
    tbody td { padding:13px 22px; font-size:13.5px; color:#2a1f00; border-bottom:1px solid #f5f1ea; }
    tbody tr:last-child td { border-bottom:none; }
    tbody tr:hover td { background:#faf8f3; }

    .badge { display:inline-flex; align-items:center; gap:5px; padding:3px 10px; border-radius:99px; font-size:11px; font-weight:600; }
    .badge::before { content:'●'; font-size:7px; }
    .badge.pending   { background:rgba(184,134,11,0.1); color:#7a5000; border:1px solid rgba(184,134,11,0.22); }
    .badge.approved  { background:rgba(30,126,74,0.1);  color:#1a5c38; border:1px solid rgba(30,126,74,0.22); }
    .badge.rejected  { background:rgba(192,57,43,0.1);  color:#7a1a10; border:1px solid rgba(192,57,43,0.22); }
    .badge.ready     { background:rgba(15,27,45,0.08);  color:#0f1b2d; border:1px solid rgba(15,27,45,0.18); }
    .badge.confirmed { background:rgba(30,126,74,0.1);  color:#1a5c38; border:1px solid rgba(30,126,74,0.22); }
    .badge.review    { background:rgba(184,134,11,0.1); color:#7a5000; border:1px solid rgba(184,134,11,0.22); }
    .badge.done      { background:rgba(30,126,74,0.1);  color:#1a5c38; border:1px solid rgba(30,126,74,0.22); }
    .badge.cancelled { background:rgba(192,57,43,0.1);  color:#7a1a10; border:1px solid rgba(192,57,43,0.22); }

    .abtn { padding:4px 11px; border-radius:7px; font-size:11.5px; font-weight:600; cursor:pointer; border:none; transition:all .15s; }
    .abtn-view { background:rgba(201,162,39,0.1); color:#7a5c00; border:1px solid rgba(201,162,39,0.2); }
    .abtn-view:hover { background:rgba(201,162,39,0.2); }
    .abtn-gold { background:var(--gold); color:var(--navy); border:none; padding:9px 18px; border-radius:9px; font-size:13px; font-weight:700; cursor:pointer; transition:all .18s; }
    .abtn-gold:hover { background:var(--gold2); box-shadow:0 4px 14px rgba(201,162,39,0.3); }
    .abtn-outline { background:transparent; color:var(--navy); border:1.5px solid #d4c9af; padding:9px 18px; border-radius:9px; font-size:13px; font-weight:600; cursor:pointer; transition:all .18s; }
    .abtn-outline:hover { border-color:var(--gold); color:#7a5c00; }

    .alog { padding:4px 0; }
    .aitem { display:flex; align-items:flex-start; gap:12px; padding:12px 22px; border-bottom:1px solid #f5f1ea; transition:background .15s; }
    .aitem:last-child { border-bottom:none; }
    .aitem:hover { background:#faf8f3; }
    .adot { width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:12px; flex-shrink:0; margin-top:2px; }
    .adot.gold{background:rgba(201,162,39,0.12);} .adot.navy{background:rgba(15,27,45,0.08);} .adot.green{background:rgba(30,126,74,0.1);} .adot.red{background:rgba(192,57,43,0.08);}
    .abody { flex:1; }
    .abody strong { font-size:13px; font-weight:600; color:var(--navy); }
    .abody p { font-size:11.5px; color:#8a7a5a; margin-top:2px; }
    .atime { font-size:11px; color:#b0a48a; white-space:nowrap; margin-top:3px; }

    .rgrid { display:grid; grid-template-columns:repeat(3,1fr); gap:12px; padding:18px 22px; }
    .rcard { border:1px solid #e0d9c8; border-radius:11px; padding:15px 14px; cursor:pointer; transition:all .2s; background:var(--bg); display:flex; align-items:center; gap:11px; }
    .rcard:hover { border-color:var(--gold); background:#fffbee; box-shadow:0 3px 14px rgba(201,162,39,0.1); }
    .rcard-ico { width:36px; height:36px; border-radius:9px; display:flex; align-items:center; justify-content:center; font-size:17px; background:rgba(201,162,39,0.1); flex-shrink:0; }
    .rcard-t h4 { font-size:12px; font-weight:600; color:var(--navy); }
    .rcard-t p  { font-size:11px; color:#8a7a5a; margin-top:1px; }

    .welcome-banner { background:linear-gradient(120deg,var(--navy2) 0%,var(--navy3) 60%,#243868 100%); border-radius:16px; padding:26px 30px; margin-bottom:22px; display:flex; align-items:center; justify-content:space-between; position:relative; overflow:hidden; }
    .welcome-banner::before { content:''; position:absolute; inset:0; background:radial-gradient(ellipse at 80% 50%,rgba(201,162,39,0.15) 0%,transparent 60%); }
    .wb-text { position:relative; }
    .wb-text h2 { font-family:'Playfair Display',serif; font-size:24px; font-weight:900; color:var(--text); margin-bottom:4px; }
    .wb-text h2 span { color:var(--gold2); }
    .wb-text p { font-size:12.5px; color:var(--muted); line-height:1.5; }
    .wb-actions { display:flex; gap:10px; position:relative; }
    .btn-banner-primary { padding:10px 20px; background:var(--gold); color:var(--navy); border:none; border-radius:9px; font-family:'Playfair Display',serif; font-size:13px; font-weight:700; cursor:pointer; transition:all .2s; }
    .btn-banner-primary:hover { background:var(--gold2); box-shadow:0 4px 16px rgba(201,162,39,0.3); }
    .btn-banner-outline { padding:10px 20px; background:rgba(255,255,255,0.07); color:var(--text); border:1px solid rgba(255,255,255,0.15); border-radius:9px; font-size:13px; font-weight:500; cursor:pointer; transition:all .2s; }
    .btn-banner-outline:hover { background:rgba(255,255,255,0.12); }

    .appt-list { padding:4px 0; }
    .appt-item { display:flex; align-items:center; gap:14px; padding:13px 22px; border-bottom:1px solid #f5f1ea; transition:background .15s; }
    .appt-item:last-child { border-bottom:none; }
    .appt-item:hover { background:#faf8f3; }
    .appt-date { width:48px; height:52px; background:var(--navy2); border-radius:10px; display:flex; flex-direction:column; align-items:center; justify-content:center; flex-shrink:0; }
    .appt-date .day { font-family:'Playfair Display',serif; font-size:20px; font-weight:900; color:var(--gold2); line-height:1; }
    .appt-date .mon { font-size:9px; font-weight:600; color:var(--muted); letter-spacing:1px; text-transform:uppercase; }
    .appt-info { flex:1; }
    .appt-info h4 { font-size:13.5px; font-weight:600; color:var(--navy); }
    .appt-info p  { font-size:11.5px; color:#8a7a5a; margin-top:2px; }

    .svc-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; padding:18px 22px; }
    .svc-card { border:1px solid #e0d9c8; border-radius:12px; padding:18px 15px; cursor:pointer; transition:all .2s; background:var(--bg); text-align:center; }
    .svc-card:hover { border-color:var(--gold); background:#fffbee; box-shadow:0 4px 16px rgba(201,162,39,0.12); transform:translateY(-2px); }
    .svc-emoji { font-size:26px; margin-bottom:8px; }
    .svc-name { font-size:12.5px; font-weight:600; color:var(--navy); margin-bottom:2px; }
    .svc-desc { font-size:11px; color:#8a7a5a; line-height:1.4; }

    .sched-layout { display:grid; grid-template-columns:1fr 380px; gap:18px; align-items:start; }
    .cal-panel { background:var(--white); border-radius:14px; border:1px solid #ede8dd; overflow:hidden; }
    .cal-head { padding:16px 18px 12px; border-bottom:1px solid #f0ebe0; display:flex; align-items:center; justify-content:space-between; }
    .cal-head-title { font-family:'Playfair Display',serif; font-size:14px; font-weight:700; color:var(--navy); }
    .cal-nav-btns { display:flex; gap:4px; }
    .cal-nav-btns button { width:26px; height:26px; border:1px solid #e0d9c8; background:var(--bg); border-radius:7px; cursor:pointer; font-size:12px; display:flex; align-items:center; justify-content:center; color:var(--navy); transition:all .15s; }
    .cal-nav-btns button:hover { border-color:var(--gold); color:#7a5c00; }
    .cal-grid-wrap { padding:12px 14px; }
    .cal-dow { display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
    .cal-dow span { font-size:9px; font-weight:700; letter-spacing:.8px; color:#a0917a; padding:3px 0; text-transform:uppercase; }
    .cal-days { display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
    .cal-day { aspect-ratio:1; display:flex; align-items:center; justify-content:center; font-size:11.5px; font-weight:500; border-radius:7px; cursor:default; color:#c8bfac; transition:all .15s; position:relative; }
    .cal-day.open { color:#6a5a40; cursor:pointer; }
    .cal-day.open:hover { background:rgba(201,162,39,0.1); color:#7a5c00; }
    .cal-day.today { background:var(--navy); color:var(--white) !important; font-weight:700; }
    .cal-day.today.open:hover { background:var(--navy3); }
    .cal-day.has-slots.open { font-weight:700; color:var(--navy); }
    .cal-day.has-slots.open::after { content:''; position:absolute; bottom:3px; left:50%; transform:translateX(-50%); width:4px; height:4px; border-radius:50%; background:var(--gold); }
    .cal-day.selected { background:rgba(201,162,39,0.2) !important; border:1.5px solid var(--gold); color:#7a5c00 !important; }
    .cal-day.other { color:#ddd4c4 !important; }
    .slot-picker { background:var(--white); border-radius:14px; border:1px solid #ede8dd; overflow:hidden; position:sticky; top:80px; }
    .slot-picker-head { padding:16px 18px 12px; border-bottom:1px solid #f0ebe0; }
    .slot-picker-title { font-family:'Playfair Display',serif; font-size:14px; font-weight:700; color:var(--navy); }
    .slot-picker-sub { font-size:11.5px; color:#a0917a; margin-top:2px; }
    .slot-picker-body { padding:14px 18px; }
    .slot-info-note { display:flex; align-items:flex-start; gap:8px; background:#fffbee; border:1px solid #e8d88a; border-radius:9px; padding:10px 12px; margin-bottom:14px; font-size:12px; color:#6b5a2a; line-height:1.5; }
    .slots-available { display:flex; flex-direction:column; gap:7px; margin-bottom:16px; min-height:60px; }
    .slot-option { display:flex; align-items:center; gap:10px; padding:11px 14px; border:1.5px solid #e0d9c8; border-radius:9px; cursor:pointer; background:var(--bg); transition:all .18s; }
    .slot-option:hover { border-color:var(--gold); background:#fffbee; }
    .slot-option.selected { border-color:var(--gold); background:rgba(201,162,39,0.1); }
    .slot-option.full { opacity:.5; cursor:not-allowed; background:#f5f1ea; border-color:#e0d9c8; }
    .slot-option-time { font-size:13px; font-weight:700; color:var(--navy); flex:1; }
    .slot-option-count { font-size:11px; color:#8a7a5a; }
    .slot-option-dot { width:8px; height:8px; border-radius:50%; background:var(--gold); flex-shrink:0; }
    .slot-option.full .slot-option-dot { background:#e74c3c; }
    .slot-option.full .slot-option-time { color:#c0392b; }
    .no-date-msg { font-size:12.5px; color:#a0917a; text-align:center; padding:24px 0; font-style:italic; }
    .spick-field { margin-bottom:12px; }
    .spick-field label { display:block; font-size:10.5px; font-weight:600; color:#a0917a; letter-spacing:.8px; text-transform:uppercase; margin-bottom:5px; }
    .spick-field select, .spick-field textarea { width:100%; padding:10px 13px; border-radius:9px; border:1.5px solid #d4c9af; background:var(--white); font-family:'DM Sans',sans-serif; font-size:13px; color:#1a1200; outline:none; appearance:none; transition:border-color .2s,box-shadow .2s; }
    .spick-field select:focus, .spick-field textarea:focus { border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,162,39,0.12); }
    .spick-field textarea { resize:vertical; min-height:76px; }
    .submit-btn { width:100%; padding:13px; background:var(--navy); color:var(--gold2); border:none; border-radius:10px; font-family:'Playfair Display',serif; font-size:15px; font-weight:700; cursor:pointer; transition:all .2s; margin-top:4px; }
    .submit-btn:hover { background:var(--navy3); box-shadow:0 4px 18px rgba(15,27,45,0.2); }

    .modal-overlay { position:fixed; inset:0; background:rgba(15,27,45,0.55); z-index:999; display:flex; align-items:center; justify-content:center; opacity:0; pointer-events:none; transition:opacity .22s; backdrop-filter:blur(3px); }
    .modal-overlay.open { opacity:1; pointer-events:all; }
    .modal { background:var(--white); border-radius:16px; width:480px; max-width:95vw; box-shadow:0 24px 80px rgba(0,0,0,0.18); border:1px solid #ede8dd; transform:translateY(20px) scale(.97); transition:transform .22s; overflow:hidden; }
    .modal-overlay.open .modal { transform:translateY(0) scale(1); }
    .modal-head { padding:20px 24px 16px; border-bottom:1px solid #f0ebe0; display:flex; align-items:flex-start; justify-content:space-between; }
    .modal-head-title { font-family:'Playfair Display',serif; font-size:16px; font-weight:700; color:var(--navy); }
    .modal-head-sub { font-size:12px; color:#a0917a; margin-top:2px; }
    .modal-close { width:28px; height:28px; border-radius:50%; border:1px solid #e0d9c8; background:var(--bg); cursor:pointer; font-size:13px; display:flex; align-items:center; justify-content:center; transition:all .15s; }
    .modal-close:hover { background:#f5ebe0; border-color:#c0a870; }
    .modal-body { padding:20px 24px; }
    .modal-foot { padding:14px 24px 18px; display:flex; justify-content:flex-end; gap:10px; border-top:1px solid #f0ebe0; }
    .modal-detail-row { display:flex; gap:12px; margin-bottom:12px; }
    .modal-box { flex:1; padding:12px 14px; border-radius:10px; background:var(--bg); border:1px solid #e0d9c8; }
    .modal-box label { font-size:10px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:#a0917a; display:block; margin-bottom:4px; }
    .modal-box p { font-size:13.5px; font-weight:600; color:var(--navy); }
    .modal-desc-box { padding:13px 14px; border-radius:10px; background:#fffbee; border:1.5px solid rgba(201,162,39,0.25); margin-bottom:14px; }
    .modal-desc-box label { font-size:10px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:#a0917a; display:block; margin-bottom:6px; }
    .modal-desc-box p { font-size:13px; color:#3a2800; line-height:1.55; }

    .toast-wrap { position:fixed; bottom:28px; right:28px; z-index:9999; display:flex; flex-direction:column; gap:8px; pointer-events:none; }
    .toast { padding:11px 18px; border-radius:10px; font-size:13px; font-weight:600; display:flex; align-items:center; gap:9px; box-shadow:0 6px 22px rgba(0,0,0,0.14); transform:translateY(20px); opacity:0; transition:all .3s; pointer-events:none; }
    .toast.show { transform:translateY(0); opacity:1; }
    .toast.t-ok   { background:#1a4a30; color:#a8e6c0; }
    .toast.t-warn { background:#4a3a00; color:#f5d780; }

    .empty-state { padding:36px 22px; text-align:center; color:#a0917a; font-size:13.5px; }

    .notif-toolbar {
      display:flex; align-items:center; gap:8px;
      padding:14px 22px; border-bottom:1px solid #f0ebe0;
      background:#faf8f3;
    }
    .notif-filter-btn {
      padding:5px 13px; border-radius:20px; font-size:11.5px; font-weight:600;
      cursor:pointer; border:1.5px solid #e0d9c8; background:var(--white);
      color:#8a7a5a; transition:all .15s;
    }
    .notif-filter-btn:hover { border-color:var(--gold); color:#7a5c00; }
    .notif-filter-btn.on { background:var(--gold); color:var(--navy); border-color:var(--gold); }
    .notif-mark-all {
      margin-left:auto; font-size:11.5px; font-weight:600;
      color:var(--gold); background:none; border:none; cursor:pointer; padding:5px 0;
    }
    .notif-mark-all:hover { text-decoration:underline; }

    .notif-feed { padding:12px 20px; display:flex; flex-direction:column; gap:10px; }

    .ncard {
      display:flex; gap:14px;
      background:var(--white); border-radius:12px;
      border:1px solid #ede8dd;
      padding:16px 18px;
      transition:box-shadow .18s, transform .18s;
      position:relative; overflow:hidden;
    }
    .ncard:hover { box-shadow:0 4px 18px rgba(0,0,0,0.06); transform:translateY(-1px); }
    .ncard::before {
      content:''; position:absolute; top:0; left:0; bottom:0; width:3px;
    }
    .ncard.nc-green::before { background:linear-gradient(180deg,#1e7e4a,#27ae60); }
    .ncard.nc-gold::before  { background:linear-gradient(180deg,var(--gold),var(--gold2)); }
    .ncard.nc-navy::before  { background:linear-gradient(180deg,var(--navy),var(--navy3)); }
    .ncard.nc-red::before   { background:linear-gradient(180deg,#c0392b,#e74c3c); }
    .ncard.unread { background:#fffef8; border-color:#e8d88a; }
    .ncard-icon {
      width:38px; height:38px; border-radius:10px;
      display:flex; align-items:center; justify-content:center;
      font-size:17px; flex-shrink:0; margin-top:1px;
    }
    .ncard-icon.nc-green { background:rgba(30,126,74,0.1); }
    .ncard-icon.nc-gold  { background:rgba(201,162,39,0.12); }
    .ncard-icon.nc-navy  { background:rgba(15,27,45,0.08); }
    .ncard-icon.nc-red   { background:rgba(192,57,43,0.08); }
    .ncard-body { flex:1; min-width:0; }
    .ncard-top { display:flex; align-items:flex-start; justify-content:space-between; gap:10px; margin-bottom:4px; }
    .ncard-title { font-size:13px; font-weight:700; color:var(--navy); line-height:1.3; }
    .ncard-time { font-size:10.5px; color:#b0a48a; white-space:nowrap; flex-shrink:0; margin-top:1px; }
    .ncard-msg { font-size:12px; color:#6b5e42; line-height:1.55; }
    .ncard-tag {
      display:inline-flex; align-items:center; margin-top:8px;
      font-size:10px; font-weight:600; letter-spacing:.5px; padding:2px 9px;
      border-radius:20px; text-transform:uppercase;
    }
    .ncard-tag.nc-green { background:rgba(30,126,74,0.1); color:#1a5c38; }
    .ncard-tag.nc-gold  { background:rgba(201,162,39,0.1); color:#7a5c00; }
    .ncard-tag.nc-navy  { background:rgba(15,27,45,0.07);  color:#1e3050; }
    .ncard-tag.nc-red   { background:rgba(192,57,43,0.08); color:#7a1a10; }
    .unread-dot {
      width:8px; height:8px; border-radius:50%;
      background:var(--gold2); flex-shrink:0; margin-top:6px;
    }
    .notif-empty { text-align:center; padding:48px 22px; color:#a0917a; font-size:13px; }
    .notif-empty .ne-ico { font-size:36px; opacity:.4; margin-bottom:10px; }

    .doc-req-layout { display:grid; grid-template-columns:1fr 1fr; gap:18px; padding:22px; }
    .doc-type-list { display:flex; flex-direction:column; gap:8px; }
    .doc-type-item {
      display:flex; align-items:center; gap:13px;
      padding:13px 16px; border:1.5px solid #e0d9c8;
      border-radius:11px; cursor:pointer; background:var(--bg);
      transition:all .18s;
    }
    .doc-type-item:hover { border-color:var(--gold); background:#fffbee; }
    .doc-type-item.selected { border-color:var(--gold); background:rgba(201,162,39,0.08); }
    .doc-type-item.selected .dti-radio { background:var(--gold); border-color:var(--gold); }
    .doc-type-item.selected .dti-radio::after { opacity:1; }
    .dti-radio {
      width:18px; height:18px; border-radius:50%;
      border:2px solid #d4c9af; background:var(--white);
      flex-shrink:0; position:relative; transition:all .15s;
    }
    .dti-radio::after {
      content:''; position:absolute; inset:3px;
      border-radius:50%; background:var(--navy);
      opacity:0; transition:opacity .15s;
    }
    .dti-icon { font-size:20px; flex-shrink:0; }
    .dti-info h4 { font-size:13px; font-weight:600; color:var(--navy); }
    .dti-info p  { font-size:11px; color:#8a7a5a; margin-top:1px; }
    .doc-form-col { display:flex; flex-direction:column; gap:0; }
    .doc-form-col .field-grp { margin-bottom:14px; }
    .field-grp { }
    .field-grp label { display:block; font-size:10.5px; font-weight:600; color:#a0917a; letter-spacing:.8px; text-transform:uppercase; margin-bottom:5px; }
    .field-grp input, .field-grp select, .field-grp textarea {
      width:100%; padding:11px 14px; border-radius:9px;
      border:1.5px solid #d4c9af; background:var(--white);
      font-family:'DM Sans',sans-serif; font-size:13.5px; color:#1a1200;
      transition:border-color .2s,box-shadow .2s; outline:none; appearance:none;
    }
    .field-grp input:focus, .field-grp select:focus, .field-grp textarea:focus { border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,162,39,0.12); }
    .field-grp input::placeholder, .field-grp textarea::placeholder { color:#b0a48a; }
    .field-grp textarea { resize:vertical; min-height:88px; }
    .field-grp input[readonly] { background:#faf8f3; color:#6b5e42; cursor:default; }
    .row-2 { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .sel-doc-echo {
      display:flex; align-items:center; gap:10px;
      padding:12px 14px; border-radius:10px;
      background:rgba(201,162,39,0.08); border:1px solid rgba(201,162,39,0.22);
      margin-bottom:14px;
    }
    .sel-doc-echo .sde-icon { font-size:20px; }
    .sel-doc-echo .sde-name { font-size:13px; font-weight:700; color:var(--navy); }
    .sel-doc-echo .sde-sub  { font-size:11px; color:#8a7a5a; }
    .sel-doc-echo.empty { background:var(--bg); border-color:#e0d9c8; }
    .sel-doc-echo.empty .sde-name { color:#a0917a; font-weight:500; }
    .doc-req-info-note {
      display:flex; align-items:flex-start; gap:8px;
      background:#fffbee; border:1px solid #e8d88a; border-radius:9px;
      padding:10px 13px; margin-bottom:14px; font-size:12px; color:#6b5a2a; line-height:1.5;
    }

    .prof-hero {
      background:linear-gradient(135deg, var(--navy2) 0%, var(--navy3) 55%, #243868 100%);
      padding:32px 32px 0;
      position:relative; overflow:hidden;
    }
    .prof-hero::before {
      content:''; position:absolute; inset:0;
      background:radial-gradient(ellipse at 90% 60%,rgba(201,162,39,0.13) 0%,transparent 55%);
    }
    .prof-hero-inner { display:flex; align-items:flex-end; gap:22px; position:relative; z-index:1; }
    .prof-avatar-wrap { position:relative; flex-shrink:0; }
    .prof-ava-lg {
      width:80px; height:80px; border-radius:50%;
      background:linear-gradient(135deg,var(--gold3),var(--gold));
      display:flex; align-items:center; justify-content:center;
      font-family:'Playfair Display',serif; font-size:32px; font-weight:900;
      color:var(--navy);
      border:3px solid rgba(201,162,39,0.5);
      box-shadow:0 4px 20px rgba(201,162,39,0.25);
    }
    .prof-online {
      position:absolute; bottom:4px; right:4px;
      width:14px; height:14px; border-radius:50%;
      background:#27ae60; border:2px solid var(--navy2);
    }
    .prof-hero-meta { padding-bottom:18px; }
    .prof-hero-name {
      font-family:'Playfair Display',serif; font-size:22px; font-weight:900;
      color:var(--text); line-height:1.1; margin-bottom:4px;
    }
    .prof-hero-email { font-size:12.5px; color:var(--muted); }
    .prof-hero-chips { display:flex; gap:8px; margin-top:10px; flex-wrap:wrap; }
    .prof-chip {
      display:inline-flex; align-items:center; gap:5px;
      font-size:10.5px; font-weight:600; padding:4px 11px; border-radius:20px;
    }
    .prof-chip.verified { background:rgba(30,126,74,0.22); color:#7fffb0; border:1px solid rgba(30,126,74,0.3); }
    .prof-chip.resident { background:rgba(201,162,39,0.18); color:var(--gold3); border:1px solid rgba(201,162,39,0.28); }

    .prof-tabs {
      display:flex; gap:0;
      border-top:1px solid rgba(255,255,255,0.07);
      position:relative; z-index:1;
      padding:0 32px;
    }
    .prof-tab {
      padding:13px 18px; font-size:12.5px; font-weight:600;
      cursor:pointer; border:none; background:none;
      color:rgba(255,255,255,0.4);
      border-bottom:2px solid transparent;
      transition:all .18s; margin-bottom:-1px;
    }
    .prof-tab:hover { color:rgba(255,255,255,0.75); }
    .prof-tab.active { color:var(--gold2); border-bottom-color:var(--gold2); }
    .prof-tab-body { padding:24px 28px; }
    .prof-tab-pane { display:none; }
    .prof-tab-pane.active { display:block; animation:fadeUp .3s ease both; }
    .prof-info-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
    .prof-info-card {
      background:var(--bg); border:1px solid #e0d9c8;
      border-radius:12px; padding:16px 18px;
      display:flex; flex-direction:column; gap:4px;
      transition:border-color .15s;
    }
    .prof-info-card:hover { border-color:#c8b98a; }
    .pic-label {
      font-size:9.5px; font-weight:700; letter-spacing:1.5px;
      text-transform:uppercase; color:#a0917a;
    }
    .pic-value { font-size:14px; font-weight:600; color:var(--navy); }
    .pic-edit {
      margin-top:6px; align-self:flex-start;
      font-size:11px; font-weight:600; color:var(--gold);
      background:none; border:none; cursor:pointer; padding:0;
    }
    .pic-edit:hover { text-decoration:underline; }
    .prof-info-card.full { grid-column:1/-1; }
    .prof-status-card {
      background:linear-gradient(120deg,rgba(30,126,74,0.06),rgba(30,126,74,0.02));
      border:1px solid rgba(30,126,74,0.2);
      border-radius:12px; padding:16px 18px;
      display:flex; align-items:center; gap:14px;
      grid-column:1/-1;
    }
    .psc-icon { width:40px; height:40px; border-radius:10px; background:rgba(30,126,74,0.12); display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0; }
    .psc-body { flex:1; }
    .psc-title { font-size:13px; font-weight:700; color:#1a5c38; }
    .psc-sub   { font-size:11.5px; color:#4a8a5a; margin-top:2px; }
    .prof-security-item {
      display:flex; align-items:center; justify-content:space-between;
      padding:16px 18px; background:var(--bg);
      border:1px solid #e0d9c8; border-radius:12px;
      margin-bottom:10px; transition:border-color .15s;
    }
    .prof-security-item:hover { border-color:#c8b98a; }
    .psi-left { display:flex; align-items:center; gap:13px; }
    .psi-ico { width:38px; height:38px; border-radius:9px; background:rgba(201,162,39,0.1); display:flex; align-items:center; justify-content:center; font-size:17px; flex-shrink:0; }
    .psi-title { font-size:13px; font-weight:600; color:var(--navy); }
    .psi-sub   { font-size:11.5px; color:#8a7a5a; margin-top:1px; }
    .prof-activity-item {
      display:flex; gap:12px; padding:12px 0;
      border-bottom:1px solid #f0ebe0;
    }
    .prof-activity-item:last-child { border-bottom:none; }
    .pai-dot { width:28px; height:28px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:12px; flex-shrink:0; margin-top:2px; }
    .pai-dot.gold  { background:rgba(201,162,39,0.12); }
    .pai-dot.green { background:rgba(30,126,74,0.1); }
    .pai-dot.navy  { background:rgba(15,27,45,0.08); }
    .pai-body { flex:1; }
    .pai-body strong { font-size:13px; font-weight:600; color:var(--navy); }
    .pai-body p { font-size:11.5px; color:#8a7a5a; margin-top:2px; }
    .pai-time { font-size:11px; color:#b0a48a; white-space:nowrap; }

    ::-webkit-scrollbar{width:6px;} ::-webkit-scrollbar-thumb{background:#d4c9af;border-radius:99px;}
    .edit-field { margin-bottom: 14px; }
    .edit-field label { display: block; font-size: 11px; font-weight: 600; color: #a0917a; margin-bottom: 5px; letter-spacing: 0.5px; }
    .edit-field input { width: 100%; padding: 10px 12px; border: 1.5px solid #d4c9af; border-radius: 9px; font-family: 'DM Sans', sans-serif; font-size: 13px; background: var(--white); transition: border-color 0.2s; }
    .edit-field input:focus { outline: none; border-color: var(--gold); }
    /* My Document Requests page only */
    #page-my-requests .my-requests-shell { background:#fff; border:1px solid #e9e5dc; border-radius:16px; box-shadow:0 8px 28px rgba(15,27,45,.06); overflow:hidden; }
    #page-my-requests .my-requests-head { display:flex; align-items:center; justify-content:space-between; gap:18px; padding:24px 28px 20px; border-bottom:1px solid #eeeae2; }
    #page-my-requests .my-requests-title { display:flex; align-items:center; gap:13px; }
    #page-my-requests .my-requests-title-icon { width:43px; height:43px; flex:0 0 43px; display:grid; place-items:center; border-radius:50%; color:#84650d; background:rgba(201,162,39,.13); }
    #page-my-requests .my-requests-title-icon svg { width:22px; height:22px; fill:none; stroke:currentColor; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; }
    #page-my-requests .my-requests-head .ph-title { font-size:19px; }
    #page-my-requests .my-requests-head .ph-sub { font-size:12px; margin-top:5px; }
    #page-my-requests .my-requests-refresh, #page-my-requests .my-requests-clear, #page-my-requests .my-requests-empty-action { height:41px; padding:0 14px; border-radius:9px; background:#fff; font:600 12px 'DM Sans',sans-serif; cursor:pointer; white-space:nowrap; transition:all .16s; }
    #page-my-requests .my-requests-refresh, #page-my-requests .my-requests-empty-action { color:#80610b; border:1px solid rgba(201,162,39,.55); }
    #page-my-requests .my-requests-refresh:hover, #page-my-requests .my-requests-empty-action:hover { background:#fff9e9; border-color:var(--gold); }
    #page-my-requests .my-requests-toolbar { display:grid; grid-template-columns:minmax(240px,1fr) minmax(170px,220px) minmax(140px,170px) auto; gap:10px; padding:19px 26px; }
    #page-my-requests .my-requests-search { position:relative; }
    #page-my-requests .my-requests-search svg { position:absolute; left:13px; top:50%; transform:translateY(-50%); width:17px; height:17px; stroke:#8a9bb5; pointer-events:none; }
    #page-my-requests .my-requests-search input, #page-my-requests .my-requests-toolbar select { width:100%; height:41px; border:1px solid #e1ddd4; border-radius:9px; padding:0 12px; background:#fff; color:#263449; font:400 12px 'DM Sans',sans-serif; outline:none; }
    #page-my-requests .my-requests-search input { padding-left:40px; }
    #page-my-requests .my-requests-search input:focus, #page-my-requests .my-requests-toolbar select:focus { border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,162,39,.1); }
    #page-my-requests .my-requests-clear { display:inline-flex; align-items:center; gap:6px; color:#b0443b; background:#fff6f5; border:1px solid rgba(192,57,43,.3); }
    #page-my-requests .my-requests-clear:hover { background:#fde9e6; border-color:#c0392b; }
    #page-my-requests .my-requests-clear svg { width:14px; height:14px; fill:none; stroke:currentColor; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; }
    #page-my-requests .my-requests-table-wrap { overflow-x:auto; }
    #page-my-requests .my-requests-table { width:100%; min-width:900px; border-collapse:collapse; }
    #page-my-requests .my-requests-table thead th { padding:12px 17px; background:#faf9f6; border-top:1px solid #f0ede7; border-bottom:1px solid #ece8e0; color:#8b8170; font-size:10px; letter-spacing:.8px; text-transform:uppercase; text-align:left; }
    #page-my-requests .my-requests-table tbody td { padding:14px 17px; border-bottom:1px solid #f0ede8; vertical-align:middle; font-size:12.5px; }
    #page-my-requests .my-requests-table tbody tr:last-child td { border-bottom:0; }
    #page-my-requests .my-requests-table tbody tr:hover td { background:#fdfcf9; }
    #page-my-requests .my-request-number { color:#1d2b40; font:700 13px 'Playfair Display',serif; white-space:nowrap; }
    #page-my-requests .my-request-type { display:inline-flex; align-items:center; gap:6px; padding:5px 8px; border:1px solid #dbeaf7; border-radius:6px; background:#edf5fc; color:#315b85; font-size:10.5px; font-weight:600; }
    #page-my-requests .my-request-type svg { width:13px; height:13px; fill:none; stroke:currentColor; stroke-width:1.7; stroke-linecap:round; stroke-linejoin:round; }
    #page-my-requests .my-request-purpose { display:block; min-width:140px; max-width:280px; color:#646c78; font-size:11.5px; line-height:1.45; overflow-wrap:anywhere; }
    #page-my-requests .my-request-date { display:flex; align-items:flex-start; gap:6px; color:#596474; white-space:nowrap; font-size:11.5px; }
    #page-my-requests .my-request-date svg { width:14px; height:14px; flex:0 0 14px; fill:none; stroke:#a58a43; stroke-width:1.7; stroke-linecap:round; stroke-linejoin:round; }
    #page-my-requests .my-request-time { display:block; margin-top:3px; color:#92908a; font-size:10px; }
    #page-my-requests .my-request-status { display:inline-flex; align-items:center; gap:6px; padding:5px 9px; border:1px solid; border-radius:99px; font-size:10.5px; font-weight:700; text-transform:capitalize; white-space:nowrap; }
    #page-my-requests .my-request-status::before { content:''; width:6px; height:6px; border-radius:50%; background:currentColor; }
    #page-my-requests .my-request-status.pending { color:#80610b; background:#fff7df; border-color:#f0dfaa; }
    #page-my-requests .my-request-status.approved { color:#26734c; background:#edf8f1; border-color:#cbe8d5; }
    #page-my-requests .my-request-status.rejected { color:#b8443c; background:#fff3f1; border-color:#f0d0cc; }
    #page-my-requests .my-request-status.ready { color:#315b85; background:#edf5fc; border-color:#dbeaf7; }
    #page-my-requests .my-request-view { height:32px; padding:0 11px; display:inline-flex; align-items:center; gap:6px; border:1px solid rgba(201,162,39,.55); border-radius:8px; background:#fff; color:#80610b; font:600 11px 'DM Sans',sans-serif; cursor:pointer; transition:all .15s; white-space:nowrap; }
    #page-my-requests .my-request-view:hover { background:#fff9e9; border-color:var(--gold); }
    #page-my-requests .my-request-view svg { width:14px; height:14px; fill:none; stroke:currentColor; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; }
    #page-my-requests .my-requests-footer { display:flex; align-items:center; justify-content:space-between; gap:14px; padding:15px 24px; border-top:1px solid #eeeae2; color:#898273; font-size:11.5px; }
    #page-my-requests .my-requests-pagination { display:flex; align-items:center; gap:5px; }
    #page-my-requests .my-requests-pagination button { min-width:30px; height:30px; padding:0 8px; border:1px solid #e5e0d6; border-radius:7px; background:#fff; color:#596273; font:600 11px 'DM Sans',sans-serif; cursor:pointer; }
    #page-my-requests .my-requests-pagination button:hover:not(:disabled) { border-color:var(--gold); }
    #page-my-requests .my-requests-pagination button.current { background:var(--gold); border-color:var(--gold); color:#fff; }
    #page-my-requests .my-requests-pagination button:disabled { opacity:.42; cursor:default; }
    #page-my-requests .my-requests-pagination svg { width:14px; height:14px; fill:none; stroke:currentColor; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; vertical-align:middle; }
    #page-my-requests .my-requests-no-match, #page-my-requests .my-requests-empty { padding:48px 20px; text-align:center; color:#4b5668; font-size:13px; }
    #page-my-requests .my-requests-no-match { display:none; }
    #page-my-requests .my-requests-no-match span { display:block; margin-top:5px; color:#92908a; font-size:12px; }
    #page-my-requests .my-requests-empty { padding:58px 20px; }
    #page-my-requests .my-requests-empty svg { width:58px; height:58px; margin-bottom:13px; color:var(--gold); }
    #page-my-requests .my-requests-empty h3 { color:#273449; font:700 17px 'Playfair Display',serif; margin-bottom:5px; }
    #page-my-requests .my-requests-empty p { color:#92908a; font-size:12px; margin-bottom:16px; }
    @media (max-width: 900px) {
      #page-my-requests .my-requests-head { padding:21px 20px 18px; }
      #page-my-requests .my-requests-toolbar { grid-template-columns:minmax(180px,1fr) 1fr; padding:16px 20px; }
      #page-my-requests .my-requests-clear { justify-self:start; }
    }
    @media (max-width: 600px) {
      #page-my-requests .my-requests-head { align-items:flex-start; flex-direction:column; }
      #page-my-requests .my-requests-head .my-requests-refresh { align-self:flex-end; margin-top:-4px; }
      #page-my-requests .my-requests-toolbar { grid-template-columns:1fr; gap:9px; padding:14px; }
      #page-my-requests .my-requests-search { grid-column:1; }
      #page-my-requests .my-requests-toolbar select { min-width:0; }
      #page-my-requests .my-requests-footer { padding:13px 14px; align-items:flex-start; flex-direction:column; }
    }

    /* My Appointments page styles are intentionally scoped to this page. */
    #page-my-appointments .appointments-shell { background:#fff; border:1px solid #e9e5dc; border-radius:16px; box-shadow:0 8px 28px rgba(15,27,45,.06); overflow:hidden; }
    #page-my-appointments .appointments-head { display:flex; align-items:center; justify-content:space-between; gap:18px; padding:24px 28px 20px; border-bottom:1px solid #eeeae2; }
    #page-my-appointments .appointments-heading { display:flex; align-items:center; gap:13px; min-width:0; }
    #page-my-appointments .appointments-title-icon { width:43px; height:43px; flex:0 0 43px; display:grid; place-items:center; border-radius:50%; color:#84650d; background:rgba(201,162,39,.13); }
    #page-my-appointments .appointments-title-icon svg { width:22px; height:22px; fill:none; stroke:currentColor; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; }
    #page-my-appointments .appointments-head .ph-title { font-size:19px; }
    #page-my-appointments .appointments-head .ph-sub { font-size:12px; margin-top:5px; }
    #page-my-appointments .appointments-refresh, #page-my-appointments .appointments-clear, #page-my-appointments .appointments-empty-action { height:41px; padding:0 14px; border-radius:9px; background:#fff; font:600 12px 'DM Sans',sans-serif; cursor:pointer; white-space:nowrap; transition:all .16s; }
    #page-my-appointments .appointments-refresh, #page-my-appointments .appointments-empty-action { color:#80610b; border:1px solid rgba(201,162,39,.55); }
    #page-my-appointments .appointments-refresh:hover, #page-my-appointments .appointments-empty-action:hover { background:#fff9e9; border-color:var(--gold); }
    #page-my-appointments .appointments-refresh svg, #page-my-appointments .appointments-clear svg, #page-my-appointments .appointments-empty svg, #page-my-appointments .appointment-date svg, #page-my-appointments .appointment-view svg, #page-my-appointments .appointments-pagination svg { fill:none; stroke:currentColor; stroke-linecap:round; stroke-linejoin:round; }
    #page-my-appointments .appointments-refresh svg { width:14px; height:14px; stroke-width:2; vertical-align:-2px; margin-right:5px; }
    #page-my-appointments .appointments-toolbar { display:grid; grid-template-columns:minmax(240px,1fr) minmax(160px,210px) auto; gap:10px; padding:19px 26px; }
    #page-my-appointments .appointments-search { position:relative; }
    #page-my-appointments .appointments-search svg { position:absolute; left:13px; top:50%; transform:translateY(-50%); width:17px; height:17px; stroke:#8a9bb5; stroke-width:2; pointer-events:none; }
    #page-my-appointments .appointments-search input, #page-my-appointments .appointments-toolbar select { width:100%; height:41px; border:1px solid #e1ddd4; border-radius:9px; padding:0 12px; background:#fff; color:#263449; font:400 12px 'DM Sans',sans-serif; outline:none; }
    #page-my-appointments .appointments-search input { padding-left:40px; }
    #page-my-appointments .appointments-search input:focus, #page-my-appointments .appointments-toolbar select:focus { border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,162,39,.1); }
    #page-my-appointments .appointments-clear { display:inline-flex; align-items:center; justify-content:center; gap:6px; color:#b0443b; background:#fff6f5; border:1px solid rgba(192,57,43,.3); }
    #page-my-appointments .appointments-clear:hover { background:#fde9e6; border-color:#c0392b; }
    #page-my-appointments .appointments-clear svg { width:14px; height:14px; stroke-width:1.8; }
    #page-my-appointments .appointments-table-wrap { overflow-x:auto; }
    #page-my-appointments .appointments-table { width:100%; min-width:820px; border-collapse:collapse; }
    #page-my-appointments .appointments-table thead th { padding:12px 17px; background:#faf9f6; border-top:1px solid #f0ede7; border-bottom:1px solid #ece8e0; color:#8b8170; font-size:10px; letter-spacing:.8px; text-transform:uppercase; text-align:left; }
    #page-my-appointments .appointments-table tbody td { padding:14px 17px; border-bottom:1px solid #f0ede8; vertical-align:middle; font-size:12.5px; }
    #page-my-appointments .appointments-table tbody tr:last-child td { border-bottom:0; }
    #page-my-appointments .appointments-table tbody tr:hover td { background:#fdfcf9; }
    #page-my-appointments .appointment-date { display:flex; align-items:flex-start; gap:8px; min-width:145px; color:#263449; font-weight:700; }
    #page-my-appointments .appointment-date svg { width:16px; height:16px; flex:0 0 16px; margin-top:1px; stroke:#a58a43; stroke-width:1.7; }
    #page-my-appointments .appointment-date time { display:block; white-space:nowrap; }
    #page-my-appointments .appointment-date small { display:block; margin-top:4px; color:#8a7a5a; font-size:11px; font-weight:400; }
    #page-my-appointments .appointment-purpose { display:inline-flex; padding:6px 9px; border:1px solid #dbeaf7; border-radius:6px; background:#edf5fc; color:#315b85; font-size:10.5px; font-weight:600; }
    #page-my-appointments .appointment-description { display:block; min-width:150px; max-width:300px; color:#646c78; font-size:11.5px; line-height:1.5; overflow-wrap:anywhere; white-space:normal; }
    #page-my-appointments .appointment-status { display:inline-flex; align-items:center; gap:6px; padding:5px 9px; border:1px solid #e5dfd0; border-radius:99px; background:#f7f5f0; color:#62605a; font-size:10.5px; font-weight:700; text-transform:capitalize; white-space:nowrap; }
    #page-my-appointments .appointment-status::before { content:''; width:6px; height:6px; border-radius:50%; background:currentColor; }
    #page-my-appointments .appointment-status.pending { color:#80610b; background:#fff7df; border-color:#f0dfaa; }
    #page-my-appointments .appointment-status.confirmed, #page-my-appointments .appointment-status.approved { color:#26734c; background:#edf8f1; border-color:#cbe8d5; }
    #page-my-appointments .appointment-status.rejected, #page-my-appointments .appointment-status.cancelled { color:#b8443c; background:#fff3f1; border-color:#f0d0cc; }
    #page-my-appointments .appointment-status.review { color:#315b85; background:#edf5fc; border-color:#dbeaf7; }
    #page-my-appointments .appointment-view { height:33px; padding:0 11px; display:inline-flex; align-items:center; gap:6px; border:1px solid rgba(201,162,39,.55); border-radius:8px; background:#fff; color:#80610b; font:600 11px 'DM Sans',sans-serif; cursor:pointer; transition:all .15s; white-space:nowrap; }
    #page-my-appointments .appointment-view:hover { background:#fff9e9; border-color:var(--gold); }
    #page-my-appointments .appointment-view svg { width:14px; height:14px; stroke-width:1.8; }
    #page-my-appointments .appointments-footer { display:flex; align-items:center; justify-content:space-between; gap:14px; padding:15px 24px; border-top:1px solid #eeeae2; color:#898273; font-size:11.5px; }
    #page-my-appointments .appointments-pagination { display:flex; align-items:center; gap:5px; }
    #page-my-appointments .appointments-pagination button { min-width:30px; height:30px; padding:0 8px; border:1px solid #e5e0d6; border-radius:7px; background:#fff; color:#596273; font:600 11px 'DM Sans',sans-serif; cursor:pointer; }
    #page-my-appointments .appointments-pagination button:hover:not(:disabled) { border-color:var(--gold); }
    #page-my-appointments .appointments-pagination button.current { background:var(--gold); border-color:var(--gold); color:#fff; }
    #page-my-appointments .appointments-pagination button:disabled { opacity:.42; cursor:default; }
    #page-my-appointments .appointments-pagination svg { width:14px; height:14px; stroke-width:2; vertical-align:middle; }
    #page-my-appointments .appointments-no-match, #page-my-appointments .appointments-empty { padding:48px 20px; text-align:center; color:#4b5668; font-size:13px; }
    #page-my-appointments .appointments-no-match { display:none; }
    #page-my-appointments .appointments-no-match span { display:block; margin-top:5px; color:#92908a; font-size:12px; }
    #page-my-appointments .appointments-empty { padding:58px 20px; }
    #page-my-appointments .appointments-empty svg { width:58px; height:58px; margin-bottom:13px; color:var(--gold); stroke-width:2; }
    #page-my-appointments .appointments-empty h3 { color:#273449; font:700 17px 'Playfair Display',serif; margin-bottom:5px; }
    #page-my-appointments .appointments-empty p { color:#92908a; font-size:12px; margin-bottom:16px; }
    #page-my-appointments .appointments-empty-action svg { width:14px; height:14px; stroke-width:1.8; vertical-align:-3px; margin-right:5px; }
    #page-my-appointments .appointments-table-wrap.no-results .appointments-table { display:none; }
    #page-my-appointments .appointments-table-wrap.no-results .appointments-no-match { display:block; }
    @media (max-width: 900px) {
      #page-my-appointments .appointments-head { padding:21px 20px 18px; }
      #page-my-appointments .appointments-toolbar { grid-template-columns:minmax(180px,1fr) minmax(150px,1fr); padding:16px 20px; }
      #page-my-appointments .appointments-clear { justify-self:start; }
    }
    @media (max-width: 600px) {
      #page-my-appointments .appointments-head { align-items:flex-start; flex-direction:column; }
      #page-my-appointments .appointments-head .appointments-refresh { align-self:flex-end; margin-top:-4px; }
      #page-my-appointments .appointments-toolbar { grid-template-columns:1fr; gap:9px; padding:14px; }
      #page-my-appointments .appointments-footer { padding:13px 14px; align-items:flex-start; flex-direction:column; }
    }
  </style>
</head>
<body>

<aside class="sidebar">
  <div class="sb-logo">
    <div class="sb-mark">B</div>
    <div>
      <div class="sb-words">BUHU<span>AN</span></div>
      <span class="sb-sub">Resident Portal</span>
    </div>
  </div>
  <div class="nav-grp">
    <div class="nav-grp-lbl">Main</div>
    <a class="nav-lnk active" onclick="showPage('dashboard',this)"><div class="nav-ico"><svg viewBox="0 0 24 24" aria-hidden="true"><path fill="#f4c95d" d="M3.5 10.4 12 3.5l8.5 6.9v9.1a1.5 1.5 0 0 1-1.5 1.5H5a1.5 1.5 0 0 1-1.5-1.5z"/><path fill="#e97857" d="m2 10 10-8 10 8-1.4 1.7L12 4.9l-8.6 6.8z"/><path fill="#fff8e8" d="M9.5 14h5v7h-5z"/><path fill="#75b9e7" d="M5.5 12.5h2.8v3H5.5zM15.7 12.5h2.8v3h-2.8z"/></svg></div> Home</a>
    <a class="nav-lnk" onclick="showPage('profile',this)"><div class="nav-ico"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="7.5" r="4.1" fill="#c9a3ff"/><path d="M4.1 20.5a7.9 7.9 0 0 1 15.8 0" fill="#9b6be0"/><path d="M4.1 20.5a7.9 7.9 0 0 1 15.8 0" fill="none" stroke="#d9c1ff" stroke-width="1.2"/></svg></div> My Profile</a>
  </div>
  <div class="nav-grp">
    <div class="nav-grp-lbl">Barangay Services</div>
    <a class="nav-lnk" onclick="showPage('request-doc',this)"><div class="nav-ico"><svg viewBox="0 0 24 24" aria-hidden="true"><path fill="#77b8e5" d="M5 2.5h9l5 5v13A1.5 1.5 0 0 1 17.5 22h-12A1.5 1.5 0 0 1 4 20.5V4a1.5 1.5 0 0 1 1-1.5z"/><path fill="#b9def4" d="M14 2.5v5h5z"/><path d="M7.5 12h8M7.5 15.5h8M7.5 19h5" fill="none" stroke="#315b85" stroke-width="1.4" stroke-linecap="round"/></svg></div> Request Document</a>
    <a class="nav-lnk" onclick="showPage('my-requests',this)"><div class="nav-ico"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="5" y="4.5" width="14" height="18" rx="2" fill="#82d5c6"/><rect x="8" y="2.5" width="8" height="4" rx="1.5" fill="#f4c95d"/><path d="M8.5 11h2M12.5 11h3M8.5 15h2M12.5 15h3M8.5 19h2M12.5 19h3" fill="none" stroke="#287d77" stroke-width="1.4" stroke-linecap="round"/></svg></div> My Document Requests<span class="nav-cnt" id="req-cnt">0</span></a>
    <a class="nav-lnk" onclick="showPage('schedule',this)"><div class="nav-ico"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="17" rx="2.5" fill="#edf5fc"/><path d="M3 8a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v3H3z" fill="#e97857"/><path d="M8 3v4M16 3v4" fill="none" stroke="#f4c95d" stroke-width="2" stroke-linecap="round"/><circle cx="8" cy="15" r="1.3" fill="#75b9e7"/><circle cx="12" cy="15" r="1.3" fill="#75b9e7"/><circle cx="16" cy="15" r="1.3" fill="#75b9e7"/><circle cx="8" cy="19" r="1.3" fill="#75b9e7"/><circle cx="12" cy="19" r="1.3" fill="#75b9e7"/></svg></div> Schedule Appointment</a>
    <a class="nav-lnk" onclick="showPage('my-appointments',this)"><div class="nav-ico"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="17" rx="2.5" fill="#c5e6f7"/><path d="M3 8a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v3H3z" fill="#78bce4"/><path d="M8 3v4M16 3v4" fill="none" stroke="#315b85" stroke-width="2" stroke-linecap="round"/><circle cx="8" cy="15" r="1.3" fill="#fff"/><circle cx="12" cy="15" r="1.3" fill="#fff"/><circle cx="16" cy="15" r="1.3" fill="#fff"/><path d="m7.5 19 1.5 1.5 3-3" fill="none" stroke="#338b63" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></div> My Appointments</a>
  </div>
  <div class="nav-grp">
    <div class="nav-grp-lbl">Account</div>
    <a class="nav-lnk" onclick="showPage('notifications',this)"><div class="nav-ico"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 9a6 6 0 0 0-12 0c0 6.5-2.5 7-3 9h18c-.5-2-3-2.5-3-9" fill="#ffd34f" stroke="#e8ac24" stroke-width="1.4" stroke-linejoin="round"/><path d="M10 21h4" fill="none" stroke="#e8ac24" stroke-width="1.7" stroke-linecap="round"/><circle cx="12" cy="4" r="1.2" fill="#fff0a8"/></svg></div> Notifications<span class="nav-cnt" id="notif-cnt">{{ $notificationsCount ?? 0 }}</span></a>
  </div>
  <div class="sb-foot">
    <div class="sb-user-card">
      <div style="display: flex; align-items: center; gap: 10px;">
        <div class="sb-ava" id="sidebar-avatar">{{ strtoupper(substr(auth()->user()->first_name ?? 'R', 0, 1)) }}</div>
        <div class="sb-uinfo">
          <div class="sb-uname" id="sidebar-name">{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }}</div>
          <div class="sb-urole">Verified Resident</div>
        </div>
      </div>
      <form method="POST" action="{{ route('logout') }}" style="margin: 0;">@csrf<button type="submit" class="logout-icon" title="Log out" aria-label="Log out"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2v10M6.2 5.8a8 8 0 1 0 11.6 0"/></svg></button></form>
    </div>
  </div>
</aside>

<div class="main">
  <div class="topbar">
    <div class="tb-info"><div class="tb-title" id="page-title">Home</div><div class="tb-sub">BUHUAN &middot; Barangay Buhuan &middot; Resident Portal</div></div>
    <div class="tb-right"><div class="chip" id="dchip">—</div></div>
  </div>
  <div class="content">

    <div class="page active" id="page-dashboard">
      <div class="welcome-banner">
        <div class="wb-text"><h2>Good day, <span>{{ auth()->user()->first_name ?? 'Resident' }}!</span> 👋</h2><p>Welcome to the BUHUAN Resident Portal &middot; Barangay Buhuan<br>Request documents or schedule an appointment below.</p></div>
        <div class="wb-actions"><button class="btn-banner-primary" onclick="showPage('request-doc',document.querySelector('[onclick*=request-doc]'))">+ Request Document</button><button class="btn-banner-outline" onclick="showPage('schedule',document.querySelector('[onclick*=schedule]'))">Schedule Appointment</button></div>
      </div>
      <div class="stats">
        <div class="scard c1" onclick="showPage('my-requests',document.querySelector('[onclick*=my-requests]'))"><div class="stag warn">Active</div><div class="sico c1">📄</div><div class="sval">{{ $activeRequests ?? 0 }}</div><div class="slbl">Active Document Requests</div></div>
        <div class="scard c2" onclick="showPage('my-requests',document.querySelector('[onclick*=my-requests]'))"><div class="stag ok">Done</div><div class="sico c2">✅</div><div class="sval">{{ $completedRequests ?? 0 }}</div><div class="slbl">Completed Requests</div></div>
        <div class="scard c3" onclick="showPage('my-appointments',document.querySelector('[onclick*=my-appointments]'))"><div class="stag info">Upcoming</div><div class="sico c3">📅</div><div class="sval">{{ $upcomingAppointments ?? 0 }}</div><div class="slbl">Upcoming Appointment</div></div>
      </div>
      <div class="row2">
        <div class="panel-half"><div class="ph"><div><div class="ph-title">Recent Document Requests</div><div class="ph-sub">Track the status of your latest submissions</div></div><button class="ph-btn" onclick="showPage('my-requests',document.querySelector('[onclick*=my-requests]'))">View all →</button></div><div class="tw"><table><thead><tr><th>Request #</th><th>Document</th><th>Date Filed</th><th>Status</th></tr></thead><tbody>@forelse($recentRequests ?? [] as $req)<tr><td style="font-family:'Playfair Display',serif;font-weight:700;color:var(--navy);">#{{ str_pad($req->id,4,'0',STR_PAD_LEFT) }}</td><td>{{ $req->document_type }}</td><td style="font-size:12px;color:#8a7a5a;">{{ $req->created_at->format('M d, Y') }}</td><td><span class="badge {{ $req->status }}">{{ ucfirst($req->status) }}</span></td></tr>@empty<tr><td colspan="4" class="empty-state">No requests yet.</td></tr>@endforelse</tbody></table></div></div>
        <div class="panel-half"><div class="ph"><div><div class="ph-title">Upcoming Appointments</div><div class="ph-sub">Your next scheduled meetings</div></div><button class="ph-btn" onclick="showPage('my-appointments',document.querySelector('[onclick*=my-appointments]'))">View all →</button></div><div class="appt-list">@forelse($upcomingApptList ?? [] as $appt)<div class="appt-item"><div class="appt-date"><div class="day">{{ \Carbon\Carbon::parse($appt->scheduled_at)->format('d') }}</div><div class="mon">{{ \Carbon\Carbon::parse($appt->scheduled_at)->format('M') }}</div></div><div class="appt-info"><h4>{{ $appt->purpose }}</h4><p>Barangay Hall &middot; {{ \Carbon\Carbon::parse($appt->scheduled_at)->format('h:i A') }}</p></div><span class="badge {{ $appt->status }}" style="font-size:10px;padding:2px 8px;">{{ ucfirst($appt->status) }}</span></div>@empty<div class="empty-state">No upcoming appointments.</div>@endforelse</div></div>
      </div>
    </div>

    <div class="page" id="page-request-doc">
      <div class="panel">
        <div class="ph"><div><div class="ph-title">Request Official Document</div><div class="ph-sub">Select a document type and provide the purpose of your request</div></div></div>
        <div class="doc-req-layout">
          <div class="doc-type-list">
            <div class="doc-type-item" onclick="pickDoc('Barangay Clearance', this)">
              <div class="dti-radio"></div><div class="dti-icon">📜</div>
              <div class="dti-info"><h4>Barangay Clearance</h4><p>For employment, ID, or legal needs</p></div>
            </div>
            <div class="doc-type-item" onclick="pickDoc('Certificate of Indigency', this)">
              <div class="dti-radio"></div><div class="dti-icon">🤝</div>
              <div class="dti-info"><h4>Certificate of Indigency</h4><p>For financial or medical assistance</p></div>
            </div>
            <div class="doc-type-item" onclick="pickDoc('Certificate of Residency', this)">
              <div class="dti-radio"></div><div class="dti-icon">🏠</div>
              <div class="dti-info"><h4>Certificate of Residency</h4><p>Proof of address for various applications</p></div>
            </div>
            <div class="doc-type-item" onclick="pickDoc('Barangay Identification', this)">
              <div class="dti-radio"></div><div class="dti-icon">🪪</div>
              <div class="dti-info"><h4>Barangay Identification</h4><p>Local ID for residents of Buhuan</p></div>
            </div>
          </div>
          <div class="doc-form-col">
            <div class="doc-req-info-note">ℹ️ Please ensure your profile is up to date before requesting. Documents will be based on your registered information.</div>
            <div class="sel-doc-echo empty" id="sel-doc-echo"><div class="sde-icon">📄</div><div><div class="sde-name">No document selected</div><div class="sde-sub">Please pick one from the left</div></div></div>
            <div class="field-grp"><label>Purpose of Request</label><select id="doc-purpose-sel"><option value="">-- Select Purpose --</option><option value="Employment">Employment</option><option value="Financial Assistance">Financial Assistance</option><option value="Scholarship">Scholarship</option><option value="ID Application">ID Application</option><option value="Business Permit">Business Permit</option><option value="Other">Other (Specify in notes)</option></select></div>
            <div class="field-grp"><label>Additional Notes</label><textarea id="doc-notes" placeholder="Any specific instructions or details..."></textarea></div>
            <button class="submit-btn" onclick="submitDocRequest()"> Submit Request</button>
          </div>
        </div>
      </div>
    </div>

    <div class="page" id="page-my-requests">
      <div class="my-requests-shell">
        <div class="my-requests-head">
          <div class="my-requests-title">
            <div class="my-requests-title-icon"><svg viewBox="0 0 24 24"><path d="M8 4H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-2"/><rect x="8" y="2" width="8" height="4" rx="1"/><path d="m8 13 2 2 5-5M8 18h8"/></svg></div>
            <div><div class="ph-title">My Document Requests</div><div class="ph-sub">Track the status and history of your requested documents</div></div>
          </div>
          <button type="button" class="my-requests-refresh" onclick="window.location.reload()"><svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:-2px;margin-right:5px"><path d="M20 7v5h-5M4 17v-5h5"/><path d="M5.6 9A7 7 0 0 1 18 6l2 6M4 12l2 6a7 7 0 0 0 12.4-3"/></svg>Refresh</button>
        </div>
        @if($myRequests->isEmpty())
          <div class="my-requests-empty"><svg viewBox="0 0 64 64" fill="none" aria-hidden="true"><path d="M18 7h19l12 12v35a4 4 0 0 1-4 4H18a4 4 0 0 1-4-4V11a4 4 0 0 1 4-4Z" stroke="currentColor" stroke-width="2.5"/><path d="M37 8v12h12M22 31h20M22 38h15" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><circle cx="44" cy="47" r="9" fill="#fff7df" stroke="currentColor" stroke-width="2.5"/><path d="M44 42v6M44 52h.01" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg><h3>No document requests</h3><p>You haven't submitted any document requests yet.</p><button type="button" class="my-requests-empty-action" onclick="showPage('request-doc', document.querySelector('[onclick*=request-doc]'))">Request a Document</button></div>
        @else
          <div class="my-requests-toolbar">
            <label class="my-requests-search"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m16 16 4 4"/></svg><input type="search" id="my-requests-search" placeholder="Search document type, purpose, or request number..." aria-label="Search your document requests"></label>
            <select id="my-requests-type-filter" aria-label="Filter by document type">
              <option value="">All Document Types</option>
              <option value="Barangay Clearance">Barangay Clearance</option>
              <option value="Certificate of Indigency">Certificate of Indigency</option>
              <option value="Certificate of Residency">Certificate of Residency</option>
              <option value="Barangay Identification">Barangay Identification</option>
            </select>
            <select id="my-requests-status-filter" aria-label="Filter by request status"><option value="">All Status</option><option value="pending">Pending</option><option value="approved">Approved</option><option value="rejected">Rejected</option><option value="ready">Ready</option></select>
            <button type="button" class="my-requests-clear" id="my-requests-clear"><svg viewBox="0 0 24 24"><path d="M4 5h16l-6 7v6l-4 2v-8z"/><path d="m17 17 4 4m0-4-4 4"/></svg>Clear Filters</button>
          </div>
          <div class="my-requests-table-wrap">
            <table class="my-requests-table"><thead><tr><th>Request #</th><th>Document Type</th><th>Purpose</th><th>Date Filed</th><th>Status</th><th>Action</th></tr></thead>
              <tbody id="my-requests-table-body">
                @foreach($myRequests as $req)
                  @php($requestNumber = '#' . str_pad($req->id, 4, '0', STR_PAD_LEFT))
                  <tr class="my-document-request-row" data-document-type="{{ $req->document_type }}" data-status="{{ $req->status }}" data-search="{{ $requestNumber }} {{ $req->document_type }} {{ $req->purpose }}">
                    <td><span class="my-request-number">{{ $requestNumber }}</span></td>
                    <td><span class="my-request-type"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h6"/></svg>{{ $req->document_type }}</span></td>
                    <td><span class="my-request-purpose">{{ $req->purpose }}</span></td>
                    <td><div class="my-request-date"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg><span>{{ $req->created_at->format('M d, Y') }}<span class="my-request-time">{{ $req->created_at->format('g:i A') }}</span></span></div></td>
                    <td><span class="my-request-status {{ $req->status }}">{{ ucfirst($req->status) }}</span></td>
                    <td><button type="button" class="my-request-view" onclick="openDocModal({num:'{{ $requestNumber }}', type:'{{ $req->document_type }}', date:'{{ $req->created_at->format('M d, Y') }}', purpose:'{{ $req->purpose }}', status:'{{ ucfirst($req->status) }}', notes:'{{ addslashes($req->notes ?? 'None') }}'})"><svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>View</button></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="my-requests-no-match" id="my-requests-no-match">No matching requests found.<span>Try adjusting your search or filters.</span></div>
          </div>
          <div class="my-requests-footer"><span id="my-requests-count"></span><div class="my-requests-pagination" id="my-requests-pagination" aria-label="Your document request pages"></div></div>
        @endif
      </div>
    </div>

    <div class="page" id="page-schedule">
      <div class="panel">
        <div class="ph"><div><div class="ph-title">Schedule an Appointment</div><div class="ph-sub">Book a meeting with the barangay office for concerns or consultations</div></div></div>
        <div class="sched-layout" style="padding:22px;">
          <div class="cal-panel">
            <div class="cal-head"><div class="cal-head-title" id="user-cal-label">Month Year</div><div class="cal-nav-btns"><button onclick="userCalNav(-1)">‹</button><button onclick="userCalNav(1)">›</button></div></div>
            <div class="cal-grid-wrap"><div class="cal-dow"><span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span></div><div class="cal-days" id="user-cal-days"></div></div>
          </div>
          <div class="slot-picker">
            <div class="slot-picker-head"><div class="slot-picker-title" id="spick-date-label">Select a date first</div><div class="slot-picker-sub" id="spick-date-sub">Available time slots will appear here</div></div>
            <div class="slot-picker-body">
              <div class="slots-available" id="user-slots-list"><div class="no-date-msg">← Select an available date from the calendar</div></div>
              <div id="appt-form-fields" style="display:none; animation:fadeUp .3s ease both;">
                <div class="slot-info-note">You are booking for: <strong id="appt-summary-date">...</strong> at <strong id="appt-summary-time">...</strong></div>
                <div class="spick-field"><label>Purpose of Appointment</label><select id="appt-purpose"><option value="">-- Select Purpose --</option><option value="Concern/Complaint">Concern/Complaint</option><option value="Legal Consultation">Legal Consultation</option><option value="Barangay Agenda">Barangay Agenda</option><option value="Personal Meeting">Personal Meeting</option><option value="Other">Other</option></select></div>
                <div class="spick-field"><label>Short Description/Notes</label><textarea id="appt-notes" placeholder="Briefly describe the reason for your visit..."></textarea></div>
                <button class="submit-btn" onclick="submitAppointment()">Confirm Appointment</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="page" id="page-my-appointments">
      <div class="appointments-shell">
        <div class="appointments-head">
          <div class="appointments-heading">
            <div class="appointments-title-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18M8 14h.01M12 14h.01M16 14h.01M8 17h.01M12 17h.01"/></svg></div>
            <div><div class="ph-title">My Appointments</div><div class="ph-sub">View and manage your scheduled meetings with the barangay</div></div>
          </div>
          <button type="button" class="appointments-refresh" onclick="window.location.reload()"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 7v5h-5M4 17v-5h5"/><path d="M5.6 9A7 7 0 0 1 18 6l2 6M4 12l2 6a7 7 0 0 0 12.4-3"/></svg>Refresh</button>
        </div>
        @if($myAppointments->isEmpty())
          <div class="appointments-empty">
            <svg viewBox="0 0 64 64" aria-hidden="true"><rect x="10" y="12" width="44" height="42" rx="5"/><path d="M42 8v9M22 8v9M10 23h44M21 33h7M36 33h7M21 42h7"/></svg>
            <h3>No appointments yet</h3>
            <p>You haven't scheduled any appointments with the barangay.</p>
            <button type="button" class="appointments-empty-action" onclick="showPage('schedule', document.querySelector('[onclick*=schedule]'))"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>Schedule an Appointment</button>
          </div>
        @else
          <div class="appointments-toolbar">
            <label class="appointments-search"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m16 16 4 4"/></svg><input type="search" id="resident-appointments-search" placeholder="Search purpose, description, or date..." aria-label="Search your appointments"></label>
            <select id="resident-appointments-status" aria-label="Filter appointments by status">
              <option value="">All Status</option>
              @foreach($myAppointments->pluck('status')->filter()->unique()->sort() as $appointmentStatus)
                <option value="{{ strtolower($appointmentStatus) }}">{{ ucfirst($appointmentStatus) }}</option>
              @endforeach
            </select>
            <button type="button" class="appointments-clear" id="resident-appointments-clear"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h16l-6 7v6l-4 2v-8zM17 17l4 4m0-4-4 4"/></svg>Clear Filters</button>
          </div>
          <div class="appointments-table-wrap" id="resident-appointments-table-wrap">
            <table class="appointments-table" id="resident-appointments-table">
              <thead><tr><th>Appointment Details</th><th>Purpose</th><th>Description</th><th>Status</th><th>Action</th></tr></thead>
              <tbody id="resident-appointments-body">
                @foreach($myAppointments as $apt)
                  @php($appointmentDate = \Carbon\Carbon::parse($apt->scheduled_at))
                  <tr class="resident-appointment-row" data-status="{{ strtolower($apt->status) }}" data-search="{{ $apt->purpose }} {{ $apt->notes }} {{ $appointmentDate->format('M d, Y') }} {{ $appointmentDate->format('h:i A') }}">
                    <td><div class="appointment-date"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg><span><time>{{ $appointmentDate->format('M d, Y') }}</time><small>{{ $appointmentDate->format('h:i A') }}</small></span></div></td>
                    <td><span class="appointment-purpose">{{ $apt->purpose }}</span></td>
                    <td><span class="appointment-description">{{ $apt->notes ?: 'No description provided.' }}</span></td>
                    <td><span class="appointment-status {{ strtolower($apt->status) }}">{{ ucfirst($apt->status) }}</span></td>
                    <td><button type="button" class="appointment-view" onclick="openApptModal({date:'{{ $appointmentDate->format('M d, Y') }}', time:'{{ $appointmentDate->format('h:i A') }}', purpose:'{{ $apt->purpose }}', detail:'{{ addslashes($apt->notes ?? 'None') }}', status:'{{ ucfirst($apt->status) }}'})"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>View Details</button></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="appointments-no-match" id="resident-appointments-no-match">No matching appointments found.<span>Try adjusting your search or filters.</span></div>
          </div>
          <div class="appointments-footer"><span id="resident-appointments-count"></span><div class="appointments-pagination" id="resident-appointments-pagination" aria-label="Appointment pages"></div></div>
        @endif
      </div>
    </div>

    <div class="page" id="page-notifications">
      <div class="panel">
        <div class="ph"><div><div class="ph-title">Notifications</div><div class="ph-sub">Latest updates regarding your requests and account</div></div></div>
        <div class="notif-toolbar">
          <div class="notif-filter-btn on" onclick="filterNotif('all', this)">All</div>
          <div class="notif-filter-btn" onclick="filterNotif('document', this)">Documents</div>
          <div class="notif-filter-btn" onclick="filterNotif('appointment', this)">Appointments</div>
        </div>
        <div class="notif-feed">
          @forelse($notifications ?? [] as $n)
          <div class="ncard {{ $n->read_at ? '' : 'unread' }} nc-{{ $n->data['color'] ?? 'gold' }}" data-type="{{ $n->data['type'] ?? 'general' }}">
            <div class="ncard-icon nc-{{ $n->data['color'] ?? 'gold' }}">{{ $n->data['icon'] ?? '🔔' }}</div>
            <div class="ncard-body">
              <div class="ncard-top"><div class="ncard-title">{{ $n->data['title'] ?? 'Notification' }}</div><div class="ncard-time">{{ $n->created_at->diffForHumans() }}</div></div>
              <div class="ncard-msg">{{ $n->data['message'] ?? '' }}</div>
            </div>
            @if(!$n->read_at)<div class="unread-dot"></div>@endif
          </div>
          @empty
          <div class="notif-empty"><div class="ne-ico">🔔</div><p>No new notifications at the moment.</p></div>
          @endforelse
        </div>
      </div>
    </div>

    <div class="page" id="page-profile">
      <div class="panel">
        <div class="prof-hero">
          <div class="prof-hero-inner">
            <div class="prof-avatar-wrap"><div class="prof-ava-lg" id="profile-avatar">{{ strtoupper(substr(auth()->user()->first_name ?? 'R', 0, 1)) }}</div><div class="prof-online"></div></div>
            <div class="prof-hero-meta">
              <div class="prof-hero-name" id="profile-name">{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }}</div>
              <div class="prof-hero-email">{{ auth()->user()->email ?? '' }}</div>
              <div class="prof-hero-chips"><span class="prof-chip verified">✓ Verified Resident</span><span class="prof-chip resident">🏘 Barangay Buhuan</span></div>
            </div>
          </div>
          <div class="prof-tabs"><button class="prof-tab active" onclick="switchProfTab('info',this)">Personal Info</button><button class="prof-tab" onclick="switchProfTab('security',this)">Security</button><button class="prof-tab" onclick="switchProfTab('activity',this)">Activity</button></div>
        </div>
        <div class="prof-tab-body">
          <div class="prof-tab-pane active" id="ptab-info">
            <div class="prof-info-grid">
              <div class="prof-status-card"><div class="psc-icon">✓</div><div class="psc-body"><div class="psc-title">Account Verified & Active</div><div class="psc-sub">Your account has been approved by the barangay administrator. You have full access to all resident services.</div></div></div>
              <div class="prof-info-card"><div class="pic-label">First Name</div><div class="pic-value" id="display-firstname">{{ auth()->user()->first_name ?? '—' }}</div><button class="pic-edit" onclick="openEditProfileModal('first_name', '{{ auth()->user()->first_name ?? '' }}')">Edit</button></div>
              <div class="prof-info-card"><div class="pic-label">Last Name</div><div class="pic-value" id="display-lastname">{{ auth()->user()->last_name ?? '—' }}</div><button class="pic-edit" onclick="openEditProfileModal('last_name', '{{ auth()->user()->last_name ?? '' }}')">Edit</button></div>
              <div class="prof-info-card"><div class="pic-label">Email Address</div><div class="pic-value">{{ auth()->user()->email ?? '—' }}</div></div>
              <div class="prof-info-card"><div class="pic-label">Contact Number</div><div class="pic-value" id="display-contact">{{ auth()->user()->contact_number ?? '—' }}</div><button class="pic-edit" onclick="openEditProfileModal('contact_number', '{{ auth()->user()->contact_number ?? '' }}')">Edit</button></div>
              <div class="prof-info-card full"><div class="pic-label">Home Address in Barangay Buhuan</div><div class="pic-value" id="display-address">{{ auth()->user()->address ?? '—' }}</div><button class="pic-edit" onclick="openEditProfileModal('address', '{{ auth()->user()->address ?? '' }}')">Edit</button></div>
              <div class="prof-info-card"><div class="pic-label">Date Registered</div><div class="pic-value">{{ auth()->user()->created_at ? auth()->user()->created_at->format('F d, Y') : '—' }}</div></div>
              <div class="prof-info-card"><div class="pic-label">Account Approved On</div><div class="pic-value">{{ auth()->user()->approved_at ? \Carbon\Carbon::parse(auth()->user()->approved_at)->format('F d, Y') : '—' }}</div></div>
            </div>
          </div>
          <div class="prof-tab-pane" id="ptab-security">
            <div style="display:flex; flex-direction:column; gap:12px;">
              <div class="prof-security-item"><div class="psi-left"><div class="psi-ico">🔑</div><div><div class="psi-title">Password</div><div class="psi-sub">Change your account password</div></div></div><button class="abtn abtn-view" onclick="openPasswordModal()">Update</button></div>
              <div class="prof-security-item"><div class="psi-left"><div class="psi-ico">🛡️</div><div><div class="psi-title">Two-Factor Authentication</div><div class="psi-sub">Currently {{ auth()->user()->two_factor_secret ? 'Enabled' : 'Disabled' }}</div></div></div><button class="abtn abtn-view" onclick="openTfaModal()">{{ auth()->user()->two_factor_secret ? 'Settings' : 'Enable' }}</button></div>
            </div>
          </div>
          <div class="prof-tab-pane" id="ptab-activity">
            <div class="prof-activity-item"><div class="pai-dot gold">✨</div><div class="pai-body"><strong>Account verified</strong><p>Your identity was successfully confirmed by the admin.</p></div><div class="pai-time">Last week</div></div>
            <div class="prof-activity-item"><div class="pai-dot navy">👤</div><div class="pai-body"><strong>Profile updated</strong><p>You changed your contact information.</p></div><div class="pai-time">2 days ago</div></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="modal-overlay" id="password-modal" onclick="closePasswordModal(event)">
  <div class="modal">
    <div class="modal-head"><div><div class="modal-head-title">Change Password</div><div class="modal-head-sub">Ensure your account is using a long, random password to stay secure.</div></div><button class="modal-close" onclick="closePasswordModalDirect()">✕</button></div>
    <div class="modal-body">
      <div class="edit-field">
        <label>Current Password</label>
        <input type="password" id="current_password" placeholder="••••••••">
      </div>
      <div class="edit-field">
        <label>New Password</label>
        <input type="password" id="new_password" placeholder="••••••••">
      </div>
      <div class="edit-field">
        <label>Confirm New Password</label>
        <input type="password" id="new_password_confirmation" placeholder="••••••••">
      </div>
    </div>
    <div class="modal-foot">
      <button class="abtn-outline" onclick="closePasswordModalDirect()">Cancel</button>
      <button class="abtn-gold" onclick="savePassword()">Update Password</button>
    </div>
  </div>
</div>

<div class="modal-overlay" id="tfa-modal" onclick="closeTfaModal(event)">
  <div class="modal">
    <div class="modal-head"><div><div class="modal-head-title">Two-Factor Authentication</div><div class="modal-head-sub">Add additional security to your account using two-factor authentication.</div></div><button class="modal-close" onclick="closeTfaModalDirect()">✕</button></div>
    <div class="modal-body">
        <div id="tfa-content">
            <p>Two-factor authentication is currently <strong>{{ auth()->user()->two_factor_secret ? 'Enabled' : 'Disabled' }}</strong>.</p>
            <p style="font-size: 0.9em; color: #666; margin-top: 8px;">When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.</p>
        </div>
    </div>
    <div class="modal-foot">
      <button class="abtn-outline" onclick="closeTfaModalDirect()">Close</button>
      <button class="abtn-gold" onclick="toggleTFA()">{{ auth()->user()->two_factor_secret ? 'Disable' : 'Enable' }}</button>
    </div>
  </div>
</div>

<div class="modal-overlay" id="edit-profile-modal" onclick="closeEditProfileModal(event)">
  <div class="modal">
    <div class="modal-head"><div><div class="modal-head-title" id="edit-modal-title">Edit Profile</div><div class="modal-head-sub" id="edit-modal-sub">Update your information</div></div><button class="modal-close" onclick="closeEditProfileModalDirect()">✕</button></div>
    <div class="modal-body">
      <div class="edit-field" id="edit-field-container">
      </div>
    </div>
    <div class="modal-foot">
      <button class="abtn-outline" onclick="closeEditProfileModalDirect()">Cancel</button>
      <button class="abtn-gold" onclick="saveProfileChanges()">Save Changes</button>
    </div>
  </div>
</div>

<div class="modal-overlay" id="doc-modal" onclick="closeDocModal(event)">
  <div class="modal">
    <div class="modal-head"><div><div class="modal-head-title">Document Request Details</div><div class="modal-head-sub" id="dm-num">#0000</div></div><button class="modal-close" onclick="closeDocModalDirect()">✕</button></div>
    <div class="modal-body">
      <div class="modal-detail-row">
        <div class="modal-box"><label>Document Type</label><p id="dm-type">—</p></div>
        <div class="modal-box"><label>Date Filed</label><p id="dm-date">—</p></div>
      </div>
      <div class="modal-detail-row">
        <div class="modal-box"><label>Purpose</label><p id="dm-purpose">—</p></div>
        <div class="modal-box"><label>Current Status</label><p id="dm-status">—</p></div>
      </div>
      <div class="modal-desc-box"><label>Additional Notes</label><p id="dm-notes">—</p></div>
    </div>
    <div class="modal-foot"><button class="abtn-outline" onclick="closeDocModalDirect()">Close</button></div>
  </div>
</div>

<div class="modal-overlay" id="appt-modal" onclick="closeApptModal(event)">
  <div class="modal">
    <div class="modal-head"><div><div class="modal-head-title">Appointment Details</div><div class="modal-head-sub" id="am-sub">—</div></div><button class="modal-close" onclick="closeApptModalDirect()">✕</button></div>
    <div class="modal-body">
      <div class="modal-detail-row">
        <div class="modal-box"><label>Date</label><p id="am-date">—</p></div>
        <div class="modal-box"><label>Time Slot</label><p id="am-time">—</p></div>
      </div>
      <div class="modal-desc-box"><label>Purpose & Details</label><p id="am-detail">—</p></div>
      <div class="modal-detail-row"><div class="modal-box"><label>Status</label><p id="am-status">—</p></div></div>
    </div>
    <div class="modal-foot"><button class="abtn-outline" onclick="closeApptModalDirect()">Close</button></div>
  </div>
</div>

<div class="toast-wrap" id="toast-wrap"></div>

<script>
// ── Live date ──
const d = new Date();
document.getElementById('dchip').textContent = d.toLocaleDateString('en-PH',{weekday:'short',year:'numeric',month:'short',day:'numeric'});

// ── Page titles ──
const titles = {
  dashboard:'Home', 'request-doc':'Request Document',
  'my-requests':'My Document Requests', schedule:'Schedule Appointment',
  'my-appointments':'My Appointments', notifications:'Notifications',
  profile:'My Profile'
};
function showPage(pageId, navEl) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  const targetPage = document.getElementById('page-'+pageId);
  if (targetPage) targetPage.classList.add('active');
  document.getElementById('page-title').textContent = titles[pageId]||'Home';
  document.querySelectorAll('.nav-lnk').forEach(n => n.classList.remove('active'));
  if (navEl) navEl.classList.add('active');
  document.querySelector('.content').scrollTop = 0;
}

// ── Profile Tabs ──
function switchProfTab(tabId, btn) {
  document.querySelectorAll('.prof-tab').forEach(b => b.classList.remove('active'));
  document.querySelectorAll('.prof-tab-pane').forEach(p => p.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('ptab-'+tabId).classList.add('active');
}

// ── Document Requests ──
let selectedDocType = null;
function pickDoc(type, el) {
  selectedDocType = type;
  document.querySelectorAll('.doc-type-item').forEach(item => item.classList.remove('selected'));
  el.classList.add('selected');
  const echo = document.getElementById('sel-doc-echo');
  echo.classList.remove('empty');
  echo.querySelector('.sde-name').textContent = type;
  echo.querySelector('.sde-sub').textContent = 'Selected for request';
}

function submitDocRequest() {
  if (!selectedDocType) { showToast('Please select a document type.','warn'); return; }
  const purpose = document.getElementById('doc-purpose-sel').value;
  if (!purpose) { showToast('Please select the purpose of your request.','warn'); return; }
  const notes = document.getElementById('doc-notes').value;

  fetch('{{ route("resident.submit.document") }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ document_type: selectedDocType, purpose, notes })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      showToast(data.message, 'ok');
      setTimeout(() => location.reload(), 1500);
    } else {
      showToast('Error submitting request.', 'warn');
    }
  })
  .catch(err => {
    console.error(err);
    showToast('Network error.', 'warn');
  });
}

// ── Profile Editing ──
let currentEditField = null;
function openEditProfileModal(field, currentVal) {
  currentEditField = field;
  const container = document.getElementById('edit-field-container');
  const modalTitle = document.getElementById('edit-modal-title');
  const modalSub = document.getElementById('edit-modal-sub');

  let label = '', placeholder = '';
  if (field === 'first_name') { label = 'First Name'; placeholder = 'Enter first name'; modalTitle.innerText = 'Edit First Name'; }
  else if (field === 'last_name') { label = 'Last Name'; placeholder = 'Enter last name'; modalTitle.innerText = 'Edit Last Name'; }
  else if (field === 'contact_number') { label = 'Contact Number'; placeholder = 'e.g. 09123456789'; modalTitle.innerText = 'Edit Contact'; }
  else if (field === 'address') { label = 'Home Address'; placeholder = 'Enter full address'; modalTitle.innerText = 'Edit Address'; }

  container.innerHTML = `<label>${label}</label><input type="text" id="edit-single-field" value="${currentVal || ''}" placeholder="${placeholder}">`;
  document.getElementById('edit-profile-modal').classList.add('open');
}

function closeEditProfileModalDirect() { document.getElementById('edit-profile-modal').classList.remove('open'); }
function closeEditProfileModal(e) { if (e && e.target === document.getElementById('edit-profile-modal')) closeEditProfileModalDirect(); }

document.addEventListener('DOMContentLoaded', () => {
    const latestNotification = @json(($notificationsCount ?? 0) > 0 ? data_get($notifications->whereNull('read_at')->first(), 'data') : null);
    if (latestNotification) {
        const icon = latestNotification.icon || '🔔';
        const title = latestNotification.title || '';
        const message = latestNotification.message || '';
        showToast(`${icon} ${title}: ${message}`, 'ok');
    }
});

function saveProfileChanges() {
  const newValue = document.getElementById('edit-single-field').value.trim();
  if (!newValue && currentEditField !== 'contact_number') { showToast('This field cannot be empty.','warn'); return; }

  const payload = {}; payload[currentEditField] = newValue;

  fetch('{{ route("resident.update.profile") }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify(payload)
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      showToast(data.message, 'ok');
      location.reload();
    } else {
      showToast('Error updating profile.', 'warn');
    }
  })
  .catch(err => { console.error(err); showToast('Network error.', 'warn'); });
}

// ── Notifications ──
function filterNotif(type, btn) {
  document.querySelectorAll('.notif-filter-btn').forEach(b => b.classList.remove('on'));
  btn.classList.add('on');
  document.querySelectorAll('.ncard').forEach(c => {
    if (type === 'all') { c.style.display = 'flex'; return; }
    c.style.display = (c.dataset.type === type) ? 'flex' : 'none';
  });
}
function markAllRead() {
  fetch('{{ route("resident.notifications.markRead") }}', {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      showToast('All notifications marked as read.','ok');
      document.querySelectorAll('.ncard.unread').forEach(c => c.classList.remove('unread'));
      document.querySelectorAll('.unread-dot').forEach(d => d.remove());
      const cnt = document.getElementById('notif-cnt');
      if (cnt) cnt.textContent = '0';
    }
  });
}

// ── Security & 2FA ──
function openPasswordModal() { document.getElementById('password-modal').classList.add('open'); }
function closePasswordModalDirect() { document.getElementById('password-modal').classList.remove('open'); }
function closePasswordModal(e) { if (e && e.target === document.getElementById('password-modal')) closePasswordModalDirect(); }

function savePassword() {
  const current_password = document.getElementById('current_password').value;
  const password = document.getElementById('new_password').value;
  const password_confirmation = document.getElementById('new_password_confirmation').value;

  fetch('{{ route("resident.update.password") }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ current_password, password, password_confirmation })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      showToast(data.message, 'ok');
      closePasswordModalDirect();
    } else {
      showToast(data.message || 'Error updating password.', 'warn');
    }
  })
  .catch(err => { console.error(err); showToast('Check your current password and try again.', 'warn'); });
}

function openTfaModal() { document.getElementById('tfa-modal').classList.add('open'); }
function closeTfaModalDirect() { document.getElementById('tfa-modal').classList.remove('open'); }
function closeTfaModal(e) { if (e && e.target === document.getElementById('tfa-modal')) closeTfaModalDirect(); }

function toggleTFA() {
  showToast('Two-factor authentication simulation toggled.','ok');
  closeTfaModalDirect();
}

// ── Appointment calendar ──
const ADMIN_OPEN_DAYS = {!! $availabilityDays !!};
const ADMIN_SLOTS = {!! $availabilitySlots !!};
const ADMIN_MAX_PER_SLOT = {{ $maxPerSlot }};
const BOOKED_SLOTS = {!! json_encode($bookedSlots) !!};

let userCalYear = new Date().getFullYear(), userCalMonth = new Date().getMonth();
let selectedUserDate = null, selectedUserSlot = null;

// Helper to format slot 
function getSlotKey(dateStr, timeStr) {
  // timeStr is like "9:00 AM" or "2:00 PM"
  let [time, modifier] = timeStr.split(' ');
  let [hours, minutes] = time.split(':');
  if (hours === '12') hours = '00';
  if (modifier === 'PM') hours = parseInt(hours, 10) + 12;
  const formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:00`;
  return `${dateStr} ${formattedTime}`;
}

function userCalNav(dir) {
  userCalMonth += dir;
  if (userCalMonth < 0) { userCalMonth = 11; userCalYear--; }
  if (userCalMonth > 11) { userCalMonth = 0; userCalYear++; }
  selectedUserDate = null; selectedUserSlot = null;
  resetSlotPicker(); renderUserCalendar();
}

function renderUserCalendar() {
  const monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  const labelEl = document.getElementById('user-cal-label');
  if (labelEl) labelEl.textContent = `${monthNames[userCalMonth]} ${userCalYear}`;
  const first = new Date(userCalYear, userCalMonth, 1).getDay();
  const daysInMon = new Date(userCalYear, userCalMonth+1, 0).getDate();
  const today = new Date();
  const isCurMon = today.getFullYear()===userCalYear && today.getMonth()===userCalMonth;
  const container = document.getElementById('user-cal-days');
  if (!container) return;
  container.innerHTML = '';
  const prevDays = new Date(userCalYear, userCalMonth, 0).getDate();
  for (let i = first-1; i >= 0; i--) {
    const el = document.createElement('div'); el.className='cal-day other'; el.textContent = prevDays-i; container.appendChild(el);
  }
  for (let day = 1; day <= daysInMon; day++) {
    const dow = new Date(userCalYear, userCalMonth, day).getDay();
    const isOpen = ADMIN_OPEN_DAYS.includes(dow);
    const isPast = new Date(userCalYear, userCalMonth, day) < new Date(today.getFullYear(), today.getMonth(), today.getDate());
    const el = document.createElement('div'); el.className='cal-day';
    if (isCurMon && day===today.getDate()) el.classList.add('today');
    if (isOpen && !isPast) {
      el.classList.add('open');
      el.classList.add('has-slots');
      el.addEventListener('click', () => selectUserDate(day, dow, el));
    }
    if (selectedUserDate && selectedUserDate.day===day && userCalMonth===selectedUserDate.month && userCalYear===selectedUserDate.year) el.classList.add('selected');
    el.textContent = day;
    container.appendChild(el);
  }
}

function selectUserDate(day, dow, el) {
  document.querySelectorAll('#user-cal-days .cal-day').forEach(d => d.classList.remove('selected'));
  el.classList.add('selected');
  const mNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  const dNames = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
  selectedUserDate = { day, dow, month:userCalMonth, year:userCalYear, label:`${dNames[dow]}, ${mNames[userCalMonth]} ${day}, ${userCalYear}` };
  selectedUserSlot = null;
  renderSlotOptions();
}

function renderSlotOptions() {
  const listEl = document.getElementById('user-slots-list');
  const formEl = document.getElementById('appt-form-fields');
  formEl.style.display = 'none';
  document.getElementById('spick-date-label').textContent = selectedUserDate ? selectedUserDate.label : 'Select a date first';
  document.getElementById('spick-date-sub').textContent = selectedUserDate ? 'Choose a time slot below' : 'Available time slots will appear here';
  if (!selectedUserDate) { listEl.innerHTML='<div class="no-date-msg">← Select an available date from the calendar</div>'; return; }
  
  const dateStr = `${selectedUserDate.year}-${String(selectedUserDate.month+1).padStart(2,'0')}-${String(selectedUserDate.day).padStart(2,'0')}`;
  
  listEl.innerHTML = '';
  ADMIN_SLOTS.forEach(slot => {
    const slotKey = getSlotKey(dateStr, slot);
    const bookedCount = BOOKED_SLOTS[slotKey] || 0;
    const isFull = bookedCount >= ADMIN_MAX_PER_SLOT;
    
    const div = document.createElement('div'); 
    div.className = 'slot-option' + (isFull ? ' full' : '');
    
    if (!isFull) {
      div.addEventListener('click', () => pickSlot(slot, div));
      const remaining = ADMIN_MAX_PER_SLOT - bookedCount;
      div.innerHTML = `<div class="slot-option-dot"></div><div class="slot-option-time">${slot}</div><div class="slot-option-count">${remaining} ${remaining === 1 ? 'slot' : 'slots'} available</div>`;
    } else {
      div.innerHTML = `<div class="slot-option-dot"></div><div class="slot-option-time">${slot}</div><div class="slot-option-count">Fully Booked</div>`;
    }
    listEl.appendChild(div);
  });
}

function pickSlot(slot, el) {
  document.querySelectorAll('.slot-option').forEach(s => s.classList.remove('selected'));
  el.classList.add('selected');
  selectedUserSlot = slot;
  document.getElementById('appt-form-fields').style.display = 'block';
  document.getElementById('appt-summary-date').textContent = selectedUserDate.label;
  document.getElementById('appt-summary-time').textContent = '🕐 ' + slot;
}

function resetSlotPicker() {
  const listEl = document.getElementById('user-slots-list');
  if (listEl) listEl.innerHTML = '<div class="no-date-msg">← Select an available date from the calendar</div>';
  const formEl = document.getElementById('appt-form-fields');
  if (formEl) formEl.style.display = 'none';
}

function submitAppointment() {
  if (!selectedUserDate || !selectedUserSlot) { showToast('Please select a date and time slot.', 'warn'); return; }
  const purpose = document.getElementById('appt-purpose').value;
  if (!purpose) { showToast('Please select the purpose of your appointment.', 'warn'); return; }
  const notes = document.getElementById('appt-notes').value;
  const dateStr = `${selectedUserDate.year}-${String(selectedUserDate.month+1).padStart(2,'0')}-${String(selectedUserDate.day).padStart(2,'0')}`;

  fetch('{{ route("resident.submit.appointment") }}', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
    body: JSON.stringify({ date: dateStr, time: selectedUserSlot, purpose, notes })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      showToast(data.message || 'Appointment request submitted.', 'ok');
      setTimeout(() => location.reload(), 1500);
    } else {
      showToast(data.message || 'Error submitting appointment.', 'warn');
    }
  })
  .catch(err => { 
    console.error(err); 
    showToast('Network error or unexpected response.', 'warn'); 
  });
}

// ── Modals ──
function openDocModal(doc) {
  document.getElementById('dm-num').textContent = doc.num;
  document.getElementById('dm-type').textContent = doc.type;
  document.getElementById('dm-date').textContent = doc.date;
  document.getElementById('dm-purpose').textContent = doc.purpose;
  document.getElementById('dm-status').textContent = doc.status;
  document.getElementById('dm-notes').textContent = doc.notes;
  document.getElementById('doc-modal').classList.add('open');
}
function closeDocModalDirect() { document.getElementById('doc-modal').classList.remove('open'); }
function closeDocModal(e) { if (e && e.target === document.getElementById('doc-modal')) closeDocModalDirect(); }

function openApptModal(a) {
  document.getElementById('am-sub').textContent = a.date+' · '+a.time;
  document.getElementById('am-date').textContent = a.date;
  document.getElementById('am-time').textContent = a.time;
  document.getElementById('am-detail').textContent = a.purpose+' — '+a.detail;
  document.getElementById('am-status').textContent = a.status;
  document.getElementById('appt-modal').classList.add('open');
}
function closeApptModalDirect() { document.getElementById('appt-modal').classList.remove('open'); }
function closeApptModal(e) { if (e && e.target === document.getElementById('appt-modal')) closeApptModalDirect(); }

function showToast(msg, type='ok') {
  const wrap = document.getElementById('toast-wrap');
  const t = document.createElement('div');
  t.className = `toast t-${type}`;
  t.textContent = msg;
  wrap.appendChild(t);
  requestAnimationFrame(() => { requestAnimationFrame(() => t.classList.add('show')); });
  setTimeout(() => { t.classList.remove('show'); setTimeout(() => t.remove(), 400); }, 3800);
}

// My Document Requests search, filters, and client-side pagination.
(() => {
  const tableBody = document.getElementById('my-requests-table-body');
  if (!tableBody) return;
  const rows = Array.from(tableBody.querySelectorAll('.my-document-request-row'));
  const searchInput = document.getElementById('my-requests-search');
  const typeFilter = document.getElementById('my-requests-type-filter');
  const statusFilter = document.getElementById('my-requests-status-filter');
  const countLabel = document.getElementById('my-requests-count');
  const pagination = document.getElementById('my-requests-pagination');
  const noMatch = document.getElementById('my-requests-no-match');
  const pageSize = 8;
  let currentPage = 1;
  const normalizeRequestText = value => String(value ?? '').normalize('NFKC').trim().replace(/\s+/g, ' ').toLocaleLowerCase();

  function renderMyRequests() {
    const query = normalizeRequestText(searchInput.value);
    const selectedType = normalizeRequestText(typeFilter.value);
    const selectedStatus = normalizeRequestText(statusFilter.value);
    const filteredRows = rows.filter(row => normalizeRequestText(row.dataset.search).includes(query)
      && (!selectedType || normalizeRequestText(row.dataset.documentType) === selectedType)
      && (!selectedStatus || normalizeRequestText(row.dataset.status) === selectedStatus));
    const pageCount = Math.max(1, Math.ceil(filteredRows.length / pageSize));
    currentPage = Math.min(currentPage, pageCount);
    const start = (currentPage - 1) * pageSize;
    rows.forEach(row => { row.style.display = 'none'; });
    filteredRows.slice(start, start + pageSize).forEach(row => { row.style.display = ''; });
    noMatch.style.display = filteredRows.length ? 'none' : 'block';
    countLabel.textContent = filteredRows.length
      ? `Showing ${start + 1}\u2013${Math.min(start + pageSize, filteredRows.length)} of ${filteredRows.length} document requests`
      : 'Showing 0 of 0 document requests';
    pagination.replaceChildren();

    const addButton = (label, target, disabled, active = false, ariaLabel = label, direction = null) => {
      const button = document.createElement('button');
      button.type = 'button'; button.disabled = disabled;
      if (direction) {
        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        svg.setAttribute('viewBox', '0 0 24 24'); svg.setAttribute('aria-hidden', 'true');
        path.setAttribute('d', direction === 'left' ? 'm15 18-6-6 6-6' : 'm9 18 6-6-6-6');
        svg.appendChild(path); button.appendChild(svg);
      } else button.textContent = label;
      button.classList.toggle('current', active); button.setAttribute('aria-label', ariaLabel);
      if (active) button.setAttribute('aria-current', 'page');
      button.addEventListener('click', () => { currentPage = target; renderMyRequests(); });
      pagination.appendChild(button);
    };
    addButton('', currentPage - 1, currentPage === 1, false, 'Previous page', 'left');
    for (let page = 1; page <= pageCount; page++) addButton(String(page), page, false, page === currentPage, `Page ${page}`);
    addButton('', currentPage + 1, currentPage === pageCount, false, 'Next page', 'right');
  }

  searchInput.addEventListener('input', () => { currentPage = 1; renderMyRequests(); });
  typeFilter.addEventListener('change', () => { currentPage = 1; renderMyRequests(); });
  statusFilter.addEventListener('change', () => { currentPage = 1; renderMyRequests(); });
  document.getElementById('my-requests-clear').addEventListener('click', () => {
    searchInput.value = ''; typeFilter.value = ''; statusFilter.value = ''; currentPage = 1;
    renderMyRequests();
  });
  renderMyRequests();
})();

// My Appointments search, status filtering, and client-side pagination.
(() => {
  const table = document.getElementById('resident-appointments-table');
  if (!table) return;

  const rows = Array.from(table.querySelectorAll('.resident-appointment-row'));
  const searchInput = document.getElementById('resident-appointments-search');
  const statusFilter = document.getElementById('resident-appointments-status');
  const clearButton = document.getElementById('resident-appointments-clear');
  const countLabel = document.getElementById('resident-appointments-count');
  const pagination = document.getElementById('resident-appointments-pagination');
  const tableWrap = document.getElementById('resident-appointments-table-wrap');
  const pageSize = 8;
  let currentPage = 1;

  const normalizeText = value => String(value ?? '').normalize('NFKC').trim().replace(/\s+/g, ' ').toLocaleLowerCase();

  function renderAppointments() {
    const query = normalizeText(searchInput.value);
    const selectedStatus = normalizeText(statusFilter.value);
    const filteredRows = rows.filter(row => normalizeText(row.dataset.search).includes(query)
      && (!selectedStatus || normalizeText(row.dataset.status) === selectedStatus));
    const pageCount = Math.max(1, Math.ceil(filteredRows.length / pageSize));
    currentPage = Math.min(currentPage, pageCount);
    const start = (currentPage - 1) * pageSize;

    rows.forEach(row => { row.style.display = 'none'; });
    filteredRows.slice(start, start + pageSize).forEach(row => { row.style.display = ''; });
    tableWrap.classList.toggle('no-results', filteredRows.length === 0);
    countLabel.textContent = filteredRows.length
      ? `Showing ${start + 1}–${Math.min(start + pageSize, filteredRows.length)} of ${filteredRows.length} appointments`
      : 'Showing 0 of 0 appointments';
    pagination.replaceChildren();

    const addButton = (label, target, disabled, active = false, ariaLabel = label, direction = null) => {
      const button = document.createElement('button');
      button.type = 'button';
      button.disabled = disabled;
      button.setAttribute('aria-label', ariaLabel);
      if (active) {
        button.classList.add('current');
        button.setAttribute('aria-current', 'page');
      }
      if (direction) {
        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        svg.setAttribute('viewBox', '0 0 24 24');
        svg.setAttribute('aria-hidden', 'true');
        path.setAttribute('d', direction === 'left' ? 'm15 18-6-6 6-6' : 'm9 18 6-6-6-6');
        svg.appendChild(path);
        button.appendChild(svg);
      } else {
        button.textContent = label;
      }
      button.addEventListener('click', () => { currentPage = target; renderAppointments(); });
      pagination.appendChild(button);
    };

    if (pageCount > 1) {
      addButton('', currentPage - 1, currentPage === 1, false, 'Previous page', 'left');
      for (let page = 1; page <= pageCount; page++) addButton(String(page), page, false, page === currentPage, `Page ${page}`);
      addButton('', currentPage + 1, currentPage === pageCount, false, 'Next page', 'right');
    }
  }

  searchInput.addEventListener('input', () => { currentPage = 1; renderAppointments(); });
  statusFilter.addEventListener('change', () => { currentPage = 1; renderAppointments(); });
  clearButton.addEventListener('click', () => {
    searchInput.value = '';
    statusFilter.value = '';
    currentPage = 1;
    renderAppointments();
  });
  renderAppointments();
})();

renderUserCalendar();
</script>
</body>
</html>
