<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Handyman Dashboard - benerin.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a56db;
            --primary-hover: #1e40af;
            --text-dark: #111827;
            --text-muted: #6b7280;
            --bg-page: #f9fafb;
            --bg-sidebar: #fcfcfd;
            --border-color: #e5e7eb;
            --orange-bg: #b05118;
            --success: #10b981;
            --warning: #f59e0b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; color: var(--text-dark); background-color: var(--bg-page); line-height: 1.5; overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        button { cursor: pointer; border: none; font-family: inherit; }

        /* Top Navbar */
        .top-navbar { height: 70px; background: white; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; position: sticky; top: 0; z-index: 100; }
        .nav-left { display: flex; align-items: center; gap: 3rem; }
        .brand { font-size: 1.5rem; font-weight: 800; color: var(--primary); display: flex; align-items: center; letter-spacing: -0.5px;}
        .brand span { color: var(--text-dark); }
        .nav-links { display: flex; gap: 2rem; height: 100%; align-items: center;}
        .nav-links a { font-weight: 600; font-size: 0.95rem; color: var(--text-muted); padding: 1.5rem 0; position: relative; }
        .nav-links a:hover { color: var(--text-dark); }
        .nav-links a.active { color: var(--primary); }
        .nav-links a.active::after { content: ''; position: absolute; bottom: -2px; left: 0; right: 0; height: 3px; background: var(--primary); border-radius: 3px 3px 0 0; }
        
        .nav-right { display: flex; align-items: center; gap: 1.5rem; }
        .icon-btn { color: var(--text-dark); width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; position: relative;}
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background-color: #374151; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 2px solid white; box-shadow: 0 0 0 1px var(--border-color); cursor: pointer;}
        
        /* Dropdown UI */
        .dropdown-menu { position: absolute; top: calc(100% + 10px); right: 0; background: white; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); width: 220px; border: 1px solid var(--border-color); padding: 0.5rem; display: none; flex-direction: column; z-index: 200; transform-origin: top right; }
        .dropdown-menu.show { display: flex; animation: slideDown 0.2s ease-out forwards; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px) scale(0.95); } to { opacity: 1; transform: translateY(0) scale(1); } }
        .dropdown-item { padding: 0.75rem 1rem; color: var(--text-dark); font-size: 0.875rem; font-weight: 500; border-radius: 8px; transition: background 0.15s; display: flex; align-items: center; gap: 0.75rem; }
        .dropdown-item:hover { background: var(--bg-page); }
        .dropdown-item.text-danger { color: #dc2626; }
        .dropdown-item.text-danger:hover { background: #fef2f2; }

        /* Layout Structure */
        .layout-wrapper { display: flex; min-height: calc(100vh - 70px); }

        /* Sidebar */
        .sidebar { width: 260px; background: var(--bg-sidebar); border-right: 1px solid var(--border-color); display: flex; flex-direction: column; padding: 2rem 1.5rem; flex-shrink: 0;}
        .user-info { margin-bottom: 2.5rem; }
        .user-name { font-size: 1.125rem; font-weight: 700; color: var(--text-dark); }
        .user-title { font-size: 0.70rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-top: 0.25rem; }

        .side-menu { display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: auto;}
        .menu-item { display: flex; align-items: center; gap: 1rem; padding: 0.75rem 1rem; border-radius: 12px; color: var(--text-muted); font-weight: 600; font-size: 0.95rem; transition: all 0.2s; }
        .menu-item svg { width: 20px; height: 20px; }
        .menu-item:hover { color: var(--text-dark); }
        .menu-item.active { background: white; color: var(--primary); box-shadow: 0 2px 4px rgba(0,0,0,0.02); }

        .sidebar-bottom { margin-top: 2rem; display: flex; flex-direction: column; gap: 1.5rem; }
        .premium-card { background: var(--primary); color: white; padding: 1.5rem 1rem; border-radius: 12px; text-align: center; box-shadow: 0 4px 14px 0 rgba(26,86,219,0.25); }
        .premium-label { font-size: 0.7rem; opacity: 0.9; margin-bottom: 0.5rem;}
        .premium-title { font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem; }
        .btn-premium { background: white; color: var(--primary); padding: 0.6rem 1rem; border-radius: 8px; font-weight: 700; font-size: 0.85rem; width: 100%; transition: transform 0.2s; }
        .btn-premium:hover { transform: translateY(-2px); }

        /* Main Content */
        .main-content { flex: 1; padding: 2rem 3rem; overflow-y: auto; display: flex; flex-direction: column; gap: 2rem; }

        .header-row { display: flex; justify-content: space-between; align-items: flex-start; }
        .welcome-title { font-size: 1.75rem; font-weight: 800; color: var(--text-dark); margin-bottom: 0.5rem;}
        .welcome-desc { color: var(--text-muted); font-size: 1rem; font-weight: 500;}
        .status-toggle { display: flex; align-items: center; gap: 1rem; }
        .btn-online { background: #1e3a8a; color: white; padding: 0.5rem 1rem; border-radius: 99px; font-weight: 700; font-size: 0.875rem; display: flex; align-items: center; gap: 0.5rem; }
        .btn-online::before { content: ''; width: 8px; height: 8px; background: #60a5fa; border-radius: 50%; box-shadow: 0 0 0 2px rgba(96,165,250,0.3); }
        .toggle-bg { background: white; border: 1px solid var(--border-color); padding: 0.35rem; border-radius: 99px; display: flex; align-items: center; gap: 0.75rem; cursor: pointer; }
        .toggle-switch { width: 44px; height: 24px; background: var(--primary); border-radius: 99px; position: relative; }
        .toggle-switch::after { content: ''; position: absolute; right: 2px; top: 2px; width: 20px; height: 20px; background: white; border-radius: 50%; transition: 0.2s; }
        .toggle-label { font-weight: 700; font-size: 0.875rem; color: var(--primary); padding-right: 0.5rem; }

        /* Stat Cards Matrix */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
        .stat-card { background: white; padding: 1.5rem; border-radius: 16px; border: 1px solid var(--border-color); display: flex; flex-direction: column; position: relative; }
        .stat-label { font-size: 0.70rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem; }
        .stat-value { font-size: 2.25rem; font-weight: 800; line-height: 1; color: var(--text-dark); display: flex; align-items: baseline; gap: 0.5rem;}
        .stat-badge { font-size: 0.75rem; font-weight: 700; background: #dcfce7; color: #166534; padding: 0.25rem 0.5rem; border-radius: 6px; }
        .stat-icon { position: absolute; top: 1.5rem; right: 1.5rem; color: var(--primary); width: 20px; height: 20px;}
        .text-warning { color: var(--warning); }
        .text-danger { color: #dc2626; }

        /* Main Grid Area */
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; align-items: start; }
        
        /* Left Column */
        .left-col { display: flex; flex-direction: column; gap: 2rem; }
        
        /* Earnings Trend */
        .panel { background: white; border-radius: 16px; border: 1px solid var(--border-color); overflow: hidden; }
        .panel-header { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; }
        .panel-title { font-size: 1.125rem; font-weight: 800; color: var(--text-dark); }
        .panel-subtitle { font-size: 0.875rem; color: var(--text-muted); margin-top: 0.25rem;}
        .dropdown-select { appearance: none; background: #f3f4f6; border: none; padding: 0.5rem 2rem 0.5rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.875rem; color: var(--text-dark); cursor: pointer; background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 0.5rem center; background-size: 1.2em; }
        
        .chart-placeholder { height: 280px; padding: 0 1.5rem 1.5rem; display: flex; flex-direction: column; justify-content: flex-end; }
        .css-chart { display: flex; justify-content: space-between; align-items: flex-end; height: 180px; padding-bottom: 1rem; border-bottom: 1px solid var(--border-color); gap: 1rem;}
        .chart-bar { flex: 1; background: linear-gradient(to top, rgba(26,86,219,0.1) 0%, rgba(26,86,219,0.8) 100%); border-radius: 4px 4px 0 0; position: relative; min-height: 10%; transition: height 0.3s; }
        .chart-bar:hover { opacity: 0.8; }
        .chart-labels { display: flex; justify-content: space-between; padding-top: 1rem; }
        .chart-label { flex: 1; text-align: center; font-size: 0.65rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;}
        .chart-label.active { color: var(--primary); }

        /* Schedule List */
        .schedule-list { padding: 0 1.5rem 1.5rem; display: flex; flex-direction: column; gap: 0.5rem; }
        .schedule-item { display: flex; align-items: center; padding: 1.25rem; border: 1px solid var(--border-color); border-radius: 12px; transition: border 0.2s;}
        .schedule-item:hover { border-color: var(--primary); }
        .s-time { width: 80px; display: flex; flex-direction: column; align-items: flex-start; }
        .s-time strong { font-size: 1rem; font-weight: 800; color: var(--primary); }
        .s-time span { font-size: 0.70rem; font-weight: 700; color: var(--text-muted); }
        .s-info { flex: 1; }
        .s-title { font-weight: 700; font-size: 1rem; color: var(--text-dark); margin-bottom: 0.25rem;}
        .s-meta { font-size: 0.875rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem;}
        .s-meta span:first-child { color: var(--text-dark); font-weight: 500; }
        .s-tag { padding: 0.35rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 700; display: flex; align-items: center; gap: 0.35rem; }
        .tag-plumb { background: #ffedd5; color: #c2410c; }
        .tag-elec { background: #e0e7ff; color: #4338ca; }
        .tag-install { background: #f3f4f6; color: #374151; }
        .s-action { width: 40px; display: flex; justify-content: flex-end; color: var(--primary); }

        /* Calendar Panel */
        .calendar-controls { display: flex; align-items: center; gap: 1rem; background: var(--bg-page); padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.95rem; }
        .cal-btn { display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-dark); }
        
        .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); padding: 1rem 1.5rem 1.5rem; }
        .cal-header { display: contents; }
        .cal-day-name { font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-align: center; padding-bottom: 1rem; text-transform: uppercase; }
        .cal-cells { display: contents; }
        .cal-cell { min-height: 100px; border-top: 1px solid var(--border-color); padding: 0.75rem; display: flex; flex-direction: column; gap: 0.5rem; transition: background 0.2s; }
        .cal-cell:hover { background: #f8fafc; }
        .cal-cell.prev-month { background: #fafafa; }
        .cal-date { font-weight: 700; font-size: 0.95rem; color: var(--text-dark); width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; border-radius: 50%; }
        .cal-cell.prev-month .cal-date { color: var(--text-muted); font-weight: 500;}
        .cal-date.active { background: var(--primary); color: white; }

        .cal-event { padding: 0.5rem; border-radius: 8px; font-size: 0.75rem; font-weight: 600; line-height: 1.4; border-left: 3px solid transparent;}
        .event-blue { background: #eff6ff; color: var(--primary); border-left-color: var(--primary); }
        .event-orange { background: #fff7ed; color: #ea580c; border-left-color: #ea580c; }
        .event-amber { background: #fffbeb; color: #d97706; border-left-color: #d97706; }
        .event-green { background: #f0fdf4; color: #16a34a; border-left-color: #16a34a; }
        .event-time { font-weight: 500; font-size: 0.7rem; opacity: 0.8; margin-top: 0.2rem;}

        /* Job Details Panel */
        .details-panel { background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); border: 1px solid var(--border-color); }
        .details-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .details-header h2 { font-size: 1.25rem; font-weight: 700; }
        .badge-selected { background: var(--primary); color: white; font-size: 0.65rem; font-weight: 700; padding: 0.4rem 0.75rem; border-radius: 99px; text-transform: uppercase; letter-spacing: 1px; }
        
        .job-card { background: var(--bg-page); border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; }
        .job-card-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem; }
        .job-type-label { font-size: 0.65rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; display: block;}
        .job-title { font-size: 1.125rem; font-weight: 700; color: var(--text-dark); }
        .status-badge { background: #d1fae5; color: #065f46; font-size: 0.65rem; font-weight: 800; padding: 0.35rem 0.65rem; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px;}
        
        .assigned-box { display: flex; align-items: center; gap: 1rem; margin-top: 1.5rem; }
        .assigned-avatar { width: 48px; height: 48px; border-radius: 8px; background-color: #374151; flex-shrink: 0; }
        .assigned-info { display: flex; flex-direction: column; }
        .assigned-label { font-size: 0.65rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.25rem;}
        .assigned-name { font-weight: 700; font-size: 1rem; color: var(--text-dark); margin-bottom: 0.25rem;}
        .assigned-rating { font-size: 0.75rem; color: var(--primary); font-weight: 600; display: flex; align-items: center; gap: 0.25rem;}

        .info-boxes { display: flex; gap: 1rem; margin-bottom: 1.5rem; }
        .info-box { flex: 1; background: var(--bg-sidebar); border-radius: 12px; padding: 1.25rem; display: flex; flex-direction: column; gap: 0.5rem; border: 1px solid var(--border-color);}
        .info-box-label { font-size: 0.65rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center; gap: 0.35rem;}
        .info-box-label svg { width: 12px; height: 12px; }
        .info-box-val { font-weight: 700; font-size: 0.95rem; line-height: 1.3; }

        .btn-message { background: #e5e7eb; color: var(--primary); font-weight: 700; width: 100%; padding: 0.875rem; border-radius: 12px; display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-bottom: 0.5rem; transition: background 0.2s;}
        .btn-message:hover { background: #d1d5db; }
        
        .btn-invoice { background: #10b981; color: white; margin-top:0.5rem;}
        .btn-invoice:hover { background: #059669; }

        /* Right Column */
        .right-col { display: flex; flex-direction: column; gap: 1.5rem; }
        
        .action-btn { width: 100%; display: flex; justify-content: space-between; align-items: center; padding: 1.25rem 1.5rem; border-radius: 12px; font-weight: 700; font-size: 1rem; transition: transform 0.2s;}
        .action-btn:hover { transform: translateY(-2px); }
        .btn-blue { background: #1e3a8a; color: white; box-shadow: 0 4px 12px rgba(30,58,138,0.2); }
        .btn-light { background: #e5e7eb; color: var(--primary); }
        .action-left { display: flex; align-items: center; gap: 1rem; }

        /* Feedback Section */
        .feedback-list { padding: 0 1.5rem 1.5rem; display: flex; flex-direction: column; gap: 1.5rem;}
        .feedback-item { display: flex; flex-direction: column; gap: 0.75rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); }
        .feedback-item:last-child { border-bottom: none; padding-bottom: 0; }
        .fb-header { display: flex; justify-content: space-between; align-items: center; }
        .fb-stars { color: var(--warning); display: flex; gap: 2px; }
        .fb-stars svg { width: 14px; height: 14px; fill: currentColor; }
        .fb-time { font-size: 0.65rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;}
        .fb-text { font-size: 0.9rem; font-style: italic; color: #374151; line-height: 1.5; }
        .fb-author { font-size: 0.85rem; font-weight: 700; color: var(--text-dark); }
        .btn-ghost { background: none; color: var(--primary); font-weight: 700; font-size: 0.9rem; padding: 1rem; text-align: center; width: 100%; border-top: 1px solid var(--border-color); }

        /* Priority Support Banner */
        .support-banner { background: white; border-radius: 16px; border: 1px solid var(--border-color); overflow: hidden; display: flex; margin-top: 2rem;}
        .support-img { width: 350px; background: #374151; position: relative; flex-shrink: 0; }
        .support-img img { width: 100%; height: 100%; object-fit: cover; }
        .support-content { padding: 2.5rem; display: flex; flex-direction: column; justify-content: center; }
        .support-title { font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem; }
        .support-desc { font-size: 0.95rem; color: var(--text-muted); margin-bottom: 1.5rem; max-width: 500px; line-height: 1.6;}
        .support-actions { display: flex; gap: 1rem; }
        .btn-support-main { background: #1e3a8a; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 700; font-size: 0.95rem; }
        /* Job Detail Modal */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; padding: 1rem; backdrop-filter: blur(4px); }
        .modal-overlay.active { display: flex; animation: fadeIn 0.2s ease; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .modal-box { background: white; border-radius: 20px; width: 100%; max-width: 560px; max-height: 88vh; overflow-y: auto; box-shadow: 0 25px 50px rgba(0,0,0,0.25); animation: slideUp 0.25s ease; }
        @keyframes slideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .modal-head { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; border-bottom: 1px solid var(--border-color); position: sticky; top: 0; background: white; z-index: 1; border-radius: 20px 20px 0 0; }
        .modal-head h3 { font-size: 1.1rem; font-weight: 800; }
        .modal-close { width: 32px; height: 32px; border-radius: 50%; background: var(--bg-page); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 1.1rem; color: var(--text-muted); transition: background 0.2s; }
        .modal-close:hover { background: #e5e7eb; color: var(--text-dark); }
        .modal-body { padding: 1.5rem; }
        .modal-images { display: flex; gap: 0.75rem; overflow-x: auto; margin-bottom: 1.5rem; scrollbar-width: none; padding-bottom: 0.25rem; }
        .modal-images::-webkit-scrollbar { display: none; }
        .modal-img-thumb { width: 120px; height: 90px; flex-shrink: 0; border-radius: 10px; object-fit: cover; border: 1px solid var(--border-color); cursor: zoom-in; transition: transform 0.2s; }
        .modal-img-thumb:hover { transform: scale(1.03); }
        .modal-meta-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem; }
        .modal-meta-box { background: var(--bg-page); border-radius: 10px; padding: 1rem; }
        .modal-meta-label { font-size: 0.65rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.35rem; }
        .modal-meta-val { font-weight: 700; font-size: 0.95rem; }
        .modal-desc { font-size: 0.9rem; color: #374151; line-height: 1.7; background: var(--bg-page); border-radius: 10px; padding: 1rem; margin-bottom: 1.5rem; }
        .modal-actions { display: flex; gap: 0.75rem; }
        .btn-accept { flex: 1; background: #10b981; color: white; padding: 0.875rem; border-radius: 10px; font-weight: 700; font-size: 0.95rem; border: none; cursor: pointer; transition: background 0.2s; }
        .btn-accept:hover { background: #059669; }
        .btn-decline { flex: 1; background: white; color: #ef4444; border: 1.5px solid #ef4444; padding: 0.875rem; border-radius: 10px; font-weight: 700; font-size: 0.95rem; cursor: pointer; transition: background 0.2s; }
        .btn-decline:hover { background: #fef2f2; }
    </style>
</head>
<body>
    @php
        // Handyman Calculations
        $activeJobsCount = $jobs->whereIn('JobStatus', ['accepted', 'inspection', 'repairing'])->count();
        $completedJobs = $jobs->where('JobStatus', 'finished');
        $completedCount = $completedJobs->count();
        $totalEarnings = $completedJobs->sum('JobPrice');
        
        $pendingRequests = $jobs->where('JobStatus', 'pending')->sortBy('JobStartDate');

        
        $avgRatingFromReviews = \App\Models\Rating::where('HandymanID', auth()->user()->UserID)->avg('Rating');
        $userRating = $avgRatingFromReviews ? number_format($avgRatingFromReviews, 1) : '0.0';
        
        // Filter schedule for today
        $todayStart = now()->startOfDay();
        $todayEnd = now()->endOfDay();
        $todaysSchedule = $jobs->filter(function($job) use ($todayStart, $todayEnd) {
            $d = new \Carbon\Carbon($job->JobStartDate ?? $job->created_at);
            return $d->between($todayStart, $todayEnd) && !in_array($job->JobStatus, ['finished']);
        })->sortBy('JobStartDate')->take(5);

        // Map tags based on JobName loosely for styling
        function getJobTagStyle($name) {
            $name = strtolower($name);
            if(str_contains($name, 'leak') || str_contains($name, 'plumb') || str_contains($name, 'sink') || str_contains($name, 'pipe')) return ['plumb', 'Plumbing', '<path d="M12 2v20m0 0a2 2 0 01-2-2h4a2 2 0 01-2 2z"/>'];
            if(str_contains($name, 'electric') || str_contains($name, 'light') || str_contains($name, 'wire') || str_contains($name, 'audit')) return ['elec', 'Electrical', '<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>'];
            return ['install', 'Installation', '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>'];
        }
    @endphp

    <!-- Top Navbar -->
    <nav class="top-navbar">
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="brand">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" style="margin-right:8px;" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#1a56db"/>
                    <path d="M2 17L12 22L22 17M2 12L12 17L22 12" stroke="#1a56db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                benerin<span>.id</span>
            </a>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
                <a href="{{ route('history.index') }}">Jobs</a>
                <a href="#">Earnings</a>
                <a href="{{ route('chat.index') }}">Messages</a>
                <a href="#">Payments</a>
            </div>
        </div>
        <div class="nav-right">
            <div class="icon-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </div>
            
            <div class="user-menu" style="position: relative;">
                <div class="user-avatar" id="profileDropdownBtn">
                    @if(auth()->check() && auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    @endif
                </div>
                <div class="dropdown-menu" id="profileDropdownMenu">
                    <div style="padding: 0.5rem 1rem; border-bottom: 1px solid var(--border-color); margin-bottom: 0.5rem;">
                        <p style="font-weight: 700; font-size: 0.9rem; color: var(--text-dark);">{{ auth()->check() ? auth()->user()->name : 'Professional' }}</p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">{{ auth()->check() ? auth()->user()->email : 'user@example.com' }}</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        Profile Settings
                    </a>
                    <a href="#" class="dropdown-item">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        Settings
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger" style="width: 100%; text-align: left; background: none;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Layout -->
    <div class="layout-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="user-info">
                <h3 class="user-name">{{ auth()->user()->name }}</h3>
                <p class="user-title">Verified Professional</p>
            </div>

            <nav class="side-menu">
                <a href="#" class="menu-item active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    Overview
                </a>
                <a href="#" class="menu-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Schedule
                </a>
                <a href="{{ route('history.index') }}" class="menu-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    Service History
                </a>
                <a href="#" class="menu-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    Customers
                </a>
                <a href="{{ route('profile.edit') }}" class="menu-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    Settings
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header Row -->
            <div class="header-row">
                <div>
                    <h1 class="welcome-title">Welcome back, {{ explode(' ', auth()->user()->name)[0] }}!</h1>
                    <p class="welcome-desc">You have {{ $activeJobsCount }} active jobs today. Your profile visibility is high.</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-label">Total Earnings</span>
                    <div class="stat-value">${{ number_format($totalEarnings, 2) }} <span class="stat-badge" style="background: var(--bg-page); border: 1px solid var(--border-color); color: var(--text-muted); border-radius: 12px; padding: 0.2rem 0.6rem;">0.0%</span></div>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Active Jobs</span>
                    <div class="stat-value">{{ $activeJobsCount }}</div>
                    <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Avg Rating</span>
                    <div class="stat-value">{{ $userRating }}</div>
                    <svg class="stat-icon text-warning" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Completed Tasks</span>
                    <div class="stat-value">{{ $completedCount }}</div>
                    <svg class="stat-icon" style="color:#b05118" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><polyline points="9 12 11 14 15 10" stroke="white" stroke-width="2" fill="none"></polyline></svg>
                </div>
            </div>

            <!-- Content Split -->
            <div class="content-grid">
                <!-- Left Column -->
                <div class="left-col">
                    
                    @if($pendingRequests->count() > 0)
                    <!-- Pending Requests Panel -->
                    <div class="panel" style="border-color: var(--warning);">
                        <div class="panel-header" style="background: #fffbeb; border-bottom: 1px solid #fde68a;">
                            <div>
                                <h2 class="panel-title" style="color: #92400e;">New Job Requests</h2>
                                <p class="panel-subtitle" style="color: #b45309;">You have {{ $pendingRequests->count() }} pending appointment(s) awaiting review.</p>
                            </div>
                        </div>
                        <div class="schedule-list" style="padding-top: 1.5rem;">
                            @foreach($pendingRequests as $job)
                                @php $timeObj = new \Carbon\Carbon($job->JobStartDate ?? $job->created_at); @endphp
                                <div class="schedule-item" style="border-color: #fcd34d; background: #fffcf2; cursor: pointer;"
                                     onclick="openJobModal({{ $job->JobID }})"
                                     title="Click to view full details">
                                    <div class="s-time" style="width: 100px;">
                                        <strong style="color:#d97706; font-size:1.1rem;">{{ $timeObj->format('M d') }}</strong>
                                        <span style="font-size:0.8rem;">{{ $timeObj->format('h:i A') }}</span>
                                    </div>
                                    <div class="s-info">
                                        <div class="s-title">{{ $job->JobType ?: $job->JobName }}</div>
                                        <div class="s-meta">
                                            <span>{{ $job->customer ? $job->customer->name : 'Client' }}</span>
                                            @if($job->JobImages && count((array)$job->JobImages) > 0)
                                                • <span style="color:var(--primary);">{{ count((array)$job->JobImages) }} photo(s)</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div style="display:flex; align-items:center; gap:0.5rem; color: var(--primary); font-size:0.8rem; font-weight:600; flex-shrink:0;">
                                        View Details
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Earnings Trend Panel -->
                    <div class="panel">
                        <div class="panel-header">
                            <div>
                                <h2 class="panel-title">Earnings Trend</h2>
                                <p class="panel-subtitle">Performance over the last 7 days</p>
                            </div>
                            <select class="dropdown-select">
                                <option>Last 7 Days</option>
                                <option>Last 30 Days</option>
                            </select>
                        </div>
                        @php
                            // Calculate daily earnings for the last 7 days
                            $dayLabels = ['MON','TUE','WED','THU','FRI','SAT','SUN'];
                            $todayDayOfWeek = now()->dayOfWeekIso; // 1=Mon, 7=Sun
                            $dailyEarnings = [];
                            for ($d = 6; $d >= 0; $d--) {
                                $date = now()->subDays($d);
                                $dayIdx = $date->dayOfWeekIso; // 1=Mon .. 7=Sun
                                $earned = $completedJobs->filter(function($job) use ($date) {
                                    return $job->updated_at && \Carbon\Carbon::parse($job->updated_at)->isSameDay($date);
                                })->sum('JobPrice');
                                $dailyEarnings[] = [
                                    'label' => $dayLabels[$dayIdx - 1],
                                    'amount' => $earned,
                                    'isToday' => $d === 0,
                                ];
                            }
                            $maxEarning = max(array_column($dailyEarnings, 'amount'));
                        @endphp
                        <div class="chart-placeholder">
                            <div class="css-chart">
                                @foreach($dailyEarnings as $day)
                                    @php
                                        $pct = $maxEarning > 0 ? round(($day['amount'] / $maxEarning) * 100) : 0;
                                        $minHeight = $day['amount'] > 0 ? max($pct, 10) : 5;
                                    @endphp
                                    <div class="chart-bar" style="height: {{ $minHeight }}%;{{ $day['isToday'] ? ' background: var(--primary);' : '' }}"></div>
                                @endforeach
                            </div>
                            <div class="chart-labels">
                                @foreach($dailyEarnings as $day)
                                    <span class="chart-label{{ $day['isToday'] ? ' active' : '' }}">{{ $day['label'] }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Column -->
                <div class="right-col">
                    


                    <a href="{{ route('history.index') }}" style="display:block; margin-bottom: 0.5rem;">
                        <button class="action-btn btn-light" style="width:100%;">
                            <div class="action-left">
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                                View All Jobs
                            </div>
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </button>
                    </a>

                    <!-- Recent Feedback -->
                    <div class="panel" style="position:relative;">
                        <div class="panel-header">
                            <h2 class="panel-title">Recent Feedback</h2>
                        </div>
                        <div class="feedback-list">
                            @forelse($recentFeedback as $fb)
                                <div class="feedback-item">
                                    <div class="fb-header">
                                        <div class="fb-stars">
                                            @for($i=0; $i<(int)$fb->Rating; $i++)
                                                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            @endfor
                                        </div>
                                        <span class="fb-time">{{ $fb->created_at->diffForHumans(null, true, true) }} AGO</span>
                                    </div>
                                    @if($fb->feedback)
                                        <p class="fb-text">"{{ $fb->feedback }}"</p>
                                    @else
                                        <p class="fb-text" style="color:var(--text-muted); font-style:normal;">No comment provided.</p>
                                    @endif
                                    <span class="fb-author">— {{ $fb->customer ? $fb->customer->name : 'Customer' }}</span>
                                </div>
                            @empty
                                <div style="text-align: center; padding: 2rem; color: var(--text-muted); font-weight:500;">
                                    No feedback received yet.
                                </div>
                            @endforelse
                        </div>
                        @php $totalReviews = \App\Models\Rating::where('HandymanID', auth()->user()->UserID)->count(); @endphp
                        @if($totalReviews > 0)
                        <button class="btn-ghost" style="position: absolute; bottom: 0; background: white; border-radius: 0 0 16px 16px;" onclick="openAllReviewsModal()">Read All {{ $totalReviews }} Review{{ $totalReviews !== 1 ? 's' : '' }}</button>
                        @endif
                    </div>

                </div>
            </div>

            <!-- Calendar and Job Details Grid -->
            <div class="main-grid" style="display: grid; grid-template-columns: minmax(0, 1fr) 350px; gap: 2rem; align-items: start; margin-bottom: 2rem;">
                <!-- Calendar Panel -->
                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-title">
                            <h2>Calendar</h2>
                            <p id="currentMonthYear">Loading...</p>
                        </div>
                        <div class="calendar-controls">
                            <span class="cal-btn" id="btnPrevMonth" style="cursor:pointer;"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg></span>
                            <span class="cal-btn" id="btnNextMonth" style="cursor:pointer; padding-left: 0.5rem;"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg></span>
                        </div>
                    </div>
                    <div class="calendar-grid">
                        <div class="cal-header">
                            <div class="cal-day-name">Sun</div>
                            <div class="cal-day-name">Mon</div>
                            <div class="cal-day-name">Tue</div>
                            <div class="cal-day-name">Wed</div>
                            <div class="cal-day-name">Thu</div>
                            <div class="cal-day-name">Fri</div>
                            <div class="cal-day-name">Sat</div>
                        </div>
                        <div class="cal-cells" id="calendarCells">
                            <!-- Populated by JavaScript -->
                        </div>
                    </div>
                </div>

                <div class="details-panel">
                    <div class="details-header">
                        <h2>Job Details</h2>
                        <span id="selectedDateBadge" class="badge-selected" style="background:var(--text-muted); transition: background 0.3s;">Selected: Today</span>
                    </div>

                    <div id="jobDetailsContent">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>

            <!-- Priority Support Banner -->
            <div class="support-banner">
                <div class="support-img">
                    <img src="https://images.unsplash.com/photo-1581141849291-1125c7b692b5?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Tools">
                </div>
                <div class="support-content">
                    <h2 class="support-title">Need priority support?</h2>
                    <p class="support-desc">Our dedicated provider success team is available 24/7 to help you manage your bookings and resolve client disputes.</p>
                    <div class="support-actions">
                        <button class="btn-support-main">Contact Success Team</button>
                        <button class="btn-support-sec">Browse Help Center</button>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- Job Detail Modal -->
    <div class="modal-overlay" id="jobModal">
        <div class="modal-box">
            <div class="modal-head">
                <h3 id="modalJobTitle">Job Details</h3>
                <div class="modal-close" onclick="closeJobModal()">✕</div>
            </div>
            <div class="modal-body">
                <div id="modalImagesRow" class="modal-images" style="display:none;"></div>
                <div class="modal-meta-row">
                    <div class="modal-meta-box">
                        <div class="modal-meta-label">Client</div>
                        <div class="modal-meta-val" id="modalClient">—</div>
                    </div>
                    <div class="modal-meta-box">
                        <div class="modal-meta-label">Requested Date</div>
                        <div class="modal-meta-val" id="modalDate">—</div>
                    </div>
                    <div class="modal-meta-box">
                        <div class="modal-meta-label">Job Type</div>
                        <div class="modal-meta-val" id="modalType">—</div>
                    </div>
                    <div class="modal-meta-box">
                        <div class="modal-meta-label">Status</div>
                        <div class="modal-meta-val" id="modalStatus">—</div>
                    </div>
                </div>
                <div class="modal-desc" id="modalDesc">No description provided.</div>
                <div class="modal-actions" id="modalActions"></div>
                <button class="btn-message" id="pendingModalMessageBtn" style="margin-top:1rem; width:100%; display:flex; align-items:center; justify-content:center; gap:0.5rem; background:#f3f4f6; color:var(--primary); padding:0.75rem 0.85rem; border:none; border-radius:12px; font-weight:700; cursor:pointer;">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    Message Client
                </button>
            </div>
        </div>
    </div>

    <!-- Calendar Job Full Details Modal -->
    <div class="modal-overlay" id="calJobModal">
        <div class="modal-box">
            <div class="modal-head">
                <div>
                    <p style="font-size:0.65rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px; margin-bottom:0.25rem;" id="calModalType">—</p>
                    <h3 id="calModalTitle">Job Details</h3>
                </div>
                <div style="display:flex; align-items:center; gap:0.75rem;">
                    <span id="calModalStatus" style="font-size:0.65rem; font-weight:800; padding:0.35rem 0.75rem; border-radius:6px; background:#fef3c7; color:#92400e;">—</span>
                    <div class="modal-close" onclick="closeCalJobModal()">✕</div>
                </div>
            </div>
            <div class="modal-body">
                <div id="calModalPhotosWrap" style="display:none; margin-bottom:1.5rem;">
                    <p style="font-size:0.65rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px; margin-bottom:0.5rem;">Photos</p>
                    <div class="modal-images" id="calModalPhotos"></div>
                </div>
                <div class="modal-meta-row">
                    <div class="modal-meta-box">
                        <div class="modal-meta-label">Client</div>
                        <div class="modal-meta-val" id="calModalClient">—</div>
                    </div>
                    <div class="modal-meta-box">
                        <div class="modal-meta-label">Scheduled Date</div>
                        <div class="modal-meta-val" id="calModalDate">—</div>
                    </div>
                </div>
                <p style="font-size:0.65rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px; margin-bottom:0.5rem;">Description</p>
                <div class="modal-desc" id="calModalDesc" style="margin-bottom:1.5rem;">No description provided.</div>

                <div id="calModalInvoiceWrap" style="display:none; margin-bottom:1.5rem; background: var(--bg-page); border-radius: 12px; padding: 1.25rem; border: 1px solid var(--border-color);">
                    <p style="font-size:0.65rem; font-weight:800; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px; margin-bottom:0.75rem;">Itemized Invoice Charges</p>
                    <div id="calModalInvoiceItems" style="display: flex; flex-direction: column; gap: 0.5rem;"></div>
                    <div style="margin-top: 0.75rem; border-top: 1px dashed var(--border-color); padding-top: 0.5rem; display: flex; justify-content: space-between; align-items: center; font-weight: 800; font-size: 0.9rem;">
                        <span style="color: var(--text-muted);">Total Billed:</span>
                        <span id="calModalInvoiceTotal" style="color: var(--success); font-size: 1.1rem;">$0.00</span>
                    </div>
                </div>
                <button class="btn-message" id="calModalMessageBtn" style="margin-top:1rem; width:100%; display:flex; align-items:center; justify-content:center; gap:0.5rem; background:var(--primary); color:white; padding:0.75rem 0.85rem; border:none; border-radius:12px; font-weight:700; cursor:pointer;">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:white;"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    Message Client
                </button>
            </div>
        </div>
    </div>

    <!-- Image Lightbox -->
    <div id="lightbox" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.9); z-index:2000; align-items:center; justify-content:center; cursor:zoom-out;" onclick="this.style.display='none'">
        <img id="lightboxImg" src="" style="max-width:90vw; max-height:90vh; border-radius:8px; object-fit:contain;">
    </div>

    <!-- All Reviews Modal -->
    @php
        $allReviews = \App\Models\Rating::with(['customer', 'job'])
            ->where('HandymanID', auth()->user()->UserID)
            ->latest()
            ->get();
    @endphp
    <div class="modal-overlay" id="allReviewsModal">
        <div class="modal-box" style="max-width:520px;">
            <div class="modal-head">
                <div>
                    <h3>All Reviews</h3>
                    <p style="font-size:0.8rem; color:var(--text-muted); font-weight:500; margin-top:0.15rem;">{{ $allReviews->count() }} review{{ $allReviews->count() !== 1 ? 's' : '' }} • {{ $userRating }} avg</p>
                </div>
                <div class="modal-close" onclick="closeAllReviewsModal()">✕</div>
            </div>
            <div class="modal-body" style="padding:0;">
                <div style="display:flex; flex-direction:column; max-height:60vh; overflow-y:auto;">
                    @forelse($allReviews as $review)
                        <div style="padding:1.25rem 1.5rem; border-bottom:1px solid var(--border-color); {{ $loop->last ? 'border-bottom:none;' : '' }}">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.5rem;">
                                <div style="display:flex; align-items:center; gap:0.75rem;">
                                    <div style="width:36px; height:36px; border-radius:50%; background:#e2e8f0; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.8rem; color:var(--text-muted); flex-shrink:0; overflow:hidden;">
                                        @if($review->customer && $review->customer->avatar)
                                            <img src="{{ asset('storage/' . $review->customer->avatar) }}" style="width:100%;height:100%;object-fit:cover;">
                                        @else
                                            {{ $review->customer ? substr($review->customer->name, 0, 1) : '?' }}
                                        @endif
                                    </div>
                                    <div>
                                        <div style="font-weight:700; font-size:0.9rem;">{{ $review->customer ? $review->customer->name : 'Customer' }}</div>
                                        <div style="font-size:0.7rem; color:var(--text-muted); font-weight:500;">{{ $review->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div style="display:flex; align-items:center; gap:0.15rem; color:#f59e0b;">
                                    @for($i = 0; $i < (int)$review->Rating; $i++)
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    @endfor
                                    @for($i = (int)$review->Rating; $i < 5; $i++)
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="#e2e8f0"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    @endfor
                                </div>
                            </div>
                            @if($review->feedback)
                                <p style="font-size:0.875rem; color:#374151; line-height:1.6; font-style:italic; margin-top:0.35rem;">"{{ $review->feedback }}"</p>
                            @else
                                <p style="font-size:0.825rem; color:var(--text-muted); margin-top:0.35rem;">No comment provided.</p>
                            @endif
                            @if($review->job)
                                <div style="margin-top:0.5rem; font-size:0.7rem; font-weight:600; color:var(--text-muted); background:var(--bg-page); display:inline-block; padding:0.25rem 0.6rem; border-radius:6px;">
                                    {{ $review->job->JobType ?? $review->job->JobName }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <div style="padding:3rem; text-align:center; color:var(--text-muted); font-weight:500;">No reviews yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const jobsData = @json($jobs->values());
    const pendingData = @json($pendingRequests->values());
    const storageBase = '{{ asset("storage") }}';

    // Modal Logic
    window.openJobModal = function(jobId) {
        const job = pendingData.find(j => j.JobID == jobId);
        if (!job) return;

        document.getElementById('modalJobTitle').textContent = job.JobName || job.JobType;
        document.getElementById('modalClient').textContent = job.customer ? job.customer.name : 'Unknown Client';
        document.getElementById('modalDate').textContent = job.JobStartDate ? new Date(job.JobStartDate).toLocaleDateString('en-US', {month:'short', day:'numeric', year:'numeric', hour:'2-digit', minute:'2-digit'}) : '—';
        document.getElementById('modalType').textContent = job.JobType || '—';
        document.getElementById('modalStatus').textContent = 'PENDING';
        document.getElementById('modalDesc').textContent = job.JobDesk || 'No description provided.';

        // Images
        const imagesRow = document.getElementById('modalImagesRow');
        imagesRow.innerHTML = '';
        const images = Array.isArray(job.JobImages) ? job.JobImages : (job.JobImages ? JSON.parse(job.JobImages) : []);
        if (images && images.length > 0) {
            imagesRow.style.display = 'flex';
            images.forEach(path => {
                const img = document.createElement('img');
                img.className = 'modal-img-thumb';
                img.src = storageBase + '/' + path;
                img.alt = 'Job photo';
                img.onclick = () => {
                    document.getElementById('lightboxImg').src = img.src;
                    document.getElementById('lightbox').style.display = 'flex';
                };
                imagesRow.appendChild(img);
            });
        } else {
            imagesRow.style.display = 'none';
        }

        // Accept / Decline actions
        document.getElementById('modalActions').innerHTML = `
            <form method="POST" action="/jobs/${job.JobID}/status" style="flex:1;margin:0;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="status" value="accepted">
                <button type="submit" class="btn-accept" style="width:100%;">
                    ✓ Accept Job
                </button>
            </form>
            <form method="POST" action="/jobs/${job.JobID}/status" style="flex:1;margin:0;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="status" value="cancelled">
                <button type="submit" class="btn-decline" style="width:100%;">
                    ✕ Decline
                </button>
            </form>
        `;

        const pendingMessageBtn = document.getElementById('pendingModalMessageBtn');
        if (pendingMessageBtn) {
            pendingMessageBtn.onclick = function() {
                window.location.href = `/messages?job=${job.JobID}`;
            };
        }

        document.getElementById('jobModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    window.closeJobModal = function() {
        document.getElementById('jobModal').classList.remove('active');
        document.body.style.overflow = '';
    };

    document.getElementById('jobModal').addEventListener('click', function(e) {
        if (e.target === this) closeJobModal();
    });

    // Calendar Job Details Modal
    window.openCalJobModal = function(jobId) {
        const job = jobsData.find(j => j.JobID == jobId);
        if (!job) return;

        document.getElementById('calModalTitle').textContent = job.JobName || job.JobType;
        document.getElementById('calModalType').textContent = job.JobType || '—';
        document.getElementById('calModalStatus').textContent = (job.JobStatus || '').toUpperCase();
        document.getElementById('calModalClient').textContent = job.customer ? job.customer.name : 'Unknown Client';
        document.getElementById('calModalDate').textContent = job.JobStartDate
            ? new Date(job.JobStartDate).toLocaleDateString('en-US', {month:'short', day:'numeric', year:'numeric', hour:'2-digit', minute:'2-digit'})
            : '—';
        document.getElementById('calModalDesc').textContent = job.JobDesk || 'No description provided.';

        const photosWrap = document.getElementById('calModalPhotosWrap');
        const photosContainer = document.getElementById('calModalPhotos');
        photosContainer.innerHTML = '';
        const imgs = Array.isArray(job.JobImages) ? job.JobImages : (job.JobImages ? JSON.parse(job.JobImages) : []);
        if (imgs && imgs.length > 0) {
            photosWrap.style.display = 'block';
            imgs.forEach(path => {
                const img = document.createElement('img');
                img.className = 'modal-img-thumb';
                img.src = storageBase + '/' + path;
                img.alt = 'Job photo';
                img.onclick = () => {
                    document.getElementById('lightboxImg').src = img.src;
                    document.getElementById('lightbox').style.display = 'flex';
                };
                photosContainer.appendChild(img);
            });
        } else {
            photosWrap.style.display = 'none';
        }

        // Populating Billed Invoice Items in modal
        const invoiceWrap = document.getElementById('calModalInvoiceWrap');
        const invoiceItemsContainer = document.getElementById('calModalInvoiceItems');
        const invoiceTotalEl = document.getElementById('calModalInvoiceTotal');
        invoiceItemsContainer.innerHTML = '';

        const invoiceItems = Array.isArray(job.InvoiceItems) ? job.InvoiceItems : (job.InvoiceItems ? JSON.parse(job.InvoiceItems) : []);
        if (invoiceItems && invoiceItems.length > 0) {
            invoiceWrap.style.display = 'block';
            invoiceItems.forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.style.display = 'flex';
                itemDiv.style.justify = 'space-between';
                itemDiv.style.alignItems = 'center';
                itemDiv.style.fontSize = '0.85rem';
                itemDiv.innerHTML = `
                    <span style="color: var(--text-dark); font-weight: 500;">${item.name}</span>
                    <span style="color: var(--text-dark); font-weight: 700;">$${parseFloat(item.price).toFixed(2)}</span>
                `;
                invoiceItemsContainer.appendChild(itemDiv);
            });
            invoiceTotalEl.textContent = '$' + parseFloat(job.JobPrice || 0).toFixed(2);
        } else if (job.JobStatus === 'finished' && job.JobPrice) {
            invoiceWrap.style.display = 'block';
            const itemDiv = document.createElement('div');
            itemDiv.style.display = 'flex';
            itemDiv.style.justify = 'space-between';
            itemDiv.style.alignItems = 'center';
            itemDiv.style.fontSize = '0.85rem';
            itemDiv.innerHTML = `
                <span style="color: var(--text-dark); font-weight: 500;">Flat Rate / General Service Charge</span>
                <span style="color: var(--text-dark); font-weight: 700;">$${parseFloat(job.JobPrice).toFixed(2)}</span>
            `;
            invoiceItemsContainer.appendChild(itemDiv);
            invoiceTotalEl.textContent = '$' + parseFloat(job.JobPrice).toFixed(2);
        } else {
            invoiceWrap.style.display = 'none';
        }

        const messageBtn = document.getElementById('calModalMessageBtn');
        if (messageBtn) {
            messageBtn.onclick = function() {
                window.location.href = `/messages?job=${job.JobID}`;
            };
        }

        document.getElementById('calJobModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    window.closeCalJobModal = function() {
        document.getElementById('calJobModal').classList.remove('active');
        document.body.style.overflow = '';
    };

    document.getElementById('calJobModal').addEventListener('click', function(e) {
        if (e.target === this) closeCalJobModal();
    });

    // All Reviews Modal
    window.openAllReviewsModal = function() {
        document.getElementById('allReviewsModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    window.closeAllReviewsModal = function() {
        document.getElementById('allReviewsModal').classList.remove('active');
        document.body.style.overflow = '';
    };

    document.getElementById('allReviewsModal').addEventListener('click', function(e) {
        if (e.target === this) closeAllReviewsModal();
    });

    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();
    let selectedDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());

    const monthYearText = document.getElementById('currentMonthYear');
    const cellsContainer = document.getElementById('calendarCells');
    const selectedDateBadge = document.getElementById('selectedDateBadge');
    const jobDetailsContent = document.getElementById('jobDetailsContent');

    // Dropdown Toggle Logic
    const profileBtn = document.getElementById('profileDropdownBtn');
    const profileMenu = document.getElementById('profileDropdownMenu');
    if(profileBtn && profileMenu) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.classList.toggle('show');
        });
        document.addEventListener('click', (e) => {
            if (!profileMenu.contains(e.target)) {
                profileMenu.classList.remove('show');
            }
        });
    }

    function getJobsForDate(dateObj) {
        return jobsData.filter(job => {
            const jobDateStr = job.JobStartDate || job.created_at;
            const jobDate = new Date(jobDateStr);
            return jobDate.getDate() === dateObj.getDate() && 
                   jobDate.getMonth() === dateObj.getMonth() && 
                   jobDate.getFullYear() === dateObj.getFullYear() &&
                   job.JobStatus !== 'cancelled';
        });
    }

    function renderCalendar(month, year) {
        monthYearText.textContent = `${monthNames[month]} ${year}`;
        cellsContainer.innerHTML = '';

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const prevMonthDays = new Date(year, month, 0).getDate();

        for(let i = firstDay - 1; i >= 0; i--) {
            const day = prevMonthDays - i;
            cellsContainer.innerHTML += `<div class="cal-cell prev-month"><span class="cal-date">${day}</span></div>`;
        }

        for(let i = 1; i <= daysInMonth; i++) {
            let isSelected = (i === selectedDate.getDate() && month === selectedDate.getMonth() && year === selectedDate.getFullYear());
            let activeClass = isSelected ? 'active' : '';
            let isToday = (i === today.getDate() && month === today.getMonth() && year === today.getFullYear());
            let todayStyle = isToday && !isSelected ? 'border: 2px solid var(--primary); color: var(--primary);' : '';
            
            const cellDate = new Date(year, month, i);
            const dayJobs = getJobsForDate(cellDate);
            
            let eventsHtml = '';
            dayJobs.forEach(job => {
                let colorClass = 'event-blue';
                if(job.JobStatus === 'pending') colorClass = 'event-orange';
                if(job.JobStatus === 'inspection') colorClass = 'event-amber';
                if(job.JobStatus === 'repairing') colorClass = 'event-green';
                if(job.JobStatus === 'finished') colorClass = 'event-blue'; // finished gets blue

                eventsHtml += `<div class="cal-event ${colorClass}">
                    ${job.JobName || job.JobType}
                    <div class="event-time">${job.JobStatus.toUpperCase()}</div>
                </div>`;
            });

            cellsContainer.innerHTML += `<div class="cal-cell" data-day="${i}" style="cursor:pointer;"><span class="cal-date ${activeClass}" style="${todayStyle}">${i}</span>${eventsHtml}</div>`;
        }

        const totalCellsStr = cellsContainer.children.length;
        const remainingCells = (7 - (totalCellsStr % 7)) % 7;
        for(let i = 1; i <= remainingCells; i++) {
            cellsContainer.innerHTML += `<div class="cal-cell prev-month"><span class="cal-date">${i}</span></div>`;
        }

        document.querySelectorAll('.cal-cell[data-day]').forEach(cell => {
            cell.addEventListener('click', function() {
                const day = parseInt(this.getAttribute('data-day'));
                selectedDate = new Date(year, month, day);
                updateSelectedBadge();
                renderCalendar(currentMonth, currentYear);
            });
        });
    }

    function renderJobDetails() {
        const dayJobs = getJobsForDate(selectedDate);
        if (dayJobs.length === 0) {
            jobDetailsContent.innerHTML = `
            <div style="text-align: center; padding: 4rem 1rem; color: var(--text-muted); display: flex; flex-direction: column; align-items: center; gap: 1rem;">
                <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.5;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                <p style="font-weight: 500;">No jobs today.</p>
            </div>`;
            return;
        }

        let html = '';
        dayJobs.forEach(job => {
            let customerName = job.customer ? job.customer.name : 'Unknown Client';
            let jobStatus = job.JobStatus;
            let desc = job.JobDesk ? job.JobDesk : 'No additional details.';
            let duration = job.JobDuration ? `${job.JobDuration} hrs` : 'TBD';
            
            let priceLabel = 'Est. Price';
            let priceValue = '—';
            if (jobStatus === 'finished' && job.JobPrice) {
                priceLabel = 'Final Price';
                priceValue = '$' + parseFloat(job.JobPrice).toFixed(2);
            } else if (jobStatus !== 'finished') {
                priceValue = 'Unbilled';
            }

            let actionHtml = '';
            if(jobStatus === 'pending') {
                actionHtml = `<div style="padding:1rem; background: #fffcf2; border-radius:12px; font-size:0.85rem; color:#b45309; text-align:center; font-weight:600;">Action required in New Job Requests panel above.</div>`;
            } else if(jobStatus === 'accepted') {
                actionHtml = `
                <form method="POST" action="/jobs/${job.JobID}/status" style="margin:0;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="status" value="inspection">
                    <button type="submit" class="btn-message" style="background:#f59e0b; color:white;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        Mark as In-Inspection
                    </button>
                </form>`;
            } else if(jobStatus === 'inspection') {
                actionHtml = `
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <!-- Decline Job Form -->
                    <form method="POST" action="/jobs/${job.JobID}/status" style="margin:0;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn-decline" style="width:100%; display:flex; align-items:center; justify-content:center; gap:0.5rem; background:#fee2e2; color:#ef4444; border:1px solid #fecaca; padding: 0.75rem; border-radius: 12px; font-weight:700; cursor:pointer; transition: all 0.2s;" onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fee2e2'">
                            ✕ Decline / Unable to Perform Work
                        </button>
                    </form>

                    <!-- Estimation Form Builder -->
                    <form id="invoice-form-${job.JobID}" method="POST" action="/jobs/${job.JobID}/status" style="margin:0; background: var(--bg-sidebar); padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); display: flex; flex-direction: column; gap: 1rem;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="status" value="awaiting_approval">
                        
                        <div>
                            <span style="display:block; font-size: 0.75rem; font-weight: 800; color: var(--text-muted); text-transform:uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">Invoice / Estimation Details</span>
                            <div id="invoice-items-${job.JobID}" style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <!-- Dynamic rows here -->
                            </div>
                            <button type="button" onclick="addInvoiceItem(${job.JobID})" style="margin-top: 0.75rem; width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.35rem; padding: 0.6rem; background: var(--primary-light); color: var(--primary); border: none; border-radius: 10px; font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.2s;">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                Add Labor / Materials Item
                            </button>
                        </div>

                        <div style="border-top: 1px dashed var(--border-color); padding-top: 0.75rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; font-weight: 800; color: var(--text-dark);">
                                <span style="font-size: 0.85rem;">Total Amount:</span>
                                <div style="display: flex; align-items: center; gap: 0.25rem;">
                                    <span style="font-size: 1.1rem; font-weight: 800; color: var(--primary);">$</span>
                                    <input type="number" id="invoice-total-${job.JobID}" name="JobPrice" readonly required min="0" step="0.01" style="width: 100px; padding: 0.35rem 0.5rem; border: 1px solid var(--border-color); border-radius: 8px; font-weight: 800; color: var(--primary); font-size: 1.1rem; background: var(--bg-page); text-align: right;" value="0.00">
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-message" style="margin:0; width:100%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.85rem; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(26, 86, 219, 0.2);">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            Send to Customer
                        </button>
                    </form>
                </div>`;
            } else if(jobStatus === 'awaiting_approval') {
                let itemsHtml = '';
                const items = Array.isArray(job.InvoiceItems) ? job.InvoiceItems : (job.InvoiceItems ? JSON.parse(job.InvoiceItems) : []);
                if (items && items.length > 0) {
                    let total = 0;
                    items.forEach(i => total += parseFloat(i.price || 0));
                    itemsHtml = `
                    <div style="margin-top: 1rem; margin-bottom: 1rem; background: var(--bg-sidebar); padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color);">
                        <span style="display:block; font-size: 0.75rem; font-weight: 800; color: var(--text-muted); text-transform:uppercase; letter-spacing: 0.5px; margin-bottom: 0.75rem;">Estimated Charges</span>
                        <div style="display: flex; flex-direction: column; gap: 0.6rem;">
                            ${items.map(item => `
                                <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem;">
                                    <span style="color: var(--text-dark); font-weight: 500;">${item.name}</span>
                                    <span style="color: var(--text-dark); font-weight: 700;">$${parseFloat(item.price).toFixed(2)}</span>
                                </div>
                            `).join('')}
                        </div>
                        <div style="margin-top: 0.75rem; border-top: 1px dashed var(--border-color); padding-top: 0.5rem;">
                            <div style="display:flex; justify-content:space-between; align-items:center; font-weight:800; color:var(--text-dark); font-size:0.9rem;">
                                <span>Total Amount:</span>
                                <span style="color:var(--primary); font-size:1.1rem;">$${total.toFixed(2)}</span>
                            </div>
                        </div>
                    </div>`;
                }
                actionHtml = `
                ${itemsHtml}
                <div style="padding:1.25rem; background: #fffbeb; border:1px solid #fef3c7; border-radius:12px; font-size:0.85rem; color:#b45309; text-align:center; font-weight:600; display:flex; flex-direction:column; gap:0.25rem;">
                    <span>Awaiting Customer Approval</span>
                    <span style="font-size:0.75rem; font-weight:500; color:#d97706;">Estimation sent. Awaiting agree/decline response.</span>
                </div>`;
            } else if(jobStatus === 'repairing') {
                let itemsHtml = '';
                const items = Array.isArray(job.InvoiceItems) ? job.InvoiceItems : (job.InvoiceItems ? JSON.parse(job.InvoiceItems) : []);
                if (items && items.length > 0) {
                    let total = 0;
                    items.forEach(i => total += parseFloat(i.price || 0));
                    itemsHtml = `
                    <div style="margin-top: 1rem; margin-bottom: 1rem; background: var(--bg-sidebar); padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color);">
                        <span style="display:block; font-size: 0.75rem; font-weight: 800; color: var(--text-muted); text-transform:uppercase; letter-spacing: 0.5px; margin-bottom: 0.75rem;">Agreed Estimation Charges</span>
                        <div style="display: flex; flex-direction: column; gap: 0.6rem;">
                            ${items.map(item => `
                                <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem;">
                                    <span style="color: var(--text-dark); font-weight: 500;">${item.name}</span>
                                    <span style="color: var(--text-dark); font-weight: 700;">$${parseFloat(item.price).toFixed(2)}</span>
                                </div>
                            `).join('')}
                        </div>
                        <div style="margin-top: 0.75rem; border-top: 1px dashed var(--border-color); padding-top: 0.5rem;">
                            <div style="display:flex; justify-content:space-between; align-items:center; font-weight:800; color:var(--text-dark); font-size:0.9rem;">
                                <span>Total Amount:</span>
                                <span style="color:var(--primary); font-size:1.1rem;">$${total.toFixed(2)}</span>
                            </div>
                        </div>
                    </div>`;
                }
                actionHtml = `
                ${itemsHtml}
                <form method="POST" action="/jobs/${job.JobID}/status" style="margin:0;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="status" value="finished">
                    <button type="submit" class="btn-message" style="margin:0; width:100%; background: var(--success); color: white; display: flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.85rem; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.2);">
                        ✓ Mark Job Completed
                    </button>
                </form>`;
            } else if(jobStatus === 'finished') {
                let itemsHtml = '';
                const items = Array.isArray(job.InvoiceItems) ? job.InvoiceItems : (job.InvoiceItems ? JSON.parse(job.InvoiceItems) : []);
                if (items && items.length > 0) {
                    itemsHtml = `
                    <div style="margin-top: 1rem; margin-bottom: 1rem; background: var(--bg-sidebar); padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color);">
                        <span style="display:block; font-size: 0.75rem; font-weight: 800; color: var(--text-muted); text-transform:uppercase; letter-spacing: 0.5px; margin-bottom: 0.75rem;">Billed Invoice Items</span>
                        <div style="display: flex; flex-direction: column; gap: 0.6rem;">
                            ${items.map(item => `
                                <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem;">
                                    <span style="color: var(--text-dark); font-weight: 500;">${item.name}</span>
                                    <span style="color: var(--text-dark); font-weight: 700;">$${parseFloat(item.price).toFixed(2)}</span>
                                </div>
                            `).join('')}
                        </div>
                        <div style="margin-top: 0.75rem; border-top: 1px dashed var(--border-color); padding-top: 0.5rem; display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.85rem; font-weight: 800; color: var(--text-dark);">Total Billed:</span>
                            <span style="font-size: 1.1rem; font-weight: 800; color: var(--success);">$${parseFloat(job.JobPrice).toFixed(2)}</span>
                        </div>
                    </div>`;
                }
                actionHtml = `
                ${itemsHtml}
                <div style="padding:1rem; background: #f0fdf4; border-radius:12px; font-size:0.85rem; color:#166534; text-align:center; font-weight:600;">Job completely documented and paid.</div>`;
            }

            html += `
            <div class="job-card">
                <div class="job-card-top">
                    <div>
                        <span class="job-type-label">${job.JobName}</span>
                        <h3 class="job-title">${job.JobType}</h3>
                    </div>
                    <span class="status-badge" style="background:${jobStatus==='pending'?'#fef700':(jobStatus==='finished'?'#d1fae5':(jobStatus==='repairing'?'#dbeafe':'#fef3c7'))};color:#111;">${jobStatus.toUpperCase()}</span>
                </div>
                <p style="font-size: 0.8rem; margin:1rem 0; color:var(--text-muted);">${desc}</p>
                
                <div class="assigned-box">
                    <div class="assigned-avatar" style="background:var(--orange-bg); display:flex; align-items:center; justify-content:center; color:white; font-size:1.2rem; font-weight:bold;">${customerName.charAt(0)}</div>
                    <div class="assigned-info">
                        <span class="assigned-label">Client Name</span>
                        <span class="assigned-name">${customerName}</span>
                        <span class="assigned-rating" style="color:var(--text-muted); font-size:0.7rem;">Verified Member</span>
                    </div>
                </div>

                <button type="button" onclick="openCalJobModal(${job.JobID})" style="width:100%; margin-top:1rem; padding:0.65rem; background:var(--bg-page); border:1px solid var(--border-color); border-radius:10px; font-weight:700; font-size:0.8rem; color:var(--primary); cursor:pointer; display:flex; align-items:center; justify-content:center; gap:0.4rem; transition:background 0.2s;" onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='var(--bg-page)'">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    View Full Details
                </button>
            </div>

            <div class="info-boxes">
                <div class="info-box">
                    <span class="info-box-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        Est. Duration
                    </span>
                    <span class="info-box-val" style="font-size: 0.8rem;">${duration}</span>
                </div>
                <div class="info-box">
                    <span class="info-box-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        ${priceLabel}
                    </span>
                    <span class="info-box-val">${priceValue}</span>
                </div>
            </div>

            ${actionHtml}

            <hr style="border:none; border-top:1px solid var(--border-color); margin:1.5rem 0;">
            `;
        });
        jobDetailsContent.innerHTML = html;

        // Auto-initialize itemized list for any inspection jobs displayed
        dayJobs.forEach(job => {
            if (job.JobStatus === 'inspection') {
                addInvoiceItem(job.JobID);
            }
        });
    }

    window.addInvoiceItem = function(jobId, name = '', price = '') {
        const container = document.getElementById(`invoice-items-${jobId}`);
        if (!container) return;

        const rowCount = container.children.length;
        const row = document.createElement('div');
        row.style.display = 'flex';
        row.style.gap = '0.5rem';
        row.style.alignItems = 'center';
        row.style.minWidth = '0';
        row.innerHTML = `
            <input type="text" name="InvoiceItems[${rowCount}][name]" required style="flex: 1; min-width: 0; padding: 0.5rem 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem; color: var(--text-dark); background: white;" placeholder="Item description" value="${name}">
            <input type="number" name="InvoiceItems[${rowCount}][price]" required min="0" step="0.01" style="width: 70px; flex-shrink: 0; padding: 0.5rem 0.5rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem; font-weight: 700; color: var(--text-dark); background: white; text-align: right;" placeholder="Price" value="${price}" oninput="calculateInvoiceTotal(${jobId})">
            <button type="button" onclick="removeInvoiceItem(this, ${jobId})" style="flex-shrink: 0; width: 32px; height: 32px; padding: 0; color: #ef4444; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; background: #fef2f2; border: 1px solid #fee2e2; transition: all 0.2s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
            </button>
        `;
        container.appendChild(row);
        calculateInvoiceTotal(jobId);
    };

    window.removeInvoiceItem = function(btn, jobId) {
        const row = btn.parentElement;
        row.remove();
        calculateInvoiceTotal(jobId);
        
        // Re-index remaining inputs
        const container = document.getElementById(`invoice-items-${jobId}`);
        Array.from(container.children).forEach((child, index) => {
            const inputs = child.querySelectorAll('input');
            if (inputs.length === 2) {
                inputs[0].name = `InvoiceItems[${index}][name]`;
                inputs[1].name = `InvoiceItems[${index}][price]`;
            }
        });
    };

    window.calculateInvoiceTotal = function(jobId) {
        const container = document.getElementById(`invoice-items-${jobId}`);
        const totalInput = document.getElementById(`invoice-total-${jobId}`);
        if (!container) return;

        let total = 0;
        const priceInputs = container.querySelectorAll('input[type="number"]');
        priceInputs.forEach(input => {
            const val = parseFloat(input.value);
            if (!isNaN(val) && val > 0) {
                total += val;
            }
        });

        if (totalInput) totalInput.value = total.toFixed(2);
    };

    const dayNamesFull = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    function updateSelectedBadge() {
        const dayName = dayNamesFull[selectedDate.getDay()];
        const monthName = monthNames[selectedDate.getMonth()];
        const dateNum = selectedDate.getDate();
        const yearNum = selectedDate.getFullYear();
        
        selectedDateBadge.textContent = `${dayName} ${monthName} ${dateNum}, ${yearNum}`.toUpperCase();
        
        const isToday = (selectedDate.getDate() === today.getDate() && selectedDate.getMonth() === today.getMonth() && selectedDate.getFullYear() === today.getFullYear());
        selectedDateBadge.style.background = isToday ? 'var(--text-muted)' : 'var(--primary)';
        
        renderJobDetails();
    }

    document.getElementById('btnPrevMonth').addEventListener('click', () => {
        currentMonth--;
        if(currentMonth < 0) { currentMonth = 11; currentYear--; }
        renderCalendar(currentMonth, currentYear);
    });
    
    document.getElementById('btnNextMonth').addEventListener('click', () => {
        currentMonth++;
        if(currentMonth > 11) { currentMonth = 0; currentYear++; }
        renderCalendar(currentMonth, currentYear);
    });
    

    renderCalendar(currentMonth, currentYear);
    updateSelectedBadge();
});
</script>
</body>
</html>
