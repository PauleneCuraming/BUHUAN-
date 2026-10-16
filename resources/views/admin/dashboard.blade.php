<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BUHUAN – Admin Dashboard</title>
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

    body { font-family:'DM Sans',sans-serif; background:var(--bg); display:flex; min-height:100vh; color:#2a1f00; overflow-x: hidden; }

    .sidebar {
      width:var(--sb); min-height:100vh; background:var(--navy2);
      display:flex; flex-direction:column;
      position:fixed; top:0; left:0; bottom:0; z-index:100;
      flex-shrink: 0;
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
    .nav-cnt { margin-left:auto; background:var(--gold); color:var(--navy); font-size:10px; font-weight:700; padding:1px 7px; border-radius:99px; }

    .sb-foot { margin-top:auto; padding:16px 14px; border-top:1px solid rgba(255,255,255,0.06); }
    .sb-admin-card { display:flex; align-items:center; justify-content:space-between; gap:10px; padding:10px 12px; border-radius:10px; background:rgba(255,255,255,0.04); border:1px solid rgba(201,162,39,0.12); }
    .sb-ava { width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,var(--gold),var(--navy3)); display:flex; align-items:center; justify-content:center; font-family:'Playfair Display',serif; font-size:15px; font-weight:700; color:var(--white); flex-shrink:0; }
    .sb-ainfo { flex:1; min-width:0; }
    .sb-aname { font-size:12.5px; font-weight:600; color:var(--text); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .sb-arole { font-size:10px; color:var(--gold); font-weight:500; }

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

    /* Document Requests page only */
    #page-doc-requests .documents-shell { background:#fff; border:1px solid #e9e5dc; border-radius:16px; box-shadow:0 8px 28px rgba(15,27,45,.06); overflow:hidden; }
    #page-doc-requests .documents-head { display:flex; align-items:center; justify-content:space-between; gap:18px; padding:24px 28px 20px; border-bottom:1px solid #eeeae2; }
    #page-doc-requests .documents-title-wrap { display:flex; align-items:center; gap:13px; }
    #page-doc-requests .documents-title-icon { width:43px; height:43px; flex:0 0 43px; display:grid; place-items:center; border-radius:12px; color:#84650d; background:rgba(201,162,39,.13); }
    #page-doc-requests .documents-title-icon svg { width:22px; height:22px; fill:none; stroke:currentColor; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; }
    #page-doc-requests .documents-head .ph-title { font-size:19px; }
    #page-doc-requests .documents-head .ph-sub { font-size:12px; margin-top:5px; }
    #page-doc-requests .documents-refresh, #page-doc-requests .documents-clear { height:42px; padding:0 15px; border-radius:9px; background:#fff; font:600 12px 'DM Sans',sans-serif; cursor:pointer; white-space:nowrap; transition:all .16s; }
    #page-doc-requests .documents-refresh { color:#80610b; border:1px solid rgba(201,162,39,.55); }
    #page-doc-requests .documents-refresh:hover { background:#fff9e9; border-color:var(--gold); }
    #page-doc-requests .documents-toolbar { display:grid; grid-template-columns:minmax(240px,1fr) minmax(160px,210px) auto; gap:10px; padding:19px 26px; }
    #page-doc-requests .documents-search { position:relative; }
    #page-doc-requests .documents-search svg { position:absolute; left:13px; top:50%; transform:translateY(-50%); width:17px; height:17px; stroke:#8a9bb5; pointer-events:none; }
    #page-doc-requests .documents-search input, #page-doc-requests .documents-toolbar select { width:100%; height:42px; border:1px solid #e1ddd4; border-radius:9px; padding:0 12px; background:#fff; color:#263449; font:400 12px 'DM Sans',sans-serif; outline:none; }
    #page-doc-requests .documents-search input { padding-left:40px; }
    #page-doc-requests .documents-search input:focus, #page-doc-requests .documents-toolbar select:focus { border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,162,39,.1); }
    #page-doc-requests .documents-clear { display:inline-flex; align-items:center; gap:6px; color:#b0443b; background:#fff6f5; border:1px solid rgba(192,57,43,.3); }
    #page-doc-requests .documents-clear:hover { background:#fde9e6; border-color:#c0392b; }
    #page-doc-requests .documents-clear svg { width:14px; height:14px; fill:none; stroke:currentColor; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; }
    #page-doc-requests .documents-table-wrap { overflow-x:auto; }
    #page-doc-requests .documents-table { width:100%; min-width:930px; border-collapse:collapse; }
    #page-doc-requests .documents-table thead th { padding:12px 17px; background:#faf9f6; border-top:1px solid #f0ede7; border-bottom:1px solid #ece8e0; color:#8b8170; font-size:10px; letter-spacing:.8px; text-transform:uppercase; text-align:left; }
    #page-doc-requests .documents-table tbody td { padding:14px 17px; border-bottom:1px solid #f0ede8; vertical-align:middle; font-size:12.5px; }
    #page-doc-requests .documents-table tbody tr:last-child td { border-bottom:0; }
    #page-doc-requests .documents-table tbody tr:hover td { background:#fdfcf9; }
    #page-doc-requests .request-number { color:#1d2b40; font:700 13px 'Playfair Display',serif; white-space:nowrap; }
    #page-doc-requests .document-resident { display:flex; align-items:center; gap:9px; min-width:185px; }
    #page-doc-requests .document-avatar { width:35px; height:35px; flex:0 0 35px; display:grid; place-items:center; border-radius:50%; color:#263449; background:linear-gradient(135deg,#f5df9d,#d5ae43); font:700 14px 'Playfair Display',serif; }
    #page-doc-requests .document-resident-name { color:#1d2b40; font-size:12px; font-weight:700; }
    #page-doc-requests .document-resident-meta { color:#898b90; font-size:10.5px; margin-top:3px; overflow-wrap:anywhere; }
    #page-doc-requests .document-type-badge { display:inline-flex; align-items:center; gap:6px; padding:5px 8px; border:1px solid #dbeaf7; border-radius:6px; background:#edf5fc; color:#315b85; font-size:10.5px; font-weight:600; }
    #page-doc-requests .document-type-badge svg { width:13px; height:13px; fill:none; stroke:currentColor; stroke-width:1.7; stroke-linecap:round; stroke-linejoin:round; }
    #page-doc-requests .document-purpose { display:block; min-width:140px; max-width:270px; color:#646c78; font-size:11.5px; line-height:1.45; overflow-wrap:anywhere; }
    #page-doc-requests .document-date { display:flex; align-items:flex-start; gap:6px; color:#596474; white-space:nowrap; font-size:11.5px; }
    #page-doc-requests .document-date svg { width:14px; height:14px; flex:0 0 14px; fill:none; stroke:#a58a43; stroke-width:1.7; stroke-linecap:round; stroke-linejoin:round; }
    #page-doc-requests .document-view { height:32px; padding:0 11px; display:inline-flex; align-items:center; gap:6px; border:1px solid rgba(201,162,39,.55); border-radius:8px; background:#fff; color:#80610b; font:600 11px 'DM Sans',sans-serif; cursor:pointer; transition:all .15s; white-space:nowrap; }
    #page-doc-requests .document-view:hover { background:#fff9e9; border-color:var(--gold); }
    #page-doc-requests .document-view svg { width:14px; height:14px; fill:none; stroke:currentColor; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; }
    #page-doc-requests .documents-footer { display:flex; align-items:center; justify-content:space-between; gap:14px; padding:15px 24px; border-top:1px solid #eeeae2; color:#898273; font-size:11.5px; }
    #page-doc-requests .documents-pagination { display:flex; align-items:center; gap:5px; }
    #page-doc-requests .documents-pagination button { min-width:30px; height:30px; padding:0 8px; border:1px solid #e5e0d6; border-radius:7px; background:#fff; color:#596273; font:600 11px 'DM Sans',sans-serif; cursor:pointer; }
    #page-doc-requests .documents-pagination button:hover:not(:disabled) { border-color:var(--gold); }
    #page-doc-requests .documents-pagination button.current { background:var(--gold); border-color:var(--gold); color:#fff; }
    #page-doc-requests .documents-pagination button:disabled { opacity:.42; cursor:default; }
    #page-doc-requests .documents-no-match, #page-doc-requests .documents-empty { padding:48px 20px; text-align:center; color:#4b5668; font-size:13px; }
    #page-doc-requests .documents-no-match { display:none; }
    #page-doc-requests .documents-no-match span { display:block; margin-top:5px; color:#92908a; font-size:12px; }
    #page-doc-requests .documents-empty { padding:62px 20px; }
    #page-doc-requests .documents-empty svg { width:58px; height:58px; margin-bottom:13px; color:var(--gold); }
    #page-doc-requests .documents-empty h3 { color:#273449; font:700 17px 'Playfair Display',serif; margin-bottom:5px; }
    #page-doc-requests .documents-empty p { color:#92908a; font-size:12px; }

    /* Manage Users page only */
    #page-manage-users .users-shell { background:#fff; border:1px solid #e9e5dc; border-radius:16px; box-shadow:0 8px 28px rgba(15,27,45,.06); overflow:hidden; }
    #page-manage-users .users-head { display:flex; align-items:center; justify-content:space-between; gap:18px; padding:25px 28px 21px; border-bottom:1px solid #eeeae2; }
    #page-manage-users .users-head .ph-title { font-size:19px; }
    #page-manage-users .users-head .ph-sub { font-size:12.5px; margin-top:5px; }
    #page-manage-users .users-refresh, #page-manage-users .users-clear { height:42px; padding:0 15px; border-radius:9px; background:#fff; font:600 12px 'DM Sans',sans-serif; cursor:pointer; white-space:nowrap; transition:all .16s; }
    #page-manage-users .users-refresh { color:#80610b; border:1px solid rgba(201,162,39,.55); }
    #page-manage-users .users-refresh:hover { background:#fff9e9; border-color:var(--gold); }
    #page-manage-users .users-toolbar { display:grid; grid-template-columns:minmax(220px,1fr) 190px auto; gap:12px; padding:20px 28px; background:#fff; }
    #page-manage-users .users-search { position:relative; }
    #page-manage-users .users-search svg { position:absolute; left:13px; top:50%; transform:translateY(-50%); width:17px; height:17px; stroke:#8a9bb5; pointer-events:none; }
    #page-manage-users .users-search input, #page-manage-users .users-toolbar select { width:100%; height:42px; border:1px solid #e1ddd4; border-radius:9px; padding:0 13px; background:#fff; color:#263449; font:400 13px 'DM Sans',sans-serif; outline:none; }
    #page-manage-users .users-search input { padding-left:40px; }
    #page-manage-users .users-search input:focus, #page-manage-users .users-toolbar select:focus { border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,162,39,.1); }
    #page-manage-users .users-clear { color:#b0443b; background:#fff6f5; border:1px solid rgba(192,57,43,.3); }
    #page-manage-users .users-clear:hover { background:#fde9e6; border-color:#c0392b; }
    #page-manage-users .users-table-wrap { overflow-x:auto; }
    #page-manage-users .users-table { width:100%; min-width:920px; border-collapse:collapse; }
    #page-manage-users .users-table thead th { padding:12px 18px; background:#faf9f6; border-top:1px solid #f0ede7; border-bottom:1px solid #ece8e0; color:#8b8170; font-size:10px; letter-spacing:.8px; text-transform:uppercase; text-align:left; }
    #page-manage-users .users-table tbody td { padding:14px 18px; border-bottom:1px solid #f0ede8; vertical-align:middle; font-size:12.5px; }
    #page-manage-users .users-table tbody tr:last-child td { border-bottom:0; }
    #page-manage-users .users-table tbody tr:hover td { background:#fdfcf9; }
    #page-manage-users .users-name-cell { display:flex; align-items:center; gap:10px; min-width:165px; }
    #page-manage-users .users-name-cell strong { color:#1d2b40; font-size:12.5px; }
    #page-manage-users .users-avatar { width:36px; height:36px; flex:0 0 36px; display:grid; place-items:center; border-radius:50%; color:#263449; background:linear-gradient(135deg,#f5df9d,#d5ae43); font:700 14px 'Playfair Display',serif; }
    #page-manage-users .users-email { color:#727985; font-size:11.5px !important; overflow-wrap:anywhere; }
    #page-manage-users .users-address { display:flex; align-items:flex-start; gap:6px; min-width:150px; max-width:245px; color:#586171; font-size:11.5px; line-height:1.45; }
    #page-manage-users .users-address span { overflow-wrap:anywhere; }
    #page-manage-users .users-address svg { width:14px; height:14px; flex:0 0 14px; margin-top:1px; fill:none; stroke:#a58a43; stroke-width:1.8; }
    #page-manage-users .users-date { color:#626b78; font-size:11.5px !important; white-space:nowrap; }
    #page-manage-users .users-status { display:inline-flex; align-items:center; gap:6px; padding:5px 10px; border:1px solid; border-radius:99px; font-size:10.5px; font-weight:700; white-space:nowrap; }
    #page-manage-users .users-status i { display:block; width:6px; height:6px; border-radius:50%; }
    #page-manage-users .users-status.active { color:#26734c; background:#edf8f1; border-color:#cbe8d5; }
    #page-manage-users .users-status.active i { background:#35a263; }
    #page-manage-users .users-status.rejected { color:#b8443c; background:#fff3f1; border-color:#f0d0cc; }
    #page-manage-users .users-status.rejected i { background:#d45c52; }
    #page-manage-users .users-actions { display:flex; align-items:center; gap:6px; white-space:nowrap; }
    #page-manage-users .users-actions form { display:inline-flex; }
    #page-manage-users .users-action { height:31px; padding:0 9px; display:inline-flex; align-items:center; gap:5px; border:1px solid; border-radius:7px; font:600 10.5px 'DM Sans',sans-serif; cursor:pointer; transition:all .15s; }
    #page-manage-users .users-action svg { width:13px; height:13px; fill:none; stroke:currentColor; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; }
    #page-manage-users .users-action.approve { color:#26734c; background:#edf8f1; border-color:#cbe8d5; }
    #page-manage-users .users-action.approve:hover { background:#dff2e6; }
    #page-manage-users .users-action.reject, #page-manage-users .users-action.delete { color:#b8443c; background:#fff5f4; border-color:#f0d0cc; }
    #page-manage-users .users-action.reject:hover, #page-manage-users .users-action.delete:hover { background:#fde9e6; }
    #page-manage-users .users-footer { display:flex; align-items:center; justify-content:space-between; gap:14px; padding:15px 24px; border-top:1px solid #eeeae2; color:#898273; font-size:11.5px; }
    #page-manage-users .users-pagination { display:flex; align-items:center; gap:5px; }
    #page-manage-users .users-pagination button { min-width:30px; height:30px; padding:0 8px; border:1px solid #e5e0d6; border-radius:7px; background:#fff; color:#596273; font:600 11px 'DM Sans',sans-serif; cursor:pointer; }
    #page-manage-users .users-pagination button:hover:not(:disabled) { border-color:var(--gold); }
    #page-manage-users .users-pagination button.current { background:var(--gold); border-color:var(--gold); color:#fff; }
    #page-manage-users .users-pagination button:disabled { opacity:.42; cursor:default; }
    #page-manage-users .users-no-match, #page-manage-users .users-empty { padding:48px 20px; text-align:center; color:#4b5668; font-size:13px; }
    #page-manage-users .users-no-match { display:none; }
    #page-manage-users .users-no-match span { display:block; margin-top:5px; color:#92908a; font-size:12px; }
    #page-manage-users .users-empty { padding:62px 20px; }
    #page-manage-users .users-empty h3 { color:#273449; font:700 17px 'Playfair Display',serif; }
    #page-manage-users .users-empty-icon { color:var(--gold); margin-bottom:13px; }
    #page-manage-users .users-empty-icon svg { width:56px; height:56px; }

    /* Pending verifications page only */
    #page-verifications .verification-shell { background:#fff; border:1px solid #e9e5dc; border-radius:16px; box-shadow:0 8px 28px rgba(15,27,45,.06); overflow:hidden; }
    #page-verifications .verification-head { display:flex; align-items:center; justify-content:space-between; gap:18px; padding:25px 28px 21px; border-bottom:1px solid #eeeae2; }
    #page-verifications .verification-head .ph-title { font-size:19px; }
    #page-verifications .verification-head .ph-sub { font-size:12.5px; margin-top:5px; }
    #page-verifications .verification-controls { display:grid; grid-template-columns:minmax(220px,1fr) 190px auto; gap:12px; padding:20px 28px; background:#fff; }
    #page-verifications .verification-search { position:relative; }
    #page-verifications .verification-search svg { position:absolute; left:13px; top:50%; transform:translateY(-50%); width:17px; height:17px; stroke:#8a9bb5; pointer-events:none; }
    #page-verifications .verification-search input, #page-verifications .verification-controls select { width:100%; height:42px; border:1px solid #e1ddd4; border-radius:9px; padding:0 13px; background:#fff; color:#263449; font:400 13px 'DM Sans',sans-serif; outline:none; }
    #page-verifications .verification-search input { padding-left:40px; }
    #page-verifications .verification-search input:focus, #page-verifications .verification-controls select:focus { border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,162,39,.1); }
    #page-verifications .verification-refresh, #page-verifications .verification-clear { height:42px; padding:0 15px; border-radius:9px; background:#fff; font:600 12px 'DM Sans',sans-serif; cursor:pointer; white-space:nowrap; transition:all .16s; }
    #page-verifications .verification-refresh { color:#80610b; border:1px solid rgba(201,162,39,.55); }
    #page-verifications .verification-refresh:hover { background:#fff9e9; border-color:var(--gold); }
    #page-verifications .verification-clear { color:#b0443b; border:1px solid rgba(192,57,43,.27); }
    #page-verifications .verification-clear:hover { background:#fff6f5; border-color:#c0392b; }
    #page-verifications .verification-table-wrap { overflow-x:auto; }
    #page-verifications .verification-table { width:100%; min-width:920px; border-collapse:collapse; }
    #page-verifications .verification-table thead th { padding:12px 20px; background:#faf9f6; border-top:1px solid #f0ede7; border-bottom:1px solid #ece8e0; color:#8b8170; font-size:10px; letter-spacing:.8px; }
    #page-verifications .verification-table tbody td { padding:15px 20px; border-bottom:1px solid #f0ede8; vertical-align:middle; font-size:12.5px; }
    #page-verifications .verification-table tbody tr:last-child td { border-bottom:0; }
    #page-verifications .verification-table tbody tr:hover td { background:#fdfcf9; }
    #page-verifications .resident-cell { min-width:245px; }
    #page-verifications .resident-main { display:flex; align-items:center; gap:11px; }
    #page-verifications .resident-avatar { flex:0 0 38px; width:38px; height:38px; display:grid; place-items:center; border-radius:50%; color:#263449; background:linear-gradient(135deg,#f5df9d,#d5ae43); font:700 15px 'Playfair Display',serif; }
    #page-verifications .resident-name { color:#1d2b40; font-size:13px; font-weight:700; }
    #page-verifications .resident-email { color:#8a8d92; font-size:11.5px; margin-top:3px; }
    #page-verifications .resident-address { display:block; color:#777b82; font-size:11px; margin:5px 0 0 49px; max-width:260px; line-height:1.4; }
    #page-verifications .verification-id-badge { display:inline-block; padding:5px 9px; border-radius:6px; color:#315b85; background:#edf5fc; border:1px solid #dbeaf7; font-size:10.5px; font-weight:600; white-space:nowrap; }
    #page-verifications .verification-date { color:#536071; white-space:nowrap; font-size:11.5px; }
    #page-verifications .verification-status { display:inline-flex; padding:5px 10px; border-radius:99px; color:#80610b; background:#fff7df; border:1px solid #f0dfaa; font-size:10.5px; font-weight:700; }
    #page-verifications .verification-actions { display:flex; align-items:center; gap:6px; white-space:nowrap; }
    #page-verifications .verification-actions .abtn { height:31px; padding:0 9px; display:inline-flex; align-items:center; gap:5px; border-radius:7px; font-size:10.5px; }
    #page-verifications .verification-actions svg { width:13px; height:13px; fill:none; stroke:currentColor; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; }
    #page-verifications .verification-actions .abtn-view { color:#536071; background:#fff; border:1px solid #dedbd3; }
    #page-verifications .verification-actions .abtn-view:hover { color:#7a5c00; border-color:var(--gold); background:#fffdf6; }
    #page-verifications .verification-actions .abtn-ok { color:#26734c; background:#edf8f1; border:1px solid #cbe8d5; }
    #page-verifications .verification-actions .abtn-ok:hover { background:#dff2e6; }
    #page-verifications .verification-actions .abtn-no { color:#b8443c; background:#fff5f4; border:1px solid #f0d0cc; }
    #page-verifications .verification-actions .abtn-no:hover { background:#fde9e6; }
    #page-verifications .verification-footer { display:flex; align-items:center; justify-content:space-between; gap:14px; padding:15px 24px; border-top:1px solid #eeeae2; color:#898273; font-size:11.5px; }
    #page-verifications .verification-pagination { display:flex; align-items:center; gap:5px; }
    #page-verifications .verification-pagination button { min-width:30px; height:30px; padding:0 8px; border:1px solid #e5e0d6; border-radius:7px; background:#fff; color:#596273; font:600 11px 'DM Sans',sans-serif; cursor:pointer; }
    #page-verifications .verification-pagination button:hover:not(:disabled) { border-color:var(--gold); }
    #page-verifications .verification-pagination button.current { background:var(--gold); border-color:var(--gold); color:#fff; }
    #page-verifications .verification-pagination button:disabled { opacity:.42; cursor:default; }
    #page-verifications .verification-empty { padding:64px 20px 68px; text-align:center; }
    #page-verifications .verification-empty svg { width:58px; height:58px; margin-bottom:14px; }
    #page-verifications .verification-empty h3 { color:#273449; font:700 17px 'Playfair Display',serif; margin-bottom:6px; }
    #page-verifications .verification-empty p { color:#92908a; font-size:12.5px; }
    #page-verifications .verification-no-results { display:none; padding:30px 16px; text-align:center; color:#898273; font-size:12px; }

    /* ── MAIN ── */
    .main { margin-left:var(--sb); flex:1; display:flex; flex-direction:column; min-height:100vh; overflow-x:hidden; min-width: 0; }
    .topbar { height:62px; background:var(--white); border-bottom:1px solid #e8e0d0; display:flex; align-items:center; padding:0 30px; gap:14px; position:sticky; top:0; z-index:50; flex-shrink: 0; }
    .tb-info { flex:1; min-width: 0; }
    .tb-title { font-family:'Playfair Display',serif; font-size:19px; font-weight:700; color:var(--navy); }
    .tb-sub   { font-size:11.5px; color:#a0917a; margin-top:1px; }
    .tb-right { display:flex; align-items:center; gap:10px; flex-shrink: 0; }
    .chip { font-size:12px; color:#7a6e58; background:var(--bg); border:1px solid #ddd4be; padding:6px 13px; border-radius:8px; font-weight:500; }

    /* ── CONTENT ── */
    .content { padding:28px 30px; flex:1; overflow-y:auto; overflow-x: hidden; position: relative; min-width: 0; }
    .page { display:none; width: 100%; }
    .page.active { display:block; animation:fadeUp .35s ease both; }
    @keyframes fadeUp { from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);} }
    
    /* ── MODAL OVERLAYS ── */
    .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; z-index: 1000; }
    .modal-overlay.open { display: flex; }
    
    .modal { background: var(--white); width: 100%; max-width: 500px; border-radius: 14px; border: 1px solid #ede8dd; overflow: hidden; animation: fadeUp .35s ease both; }
    .modal-head { padding: 20px 24px; border-bottom: 1px solid #f0ebe0; display: flex; align-items: center; justify-content: space-between; }
    .modal-head-title { font-family: 'Playfair Display', serif; font-size: 16px; font-weight: 700; color: var(--navy); }
    .modal-head-sub { font-size: 11.5px; color: #a0917a; margin-top: 2px; }
    .modal-close { background: none; border: none; font-size: 16px; cursor: pointer; color: #a0917a; }
    .modal-body { padding: 20px 24px; }
    .modal-foot { padding: 16px 24px; border-top: 1px solid #f0ebe0; display: flex; justify-content: flex-end; gap: 10px; background: #faf8f3; }
    
    .appt-detail-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
    .appt-detail-box { display: flex; flex-direction: column; gap: 4px; }
    .appt-detail-box label { font-size: 10px; font-weight: 700; text-transform: uppercase; color: #a0917a; }
    .appt-detail-box p { font-size: 13.5px; font-weight: 600; color: var(--navy); }
    .appt-concern-box { margin-bottom: 16px; }
    .appt-concern-box label { font-size: 10px; font-weight: 700; text-transform: uppercase; color: #a0917a; display: block; margin-bottom: 4px; }
    .appt-concern-box p { font-size: 13.5px; line-height: 1.5; color: #2a1f00; padding: 12px; background: var(--bg); border-radius: 8px; }
    
    .status-actions { display: flex; gap: 8px; }
    .sa-btn { padding: 8px 12px; border-radius: 8px; border: none; font-size: 12px; font-weight: 600; cursor: pointer; }
    .sa-confirm { background: rgba(30,126,74,0.1); color: #1e7e4a; }
    .sa-reschedule { background: rgba(201,162,39,0.1); color: #7a5c00; }
    .sa-cancel { background: rgba(192,57,43,0.1); color: #c0392b; }

    /* ── STAT CARDS ── */
    .stats { display:grid; grid-template-columns:repeat(4,1fr); gap:18px; margin-bottom:24px; }
    .scard { background:var(--white); border-radius:14px; border:1px solid #ede8dd; padding:20px 22px; position:relative; overflow:hidden; transition:box-shadow .2s,transform .2s; cursor:pointer; animation:fadeUp .4s ease both; }
    .scard:hover { box-shadow:0 8px 26px rgba(0,0,0,0.07); transform:translateY(-2px); }
    .scard::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; }
    .scard.c1::before { background:linear-gradient(90deg,#c9a227,#e6b93a); }
    .scard.c2::before { background:linear-gradient(90deg,#0f1b2d,#1e3050); }
    .scard.c3::before { background:linear-gradient(90deg,#1e7e4a,#27ae60); }
    .scard.c4::before { background:linear-gradient(90deg,#7c5c1e,#b8860b); }
    .sico { width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:19px; margin-bottom:14px; }
    .sico.c1{background:rgba(201,162,39,0.12);} .sico.c2{background:rgba(15,27,45,0.07);} .sico.c3{background:rgba(30,126,74,0.1);} .sico.c4{background:rgba(184,134,11,0.1);}
    .sval { font-family:'Playfair Display',serif; font-size:38px; font-weight:900; color:var(--navy); line-height:1; margin-bottom:3px; }
    .slbl { font-size:12px; color:#8a7a5a; font-weight:500; }
    .stag { position:absolute; top:20px; right:18px; font-size:10.5px; font-weight:600; padding:2px 8px; border-radius:6px; }
    .stag.warn{background:rgba(184,134,11,0.1);color:#8a6000;} .stag.ok{background:rgba(30,126,74,0.1);color:#1e7e4a;}
    .scard:nth-child(1){animation-delay:.05s;} .scard:nth-child(2){animation-delay:.1s;} .scard:nth-child(3){animation-delay:.15s;} .scard:nth-child(4){animation-delay:.2s;}

    /* ── PANELS ── */
    .panel { background:var(--white); border-radius:14px; border:1px solid #ede8dd; overflow:hidden; margin-bottom:18px; }
    .panel-half { background:var(--white); border-radius:14px; border:1px solid #ede8dd; overflow:hidden; }
    .row2 { display:grid; grid-template-columns:1fr 1fr; gap:18px; margin-bottom:18px; }

    .ph { padding:18px 22px 14px; border-bottom:1px solid #f0ebe0; display:flex; align-items:flex-start; justify-content:space-between; }
    .ph-title { font-family:'Playfair Display',serif; font-size:15px; font-weight:700; color:var(--navy); }
    .ph-sub { font-size:11.5px; color:#a0917a; margin-top:2px; }
    .ph-btn { font-size:12px; font-weight:600; color:var(--gold); background:none; border:none; cursor:pointer; padding:5px 11px; border-radius:7px; transition:background .18s; white-space:nowrap; }
    .ph-btn:hover { background:rgba(201,162,39,0.1); }

    /* ── ACTIVITY ── */
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

    /* ── TABLE ── */
    .tw { overflow-x:auto; }
    table { width:100%; border-collapse:collapse; }
    thead th { font-size:10px; font-weight:600; letter-spacing:1.2px; text-transform:uppercase; color:#a0917a; padding:9px 22px; text-align:left; background:#faf8f3; border-bottom:1px solid #f0ebe0; }
    tbody td { padding:13px 22px; font-size:13.5px; color:#2a1f00; border-bottom:1px solid #f5f1ea; }
    tbody tr:last-child td { border-bottom:none; }
    tbody tr:hover td { background:#faf8f3; }

    .badge { display:inline-flex; align-items:center; gap:5px; padding:3px 10px; border-radius:99px; font-size:11px; font-weight:600; }
    .badge::before { content:'●'; font-size:7px; }
    .badge.pending  { background:rgba(184,134,11,0.1); color:#7a5000; border:1px solid rgba(184,134,11,0.22); }
    .badge.approved { background:rgba(30,126,74,0.1);  color:#1a5c38; border:1px solid rgba(30,126,74,0.22); }
    .badge.rejected { background:rgba(192,57,43,0.1);  color:#7a1a10; border:1px solid rgba(192,57,43,0.22); }
    .badge.ready    { background:rgba(15,27,45,0.08);  color:#0f1b2d; border:1px solid rgba(15,27,45,0.18); }
    .badge.confirmed{ background:rgba(30,126,74,0.1);  color:#1a5c38; border:1px solid rgba(30,126,74,0.22); }
    .badge.review   { background:rgba(184,134,11,0.1); color:#7a5000; border:1px solid rgba(184,134,11,0.22); }
    .badge.addressed{ background:rgba(30,126,74,0.12); color:#1a5c38; border:1px solid rgba(30,126,74,0.25); }

    .abtn { padding:4px 11px; border-radius:7px; font-size:11.5px; font-weight:600; cursor:pointer; border:none; transition:all .15s; }
    .abtn-ok   { background:rgba(30,126,74,0.1); color:#1e7e4a; border:1px solid rgba(30,126,74,0.2); }
    .abtn-ok:hover   { background:rgba(30,126,74,0.2); }
    .abtn-no   { background:rgba(192,57,43,0.08); color:#c0392b; border:1px solid rgba(192,57,43,0.18); }
    .abtn-no:hover   { background:rgba(192,57,43,0.16); }
    .abtn-view { background:rgba(201,162,39,0.1); color:#7a5c00; border:1px solid rgba(201,162,39,0.2); }
    .abtn-view:hover { background:rgba(201,162,39,0.2); }
    .abtn-row  { display:flex; gap:5px; }
    .abtn-gold { background:var(--gold); color:var(--navy); border:none; padding:9px 18px; border-radius:9px; font-size:13px; font-weight:700; cursor:pointer; transition:all .18s; }
    .abtn-gold:hover { background:var(--gold2); box-shadow:0 4px 14px rgba(201,162,39,0.3); }
    .abtn-outline { background:transparent; color:var(--navy); border:1.5px solid #d4c9af; padding:9px 18px; border-radius:9px; font-size:13px; font-weight:600; cursor:pointer; transition:all .18s; }
    .abtn-outline:hover { border-color:var(--gold); color:#7a5c00; }

    /* Verification list */
    .vlist { padding:4px 0; }
    .vitem { display:flex; align-items:center; gap:12px; padding:13px 22px; border-bottom:1px solid #f5f1ea; transition:background .15s; }
    .vitem:last-child { border-bottom:none; }
    .vitem:hover { background:#faf8f3; }
    .vava { width:34px; height:34px; border-radius:50%; background:linear-gradient(135deg,var(--gold3),var(--gold)); display:flex; align-items:center; justify-content:center; font-family:'Playfair Display',serif; font-size:14px; font-weight:700; color:var(--navy); flex-shrink:0; }
    .vinfo { flex:1; }
    .vinfo strong { font-size:13px; font-weight:600; color:var(--navy); display:block; }
    .vinfo span   { font-size:11px; color:#8a7a5a; }
    .vid-tag { font-size:10px; color:#7a5c00; background:rgba(201,162,39,0.1); border:1px solid rgba(201,162,39,0.2); padding:2px 7px; border-radius:5px; white-space:nowrap; font-weight:500; margin-right:6px; }

    /* Report grid */
    .rgrid { display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:16px; padding:22px; }
    .rcard { border:1px solid #e0d9c8; border-radius:12px; padding:18px; cursor:pointer; transition:all .25s cubic-bezier(0.4, 0, 0.2, 1); background:var(--white); display:flex; align-items:center; gap:14px; position:relative; overflow:hidden; }
    .rcard:hover { border-color:var(--gold); background:#fffbee; transform: translateY(-2px); box-shadow:0 6px 20px rgba(201,162,39,0.12); }
    .rcard-ico { width:44px; height:44px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:20px; background:rgba(201,162,39,0.1); flex-shrink:0; transition: transform .2s; }
    .rcard:hover .rcard-ico { transform: scale(1.1); }
    .rcard-t h4 { font-size:13.5px; font-weight:700; color:var(--navy); }
    .rcard-t p  { font-size:11.5px; color:#8a7a5a; margin-top:3px; line-height:1.4; }

    /* Summary Stat Cards */
    .summary-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:24px; }
    .summary-stat { background:var(--bg); border:1.5px solid #e0d9c8; border-radius:12px; padding:16px; display:flex; flex-direction:column; gap:4px; transition: all .2s; }
    .summary-stat:hover { border-color: var(--gold); background: #fff; }
    .ss-lbl { font-size:10px; font-weight:700; text-transform:uppercase; color:#a0917a; letter-spacing:0.5px; }
    .ss-val { font-family:'Playfair Display',serif; font-size:26px; font-weight:900; color:var(--navy); }

    /* ── APPOINTMENT SCHEDULING ── */
    .appt-layout { display:grid; grid-template-columns:1fr 380px; gap:18px; align-items:start; }
    .tab-bar { display:flex; gap:4px; padding:16px 22px 0; border-bottom:1px solid #f0ebe0; }
    .tab-btn { padding:9px 16px; font-size:12.5px; font-weight:600; cursor:pointer; border:none; background:none; color:#a0917a; border-radius:8px 8px 0 0; border-bottom:2px solid transparent; transition:all .18s; margin-bottom:-1px; }
    .tab-btn:hover { color:var(--navy); background:rgba(201,162,39,0.06); }
    .tab-btn.active { color:var(--gold); border-bottom-color:var(--gold); background:rgba(201,162,39,0.07); }
    .tab-content { display:none; }
    .tab-content.active { display:block; }
    .avail-section { padding:20px 22px; }
    .avail-label { font-size:11px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:#a0917a; margin-bottom:12px; }
    .day-grid { display:grid; grid-template-columns:repeat(7,1fr); gap:6px; margin-bottom:22px; }
    .day-chip { padding:10px 4px; text-align:center; border-radius:9px; border:1.5px solid #e0d9c8; cursor:pointer; transition:all .18s; font-size:11.5px; font-weight:600; color:#a0917a; background:var(--bg); user-select:none; }
    .day-chip span { display:block; font-size:18px; margin-bottom:2px; }
    .day-chip:hover { border-color:var(--gold); color:#7a5c00; }
    .day-chip.on { background:rgba(201,162,39,0.12); border-color:var(--gold); color:#7a5c00; }
    .slot-builder { background:var(--bg); border:1px solid #e0d9c8; border-radius:12px; padding:16px; margin-bottom:18px; }
    .slot-builder-title { font-size:13px; font-weight:700; color:var(--navy); margin-bottom:12px; display:flex; align-items:center; gap:6px; }
    .slot-row { display:grid; grid-template-columns:1fr 1fr auto; gap:10px; align-items:end; margin-bottom:10px; }
    .field-grp { display:flex; flex-direction:column; gap:4px; }
    .field-grp label { font-size:10.5px; font-weight:600; color:#a0917a; letter-spacing:.5px; text-transform:uppercase; }
    .field-grp input, .field-grp select { padding:8px 11px; border:1.5px solid #d4c9af; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; color:var(--navy); background:var(--white); outline:none; transition:border-color .18s; }
    .field-grp input:focus, .field-grp select:focus { border-color:var(--gold); }
    .slots-list { display:flex; flex-direction:column; gap:6px; margin-bottom:14px; min-height:32px; }
    .slot-tag { display:flex; align-items:center; gap:8px; padding:8px 12px; border-radius:9px; background:rgba(201,162,39,0.08); border:1px solid rgba(201,162,39,0.2); font-size:12.5px; color:#5a4200; font-weight:500; }
    .slot-tag .slot-remove { margin-left:auto; width:18px; height:18px; border-radius:50%; background:rgba(192,57,43,0.1); color:#c0392b; border:none; cursor:pointer; font-size:12px; display:flex; align-items:center; justify-content:center; transition:background .15s; flex-shrink:0; }
    .slot-tag .slot-remove:hover { background:rgba(192,57,43,0.22); }
    .slot-empty { font-size:12px; color:#c0b090; text-align:center; padding:10px 0; font-style:italic; }
    .max-row { display:flex; align-items:center; gap:12px; padding:12px 14px; background:rgba(15,27,45,0.04); border-radius:9px; border:1px solid #e0d9c8; margin-bottom:16px; }
    .max-row label { font-size:12.5px; font-weight:600; color:var(--navy); flex:1; }
    .max-row input[type=number] { width:64px; padding:6px 10px; border:1.5px solid #d4c9af; border-radius:7px; font-size:13px; font-weight:600; text-align:center; color:var(--navy); background:var(--white); outline:none; }
    .max-row input[type=number]:focus { border-color:var(--gold); }
    .save-bar { display:flex; justify-content:flex-end; gap:10px; padding-top:4px; }
    .appt-status-bar { display:flex; align-items:center; gap:8px; padding:12px 22px; background:#faf8f3; border-bottom:1px solid #f0ebe0; flex-wrap:wrap; }
    .filter-chip { font-size:11.5px; font-weight:600; padding:4px 12px; border-radius:99px; cursor:pointer; border:1px solid #e0d9c8; background:var(--white); color:#8a7a5a; transition:all .15s; }
    .filter-chip:hover { border-color:var(--gold); color:#7a5c00; }
    .filter-chip.on { background:rgba(201,162,39,0.12); border-color:var(--gold); color:#7a5c00; }
    .filter-chip span { font-size:10px; background:var(--gold); color:var(--navy); border-radius:99px; padding:0 5px; margin-left:4px; font-weight:700; }
    .cal-panel { background:var(--white); border-radius:14px; border:1px solid #ede8dd; overflow:hidden; }
    .cal-head { padding:16px 18px 12px; border-bottom:1px solid #f0ebe0; display:flex; align-items:center; justify-content:space-between; }
    .cal-head-title { font-family:'Playfair Display',serif; font-size:14px; font-weight:700; color:var(--navy); }
    .cal-nav { display:flex; gap:4px; }
    .cal-nav button { width:26px; height:26px; border:1px solid #e0d9c8; background:var(--bg); border-radius:7px; cursor:pointer; font-size:12px; display:flex; align-items:center; justify-content:center; color:var(--navy); transition:all .15s; }
    .cal-nav button:hover { border-color:var(--gold); color:#7a5c00; }
    .cal-grid { padding:12px 14px; }
    .cal-dow { display:grid; grid-template-columns:repeat(7,1fr); text-align:center; margin-bottom:4px; }
    .cal-dow span { font-size:9px; font-weight:700; letter-spacing:.8px; color:#a0917a; padding:3px 0; text-transform:uppercase; }
    .cal-days { display:grid; grid-template-columns:repeat(7,1fr); gap:2px; }
    .cal-day { aspect-ratio:1; display:flex; align-items:center; justify-content:center; font-size:11.5px; font-weight:500; border-radius:7px; cursor:pointer; color:#6a5a40; transition:all .15s; position:relative; }
    .cal-day:hover { background:rgba(201,162,39,0.1); color:#7a5c00; }
    .cal-day.other { color:#c8bfac; }
    .cal-day.today { background:var(--navy); color:var(--white); font-weight:700; }
    .cal-day.has-slots { font-weight:700; color:var(--navy); }
    .cal-day.has-slots::after { content:''; position:absolute; bottom:3px; left:50%; transform:translateX(-50%); width:4px; height:4px; border-radius:50%; background:var(--gold); }
    .cal-day.selected { background:rgba(201,162,39,0.2); border:1.5px solid var(--gold); color:#7a5c00; }
    .cal-day.off { color:#d4cabb; cursor:default; }
    .cal-day.off:hover { background:none; color:#d4cabb; }
    .day-detail { padding:12px 14px 16px; border-top:1px solid #f0ebe0; }
    .day-detail-title { font-size:12px; font-weight:700; color:var(--navy); margin-bottom:8px; }
    .day-slot-list { display:flex; flex-direction:column; gap:5px; }
    .day-slot { display:flex; align-items:center; gap:8px; padding:7px 10px; border-radius:8px; background:var(--bg); border:1px solid #e0d9c8; }
    .day-slot .ds-time { font-size:12px; font-weight:700; color:var(--navy); min-width:72px; }
    .day-slot .ds-count { font-size:11px; color:#8a7a5a; flex:1; }
    .day-slot .ds-dot { width:7px; height:7px; border-radius:50%; background:var(--gold); flex-shrink:0; }
    .day-slot.full .ds-dot { background:#e74c3c; }
    .day-slot.full .ds-time { color:#c0392b; }
    .day-no-slots { font-size:12px; color:#c0b090; font-style:italic; text-align:center; padding:10px 0; }

    /* ── TOAST ── */
    .toast-wrap { position:fixed; bottom:30px; right:30px; display:flex; flex-direction:column; gap:10px; z-index:2000; pointer-events:none; }
    .toast { 
      background:var(--navy); color:var(--white); padding:12px 20px; border-radius:10px; font-size:13px; font-weight:600;
      box-shadow:0 10px 30px rgba(0,0,0,0.2); display:flex; align-items:center; gap:10px;
      transform:translateX(100px); opacity:0; transition:all .4s cubic-bezier(0.175, 0.885, 0.32, 1.275); pointer-events:auto;
      border-left:4px solid var(--gold);
    }
    .toast.show { transform:translateX(0); opacity:1; }
    .toast.t-warn { border-left-color:#e74c3c; }

    /* ── CONCERNS & MEETINGS ── */
    #page-concerns .concerns-shell { background:#fff; border:1px solid #e8e3d9; border-radius:15px; box-shadow:0 8px 26px rgba(15,27,45,.06); overflow:hidden; }
    #page-concerns .concerns-head { display:flex; align-items:center; justify-content:space-between; gap:18px; padding:22px 24px; border-bottom:1px solid #eeeae2; }
    #page-concerns .concerns-title-wrap { display:flex; align-items:center; gap:12px; min-width:220px; }
    #page-concerns .concerns-title-icon { width:42px; height:42px; display:grid; place-items:center; flex:0 0 42px; border-radius:50%; background:#fff7e3; color:#9b7415; }
    #page-concerns .concerns-title-icon svg { width:21px; height:21px; fill:none; stroke:currentColor; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; }
    #page-concerns .concerns-head .ph-title { font-size:19px; }
    #page-concerns .concerns-head .ph-sub { margin-top:5px; font-size:12px; }
    #page-concerns .concerns-head-actions { display:flex; align-items:center; justify-content:flex-end; gap:8px; flex-wrap:wrap; }
    #page-concerns .concerns-head .filter-chip { margin:0 !important; }
    #page-concerns .concerns-refresh { height:34px; padding:0 12px; border:1px solid rgba(212,167,44,.6); border-radius:8px; background:#fff; color:#80610b; font:600 11.5px 'DM Sans',sans-serif; cursor:pointer; transition:background .15s,border-color .15s; }
    #page-concerns .concerns-refresh:hover { background:#fff7e3; border-color:#d4a72c; }
    #page-concerns .concerns-refresh svg { width:14px; height:14px; fill:none; stroke:currentColor; stroke-width:1.8; stroke-linecap:round; stroke-linejoin:round; vertical-align:-3px; margin-right:4px; }
    #page-concerns .concern-layout { display:grid; grid-template-columns:minmax(0,35%) minmax(0,65%); align-items:stretch; min-height:600px; background:#fff; }
    #page-concerns .concern-list-column { min-width:0; display:flex; flex-direction:column; border-right:1px solid #e8e3d9; background:#fff; }
    #page-concerns .concern-search { position:relative; padding:16px; border-bottom:1px solid #eeeae2; }
    #page-concerns .concern-search svg { position:absolute; left:29px; top:50%; transform:translateY(-50%); width:16px; height:16px; fill:none; stroke:#8793a5; stroke-width:1.8; stroke-linecap:round; pointer-events:none; }
    #page-concerns .concern-search input { width:100%; height:39px; padding:0 11px 0 37px; border:1px solid #e8e3d9; border-radius:8px; outline:none; color:#17243b; font:400 11.5px 'DM Sans',sans-serif; }
    #page-concerns .concern-search input:focus { border-color:#d4a72c; box-shadow:0 0 0 3px rgba(212,167,44,.1); }
    #page-concerns .concern-list-wrap { flex:1; background:#fff; overflow-y:auto; max-height:700px; }
    #page-concerns .concern-item { padding:15px 17px; border-bottom:1px solid #f0ede7; border-left:3px solid transparent; transition:background .16s,border-color .16s; cursor:pointer; position:relative; }
    #page-concerns .concern-item:hover { background:#faf9f6; }
    #page-concerns .concern-item.active { background:#fff7e3; border-left-color:#d4a72c; padding-left:17px; box-shadow:none; }
    #page-concerns .concern-item.active .ci-user { font-weight:700; }
    #page-concerns .concern-item.addressed { opacity:1; }
    #page-concerns .ci-head { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:6px; gap:8px; }
    #page-concerns .ci-user { min-width:0; font-size:13px; font-weight:600; color:#17243b; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    #page-concerns .ci-purpose { font-size:11.5px; font-weight:500; color:#536174; margin-bottom:5px; display:-webkit-box; -webkit-line-clamp:1; -webkit-box-orient:vertical; overflow:hidden; }
    #page-concerns .ci-date { font-size:10.5px; color:#8793a5; font-weight:500; }
    #page-concerns .concern-list-status, #page-concerns .concern-status-badge { display:inline-flex; align-items:center; gap:5px; padding:4px 8px; border:1px solid #e8e3d9; border-radius:99px; background:#f7f5f0; color:#657082; font-size:10px; font-weight:700; line-height:1.2; white-space:nowrap; }
    #page-concerns .concern-list-status::before, #page-concerns .concern-status-badge::before { content:''; width:6px; height:6px; border-radius:50%; background:currentColor; }
    #page-concerns .concern-list-status.pending, #page-concerns .concern-list-status.review, #page-concerns .concern-status-badge.pending, #page-concerns .concern-status-badge.review { color:#80610b; background:#fff7e3; border-color:#f0dfaa; }
    #page-concerns .concern-list-status.addressed, #page-concerns .concern-status-badge.addressed { color:#26734c; background:#e7f4ec; border-color:#cbe8d5; }
    #page-concerns .concern-list-status.cancelled, #page-concerns .concern-status-badge.cancelled { color:#b8443c; background:#fceaea; border-color:#f0d0cc; }
    #page-concerns .concern-detail-panel { min-width:0; background:#fff; padding:21px 23px; display:flex; flex-direction:column; position:relative; min-height:100%; }
    #page-concerns .cdp-title-row { display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:18px; padding-bottom:12px; border-bottom:1px solid #eeeae2; }
    #page-concerns .cdp-title { margin:0; padding:0; border:0; font-size:15px; font-weight:700; color:#17243b; }
    #page-concerns .cdp-empty { flex:1; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#8793a5; text-align:center; padding:40px; font-size:12px; }
    #page-concerns .cdp-empty svg { width:40px; height:40px; margin-bottom:12px; fill:none; stroke:#c5b276; stroke-width:1.5; stroke-linecap:round; stroke-linejoin:round; }
    #page-concerns .cdp-body { flex:1; overflow-y:auto; }
    #page-concerns .cdp-info-row { display:grid; grid-template-columns:34px minmax(0,1fr); align-items:start; gap:11px; margin-bottom:18px; }
    #page-concerns .cdp-row-icon { width:32px; height:32px; display:grid; place-items:center; border-radius:50%; background:#f8f4e9; color:#977626; }
    #page-concerns .cdp-row-icon svg { width:16px; height:16px; fill:none; stroke:currentColor; stroke-width:1.7; stroke-linecap:round; stroke-linejoin:round; }
    #page-concerns .cdp-info-row label { font-size:9.5px; font-weight:700; letter-spacing:.55px; text-transform:uppercase; color:#8793a5; display:block; margin:1px 0 4px; }
    #page-concerns .cdp-info-row p { font-size:13px; font-weight:600; line-height:1.5; color:#17243b; overflow-wrap:anywhere; }
    #page-concerns #cdp-notes { font-weight:400; white-space:pre-wrap; }
    #page-concerns .cdp-actions { margin-top:17px; padding:15px; border:1px solid #eee8da; border-radius:10px; background:#faf8f3; }
    #page-concerns .cdp-actions-title { margin-bottom:10px; color:#6d6658; font-size:10px; font-weight:700; letter-spacing:.7px; text-transform:uppercase; }
    #page-concerns .cdp-actions-buttons { display:flex; gap:9px; flex-wrap:wrap; }
    #page-concerns #btn-mark-addressed { display:inline-flex; align-items:center; gap:7px; background:#d4a72c; color:#162338; padding:9px 15px; border-radius:8px; font-size:12px; }
    #page-concerns #btn-mark-addressed:hover { background:#e3b83e; box-shadow:0 4px 12px rgba(212,167,44,.24); }
    #page-concerns #btn-mark-addressed:focus-visible, #page-concerns .concerns-refresh:focus-visible, #page-concerns .filter-chip:focus-visible { outline:3px solid rgba(212,167,44,.35); outline-offset:2px; }
    #page-concerns #btn-mark-addressed svg { width:15px; height:15px; fill:none; stroke:currentColor; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; }
    #page-concerns .cdp-actions .abtn-outline { display:inline-flex; align-items:center; }
    @media (max-width: 900px) {
      #page-doc-requests .documents-head { padding:21px 20px 18px; }
      #page-doc-requests .documents-toolbar { grid-template-columns:minmax(180px,1fr) 1fr; padding:16px 20px; }
      #page-doc-requests .documents-clear { justify-self:start; }
      #page-manage-users .users-head { padding:21px 20px 18px; }
      #page-manage-users .users-toolbar { grid-template-columns:minmax(180px,1fr) 170px; padding:16px 20px; }
      #page-manage-users .users-clear { grid-column:2; }
      #page-verifications .verification-head { padding:21px 20px 18px; }
      #page-verifications .verification-controls { grid-template-columns:minmax(180px,1fr) 170px; padding:16px 20px; }
      #page-verifications .verification-clear { grid-column:2; }
      #page-concerns .concerns-head { align-items:flex-start; flex-direction:column; }
      #page-concerns .concerns-head-actions { justify-content:flex-start; }
      #page-concerns .concern-layout { grid-template-columns:minmax(0,38%) minmax(0,62%); }
    }
    @media (max-width: 600px) {
      #page-doc-requests .documents-head { align-items:flex-start; flex-direction:column; }
      #page-doc-requests .documents-head .documents-refresh { align-self:flex-end; margin-top:-4px; }
      #page-doc-requests .documents-toolbar { grid-template-columns:1fr; gap:9px; padding:14px; }
      #page-doc-requests .documents-search { grid-column:1; }
      #page-doc-requests .documents-toolbar select { min-width:0; }
      #page-doc-requests .documents-footer { padding:13px 14px; align-items:flex-start; flex-direction:column; }
      #page-manage-users .users-head { align-items:flex-start; flex-direction:column; }
      #page-manage-users .users-head .users-refresh { align-self:flex-end; margin-top:-4px; }
      #page-manage-users .users-toolbar { grid-template-columns:1fr 1fr; gap:9px; padding:14px; }
      #page-manage-users .users-search { grid-column:1 / -1; }
      #page-manage-users .users-clear { grid-column:auto; }
      #page-manage-users .users-footer { padding:13px 14px; align-items:flex-start; flex-direction:column; }
      #page-verifications .verification-head { align-items:flex-start; flex-direction:column; }
      #page-verifications .verification-head .verification-refresh { align-self:flex-end; margin-top:-4px; }
      #page-verifications .verification-controls { grid-template-columns:1fr 1fr; gap:9px; padding:14px 14px; }
      #page-verifications .verification-search { grid-column:1 / -1; }
      #page-verifications .verification-clear { grid-column:auto; }
      #page-verifications .verification-footer { padding:13px 14px; align-items:flex-start; flex-direction:column; }
      #page-concerns .concerns-head { padding:18px 16px; }
      #page-concerns .concerns-head-actions { width:100%; justify-content:flex-start; }
      #page-concerns .concern-layout { grid-template-columns:minmax(0,1fr); min-height:0; }
      #page-concerns .concern-list-column { border-right:0; border-bottom:1px solid #e8e3d9; }
      #page-concerns .concern-list-wrap { max-height:340px; }
      #page-concerns .concern-detail-panel { min-height:360px; padding:18px 16px; }
      #page-concerns .cdp-empty { min-height:190px; padding:24px; }
    }
  </style>
</head>
<body>
<aside class="sidebar">
  <div class="sb-logo">
    <div class="sb-mark">B</div>
    <div>
      <div class="sb-words">BUHU<span>AN</span></div>
      <span class="sb-sub">Admin Portal</span>
    </div>
  </div>

  <div class="nav-grp">
    <div class="nav-grp-lbl">Overview</div>
    <a class="nav-lnk active" onclick="showPage('dashboard',this)"><div class="nav-ico">🏠</div> Dashboard</a>
    <a class="nav-lnk" onclick="showPage('reports',this)"><div class="nav-ico">📊</div> System Records & Reports</a>
  </div>

  <div class="nav-grp">
    <div class="nav-grp-lbl">User Account Management</div>
    <a class="nav-lnk" onclick="showPage('verifications',this)"><div class="nav-ico">⏳</div> Pending Verifications<span class="nav-cnt">{{ $pendingVerifications }}</span></a>
    <a class="nav-lnk" onclick="showPage('manage-users',this)"><div class="nav-ico">👥</div> Manage Users</a>
  </div>

  <div class="nav-grp">
    <div class="nav-grp-lbl">Barangay Services</div>
    <a class="nav-lnk" onclick="showPage('doc-requests',this)"><div class="nav-ico">📄</div> Document Requests<span class="nav-cnt">{{ $totalDocuments }}</span></a>
    <a class="nav-lnk" onclick="showPage('appointments',this)"><div class="nav-ico">📅</div> Appointment Scheduling</a>
    <a class="nav-lnk" onclick="showPage('concerns',this)"><div class="nav-ico">📋</div> Concerns & Meetings</a>
  </div>

  <div class="nav-grp">
    <div class="nav-grp-lbl">System</div>
    <a class="nav-lnk" onclick="showPage('settings',this)"><div class="nav-ico">⚙️</div> Settings</a>
  </div>

  <div class="sb-foot">
    <div class="sb-admin-card">
      <div style="display:flex; align-items:center; gap:10px;">
        <div class="sb-ava">{{ strtoupper(substr(auth()->user()->first_name ?? 'A', 0, 1)) }}</div>
        <div class="sb-ainfo">
          <div class="sb-aname">{{ auth()->user()->name ?? 'Admin' }}</div>
          <div class="sb-arole">Barangay Administrator</div>
        </div>
      </div>
      <form method="POST" action="{{ route('logout') }}" style="margin:0;">
        @csrf
        <button type="submit" class="logout-icon" title="Log out">⏻</button>
      </form>
    </div>
  </div>
</aside>

<!-- ══ MAIN ══ -->
<div class="main">
  <div class="topbar">
    <div class="tb-info">
      <div class="tb-title" id="page-title">Dashboard</div>
      <div class="tb-sub">BUHUAN · Barangay Buhuan · Role: Administrator</div>
    </div>
    <div class="tb-right">
      <div class="chip" id="dchip">—</div>
    </div>
  </div>

  <div class="content">

    <!-- DASHBOARD -->
    <div class="page active" id="page-dashboard">
      <div class="stats">
        <div class="scard c1" onclick="showPage('manage-users',document.querySelector('[onclick*=manage-users]'))">
          <div class="stag ok">Approved</div>
          <div class="sico c1">👥</div>
          <div class="sval">{{ $totalApprovedResidents }}</div>
          <div class="slbl">Approved Residents</div>
        </div>
        <div class="scard c4" onclick="showPage('manage-users',document.querySelector('[onclick*=manage-users]'))">
          <div class="stag warn">Rejected</div>
          <div class="sico c4">🚫</div>
          <div class="sval">{{ $totalRejectedResidents }}</div>
          <div class="slbl">Rejected Residents</div>
        </div>
        <div class="scard c2" onclick="showPage('verifications',document.querySelector('[onclick*=verifications]'))">
          <div class="stag warn">Needs action</div>
          <div class="sico c2">⏳</div>
          <div class="sval">{{ $pendingVerifications }}</div>
          <div class="slbl">Pending Verifications</div>
        </div>
        <div class="scard c3" onclick="showPage('doc-requests',document.querySelector('[onclick*=doc-requests]'))">
          <div class="stag ok">{{ $totalDocuments }} total</div>
          <div class="sico c3">📄</div>
          <div class="sval">{{ $totalDocuments }}</div>
          <div class="slbl">Document Requests</div>
        </div>
      </div>
      <div class="row2">
        <div class="panel-half">
          <div class="ph"><div><div class="ph-title">Recent Activity</div><div class="ph-sub">Latest system‑wide actions</div></div></div>
          <div class="alog"><div class="aitem"><div class="adot green">✓</div><div class="abody"><strong>System ready</strong><p>Admin dashboard loaded</p></div><div class="atime">just now</div></div></div>
        </div>
        <div class="panel-half">
          <div class="ph"><div><div class="ph-title">Quick Navigation</div><div class="ph-sub">Go to a section</div></div></div>
          <div style="padding:16px 18px;display:flex;flex-direction:column;gap:10px;">
            <div class="rcard" onclick="showPage('verifications',document.querySelector('[onclick*=verifications]'))"><div class="rcard-ico">⏳</div><div class="rcard-t"><h4>Pending Verifications</h4><p>{{ $pendingVerifications }} accounts awaiting approval</p></div></div>
            <div class="rcard" onclick="showPage('doc-requests',document.querySelector('[onclick*=doc-requests]'))"><div class="rcard-ico">📄</div><div class="rcard-t"><h4>Document Requests</h4><p>{{ $totalDocuments }} requests to process</p></div></div>
            <div class="rcard" onclick="showPage('appointments',document.querySelector('[onclick*=appointments]'))"><div class="rcard-ico">📅</div><div class="rcard-t"><h4>Appointment Scheduling</h4><p>Manage resident schedules</p></div></div>
            <div class="rcard" onclick="showPage('reports',document.querySelector('[onclick*=reports]'))"><div class="rcard-ico">📊</div><div class="rcard-t"><h4>System Records & Reports</h4><p>Export barangay records</p></div></div>
          </div>
        </div>
      </div>
    </div>

    <!-- PENDING VERIFICATIONS -->
    <div class="page" id="page-verifications">
      <div class="verification-shell">
        <div class="verification-head">
          <div><div class="ph-title">Pending Account Verifications</div><div class="ph-sub">Residents awaiting identity verification &amp; admin approval</div></div>
          <button type="button" class="verification-refresh" onclick="window.location.reload()"><svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:-2px;margin-right:5px"><path d="M20 7v5h-5M4 17v-5h5"/><path d="M5.6 9A7 7 0 0 1 18 6l2 6M4 12l2 6a7 7 0 0 0 12.4-3"/></svg>Refresh</button>
        </div>
        @if($pendingUsers->isEmpty())
          <div class="verification-empty">
            <svg viewBox="0 0 64 64" fill="none" aria-hidden="true"><path d="M18 7h19l12 12v35a4 4 0 0 1-4 4H18a4 4 0 0 1-4-4V11a4 4 0 0 1 4-4Z" stroke="#c9a227" stroke-width="2.5"/><path d="M37 8v12h12M22 31h12M22 38h8" stroke="#c9a227" stroke-width="2.5" stroke-linecap="round"/><circle cx="43" cy="43" r="10" fill="#edf8f1" stroke="#58a879" stroke-width="2.5"/><path d="m39 43 3 3 5-6" stroke="#368958" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <h3>No pending verifications</h3><p>All resident accounts have been reviewed.</p>
          </div>
        @else
          <div class="verification-controls">
            <label class="verification-search"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m16 16 4 4"/></svg><input type="search" id="verification-search" placeholder="Search name, email, or address..." aria-label="Search pending residents"></label>
            <select id="verification-id-filter" aria-label="Filter by ID type">
              <option value="">All ID Types</option>
              <option value="PhilSys ID">PhilSys ID</option>
              <option value="Driver's License">Driver's License</option>
              <option value="Passport">Passport</option>
              <option value="Voter's ID">Voter's ID</option>
              <option value="SSS / GSIS">SSS / GSIS</option>
              <option value="PhilHealth">PhilHealth</option>
              <option value="UMID">UMID</option>
              <option value="Barangay ID">Barangay ID</option>
              <option value="Valid ID">Valid ID</option>
              @if($pendingUsers->contains(fn ($user) => ! in_array($user->id_type, ["PhilSys ID", "Driver's License", 'Passport', "Voter's ID", 'SSS / GSIS', 'PhilHealth', 'UMID', 'Barangay ID'], true)))
                @foreach($pendingUsers->pluck('id_type')->filter(fn ($type) => ! in_array($type, ["PhilSys ID", "Driver's License", 'Passport', "Voter's ID", 'SSS / GSIS', 'PhilHealth', 'UMID', 'Barangay ID'], true))->unique()->sort() as $idType)
                  <option value="{{ $idType }}">{{ $idType }}</option>
                @endforeach
              @endif
            </select>
            <button type="button" class="verification-clear" id="verification-clear">Clear Filters</button>
          </div>
          <div class="verification-table-wrap">
            <table class="verification-table"><thead><tr><th>Resident Information</th><th>ID Type</th><th>Submitted On</th><th>Status</th><th>Actions</th></tr></thead>
              <tbody id="verification-table-body">
                @foreach($pendingUsers as $user)
                  @php($residentName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')))
                  <tr class="verification-row" data-id-type="{{ $user->id_type ?? 'Valid ID' }}" data-search="{{ $residentName }} {{ $user->email ?? '' }} {{ $user->address ?? '' }}">
                    <td class="resident-cell"><div class="resident-main"><div class="resident-avatar">{{ strtoupper(substr($user->first_name ?? '', 0, 1)) }}</div><div><div class="resident-name">{{ $residentName }}</div><div class="resident-email">{{ $user->email ?? '' }}</div></div></div><span class="resident-address">{{ $user->address ?? 'N/A' }}</span></td>
                    <td><span class="verification-id-badge">{{ $user->id_type ?? 'Valid ID' }}</span></td>
                    <td><div class="verification-date">{{ $user->created_at->format('M d, Y') }}</div><div class="resident-email">{{ $user->created_at->format('g:i A') }}</div></td>
                    <td><span class="verification-status">Pending</span></td>
                    <td><div class="verification-actions">
                      <button type="button" class="abtn abtn-view v-modal-trigger" data-id="{{ $user->id }}" data-name="{{ $residentName }}" data-email="{{ $user->email ?? '' }}" data-address="{{ $user->address ?? '' }}" data-id-type="{{ $user->id_type ?? 'Valid ID' }}" data-id-path="/storage/{{ $user->valid_id_path }}"><svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>View</button>
                      <form action="{{ route('admin.users.approve', $user) }}" method="POST" style="display:inline;">@csrf<button type="submit" class="abtn abtn-ok"><svg viewBox="0 0 24 24"><path d="m5 12 4 4L19 6"/></svg>Approve</button></form>
                      <button type="button" class="abtn abtn-no" onclick="showRejectModal({{ $user->id }})"><svg viewBox="0 0 24 24"><path d="m6 6 12 12M18 6 6 18"/></svg>Reject</button>
                      <form id="reject-form-{{ $user->id }}" action="{{ route('admin.users.reject', $user) }}" method="POST" style="display:none;">@csrf<input type="hidden" name="reason" id="reject-reason-{{ $user->id }}"></form>
                    </div></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="verification-no-results" id="verification-no-results">No residents match these filters.</div>
          </div>
          <div class="verification-footer"><span id="verification-count"></span><div class="verification-pagination" id="verification-pagination" aria-label="Pending residents pages"></div></div>
        @endif
      </div>
    </div>

    <div class="page" id="page-manage-users">
      <div class="users-shell">
        <div class="users-head">
          <div><div class="ph-title">Manage Users</div><div class="ph-sub">All registered resident accounts (Approved &amp; Rejected)</div></div>
          <button type="button" class="users-refresh" onclick="window.location.reload()"><svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:-2px;margin-right:5px"><path d="M20 7v5h-5M4 17v-5h5"/><path d="M5.6 9A7 7 0 0 1 18 6l2 6M4 12l2 6a7 7 0 0 0 12.4-3"/></svg>Refresh</button>
        </div>
        @if($allResidents->isEmpty())
          <div class="users-empty"><div class="users-empty-icon"><svg viewBox="0 0 64 64" fill="none" aria-hidden="true"><circle cx="25" cy="21" r="10" stroke="currentColor" stroke-width="2.5"/><path d="M7 53c1-11 7-17 18-17s17 6 18 17M44 18h13M50.5 11.5v13" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><circle cx="48" cy="45" r="10" stroke="currentColor" stroke-width="2.5"/><path d="m44 45 3 3 5-6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div><h3>No registered users available.</h3></div>
        @else
          <div class="users-toolbar">
            <label class="users-search"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m16 16 4 4"/></svg><input type="search" id="users-search" placeholder="Search name, email, or address..." aria-label="Search residents"></label>
            <select id="users-status-filter" aria-label="Filter by account status"><option value="">All Status</option><option value="active">Active</option><option value="rejected">Rejected</option></select>
            <button type="button" class="users-clear" id="users-clear">Clear Filters</button>
          </div>
          <div class="users-table-wrap">
            <table class="users-table">
              <thead><tr><th>Name</th><th>Email</th><th>Address</th><th>Registered</th><th>Status</th><th>Action</th></tr></thead>
              <tbody id="users-table-body">
                @foreach($allResidents as $u)
                  @php($manageName = trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')))
                  <tr class="manage-user-row" data-status="{{ $u->is_approved ? 'active' : 'rejected' }}" data-search="{{ $manageName }} {{ $u->email ?? '' }} {{ $u->address ?? 'Barangay Buhuan' }}">
                    <td><div class="users-name-cell"><span class="users-avatar">{{ strtoupper(substr($u->first_name ?? '', 0, 1)) }}</span><strong>{{ $manageName }}</strong></div></td>
                    <td class="users-email">{{ $u->email ?? '' }}</td>
                    <td><div class="users-address"><svg viewBox="0 0 24 24"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg><span>{{ $u->address ?? 'Barangay Buhuan' }}</span></div></td>
                    <td class="users-date">{{ $u->created_at->format('M d, Y') }}</td>
                    <td>@if($u->is_approved)<span class="users-status active"><i></i>Active</span>@else<span class="users-status rejected" title="Reason: {{ $u->rejection_reason }}"><i></i>Rejected</span>@endif</td>
                    <td><div class="users-actions">
                      @if($u->is_approved)
                        <form action="{{ route('admin.users.reject', $u) }}" method="POST" onsubmit="return confirm('Are you sure you want to reject this resident?')">
                          @csrf
                          <button type="submit" class="users-action reject"><svg viewBox="0 0 24 24"><path d="m6 6 12 12M18 6 6 18"/></svg>Reject</button>
                        </form>
                      @else
                        <form action="{{ route('admin.users.approve', $u) }}" method="POST" onsubmit="return confirm('Are you sure you want to approve this resident?')">
                          @csrf
                          <button type="submit" class="users-action approve"><svg viewBox="0 0 24 24"><path d="m5 12 4 4L19 6"/></svg>Approve</button>
                        </form>
                      @endif
                      <form action="{{ route('admin.users.destroy', $u) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this resident account?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="users-action delete"><svg viewBox="0 0 24 24"><path d="M4 7h16M10 11v6M14 11v6M5 7l1 14h12l1-14M9 7V4h6v3"/></svg>Delete</button>
                      </form>
                    </div></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="users-no-match" id="users-no-match">No users found.<span>Try adjusting your search or filters.</span></div>
          </div>
          <div class="users-footer"><span id="users-count"></span><div class="users-pagination" id="users-pagination" aria-label="Manage users pages"></div></div>
        @endif
      </div>
    </div>

    <!-- ══ DOCUMENT REQUESTS -->
    <div class="page" id="page-doc-requests">
      <div class="documents-shell">
        <div class="documents-head">
          <div class="documents-title-wrap">
            <div class="documents-title-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h8"/></svg></div>
            <div><div class="ph-title">Document Request Processing &amp; Tracking</div><div class="ph-sub">Process, approve, and monitor resident document requests</div></div>
          </div>
          <button type="button" class="documents-refresh" onclick="window.location.reload()"><svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:-2px;margin-right:5px"><path d="M20 7v5h-5M4 17v-5h5"/><path d="M5.6 9A7 7 0 0 1 18 6l2 6M4 12l2 6a7 7 0 0 0 12.4-3"/></svg>Refresh</button>
        </div>
        @if($documentRequests->isEmpty())
          <div class="documents-empty"><svg viewBox="0 0 64 64" fill="none" aria-hidden="true"><path d="M18 7h19l12 12v35a4 4 0 0 1-4 4H18a4 4 0 0 1-4-4V11a4 4 0 0 1 4-4Z" stroke="currentColor" stroke-width="2.5"/><path d="M37 8v12h12M22 31h20M22 38h15" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><circle cx="44" cy="47" r="9" fill="#edf8f1" stroke="#58a879" stroke-width="2.5"/><path d="m40 47 3 3 5-6" stroke="#368958" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg><h3>No document requests available</h3><p>There are currently no document requests to display.</p></div>
        @else
          <div class="documents-toolbar">
            <label class="documents-search"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m16 16 4 4"/></svg><input type="search" id="documents-search" placeholder="Search resident name, document type, or purpose..." aria-label="Search document requests"></label>
            @php($residentDocumentTypes = ['Barangay Clearance', 'Certificate of Indigency', 'Certificate of Residency', 'Barangay Identification'])
            <select id="documents-type-filter" aria-label="Filter by document type">
              <option value="">All Document Types</option>
              @foreach($residentDocumentTypes as $documentType)<option value="{{ $documentType }}">{{ $documentType }}</option>@endforeach
              @foreach($documentRequests->pluck('document_type')->filter()->unique()->sort() as $documentType)
                @if(! in_array($documentType, $residentDocumentTypes, true))<option value="{{ $documentType }}">{{ $documentType }}</option>@endif
              @endforeach
            </select>
            <button type="button" class="documents-clear" id="documents-clear"><svg viewBox="0 0 24 24"><path d="M4 5h16l-6 7v6l-4 2v-8z"/><path d="m17 17 4 4m0-4-4 4"/></svg>Clear Filters</button>
          </div>
          <div class="documents-table-wrap">
            <table class="documents-table"><thead><tr><th>Request #</th><th>Resident</th><th>Document Type</th><th>Purpose</th><th>Date Filed</th><th>Action</th></tr></thead>
              <tbody id="documents-table-body">
                @foreach($documentRequests as $doc)
                  @php($residentFullName = trim(($doc->user->first_name ?? '') . ' ' . ($doc->user->last_name ?? '')))
                  <tr class="document-request-row" data-document-type="{{ $doc->document_type ?? '' }}" data-search="{{ $residentFullName }} {{ $doc->user->email ?? '' }} {{ $doc->user->address ?? '' }} {{ $doc->document_type ?? '' }} {{ $doc->purpose ?? '' }}">
                    <td><span class="request-number">#{{ str_pad($doc->id, 4, '0', STR_PAD_LEFT) }}</span></td>
                    <td><div class="document-resident"><span class="document-avatar">{{ strtoupper(substr($doc->user->first_name ?? '', 0, 1)) }}</span><div><div class="document-resident-name">{{ $residentFullName }}</div>@if($doc->user->email ?? false)<div class="document-resident-meta">{{ $doc->user->email }}</div>@endif @if($doc->user->address ?? false)<div class="document-resident-meta">{{ $doc->user->address }}</div>@endif</div></div></td>
                    <td><span class="document-type-badge"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h6"/></svg>{{ $doc->document_type ?? '' }}</span></td>
                    <td><span class="document-purpose">{{ $doc->purpose ?? '' }}</span></td>
                    <td><div class="document-date"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg><span>{{ $doc->created_at->format('M d, Y') }}<span class="document-resident-meta" style="display:block">{{ $doc->created_at->format('g:i A') }}</span></span></div></td>
                    <td><button type="button" class="document-view" onclick="openDocModal({{ $doc->id }}, '{{ addslashes($doc->user->first_name ?? '') }} {{ addslashes($doc->user->last_name ?? '') }}', '{{ addslashes($doc->document_type ?? '') }}', '{{ addslashes($doc->purpose ?? '') }}', '{{ $doc->status ?? 'pending' }}')"><svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>View</button></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="documents-no-match" id="documents-no-match">No matching requests found.<span>Try adjusting your search or filters.</span></div>
          </div>
          <div class="documents-footer"><span id="documents-count"></span><div class="documents-pagination" id="documents-pagination" aria-label="Document request pages"></div></div>
        @endif
      </div>
    </div>

    <!-- APPOINTMENT SCHEDULING -->
    <div class="page" id="page-appointments">
      <div class="panel" style="margin-bottom:18px;">
        <div class="tab-bar"><button class="tab-btn active" onclick="switchTab('incoming',this)">📥 Incoming Appointments</button><button class="tab-btn" onclick="switchTab('availability',this)">🗓️ Manage Availability</button></div>
        <div class="tab-content active" id="tab-incoming">
          <div class="appt-status-bar">
            <span style="font-size:11.5px;font-weight:600;color:#8a7a5a;margin-right:4px;">Filter:</span>
            <div class="filter-chip on" onclick="filterAppt('all',this)">All <span>{{ $apptCounts['all'] }}</span></div>
            <div class="filter-chip" onclick="filterAppt('pending',this)">Pending <span>{{ $apptCounts['pending'] }}</span></div>
            <div class="filter-chip" onclick="filterAppt('confirmed',this)">Confirmed <span>{{ $apptCounts['confirmed'] }}</span></div>
            <div class="filter-chip" onclick="filterAppt('review',this)">For Review <span>{{ $apptCounts['review'] }}</span></div>
          </div>
          <div class="tw"><table id="appt-table"><thead><tr><th>Resident</th><th>Subject</th><th>Description</th><th>Requested Date</th><th>Time Slot</th><th>Status</th><th>Action</th></tr></thead><tbody>@forelse($appointments as $apt)<tr data-status="{{ $apt->status ?? 'pending' }}"><td><strong>{{ $apt->user->first_name ?? '' }} {{ $apt->user->last_name ?? '' }}</strong><br><span style="font-size:11px;color:#8a7a5a;">{{ $apt->user->email ?? '' }}</span></td><td>{{ $apt->purpose ?? '' }}</td><td>{{ $apt->notes ?? '' }}</td><td>{{ \Carbon\Carbon::parse($apt->scheduled_at)->format('M d, Y') }}</td><td>{{ \Carbon\Carbon::parse($apt->scheduled_at)->format('h:i A') }}</td><td><span class="badge {{ $apt->status ?? 'pending' }}">{{ ucfirst($apt->status ?? 'Pending') }}</span></td><td><button class="abtn abtn-view" onclick="openApptModal({id:{{ $apt->id }},name:'{{ $apt->user->first_name ?? '' }} {{ $apt->user->last_name ?? '' }}',email:'{{ $apt->user->email ?? '' }}',subject:'{{ $apt->purpose ?? '' }}',desc:'{{ $apt->notes ?? '' }}',date:'{{ \Carbon\Carbon::parse($apt->scheduled_at)->format('M d, Y') }}',time:'{{ \Carbon\Carbon::parse($apt->scheduled_at)->format('h:i A') }}',status:'{{ $apt->status ?? 'pending' }}'})">View</button></td></tr>@empty<tr><td colspan="7" class="empty-state">No appointments scheduled.</td></tr>@endforelse</tbody></table></div>
        </div>
        <div class="tab-content" id="tab-availability"><div class="appt-layout"><div><div class="avail-section"><div class="avail-label">Step 1 — Select Open Days</div><div class="day-grid" id="day-grid"><div class="day-chip on" data-day="0"><span>☀️</span>Sun</div><div class="day-chip on" data-day="1"><span>📅</span>Mon</div><div class="day-chip on" data-day="2"><span>📅</span>Tue</div><div class="day-chip on" data-day="3"><span>📅</span>Wed</div><div class="day-chip on" data-day="4"><span>📅</span>Thu</div><div class="day-chip on" data-day="5"><span>📅</span>Fri</div><div class="day-chip" data-day="6"><span>😴</span>Sat</div></div><div class="avail-label">Step 2 — Add Available Time Slots</div><div class="slot-builder"><div class="slot-builder-title">Current Time Slots</div><div class="slots-list" id="slots-list"><div class="slot-tag" data-slot="9:00 AM"><span class="slot-ico">🕘</span> 9:00 AM<button class="slot-remove" onclick="removeSlot(this,'9:00 AM')">×</button></div><div class="slot-tag" data-slot="10:00 AM"><span class="slot-ico">🕙</span> 10:00 AM<button class="slot-remove" onclick="removeSlot(this,'10:00 AM')">×</button></div><div class="slot-tag" data-slot="11:00 AM"><span class="slot-ico">🕚</span> 11:00 AM<button class="slot-remove" onclick="removeSlot(this,'11:00 AM')">×</button></div><div class="slot-tag" data-slot="2:00 PM"><span class="slot-ico">🕑</span> 2:00 PM<button class="slot-remove" onclick="removeSlot(this,'2:00 PM')">×</button></div><div class="slot-tag" data-slot="3:00 PM"><span class="slot-ico">🕒</span> 3:00 PM<button class="slot-remove" onclick="removeSlot(this,'3:00 PM')">×</button></div></div><div class="slot-row"><div class="field-grp"><label>Start Time</label><input type="time" id="start-time" value="09:00"></div><div class="field-grp"><label>End Time</label><input type="time" id="end-time" value="17:00"></div><button class="abtn-gold" onclick="setWorkingHours()" style="height:38px;padding:0 16px;font-size:12.5px;">Set Hours</button></div></div><div class="avail-label">Step 3 — Appointment Limit Per Slot</div><div class="max-row"><label>Maximum appointments allowed per time slot</label><input type="number" id="max-per-slot" value="3" min="1" max="20"></div><div class="save-bar"><button class="abtn-outline" onclick="resetAvailability()">Reset to Default</button><button class="abtn-gold" onclick="saveAvailability()">Save Availability</button></div></div></div><div><div class="cal-panel"><div class="cal-head"><div class="cal-head-title" id="cal-month-label">May 2026</div><div class="cal-nav"><button onclick="calNav(-1)">‹</button><button onclick="calNav(1)">›</button></div></div><div class="cal-grid"><div class="cal-dow"><span>SUN</span><span>MON</span><span>TUE</span><span>WED</span><span>THU</span><span>FRI</span><span>SAT</span></div><div class="cal-days" id="cal-days"></div></div><div class="day-detail"><div class="day-detail-title" id="day-detail-title">Select a date to view slots</div><div class="day-slot-list" id="day-slot-list"></div></div></div></div></div></div>
      </div>
    </div>

    <!-- CONCERNS & MEETINGS -->
    <div class="page" id="page-concerns">
      <div class="concerns-shell">
        <div class="concerns-head">
          <div class="concerns-title-wrap">
            <div class="concerns-title-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 4H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-2"/><rect x="8" y="2" width="8" height="4" rx="1"/><path d="m8 13 2 2 5-5M8 18h8"/></svg></div>
            <div><div class="ph-title">Concerns &amp; Meetings</div><div class="ph-sub">Manage resident concerns, complaints, and meeting requests</div></div>
          </div>
          <div class="concerns-head-actions">
            <div class="filter-chip on" onclick="filterConcern('all',this)" style="margin:0">All <span>{{ $concernCounts['all'] }}</span></div>
            <div class="filter-chip" onclick="filterConcern('pending',this)" style="margin:0">Pending <span>{{ $concernCounts['pending'] }}</span></div>
            <div class="filter-chip" onclick="filterConcern('addressed',this)" style="margin:0">Addressed <span>{{ $concernCounts['addressed'] }}</span></div>
            <button type="button" class="concerns-refresh" onclick="window.location.reload()"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 7v5h-5M4 17v-5h5"/><path d="M5.6 9A7 7 0 0 1 18 6l2 6M4 12l2 6a7 7 0 0 0 12.4-3"/></svg>Refresh</button>
          </div>
        </div>
        <div class="concern-layout">
          <div class="concern-list-column">
            <label class="concern-search"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m16 16 4 4"/></svg><input type="search" id="concern-search" placeholder="Search resident, concern, or date..." aria-label="Search concerns and meetings"></label>
            <div class="concern-list-wrap" id="concern-list">
              @forelse($concerns as $con)
              <div class="concern-item {{ $con->status === 'addressed' ? 'addressed' : '' }}"
                   onclick="selectConcern(this, {
                     id: {{ $con->id }},
                     resident: '{{ addslashes($con->user->first_name ?? '') }} {{ addslashes($con->user->last_name ?? '') }}',
                     purpose: '{{ addslashes($con->purpose ?? '') }}',
                     notes: '{{ addslashes($con->notes ?? '') }}',
                     date: '{{ \Carbon\Carbon::parse($con->scheduled_at)->format('M d, Y') }}',
                     time: '{{ \Carbon\Carbon::parse($con->scheduled_at)->format('h:i A') }}',
                     status: '{{ $con->status ?? 'pending' }}'
                   })"
                   data-status="{{ $con->status ?? 'pending' }}"
                   data-search="{{ $con->user->first_name ?? '' }} {{ $con->user->last_name ?? '' }} {{ $con->purpose ?? '' }} {{ $con->notes ?? '' }} {{ \Carbon\Carbon::parse($con->scheduled_at)->format('M d, Y') }}">
                <div class="ci-head">
                  <span class="ci-user">{{ $con->user->first_name ?? '' }} {{ $con->user->last_name ?? '' }}</span>
                  <span class="concern-list-status {{ $con->status ?? 'pending' }}">{{ ucfirst($con->status ?? 'Pending') }}</span>
                </div>
                <div class="ci-purpose">{{ $con->purpose ?? '' }}</div>
                <div class="ci-date">{{ \Carbon\Carbon::parse($con->scheduled_at)->format('M d, Y') }}</div>
              </div>
              @empty
              <div class="empty-state">No concerns submitted yet.</div>
              @endforelse
            </div>
          </div>
          <div class="concern-detail-panel" id="concern-detail-panel">
            <div class="cdp-title-row"><div class="cdp-title">Concern Details</div><span class="concern-status-badge pending" id="cdp-head-status" style="display:none"></span></div>
            <div class="cdp-empty" id="cdp-empty"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 4H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-2"/><rect x="8" y="2" width="8" height="4" rx="1"/><path d="M8 12h8M8 16h5"/></svg>Select a concern from the list to review and respond.</div>
            <div id="cdp-content" style="display:none">
              <div class="cdp-body">
                <div class="cdp-info-row" id="cdp-row-resident"><span class="cdp-row-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg></span><div><label>Resident</label><p id="cdp-resident"></p></div></div>
                <div class="cdp-info-row" id="cdp-row-purpose"><span class="cdp-row-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg></span><div><label>Purpose</label><p id="cdp-purpose"></p></div></div>
                <div class="cdp-info-row" id="cdp-row-notes"><span class="cdp-row-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM14 2v6h6M8 13h8M8 17h8"/></svg></span><div><label>Notes / Details</label><p id="cdp-notes"></p></div></div>
                <div class="cdp-info-row" id="cdp-row-schedule"><span class="cdp-row-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg></span><div><label>Scheduled Date &amp; Time</label><p id="cdp-schedule"></p></div></div>
                <div class="cdp-info-row" id="cdp-row-status"><span class="cdp-row-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="m8 12 2.5 2.5L16 9"/></svg></span><div><label>Current Status</label><span class="concern-status-badge pending" id="cdp-status"></span></div></div>
                <div class="cdp-actions">
                  <div class="cdp-actions-title">Actions</div>
                  <div class="cdp-actions-buttons">
                    <button class="abtn-gold" id="btn-mark-addressed" onclick="updateConcernStatus('addressed')"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>Mark as Addressed</button>
                    <button class="abtn-outline" id="btn-mark-pending" onclick="updateConcernStatus('pending')">Set to Pending</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- REPORTS & SETTINGS -->
    <div class="page" id="page-reports">
      <div class="panel">
        <div class="ph"><div><div class="ph-title">System Records & Reports</div><div class="ph-sub">Monitor and export barangay service records</div></div></div>
        <div style="padding:20px 22px; background:#faf8f3; border-bottom:1px solid #f0ebe0;">
          <div style="font-size:13px; color:#8a7a5a; line-height:1.5;">
            Access comprehensive logs and generate summaries for all barangay operations. Select a category below to view specific records or generate a full system summary report.
          </div>
        </div>
        <div class="rgrid">
          <div class="rcard" onclick="showPage('manage-users', document.querySelector('[onclick*=manage-users]'))">
            <div class="rcard-ico">👥</div>
            <div class="rcard-t"><h4>Resident Records</h4><p>All registered accounts</p></div>
          </div>
          <div class="rcard" onclick="showPage('doc-requests', document.querySelector('[onclick*=doc-requests]'))">
            <div class="rcard-ico">📄</div>
            <div class="rcard-t"><h4>Document Report</h4><p>All requests & statuses</p></div>
          </div>
          <div class="rcard" onclick="showPage('appointments', document.querySelector('[onclick*=appointments]'))">
            <div class="rcard-ico">📅</div>
            <div class="rcard-t"><h4>Appointment Log</h4><p>Scheduled & completed</p></div>
          </div>
          <div class="rcard" onclick="showPage('verifications', document.querySelector('[onclick*=verifications]'))">
            <div class="rcard-ico">⏳</div>
            <div class="rcard-t"><h4>Pending Actions</h4><p>Unresolved verifications</p></div>
          </div>
          <div class="rcard" onclick="openSummaryReport()">
            <div class="rcard-ico">📊</div>
            <div class="rcard-t"><h4>Summary Report</h4><p>Export all records</p></div>
          </div>
        </div>
      </div>
    </div>
    <div class="page" id="page-settings">
      <div class="panel"><div class="ph"><div><div class="ph-title">System Settings</div><div class="ph-sub">Manage system configuration and administrator preferences</div></div></div><div style="padding:30px 22px;display:flex;flex-direction:column;gap:16px;">
        
        <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 18px;border:1px solid #e0d9c8;border-radius:10px;background:var(--bg);">
          <div>
            <div style="font-size:13.5px;font-weight:600;color:var(--navy);">System Name</div>
            <div style="font-size:12px;color:#8a7a5a;margin-top:2px;" id="display-system-name">{{ $systemName }}</div>
          </div>
          <button class="abtn abtn-view" onclick="openSystemNameModal()">Edit</button>
        </div>

        <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 18px;border:1px solid #e0d9c8;border-radius:10px;background:var(--bg);">
          <div>
            <div style="font-size:13.5px;font-weight:600;color:var(--navy);">System Features</div>
            <div style="font-size:12px;color:#8a7a5a;margin-top:2px;">Enable or disable core system functionalities</div>
          </div>
          <div style="display:flex; gap:8px;">
            <div class="badge approved" style="cursor:pointer" onclick="showToast('Feature toggled (demo)','ok')">Public Registration</div>
            <div class="badge approved" style="cursor:pointer" onclick="showToast('Feature toggled (demo)','ok')">Maintenance Mode</div>
          </div>
        </div>

        <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 18px;border:1px solid #e0d9c8;border-radius:10px;background:var(--bg);">
          <div>
            <div style="font-size:13.5px;font-weight:600;color:var(--navy);">Admin Account</div>
            <div style="font-size:12px;color:#8a7a5a;margin-top:2px;">{{ auth()->user()->email }} · {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
          </div>
          <button class="abtn abtn-view" onclick="openAdminAccountModal()">Edit</button>
        </div>

      </div></div>
    </div>

  </div>
</div>

<!-- ══ DOCUMENT REQUEST══ -->
<div class="modal-overlay" id="doc-modal" onclick="closeDocModal(event)">
  <div class="modal">
    <div class="modal-head">
      <div><div class="modal-head-title">Document Request Details</div><div class="modal-head-sub" id="doc-modal-sub">Process resident request</div></div>
      <button class="modal-close" onclick="closeDocModalDirect()">✕</button>
    </div>
    <div class="modal-body">
      <div style="background:var(--bg); border-radius:12px; padding:18px; border:1px solid #e0d9c8; margin-bottom:20px;">
        <div class="appt-detail-row" style="margin-bottom:12px;">
          <div class="appt-detail-box"><label>Resident</label><p id="doc-name" style="font-size:15px;">—</p></div>
          <div class="appt-detail-box"><label>Document Type</label><p id="doc-type" style="font-size:15px; color:var(--gold);">—</p></div>
        </div>
        <div class="appt-concern-box" style="margin:0;"><label>Purpose / Reason</label><p id="doc-purpose" style="background:rgba(255,255,255,0.6); margin-top:6px;">—</p></div>
      </div>
      
      <div style="margin-bottom:12px; font-size:11px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:#a0917a; display:flex; align-items:center; gap:8px;">
        <span>Update Status</span>
        <div style="flex:1; height:1px; background:#f0ebe0;"></div>
      </div>
      <div class="status-actions" style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:10px;">
        <button class="sa-btn sa-confirm" style="padding:12px 8px;" onclick="updateDocStatus('approved')">✅ Approve</button>
        <button class="sa-btn sa-reschedule" style="padding:12px 8px;" onclick="updateDocStatus('ready')">📄 Ready</button>
        <button class="sa-btn sa-cancel" style="padding:12px 8px;" onclick="updateDocStatus('rejected')">❌ Reject</button>
      </div>
    </div>
    <div class="modal-foot">
      <div style="flex:1; font-size:11.5px; color:#8a7a5a; font-style:italic;">Status change will notify the resident.</div>
      <button class="abtn-outline" onclick="closeDocModalDirect()">Close</button>
    </div>
  </div>
</div>

<!-- APPOINTMENT MODAL-->
<div class="modal-overlay" id="appt-modal" onclick="closeModal(event)">
  <div class="modal"><div class="modal-head"><div><div class="modal-head-title">Appointment Details</div><div class="modal-head-sub" id="modal-appt-sub">—</div></div><button class="modal-close" onclick="closeModalDirect()">✕</button></div><div class="modal-body"><div class="appt-detail-row"><div class="appt-detail-box"><label>Resident</label><p id="modal-name">—</p></div><div class="appt-detail-box"><label>Email</label><p id="modal-email">—</p></div></div><div class="appt-detail-row"><div class="appt-detail-box"><label>Date</label><p id="modal-date">—</p></div><div class="appt-detail-box"><label>Time Slot</label><p id="modal-time">—</p></div></div><div class="appt-concern-box"><label>Subject & Description</label><p id="modal-desc">—</p></div><div style="margin-bottom:6px;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#a0917a;">Update Status</div><div class="status-actions"><button class="sa-btn sa-confirm" onclick="updateApptStatus('confirmed')">✓ Confirm</button><button class="sa-btn sa-reschedule" onclick="updateApptStatus('review')">📋 Mark For Review</button><button class="sa-btn sa-cancel" onclick="updateApptStatus('cancelled')">✗ Cancel Appointment</button></div></div><div class="modal-foot"><button class="abtn-outline" onclick="closeModalDirect()">Close</button></div></div>
</div>

<!-- USER MODAL -->
<div class="modal-overlay" id="user-modal" onclick="closeUserModal(event)">
  <div class="modal">
    <div class="modal-head">
      <div><div class="modal-head-title">Resident Information</div><div class="modal-head-sub">Detailed account profile</div></div>
      <button class="modal-close" onclick="closeUserModalDirect()">✕</button>
    </div>
    <div class="modal-body">
      <div class="appt-detail-row">
        <div class="appt-detail-box"><label>Full Name</label><p id="user-modal-name">—</p></div>
        <div class="appt-detail-box"><label>Email Address</label><p id="user-modal-email">—</p></div>
      </div>
      <div class="appt-detail-row">
        <div class="appt-detail-box"><label>Residential Address</label><p id="user-modal-address">—</p></div>
        <div class="appt-detail-box"><label>Registration Date</label><p id="user-modal-registered">—</p></div>
      </div>
    </div>
    <div class="modal-foot"><button class="abtn-outline" onclick="closeUserModalDirect()">Close</button></div>
  </div>
</div>

<!-- EDIT USER MODAL -->
<div class="modal-overlay" id="edit-user-modal" onclick="closeEditUserModal(event)">
  <div class="modal">
    <form id="edit-user-form" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-head">
        <div><div class="modal-head-title">Edit Resident Account</div><div class="modal-head-sub">Update resident profile details</div></div>
        <button type="button" class="modal-close" onclick="closeEditUserModalDirect()">✕</button>
      </div>
      <div class="modal-body">
        <div class="appt-detail-row">
          <div class="field-grp" style="flex:1;">
            <label>First Name</label>
            <input type="text" name="first_name" id="edit-user-first-name" required>
          </div>
          <div class="field-grp" style="flex:1;">
            <label>Last Name</label>
            <input type="text" name="last_name" id="edit-user-last-name" required>
          </div>
        </div>
        <div class="field-grp" style="margin-bottom:12px;">
          <label>Email Address</label>
          <input type="email" name="email" id="edit-user-email" required>
        </div>
        <div class="field-grp" style="margin-bottom:12px;">
          <label>Contact Number</label>
          <input type="text" name="contact_number" id="edit-user-contact">
        </div>
        <div class="field-grp">
          <label>Address</label>
          <textarea name="address" id="edit-user-address" style="width:100%; padding:10px; border:1.5px solid #d4c9af; border-radius:8px; font-family:inherit;"></textarea>
        </div>
      </div>
      <div class="modal-foot">
        <button type="button" class="abtn-outline" onclick="closeEditUserModalDirect()">Cancel</button>
        <button type="submit" class="abtn-gold">Update Resident</button>
      </div>
    </form>
  </div>
</div>

<!-- SYSTEM NAME -->
<div class="modal-overlay" id="system-name-modal" onclick="closeSystemNameModal(event)">
  <div class="modal">
    <form action="{{ route('admin.settings.updateSystemName') }}" method="POST">
      @csrf
      <div class="modal-head">
        <div><div class="modal-head-title">Edit System Name</div><div class="modal-head-sub">Update the title of the application</div></div>
        <button type="button" class="modal-close" onclick="closeSystemNameModalDirect()">✕</button>
      </div>
      <div class="modal-body">
        <div class="field-grp">
          <label>System Name</label>
          <input type="text" name="system_name" value="{{ $systemName }}" required>
        </div>
      </div>
      <div class="modal-foot">
        <button type="button" class="abtn-outline" onclick="closeSystemNameModalDirect()">Cancel</button>
        <button type="submit" class="abtn-gold">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<!-- ADMIN ACCOUNT -->
<div class="modal-overlay" id="admin-account-modal" onclick="closeAdminAccountModal(event)">
  <div class="modal">
    <form action="{{ route('admin.settings.updateAdminAccount') }}" method="POST">
      @csrf
      <div class="modal-head">
        <div><div class="modal-head-title">Edit Admin Account</div><div class="modal-head-sub">Update your administrator profile</div></div>
        <button type="button" class="modal-close" onclick="closeAdminAccountModalDirect()">✕</button>
      </div>
      <div class="modal-body">
        <div class="appt-detail-row">
          <div class="field-grp" style="flex:1;">
            <label>First Name</label>
            <input type="text" name="first_name" value="{{ auth()->user()->first_name }}" required>
          </div>
          <div class="field-grp" style="flex:1;">
            <label>Last Name</label>
            <input type="text" name="last_name" value="{{ auth()->user()->last_name }}" required>
          </div>
        </div>
        <div class="field-grp" style="margin-bottom:14px;">
          <label>Email Address</label>
          <input type="email" name="email" value="{{ auth()->user()->email }}" required>
        </div>
        <div style="border-top:1px solid #eee; padding-top:14px; margin-top:14px;">
          <div style="font-size:11px; font-weight:700; color:#a0917a; text-transform:uppercase; margin-bottom:10px;">Change Password (optional)</div>
          <div class="appt-detail-row">
            <div class="field-grp" style="flex:1;">
              <label>New Password</label>
              <input type="password" name="password" autocomplete="new-password">
            </div>
            <div class="field-grp" style="flex:1;">
              <label>Confirm Password</label>
              <input type="password" name="password_confirmation" autocomplete="new-password">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-foot">
        <button type="button" class="abtn-outline" onclick="closeAdminAccountModalDirect()">Cancel</button>
        <button type="submit" class="abtn-gold">Update Account</button>
      </div>
    </form>
  </div>
</div>

<!-- SUMMARY REPORT-->
<div class="modal-overlay" id="summary-modal" onclick="closeSummaryModal(event)">
  <div class="modal">
    <div class="modal-head">
      <div><div class="modal-head-title">System Summary Report</div><div class="modal-head-sub">Overview of all barangay records</div></div>
      <button class="modal-close" onclick="closeSummaryModalDirect()">✕</button>
    </div>
    <div class="modal-body">
      <div class="summary-grid">
        <div class="summary-stat">
          <div class="ss-lbl">Approved Residents</div>
          <div class="ss-val">{{ $totalApprovedResidents }}</div>
        </div>
        <div class="summary-stat">
          <div class="ss-lbl">Pending Verifications</div>
          <div class="ss-val">{{ $pendingVerifications }}</div>
        </div>
        <div class="summary-stat">
          <div class="ss-lbl">Document Requests</div>
          <div class="ss-val">{{ $totalDocuments }}</div>
        </div>
        <div class="summary-stat">
          <div class="ss-lbl">Appointments</div>
          <div class="ss-val">{{ $apptCounts['all'] }}</div>
        </div>
      </div>
      <div style="padding:14px 16px; background:rgba(201,162,39,0.06); border:1px solid rgba(201,162,39,0.15); border-radius:10px; font-size:12.5px; color:#7a5c00; line-height:1.5; margin-bottom:20px; display:flex; gap:10px; align-items:flex-start;">
        <span style="font-size:16px;">💡</span>
        <span>This summary provides a quick snapshot of the system's current state. Use the button below to generate a full report.</span>
      </div>
    </div>
    <div class="modal-foot">
      <button class="abtn-outline" onclick="closeSummaryModalDirect()">Close</button>
      <button class="abtn-gold" onclick="exportData()">📥 Export All Data (CSV)</button>
    </div>
  </div>
</div>

<!-- VERIFICATION MODAL -->
<div class="modal-overlay" id="verification-modal" onclick="closeVerificationModal(event)">
  <div class="modal" style="max-width: 600px;">
    <div class="modal-head">
      <div><div class="modal-head-title">Identity Verification</div><div class="modal-head-sub">Review resident ID and address details</div></div>
      <button class="modal-close" onclick="closeVerificationModalDirect()">✕</button>
    </div>
    <div class="modal-body">
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 10px;">
          <div>
              <div class="appt-detail-box" style="margin-bottom: 12px;"><label>Resident Name</label><p id="v-modal-name" style="font-size: 15px;">—</p></div>
              <div class="appt-detail-box" style="margin-bottom: 12px;"><label>Email Address</label><p id="v-modal-email">—</p></div>
              <div class="appt-detail-box"><label>Home Address</label><p id="v-modal-address" style="line-height: 1.4; color: var(--gold); font-weight: 700; font-size: 15px;">—</p></div>
          </div>
          <div>
              <div class="appt-detail-box" style="margin-bottom: 8px;"><label>ID Type Provided</label><p id="v-modal-id-type">—</p></div>
              <div style="border-radius: 10px; overflow: hidden; border: 1px solid #e0d9c8; background: #fafafa; aspect-ratio: 1.5 / 1; display: flex; align-items: center; justify-content: center; position: relative;">
                  <img id="v-modal-id-img" src="" alt="ID Document" style="width: 100%; height: 100%; object-fit: contain; cursor: pointer;" onclick="window.open(this.src, '_blank')">
                  <div id="v-modal-pdf-placeholder" style="display:none; text-align:center; padding: 20px;">
                      <span style="font-size: 40px;">📄</span>
                      <p style="font-size: 12px; color: #a0917a; margin-top: 8px;">PDF Document</p>
                      <a id="v-modal-pdf-link" href="#" target="_blank" class="abtn abtn-view" style="display:inline-block; margin-top:10px; text-decoration:none;">Open PDF</a>
                  </div>
              </div>
              <p id="v-modal-click-hint" style="font-size: 10px; color: #a0917a; text-align: center; margin-top: 8px;">Click image to view full size</p>
          </div>
      </div>
      <div style="background: rgba(201,162,39,0.05); border: 1px solid rgba(201,162,39,0.15); border-radius: 10px; padding: 12px; margin-top: 10px;">
          <p style="font-size: 12px; color: #7a5c00; line-height: 1.4;"><strong>Verification Tip:</strong> Cross-check the address on the ID with the submitted home address to confirm residency in Barangay Buhuan.</p>
      </div>
    </div>
    <div class="modal-foot">
      <div style="flex: 1; display: flex; gap: 8px;">
          <button type="button" class="abtn abtn-no" id="v-modal-reject-btn" style="padding: 10px 16px;">✗ Reject</button>
      </div>
      <button class="abtn-outline" onclick="closeVerificationModalDirect()">Close</button>
      <button type="button" class="abtn abtn-ok" id="v-modal-approve-btn" style="padding: 10px 20px; font-weight: 700;">✓ Approve Resident</button>
    </div>
  </div>
</div>

<div class="toast-wrap" id="toast-wrap"></div>

<script>
// ── Live date ──
const d = new Date();
document.getElementById('dchip').textContent = d.toLocaleDateString('en-PH',{weekday:'short',year:'numeric',month:'short',day:'numeric'});

// ── Page titles ──
const titles = {
  dashboard:'Dashboard', verifications:'Pending Verifications',
  'manage-users':'Manage Users', 'doc-requests':'Document Requests',
  appointments:'Appointment Scheduling', concerns:'Concerns & Meetings',
  reports:'System Records & Reports', settings:'Settings'
};
function showPage(pageId, navEl) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.getElementById('page-'+pageId).classList.add('active');
  document.getElementById('page-title').textContent = titles[pageId]||'Dashboard';
  document.querySelectorAll('.nav-lnk').forEach(n => n.classList.remove('active'));
  if (navEl) navEl.classList.add('active');
  document.querySelector('.content').scrollTop = 0;
}

// ── Tab switching ──
function switchTab(tabId, btn) {
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('tab-'+tabId).classList.add('active');
}

// ── Filter appointments ──
function filterAppt(status, chip) {
  document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('on'));
  chip.classList.add('on');
  
  const rows = document.querySelectorAll('#appt-table tbody tr');
  rows.forEach(row => {
    if (status === 'all') {
      row.style.display = '';
    } else {
      const rowStatus = row.dataset.status;
      row.style.display = (rowStatus === status) ? '' : 'none';
    }
  });
}

// ── Filter concerns ──
let activeConcernFilter = 'all';

function filterConcern(status, chip) {
  activeConcernFilter = status;
  document.querySelectorAll('#page-concerns .filter-chip').forEach(c => c.classList.remove('on'));
  chip.classList.add('on');

  renderConcernList();
}

function renderConcernList() {
  const searchInput = document.getElementById('concern-search');
  const query = (searchInput ? searchInput.value : '').trim().toLocaleLowerCase();
  const items = document.querySelectorAll('#page-concerns .concern-item');
  items.forEach(item => {
    const statusMatches = activeConcernFilter === 'all' || item.dataset.status === activeConcernFilter;
    const searchMatches = !query || (item.dataset.search || '').toLocaleLowerCase().includes(query);
    item.style.display = statusMatches && searchMatches ? 'block' : 'none';
  });
}

const concernSearchInput = document.getElementById('concern-search');
if (concernSearchInput) concernSearchInput.addEventListener('input', renderConcernList);

let selectedConcernId = null;

function setConcernStatusBadge(element, status) {
  if (!element) return;
  const statusKey = String(status || '').toLocaleLowerCase().replace(/[^a-z0-9_-]/g, '-');
  element.className = `concern-status-badge ${statusKey}`;
  element.textContent = status ? status.charAt(0).toUpperCase() + status.slice(1) : '';
}

function selectConcern(el, data) {
  selectedConcernId = data.id;
  document.querySelectorAll('.concern-item').forEach(item => item.classList.remove('active'));
  el.classList.add('active');
  
  document.getElementById('cdp-empty').style.display = 'none';
  document.getElementById('cdp-content').style.display = 'block';
  
  const setDetailValue = (rowId, valueId, value) => {
    const row = document.getElementById(rowId);
    const field = document.getElementById(valueId);
    const available = String(value || '').trim().length > 0;
    row.style.display = available ? 'grid' : 'none';
    field.textContent = available ? value : '';
  };
  setDetailValue('cdp-row-resident', 'cdp-resident', data.resident);
  setDetailValue('cdp-row-purpose', 'cdp-purpose', data.purpose);
  setDetailValue('cdp-row-notes', 'cdp-notes', data.notes);
  setDetailValue('cdp-row-schedule', 'cdp-schedule', [data.date, data.time].filter(Boolean).join(' at '));
  setConcernStatusBadge(document.getElementById('cdp-status'), data.status);
  const headerStatus = document.getElementById('cdp-head-status');
  setConcernStatusBadge(headerStatus, data.status);
  headerStatus.style.display = 'inline-flex';
  
  // Toggle buttons based on status
  if (data.status === 'addressed') {
    document.getElementById('btn-mark-addressed').style.display = 'none';
    document.getElementById('btn-mark-pending').style.display = 'block';
  } else {
    document.getElementById('btn-mark-addressed').style.display = 'block';
    document.getElementById('btn-mark-pending').style.display = 'none';
  }
}

function updateConcernStatus(newStatus) {
  if (!selectedConcernId) return;
  
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = `/admin/concerns/${selectedConcernId}/status`;
  
  const csrf = document.createElement('input');
  csrf.type = 'hidden';
  csrf.name = '_token';
  csrf.value = '{{ csrf_token() }}';
  form.appendChild(csrf);
  
  const statusInput = document.createElement('input');
  statusInput.type = 'hidden';
  statusInput.name = 'status';
  statusInput.value = newStatus;
  form.appendChild(statusInput);
  
  document.body.appendChild(form);
  form.submit();
}

// SETTINGS MODALS LOGIC 
function openSystemNameModal() {
  document.getElementById('system-name-modal').classList.add('open');
}
function closeSystemNameModal(event) {
  if (event && event.target === document.getElementById('system-name-modal')) closeSystemNameModalDirect();
}
function closeSystemNameModalDirect() {
  document.getElementById('system-name-modal').classList.remove('open');
}

function openAdminAccountModal() {
  document.getElementById('admin-account-modal').classList.add('open');
}
function closeAdminAccountModal(event) {
  if (event && event.target === document.getElementById('admin-account-modal')) closeAdminAccountModalDirect();
}
function closeAdminAccountModalDirect() {
  document.getElementById('admin-account-modal').classList.remove('open');
}

// ── Approve/Reject user ──
function showRejectModal(userId) {
  let reason = prompt("Optional reason for rejection:");
  if (reason !== null) {
    document.getElementById('reject-reason-'+userId).value = reason;
    document.getElementById('reject-form-'+userId).submit();
  }
}

// DOCUMENT REQUEST MODAL LOGIC 
let currentDocId = null;
let currentDocStatus = null;

function openDocModal(id, residentName, docType, purpose, status) {
  currentDocId = id;
  currentDocStatus = status;
  document.getElementById('doc-name').textContent = residentName;
  document.getElementById('doc-type').textContent = docType;
  document.getElementById('doc-purpose').textContent = purpose;
  document.getElementById('doc-modal-sub').textContent = `Current status: ${status.toUpperCase()}`;
  document.getElementById('doc-modal').classList.add('open');
}

function closeDocModal(event) {
  if (event && event.target === document.getElementById('doc-modal')) closeDocModalDirect();
}
function closeDocModalDirect() {
  document.getElementById('doc-modal').classList.remove('open');
  currentDocId = null;
}

function updateDocStatus(newStatus) {
  if (!currentDocId) {
    showToast('No document request selected', 'warn');
    return;
  }
  
  showToast(`Updating request #${currentDocId} to ${newStatus}...`, 'ok');

  const form = document.createElement('form');
  form.method = 'POST';
  form.action = `/admin/document-requests/${currentDocId}/status`; 
  const csrf = document.createElement('input');
  csrf.type = 'hidden';
  csrf.name = '_token';
  csrf.value = '{{ csrf_token() }}';
  form.appendChild(csrf);
  const method = document.createElement('input');
  method.type = 'hidden';
  method.name = '_method';
  method.value = 'PATCH';
  form.appendChild(method);
  const statusInput = document.createElement('input');
  statusInput.type = 'hidden';
  statusInput.name = 'status';
  statusInput.value = newStatus;
  form.appendChild(statusInput);
  document.body.appendChild(form);

  setTimeout(() => {
    form.submit();
  }, 400);
}

// ── Appointment modal ──
let currentApptId = null;
function openApptModal(appt) {
  if (!appt || !appt.name) { showToast('No appointment selected','warn'); return; }
  currentApptId = appt.id;
  document.getElementById('modal-name').textContent = appt.name;
  document.getElementById('modal-email').textContent = appt.email;
  document.getElementById('modal-date').textContent = appt.date;
  document.getElementById('modal-time').textContent = appt.time;
  document.getElementById('modal-appt-sub').textContent = `${appt.subject} · ${appt.date}`;
  document.getElementById('modal-desc').textContent = `${appt.subject}: ${appt.desc}`;
  document.getElementById('appt-modal').classList.add('open');
}
function closeModal(e) { if (e.target === document.getElementById('appt-modal')) closeModalDirect(); }
function closeModalDirect() { document.getElementById('appt-modal').classList.remove('open'); currentApptId = null; }

// USER MODAL LOGIC
function openUserModal(user) {
  document.getElementById('user-modal-name').textContent = user.name;
  document.getElementById('user-modal-email').textContent = user.email;
  document.getElementById('user-modal-address').textContent = user.address;
  document.getElementById('user-modal-registered').textContent = user.registered;
  document.getElementById('user-modal').classList.add('open');
}
function closeUserModal(event) {
  if (event && event.target === document.getElementById('user-modal')) closeUserModalDirect();
}
function closeUserModalDirect() {
  document.getElementById('user-modal').classList.remove('open');
}

//  EDIT USER MODAL LOGIC 
function openEditUserModal(userId) {
  fetch(`/admin/users/${userId}/edit`)
    .then(res => res.json())
    .then(user => {
      document.getElementById('edit-user-form').action = `/admin/users/${userId}`;
      document.getElementById('edit-user-first-name').value = user.first_name || '';
      document.getElementById('edit-user-last-name').value = user.last_name || '';
      document.getElementById('edit-user-email').value = user.email || '';
      document.getElementById('edit-user-contact').value = user.contact_number || '';
      document.getElementById('edit-user-address').value = user.address || '';
      document.getElementById('edit-user-modal').classList.add('open');
    })
    .catch(err => {
      console.error(err);
      showToast('Error fetching resident data.', 'warn');
    });
}
function closeEditUserModal(event) {
  if (event && event.target === document.getElementById('edit-user-modal')) closeEditUserModalDirect();
}
function closeEditUserModalDirect() {
  document.getElementById('edit-user-modal').classList.remove('open');
}

function updateApptStatus(status) {
  if (!currentApptId) return;
  
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = `/admin/appointments/${currentApptId}/status`;
  
  const csrf = document.createElement('input');
  csrf.type = 'hidden';
  csrf.name = '_token';
  csrf.value = '{{ csrf_token() }}';
  form.appendChild(csrf);
  
  const statusInput = document.createElement('input');
  statusInput.type = 'hidden';
  statusInput.name = 'status';
  statusInput.value = status;
  form.appendChild(statusInput);
  
  document.body.appendChild(form);
  form.submit();
}

// ── Toast ──
function showToast(msg, type='ok') {
  const wrap = document.getElementById('toast-wrap');
  const t = document.createElement('div');
  t.className = `toast t-${type}`;
  t.textContent = msg;
  wrap.appendChild(t);
  requestAnimationFrame(() => { requestAnimationFrame(() => t.classList.add('show')); });
  setTimeout(() => { t.classList.remove('show'); setTimeout(() => t.remove(), 400); }, 3800);
}

// Day chips & calendar 
const initialDays = {!! $availabilityDays !!};
const slotsData = {!! $availabilitySlots !!};
const initialMax = {{ $maxPerSlot }};
const bookedSlots = {!! json_encode($bookedSlots) !!};

function getSlotKey(dateStr, timeStr) {
  let [time, modifier] = timeStr.split(' ');
  let [hours, minutes] = time.split(':');
  if (hours === '12') hours = '00';
  if (modifier === 'PM') hours = parseInt(hours, 10) + 12;
  const formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:00`;
  return `${dateStr} ${formattedTime}`;
}

// Initialize Day Chips
document.querySelectorAll('.day-chip').forEach(chip => {
  const day = parseInt(chip.dataset.day);
  if (initialDays.includes(day)) {
    chip.classList.add('on');
  } else {
    chip.classList.remove('on');
  }
  chip.addEventListener('click', () => { chip.classList.toggle('on'); renderCalendar(); });
});

// Initialize Slots List UI
function renderSlotsUI() {
  const listEl = document.getElementById('slots-list');
  listEl.innerHTML = '';
  if (slotsData.length === 0) {
    listEl.innerHTML = '<div class="slot-empty">No time slots added yet.</div>';
  } else {
    slotsData.forEach(s => {
      const t2 = document.createElement('div');
      t2.className='slot-tag'; t2.dataset.slot=s;
      t2.innerHTML=`<span class="slot-ico">🕐</span> ${s}<button class="slot-remove" onclick="removeSlot(this,'${s}')">×</button>`;
      listEl.appendChild(t2);
    });
  }
}
renderSlotsUI();

// Initialize Max Per Slot
document.getElementById('max-per-slot').value = initialMax;

function getOpenDays() {
  return Array.from(document.querySelectorAll('.day-chip.on')).map(c => +c.dataset.day);
}

function removeSlot(btn, slot) {
  const idx = slotsData.indexOf(slot);
  if (idx > -1) slotsData.splice(idx, 1);
  renderSlotsUI();
  renderCalendar();
}

function timeToLabel(t) { 
  if (t.includes('AM')||t.includes('PM')) return t; 
  const [h, m] = t.split(':').map(Number); 
  const ampm = h < 12 ? 'AM' : 'PM'; 
  const h12 = h % 12 || 12; 
  return `${h12}:${String(m).padStart(2,'0')} ${ampm}`; 
}

function setWorkingHours() {
  const start = document.getElementById('start-time').value;
  const end = document.getElementById('end-time').value;
  if (!start || !end || start >= end) { showToast('Invalid time range.','warn'); return; }

  slotsData.length = 0;
  let [sh, sm] = start.split(':').map(Number);
  let [eh, em] = end.split(':').map(Number);

  while (sh < eh || (sh === eh && sm < em)) {
    const ampm = sh < 12 ? 'AM' : 'PM';
    const h12 = sh % 12 || 12;
    slotsData.push(`${h12}:${String(sm).padStart(2,'0')} ${ampm}`);
    sm += 60; // 1-hour interval
    if (sm >= 60) { sh += Math.floor(sm/60); sm %= 60; }
  }

  renderSlotsUI();
  renderCalendar();
}

function saveAvailability() {
  const days = getOpenDays();
  const max = document.getElementById('max-per-slot').value;
  
  fetch('{{ route('admin.settings.updateAvailability') }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({
      days: JSON.stringify(days),
      slots: JSON.stringify(slotsData),
      max_per_slot: max
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      showToast('✓ Availability saved successfully.','ok');
    } else {
      showToast('Error saving availability.','warn');
    }
  })
  .catch(err => {
    console.error(err);
    showToast('Network error. Please try again.','warn');
  });
}

function resetAvailability() {
  const defaultDays = [1,2,3,4,5];
  document.querySelectorAll('.day-chip').forEach(chip => {
    if (defaultDays.includes(parseInt(chip.dataset.day))) chip.classList.add('on');
    else chip.classList.remove('on');
  });
  
  slotsData.length = 0;
  slotsData.push('9:00 AM','10:00 AM','11:00 AM','2:00 PM','3:00 PM');
  renderSlotsUI();
  document.getElementById('max-per-slot').value = 3;
  
  showToast('Reset to default — Mon–Fri, 9AM–3PM. Click Save to apply.','warn');
  renderCalendar();
}

function openSummaryReport() {
  document.getElementById('summary-modal').classList.add('open');
}
function closeSummaryModal(event) {
  if (event && event.target === document.getElementById('summary-modal')) closeSummaryModalDirect();
}
function closeSummaryModalDirect() {
  document.getElementById('summary-modal').classList.remove('open');
}
function exportData() {
  showToast('Generating CSV report... Please wait.', 'ok');

  const rows = [
    ['Category', 'Count'],
    ['Total Approved Residents', '{{ $totalApprovedResidents }}'],
    ['Pending Verifications', '{{ $pendingVerifications }}'],
    ['Document Requests', '{{ $totalDocuments }}'],
    ['Appointments', '{{ $apptCounts['all'] }}']
  ];
  let csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
  const encodedUri = encodeURI(csvContent);
  const link = document.createElement("a");
  link.setAttribute("href", encodedUri);
  link.setAttribute("download", "barangay_summary_report.csv");
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

let calYear = new Date().getFullYear(), calMonth = new Date().getMonth(), selectedDay = new Date().getDate();
function calNav(dir) { calMonth += dir; if (calMonth < 0) { calMonth = 11; calYear--; } if (calMonth > 11) { calMonth = 0; calYear++; } renderCalendar(); }
function renderCalendar() {
  const openDays = getOpenDays();
  const monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  document.getElementById('cal-month-label').textContent = `${monthNames[calMonth]} ${calYear}`;
  const first = new Date(calYear, calMonth, 1).getDay();
  const daysInMonth = new Date(calYear, calMonth+1, 0).getDate();
  const today = new Date();
  const isCurrentMonth = today.getFullYear()===calYear && today.getMonth()===calMonth;
  const container = document.getElementById('cal-days');
  container.innerHTML = '';
  const prevDays = new Date(calYear, calMonth, 0).getDate();
  for (let i = first-1; i >= 0; i--) {
    const el = document.createElement('div'); el.className = 'cal-day other'; el.textContent = prevDays - i; container.appendChild(el);
  }
  for (let day = 1; day <= daysInMonth; day++) {
    const el = document.createElement('div');
    const dow = new Date(calYear, calMonth, day).getDay();
    const isOpen = openDays.includes(dow);
    el.className = 'cal-day';
    if (!isOpen) el.classList.add('off');
    if (isCurrentMonth && day === today.getDate()) el.classList.add('today');
    if (isOpen && slotsData.length > 0) el.classList.add('has-slots');
    if (day === selectedDay && calMonth === 4 && calYear === 2026) el.classList.add('selected');
    el.textContent = day;
    if (isOpen) {
      el.addEventListener('click', () => {
        document.querySelectorAll('.cal-day').forEach(d => d.classList.remove('selected'));
        el.classList.add('selected'); selectedDay = day;
        showDayDetail(day, dow);
      });
    }
    container.appendChild(el);
  }
  showDayDetail(selectedDay, new Date(calYear, calMonth, selectedDay).getDay());
}
function showDayDetail(day, dow) {
  const monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  const dayNames = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
  const openDays = getOpenDays();
  document.getElementById('day-detail-title').textContent = `${dayNames[dow]}, ${monthNames[calMonth]} ${day}`;
  const listEl = document.getElementById('day-slot-list');
  listEl.innerHTML = '';
  if (!openDays.includes(dow) || slotsData.length === 0) {
    listEl.innerHTML = '<div class="day-no-slots">No slots available for this day.</div>'; return;
  }
  const maxPerSlot = +document.getElementById('max-per-slot').value || 3;
  const dateStr = `${calYear}-${String(calMonth+1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;

  slotsData.forEach(slot => {
    const slotKey = getSlotKey(dateStr, slot);
    const booked = bookedSlots[slotKey] || 0;
    const isFull = booked >= maxPerSlot;
    const div = document.createElement('div');
    div.className = 'day-slot' + (isFull ? ' full' : '');
    div.innerHTML = `<div class="ds-dot"></div><div class="ds-time">${slot}</div><div class="ds-count">${booked}/${maxPerSlot} booked</div>`;
    listEl.appendChild(div);
  });
}
renderCalendar();
document.getElementById('max-per-slot').addEventListener('change', renderCalendar);

// Document Requests search, filters, and client-side pagination.
(() => {
  const tableBody = document.getElementById('documents-table-body');
  if (!tableBody) return;
  const rows = Array.from(tableBody.querySelectorAll('.document-request-row'));
  const searchInput = document.getElementById('documents-search');
  const typeFilter = document.getElementById('documents-type-filter');
  const countLabel = document.getElementById('documents-count');
  const pagination = document.getElementById('documents-pagination');
  const noMatch = document.getElementById('documents-no-match');
  const pageSize = 8;
  let currentPage = 1;
  const normalizeDocumentText = value => String(value ?? '').normalize('NFKC').trim().replace(/\s+/g, ' ').toLocaleLowerCase();

  function renderDocumentRequests() {
    const query = normalizeDocumentText(searchInput.value);
    const selectedType = normalizeDocumentText(typeFilter.value);
    const filteredRows = rows.filter(row => normalizeDocumentText(row.dataset.search).includes(query)
      && (!selectedType || normalizeDocumentText(row.dataset.documentType) === selectedType));
    const pageCount = Math.max(1, Math.ceil(filteredRows.length / pageSize));
    currentPage = Math.min(currentPage, pageCount);
    const start = (currentPage - 1) * pageSize;
    rows.forEach(row => { row.style.display = 'none'; });
    filteredRows.slice(start, start + pageSize).forEach(row => { row.style.display = ''; });
    noMatch.style.display = filteredRows.length ? 'none' : 'block';
    countLabel.textContent = filteredRows.length
      ? `Showing ${start + 1}–${Math.min(start + pageSize, filteredRows.length)} of ${filteredRows.length} document requests`
      : 'Showing 0 of 0 document requests';
    pagination.replaceChildren();

    const addButton = (label, target, disabled, active = false, ariaLabel = label) => {
      const button = document.createElement('button');
      button.type = 'button'; button.textContent = label; button.disabled = disabled;
      button.classList.toggle('current', active); button.setAttribute('aria-label', ariaLabel);
      if (active) button.setAttribute('aria-current', 'page');
      button.addEventListener('click', () => { currentPage = target; renderDocumentRequests(); });
      pagination.appendChild(button);
    };
    addButton('‹', currentPage - 1, currentPage === 1, false, 'Previous page');
    for (let page = 1; page <= pageCount; page++) addButton(String(page), page, false, page === currentPage, `Page ${page}`);
    addButton('›', currentPage + 1, currentPage === pageCount, false, 'Next page');
  }

  searchInput.addEventListener('input', () => { currentPage = 1; renderDocumentRequests(); });
  typeFilter.addEventListener('change', () => { currentPage = 1; renderDocumentRequests(); });
  document.getElementById('documents-clear').addEventListener('click', () => {
    searchInput.value = ''; typeFilter.value = ''; currentPage = 1;
    renderDocumentRequests();
  });
  renderDocumentRequests();
})();

// Manage Users search, status filtering, and client-side pagination.
(() => {
  const tableBody = document.getElementById('users-table-body');
  if (!tableBody) return;
  const rows = Array.from(tableBody.querySelectorAll('.manage-user-row'));
  const searchInput = document.getElementById('users-search');
  const statusFilter = document.getElementById('users-status-filter');
  const countLabel = document.getElementById('users-count');
  const pagination = document.getElementById('users-pagination');
  const noMatch = document.getElementById('users-no-match');
  const pageSize = 8;
  let currentPage = 1;
  const normalizeText = value => String(value ?? '').normalize('NFKC').trim().replace(/\s+/g, ' ').toLocaleLowerCase();

  function renderUsers() {
    const query = normalizeText(searchInput.value);
    const selectedStatus = normalizeText(statusFilter.value);
    const filteredRows = rows.filter(row => normalizeText(row.dataset.search).includes(query)
      && (!selectedStatus || normalizeText(row.dataset.status) === selectedStatus));
    const pageCount = Math.max(1, Math.ceil(filteredRows.length / pageSize));
    currentPage = Math.min(currentPage, pageCount);
    const start = (currentPage - 1) * pageSize;
    rows.forEach(row => { row.style.display = 'none'; });
    filteredRows.slice(start, start + pageSize).forEach(row => { row.style.display = ''; });
    noMatch.style.display = filteredRows.length ? 'none' : 'block';
    countLabel.textContent = filteredRows.length
      ? `Showing ${start + 1}–${Math.min(start + pageSize, filteredRows.length)} of ${filteredRows.length} users`
      : 'Showing 0 of 0 users';
    pagination.replaceChildren();

    const addButton = (label, target, disabled, active = false, ariaLabel = label) => {
      const button = document.createElement('button');
      button.type = 'button'; button.textContent = label; button.disabled = disabled;
      button.classList.toggle('current', active); button.setAttribute('aria-label', ariaLabel);
      if (active) button.setAttribute('aria-current', 'page');
      button.addEventListener('click', () => { currentPage = target; renderUsers(); });
      pagination.appendChild(button);
    };
    addButton('‹', currentPage - 1, currentPage === 1, false, 'Previous page');
    for (let page = 1; page <= pageCount; page++) addButton(String(page), page, false, page === currentPage, `Page ${page}`);
    addButton('›', currentPage + 1, currentPage === pageCount, false, 'Next page');
  }

  searchInput.addEventListener('input', () => { currentPage = 1; renderUsers(); });
  statusFilter.addEventListener('change', () => { currentPage = 1; renderUsers(); });
  document.getElementById('users-clear').addEventListener('click', () => {
    searchInput.value = ''; statusFilter.value = ''; currentPage = 1; renderUsers();
  });
  renderUsers();
})();

// Pending Verifications search, ID type filter, and client-side pagination.
(() => {
  const tableBody = document.getElementById('verification-table-body');
  if (!tableBody) return;
  const rows = Array.from(tableBody.querySelectorAll('.verification-row'));
  const searchInput = document.getElementById('verification-search');
  const idFilter = document.getElementById('verification-id-filter');
  const countLabel = document.getElementById('verification-count');
  const pagination = document.getElementById('verification-pagination');
  const noResults = document.getElementById('verification-no-results');
  const pageSize = 6;
  let currentPage = 1;
  const normalizeFilterText = value => String(value ?? '').normalize('NFKC').trim().replace(/\s+/g, ' ').toLocaleLowerCase();

  function renderVerificationRows() {
    const query = normalizeFilterText(searchInput.value);
    const selectedId = normalizeFilterText(idFilter.value);
    const filteredRows = rows.filter(row => normalizeFilterText(row.dataset.search).includes(query)
      && (!selectedId || normalizeFilterText(row.dataset.idType) === selectedId));
    const pageCount = Math.max(1, Math.ceil(filteredRows.length / pageSize));
    currentPage = Math.min(currentPage, pageCount);
    const start = (currentPage - 1) * pageSize;
    rows.forEach(row => { row.style.display = 'none'; });
    filteredRows.slice(start, start + pageSize).forEach(row => { row.style.display = ''; });
    noResults.style.display = filteredRows.length ? 'none' : 'block';
    countLabel.textContent = filteredRows.length
      ? `Showing ${start + 1}–${Math.min(start + pageSize, filteredRows.length)} of ${filteredRows.length} pending residents`
      : 'Showing 0 pending residents';
    pagination.replaceChildren();
    const addButton = (label, target, disabled, active = false, ariaLabel = label) => {
      const button = document.createElement('button');
      button.type = 'button'; button.textContent = label; button.disabled = disabled;
      button.classList.toggle('current', active); button.setAttribute('aria-label', ariaLabel);
      if (active) button.setAttribute('aria-current', 'page');
      button.addEventListener('click', () => { currentPage = target; renderVerificationRows(); });
      pagination.appendChild(button);
    };
    addButton('‹', currentPage - 1, currentPage === 1, false, 'Previous page');
    for (let page = 1; page <= pageCount; page++) addButton(String(page), page, false, page === currentPage, `Page ${page}`);
    addButton('›', currentPage + 1, currentPage === pageCount, false, 'Next page');
  }

  searchInput.addEventListener('input', () => { currentPage = 1; renderVerificationRows(); });
  idFilter.addEventListener('change', () => { currentPage = 1; renderVerificationRows(); });
  document.getElementById('verification-clear').addEventListener('click', () => {
    searchInput.value = ''; idFilter.value = ''; currentPage = 1; renderVerificationRows();
  });
  renderVerificationRows();
})();

// ── Verification Modal Logic ──
document.addEventListener('click', function(e) {
  const trigger = e.target && e.target.closest ? e.target.closest('.v-modal-trigger') : null;
  if (trigger) {
    const btn = trigger;
    const data = {
      id: btn.getAttribute('data-id'),
      name: btn.getAttribute('data-name'),
      email: btn.getAttribute('data-email'),
      address: btn.getAttribute('data-address'),
      id_type: btn.getAttribute('data-id-type'),
      id_path: btn.getAttribute('data-id-path')
    };
    openVerificationModal(data);
  }
});

function openVerificationModal(data) {
  document.getElementById('v-modal-name').textContent = data.name;
  document.getElementById('v-modal-email').textContent = data.email;
  document.getElementById('v-modal-address').textContent = data.address;
  document.getElementById('v-modal-id-type').textContent = data.id_type;
  
  const imgEl = document.getElementById('v-modal-id-img');
  const pdfPlaceholder = document.getElementById('v-modal-pdf-placeholder');
  const pdfLink = document.getElementById('v-modal-pdf-link');
  const clickHint = document.getElementById('v-modal-click-hint');

  pdfPlaceholder.innerHTML = `<span style="font-size: 40px;">📄</span>
                      <p style="font-size: 12px; color: #a0917a; margin-top: 8px;">PDF Document</p>
                      <a id="v-modal-pdf-link" href="${data.id_path}" target="_blank" class="abtn abtn-view" style="display:inline-block; margin-top:10px; text-decoration:none;">Open PDF</a>`;

  if (data.id_path.toLowerCase().endsWith('.pdf')) {
    imgEl.style.display = 'none';
    clickHint.style.display = 'none';
    pdfPlaceholder.style.display = 'block';
  } else {
    imgEl.style.display = 'block';
    clickHint.style.display = 'block';
    pdfPlaceholder.style.display = 'none';
    imgEl.src = data.id_path;
    
    imgEl.onerror = function() {
        this.style.display = 'none';
        clickHint.style.display = 'none';
        pdfPlaceholder.style.display = 'block';
        pdfPlaceholder.innerHTML = `<span style="font-size: 40px;">⚠️</span>
                      <p style="font-size: 12px; color: #c0392b; margin-top: 8px; font-weight: 600;">ID Image failed to load</p>
                      <p style="font-size: 10px; color: #a0917a; margin-bottom: 10px;">The file might not be publicly accessible or was moved.</p>
                      <a href="${data.id_path}" target="_blank" class="abtn abtn-view" style="display:inline-block; text-decoration:none;">Try Open in New Tab</a>`;
    };
  }

  // Setup action buttons
  document.getElementById('v-modal-approve-btn').onclick = function() {
    if(confirm(`Approve ${data.name}?`)) {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = `/admin/users/${data.id}/approve`;
      const csrf = document.createElement('input');
      csrf.type = 'hidden'; csrf.name = '_token'; csrf.value = '{{ csrf_token() }}';
      form.appendChild(csrf);
      document.body.appendChild(form);
      form.submit();
    }
  };

  document.getElementById('v-modal-reject-btn').onclick = function() {
    closeVerificationModalDirect();
    showRejectModal(data.id);
  };

  document.getElementById('verification-modal').classList.add('open');
}

function closeVerificationModal(e) {
  if (e.target === document.getElementById('verification-modal')) closeVerificationModalDirect();
}

function closeVerificationModalDirect() {
  document.getElementById('verification-modal').classList.remove('open');
}
</script>
</body>
</html>
