<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - benerin.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a56db;
            --primary-hover: #1e40af;
            --text-dark: #111827;
            --text-muted: #6b7280;
            --bg-page: #f4f6f8;
            --bg-sidebar: #fcfcfd;
            --border-color: #e5e7eb;
            --orange-bg: #b05118;
            --orange-text: #ea580c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            background-color: var(--bg-page);
            line-height: 1.5;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        button {
            cursor: pointer;
            border: none;
            font-family: inherit;
        }

        /* Top Navbar */
        .top-navbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 3rem;
        }

        .brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            display: flex;
            align-items: center;
            letter-spacing: -0.5px;
        }

        .brand span {
            color: var(--text-dark);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            height: 100%;
            align-items: center;
        }

        .nav-links a {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-muted);
            padding: 1.5rem 0;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--text-dark);
        }

        .nav-links a.active {
            color: var(--primary);
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary);
            border-radius: 3px 3px 0 0;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .btn-emergency {
            background-color: var(--primary);
            color: white;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: background 0.2s;
        }

        .btn-emergency:hover {
            background-color: var(--primary-hover);
        }

        .icon-btn {
            color: var(--text-muted);
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #374151;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 2px solid white;
            box-shadow: 0 0 0 1px var(--border-color);
            cursor: pointer;
        }

        /* Dropdown UI */
        .dropdown-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            width: 220px;
            border: 1px solid var(--border-color);
            padding: 0.5rem;
            display: none;
            flex-direction: column;
            z-index: 200;
            transform-origin: top right;
        }

        .dropdown-menu.show {
            display: flex;
            animation: slideDown 0.2s ease-out forwards;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            color: var(--text-dark);
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 8px;
            transition: background 0.15s;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .dropdown-item:hover {
            background: var(--bg-page);
        }

        .dropdown-item.text-danger {
            color: #dc2626;
        }

        .dropdown-item.text-danger:hover {
            background: #fef2f2;
        }

        /* Layout Structure */
        .layout-wrapper {
            display: flex;
            min-height: calc(100vh - 70px);
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            padding: 2rem 1.5rem;
            flex-shrink: 0;
        }

        .user-info {
            margin-bottom: 2.5rem;
        }

        .user-greeting {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.25rem;
        }

        .user-name {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .side-menu {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: auto;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .menu-item svg {
            width: 20px;
            height: 20px;
        }

        .menu-item:hover {
            color: var(--text-dark);
        }

        .menu-item.active {
            background: white;
            color: var(--primary);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .sidebar-bottom {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .btn-book {
            background-color: var(--primary);
            color: white;
            padding: 0.875rem 1rem;
            border-radius: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            box-shadow: 0 4px 14px 0 rgba(26, 86, 219, 0.39);
        }

        .btn-book:hover {
            background-color: var(--primary-hover);
        }

        .bottom-links {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .bottom-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem 3rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Top Grid */
        .top-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 2fr;
            gap: 1.5rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #eff6ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-info {
            display: flex;
            flex-direction: column;
        }

        .stat-title {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1;
        }

        .promo-card {
            background: linear-gradient(135deg, var(--orange-bg) 0%, #904011 100%);
            border-radius: 16px;
            padding: 1.5rem 2rem;
            color: white;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .promo-content {
            position: relative;
            z-index: 2;
            max-width: 60%;
        }

        .promo-title {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .promo-desc {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-bottom: 1.5rem;
        }

        .btn-promo-action {
            background: white;
            color: var(--orange-bg);
            font-weight: 700;
            padding: 0.6rem 1.25rem;
            border-radius: 99px;
            font-size: 0.875rem;
            width: fit-content;
        }

        .promo-icon {
            position: absolute;
            right: -10%;
            top: -20%;
            opacity: 0.2;
            transform: scale(3.5);
        }

        .promo-icon svg {
            width: 100px;
            height: 100px;
        }

        /* Main Grid (Calendar + Details) */
        .main-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 350px;
            gap: 2rem;
            align-items: start;
        }

        /* Calendar Panel */
        .panel {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            overflow: hidden;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border-color);
        }

        .panel-title h2 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .panel-title p {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .calendar-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: var(--bg-page);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .cal-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-dark);
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            padding: 1rem 1.5rem 1.5rem;
        }

        .cal-header {
            display: contents;
        }

        .cal-day-name {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-align: center;
            padding-bottom: 1rem;
            text-transform: uppercase;
        }

        .cal-cells {
            display: contents;
        }

        .cal-cell {
            min-height: 100px;
            border-top: 1px solid var(--border-color);
            padding: 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .cal-cell.prev-month {
            background: #fafafa;
        }

        .cal-date {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--text-dark);
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .cal-cell.prev-month .cal-date {
            color: var(--text-muted);
            font-weight: 500;
        }

        .cal-date.active {
            background: var(--primary);
            color: white;
        }

        .cal-event {
            padding: 0.5rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            line-height: 1.4;
            border-left: 3px solid transparent;
        }

        .event-blue {
            background: #eff6ff;
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .event-orange {
            background: #fff7ed;
            color: var(--orange-text);
            border-left-color: var(--orange-text);
        }

        .event-time {
            font-weight: 500;
            font-size: 0.7rem;
            opacity: 0.8;
            margin-top: 0.2rem;
        }

        /* Job Details Panel */
        .details-panel {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .details-header h2 {
            font-size: 1.25rem;
            font-weight: 700;
        }

        .badge-selected {
            background: var(--primary);
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.4rem 0.75rem;
            border-radius: 99px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .job-card {
            background: var(--bg-page);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .job-card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .job-type-label {
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            display: block;
        }

        .job-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .status-badge {
            background: #d1fae5;
            color: #065f46;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 0.35rem 0.65rem;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .assigned-box {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .assigned-avatar {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background-color: #374151;
            flex-shrink: 0;
        }

        .assigned-info {
            display: flex;
            flex-direction: column;
        }

        .assigned-label {
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.25rem;
        }

        .assigned-name {
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .assigned-rating {
            font-size: 0.75rem;
            color: var(--primary);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .info-boxes {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-box {
            flex: 1;
            background: var(--bg-sidebar);
            border-radius: 12px;
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-box-label {
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .info-box-label svg {
            width: 12px;
            height: 12px;
        }

        .info-box-val {
            font-weight: 700;
            font-size: 0.95rem;
            line-height: 1.3;
        }

        .btn-message {
            background: #e5e7eb;
            color: var(--primary);
            font-weight: 700;
            width: 100%;
            padding: 0.875rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            transition: background 0.2s;
        }

        .btn-message:hover {
            background: #d1d5db;
        }

        .service-link {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-muted);
            transition: color 0.2s;
        }

        .service-link:hover {
            color: var(--text-dark);
        }

        .service-link svg {
            transition: transform 0.2s;
        }

        .service-link:hover svg {
            transform: translateX(3px);
        }
    </style>
</head>

<body>

    <!-- Top Navbar -->
    <nav class="top-navbar">
        <div class="nav-left">
            <a href="{{ auth()->check() ? route('dashboard') : url('/') }}" class="brand">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" style="margin-right:8px;"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#1a56db" />
                    <path d="M2 17L12 22L22 17M2 12L12 17L22 12" stroke="#1a56db" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                benerin<span>.id</span>
            </a>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
                <a href="{{ route('services.index') }}">Services</a>
                <a href="{{ route('professionals.index') }}">Professionals</a>
                <a href="{{ route('chat.index') }}">Messages</a>
                <a href="{{ route('payments.index') }}">Payments</a>
            </div>
        </div>
        <div class="nav-right">
            <button class="btn-emergency">Emergency Support</button>
            <div class="icon-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
            </div>
            <div class="icon-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>
            <div class="user-menu" style="position: relative;">
                <div class="user-avatar" id="profileDropdownBtn">
                    @if(auth()->check() && auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar"
                            style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    @endif
                </div>
                <div class="dropdown-menu" id="profileDropdownMenu">
                    <div
                        style="padding: 0.5rem 1rem; border-bottom: 1px solid var(--border-color); margin-bottom: 0.5rem;">
                        <p style="font-weight: 700; font-size: 0.9rem; color: var(--text-dark);">
                            {{ auth()->check() ? auth()->user()->name : 'User Profile' }}
                        </p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">{{ auth()->check() ?
                            auth()->user()->email : 'user@example.com' }}</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Profile Settings
                    </a>
                    <a href="#" class="dropdown-item">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                            </path>
                        </svg>
                        Settings
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger"
                            style="width: 100%; text-align: left; background: none;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
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
                <p class="user-greeting">Welcome back, {{ auth()->check() ? auth()->user()->name : 'Alex' }}</p>
                <h3 class="user-name">Member</h3>
            </div>

            <nav class="side-menu">
                <a href="#" class="menu-item active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    Overview
                </a>
                <a href="#" class="menu-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Schedule
                </a>
                <a href="{{ route('history.index') }}" class="menu-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Service History
                </a>
                <a href="#" class="menu-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Handymen
                </a>
                <a href="#" class="menu-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                        </path>
                    </svg>
                    Settings
                </a>
            </nav>

            <div class="sidebar-bottom">
                <a href="{{ route('services.index') }}" style="display:block;">
                    <button class="btn-book">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                        Book New Service
                    </button>
                </a>
                <div class="bottom-links">
                    <a href="#" class="bottom-link">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                        Help Center
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="bottom-link" style="background:none;">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Metric Cards -->
            <div class="top-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-title">Total Active Jobs</span>
                        <span class="stat-value">{{ $jobs->where('JobStatus', '!=', 'completed')->count() }}</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="color: var(--text-muted); background: var(--bg-page);">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-title">Upcoming Appointments</span>
                        <span
                            class="stat-value">{{ $jobs->where('JobStartDate', '>=', now()->startOfDay())->count() }}</span>
                    </div>
                </div>
                <!-- Promotional Banner -->
                <div class="promo-card">
                    <div class="promo-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                        </svg>
                    </div>
                    <div class="promo-content">
                        <h2 class="promo-title">Emergency Leak?</h2>
                        <p class="promo-desc">Our rapid response team is available 24/7</p>
                        <button class="btn-promo-action">Call Specialist Now</button>
                    </div>
                </div>
            </div>

            <!-- Calendar and Job Details Grid -->
            <div class="main-grid">
                <!-- Calendar Panel -->
                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-title">
                            <h2>Calendar</h2>
                            <p id="currentMonthYear">Loading...</p>
                        </div>
                        <div class="calendar-controls">
                            <span class="cal-btn" id="btnPrevMonth" style="cursor:pointer;"><svg viewBox="0 0 24 24"
                                    width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg></span>
                            <span class="cal-btn" id="btnNextMonth" style="cursor:pointer; padding-left: 0.5rem;"><svg
                                    viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg></span>
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
                        <span id="selectedDateBadge" class="badge-selected"
                            style="background:var(--text-muted); transition: background 0.3s;">Selected: Today</span>
                    </div>

                    <div id="jobDetailsContent">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jobsData = @json($jobs);

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
            if (profileBtn && profileMenu) {
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
                        jobDate.getFullYear() === dateObj.getFullYear();
                });
            }

            function renderCalendar(month, year) {
                monthYearText.textContent = `${monthNames[month]} ${year}`;
                cellsContainer.innerHTML = '';

                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const prevMonthDays = new Date(year, month, 0).getDate();

                for (let i = firstDay - 1; i >= 0; i--) {
                    const day = prevMonthDays - i;
                    cellsContainer.innerHTML += `<div class="cal-cell prev-month"><span class="cal-date">${day}</span></div>`;
                }

                for (let i = 1; i <= daysInMonth; i++) {
                    let isSelected = (i === selectedDate.getDate() && month === selectedDate.getMonth() && year === selectedDate.getFullYear());
                    let activeClass = isSelected ? 'active' : '';
                    let isToday = (i === today.getDate() && month === today.getMonth() && year === today.getFullYear());
                    let todayStyle = isToday && !isSelected ? 'border: 2px solid var(--primary); color: var(--primary);' : '';

                    const cellDate = new Date(year, month, i);
                    const dayJobs = getJobsForDate(cellDate);

                    let eventsHtml = '';
                    dayJobs.forEach(job => {
                        let isOrange = job.JobStatus === 'pending';
                        eventsHtml += `<div class="cal-event ${isOrange ? 'event-orange' : 'event-blue'}">
                            ${job.JobName || job.JobType}
                            <div class="event-time">${job.JobStatus}</div>
                        </div>`;
                    });

                    cellsContainer.innerHTML += `<div class="cal-cell" data-day="${i}" style="cursor:pointer;"><span class="cal-date ${activeClass}" style="${todayStyle}">${i}</span>${eventsHtml}</div>`;
                }

                const totalCellsStr = cellsContainer.children.length;
                const remainingCells = (7 - (totalCellsStr % 7)) % 7;
                for (let i = 1; i <= remainingCells; i++) {
                    cellsContainer.innerHTML += `<div class="cal-cell prev-month"><span class="cal-date">${i}</span></div>`;
                }

                document.querySelectorAll('.cal-cell[data-day]').forEach(cell => {
                    cell.addEventListener('click', function () {
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
                    let handymanname = job.handyman ? job.handyman.name : 'Awaiting Assignment';
                    let jobStatus = job.JobStatus;
                    let desc = job.JobDesk ? job.JobDesk : 'No additional details.';
                    let duration = job.JobDuration ? `${job.JobDuration} hrs` : 'TBD';
                    let handymanRating = job.handyman && job.handyman.avg_rating ? `★ ${parseFloat(job.handyman.avg_rating).toFixed(1)}` : '★ New';

                    let actionHtml = '';
                    if (jobStatus === 'awaiting_approval') {
                        let itemsHtml = '';
                        const items = Array.isArray(job.InvoiceItems) ? job.InvoiceItems : (job.InvoiceItems ? JSON.parse(job.InvoiceItems) : []);
                        if (items && items.length > 0) {
                            let subtotal = 0;
                            items.forEach(i => subtotal += parseFloat(i.price || 0));
                            itemsHtml = `
                            <div style="margin-top: 1rem; margin-bottom: 1rem; background: var(--bg-sidebar); padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color);">
                                <span style="display:block; font-size: 0.75rem; font-weight: 800; color: var(--text-muted); text-transform:uppercase; letter-spacing: 0.5px; margin-bottom: 0.75rem;">Estimation Details</span>
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
                                        <span>Total Estimated:</span>
                                        <span style="color:var(--primary); font-size:1.1rem;">$${subtotal.toFixed(2)}</span>
                                    </div>
                                </div>
                            </div>`;
                        }

                        actionHtml = `
                        ${itemsHtml}
                        <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 1rem; margin-bottom: 1.5rem;">
                            <form method="POST" action="/jobs/${job.JobID}/status" style="margin:0;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="status" value="repairing">
                                <button type="submit" class="btn-message" style="margin:0; width:100%; display:flex; align-items:center; justify-content:center; gap:0.5rem; background:var(--primary); color:white; padding:0.75rem 0.85rem; border:none; border-radius:12px; font-weight:700; cursor:pointer;">
                                    ✓ Approve & Begin Repairs
                                </button>
                            </form>
                            <form method="POST" action="/jobs/${job.JobID}/status" style="margin:0;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" style="width:100%; display:flex; align-items:center; justify-content:center; gap:0.5rem; background:#fee2e2; color:#ef4444; border:1px solid #fecaca; padding:0.75rem 0.85rem; border-radius:12px; font-weight:700; cursor:pointer;">
                                    ✕ Decline & Cancel
                                </button>
                            </form>
                        </div>`;
                    } else if (jobStatus === 'repairing' || jobStatus === 'finished') {
                        let itemsHtml = '';
                        const items = Array.isArray(job.InvoiceItems) ? job.InvoiceItems : (job.InvoiceItems ? JSON.parse(job.InvoiceItems) : []);
                        if (items && items.length > 0) {
                            let subtotal = 0;
                            items.forEach(i => subtotal += parseFloat(i.price || 0));
                            itemsHtml = `
                            <div style="margin-top: 1rem; margin-bottom: 1rem; background: var(--bg-sidebar); padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color);">
                                <span style="display:block; font-size: 0.75rem; font-weight: 800; color: var(--text-muted); text-transform:uppercase; letter-spacing: 0.5px; margin-bottom: 0.75rem;">Agreed Cost Breakdown</span>
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
                                        <span>Total:</span>
                                        <span style="color:var(--primary); font-size:1.1rem;">$${subtotal.toFixed(2)}</span>
                                    </div>
                                </div>
                            </div>`;
                        }
                        actionHtml = itemsHtml;

                        if (jobStatus === 'finished') {
                            actionHtml += `
                            <a href="/payments" style="display:block; text-decoration:none; margin-top: 1rem; margin-bottom: 1.5rem;">
                                <button class="btn-message" style="margin:0; width:100%; background: var(--success); color:white; font-weight:800; border:none; display:flex; align-items:center; justify-content:center; gap:0.5rem; padding: 0.85rem; border-radius:12px; cursor:pointer;">
                                    💳 Proceed to Payment Page
                                </button>
                            </a>`;
                        }
                    }

                    let badgeColor = '#e0e7ff';
                    if (jobStatus === 'pending') badgeColor = '#fef700';
                    else if (jobStatus === 'finished') badgeColor = '#d1fae5';
                    else if (jobStatus === 'awaiting_approval') badgeColor = '#fef3c7';
                    else if (jobStatus === 'repairing') badgeColor = '#dbeafe';

                    html += `
                    <div class="job-card">
                        <div class="job-card-top">
                            <div>
                                <span class="job-type-label">${job.JobName}</span>
                                <h3 class="job-title">${job.JobType}</h3>
                            </div>
                            <span class="status-badge" style="background:${badgeColor};color:#111;">${jobStatus.toUpperCase()}</span>
                        </div>
                        <p style="font-size: 0.8rem; margin:1rem 0; color:var(--text-muted);">${desc}</p>
                        
                        <div class="assigned-box">
                            <div class="assigned-avatar" style="background:var(--primary); display:flex; align-items:center; justify-content:center; color:white; font-size:1.2rem; font-weight:bold;">${handymanname.charAt(0)}</div>
                            <div class="assigned-info">
                                <span class="assigned-label">Assigned Handyman</span>
                                <span class="assigned-name">${handymanname}</span>
                                <span class="assigned-rating">${handymanRating}</span>
                            </div>
                        </div>
                    </div>

                    ${actionHtml}

                    <div class="info-boxes">
                        <div class="info-box">
                            <span class="info-box-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                Est. Date
                            </span>
                            <span class="info-box-val" style="font-size: 0.8rem;">${job.JobStartDate ? new Date(job.JobStartDate).toLocaleDateString() : 'TBD'}</span>
                        </div>
                        <div class="info-box">
                            <span class="info-box-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                Est. Duration
                            </span>
                            <span class="info-box-val">${duration}</span>
                        </div>
                    </div>

                    <button class="btn-message" onclick="window.location.href='/messages?job=${job.JobID}'">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        Message Pro
                    </button>
                    <hr style="border:none; border-top:1px solid var(--border-color); margin:1.5rem 0;">
                    `;
                });
                jobDetailsContent.innerHTML = html;
            }

            const dayNamesFull = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            function updateSelectedBadge() {
                const dayName = dayNamesFull[selectedDate.getDay()];
                const monthName = monthNames[selectedDate.getMonth()];
                const dateNum = selectedDate.getDate();
                const yearNum = selectedDate.getFullYear();

                selectedDateBadge.textContent = `${dayName} ${monthName} ${dateNum}, ${yearNum}`.toUpperCase();
                selectedDateBadge.style.letterSpacing = '1px';
                selectedDateBadge.style.fontWeight = '700';

                const isToday = (selectedDate.getDate() === today.getDate() && selectedDate.getMonth() === today.getMonth() && selectedDate.getFullYear() === today.getFullYear());
                selectedDateBadge.style.background = isToday ? 'var(--text-muted)' : 'var(--primary)';

                renderJobDetails();
            }

            document.getElementById('btnPrevMonth').addEventListener('click', () => {
                currentMonth--;
                if (currentMonth < 0) { currentMonth = 11; currentYear--; }
                renderCalendar(currentMonth, currentYear);
            });

            document.getElementById('btnNextMonth').addEventListener('click', () => {
                currentMonth++;
                if (currentMonth > 11) { currentMonth = 0; currentYear++; }
                renderCalendar(currentMonth, currentYear);
            });


            renderCalendar(currentMonth, currentYear);
            updateSelectedBadge();
        });
    </script>
</body>

</html>