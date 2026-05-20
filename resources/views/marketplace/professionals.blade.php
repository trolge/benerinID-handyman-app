<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find your craftsman - benerin.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a56db;
            --primary-hover: #1e40af;
            --text-dark: #111827;
            --text-muted: #6b7280;
            --bg-page: #f8fafc;
            --border-color: #e2e8f0;
            --card-bg: white;
            --accent: #f59e0b;
            /* For stars */
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
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button,
        input {
            font-family: inherit;
            border: none;
            outline: none;
            background: none;
        }

        /* Top Navbar (Dashboard Synced) */
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
            cursor: pointer;
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
            cursor: pointer;
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
            cursor: pointer;
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

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 5%;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 1rem;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 0.25rem 1rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .search-bar svg {
            color: var(--text-muted);
            margin-right: 0.5rem;
        }

        .search-bar input {
            border: none;
            outline: none;
            padding: 0.75rem 0.5rem;
            width: 100%;
            font-size: 0.95rem;
            font-family: inherit;
        }

        .pills-container {
            display: flex;
            gap: 0.5rem;
            overflow-x: auto;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
            scrollbar-width: none;
        }

        .pills-container::-webkit-scrollbar {
            display: none;
        }

        .pill {
            padding: 0.5rem 1.25rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            white-space: nowrap;
            transition: all 0.2s;
            border: 1px solid transparent;
            background: #e2e8f0;
            color: var(--text-dark);
        }

        .pill:hover {
            background: #cbd5e1;
        }

        .pill.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 2px 4px rgba(26, 86, 219, 0.2);
        }

        .pro-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            margin-bottom: 1.5rem;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
        }

        .pro-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .pro-header {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .pro-avatar {
            width: 72px;
            height: 72px;
            border-radius: 12px;
            background: #374151;
            overflow: hidden;
            position: relative;
            flex-shrink: 0;
        }

        .pro-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .verified-badge {
            position: absolute;
            bottom: -6px;
            right: -6px;
            background: var(--primary);
            color: white;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        .pro-info {
            flex: 1;
        }

        .pro-badge {
            text-transform: uppercase;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
            display: block;
        }

        .pro-name {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .rating-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            background: var(--bg-page);
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .rating-chip svg {
            color: var(--accent);
            fill: var(--accent);
        }

        .pro-desc {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 1.25rem;
            line-height: 1.6;
        }

        .pro-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .tag {
            background: #dbeafe;
            color: #1e40af;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pro-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
        }

        .btn-text {
            color: var(--primary);
            font-weight: 700;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            cursor: pointer;
        }

        .btn-solid {
            background: var(--primary);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            text-align: center;
            transition: background 0.2s;
            flex-shrink: 0;
            box-shadow: 0 4px 6px -1px rgba(26, 86, 219, 0.2);
        }

        .btn-solid:hover {
            background: var(--primary-hover);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: var(--text-muted);
        }

        .empty-state svg {
            opacity: 0.5;
            margin-bottom: 1rem;
        }

        /* Reviews Modal */
        .reviews-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 500;
            align-items: center;
            justify-content: center;
        }

        .reviews-overlay.show {
            display: flex;
        }

        .reviews-sheet {
            background: white;
            border-radius: 20px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            padding: 2rem;
            position: relative;
        }

        .reviews-sheet h2 {
            font-size: 1.15rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
        }

        .reviews-avg {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .reviews-avg .stars {
            color: var(--accent);
            font-weight: 700;
        }

        .review-item {
            border-top: 1px solid var(--border-color);
            padding: 1rem 0;
        }

        .review-item:first-child {
            border-top: none;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.35rem;
        }

        .review-author {
            font-weight: 700;
            font-size: 0.85rem;
        }

        .review-rating {
            color: var(--accent);
            font-size: 0.8rem;
            font-weight: 700;
        }

        .review-text {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .review-date {
            font-size: 0.7rem;
            color: #94a3b8;
            margin-top: 0.25rem;
        }

        .reviews-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            cursor: pointer;
            color: var(--text-muted);
            background: var(--bg-page);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .no-reviews-msg {
            text-align: center;
            padding: 2rem 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

    <!-- Unified Top Navbar -->
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
                @auth
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ route('services.index') }}">Services</a>
                    <a href="{{ route('professionals.index') }}" class="active">Professionals</a>
                    <a href="{{ route('chat.index') }}">Messages</a>
                    <a href="{{ route('payments.index') }}">Payments</a>
                @endauth
            </div>
        </div>
        <div class="nav-right">
            @auth
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
                        @if(auth()->user()->avatar)
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
                                {{ auth()->user()->name }}
                            </p>
                            <p style="font-size: 0.75rem; color: var(--text-muted);">{{ auth()->user()->email }}</p>
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
            @else
                <a href="{{ route('login') }}" class="btn-emergency"
                    style="background:#f3f4f6; color:#111; border:1px solid #d1d5db;">Log in</a>
            @endauth
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Find your craftsman</h1>
            <p class="page-subtitle">Verified professionals for your home maintenance needs.</p>
        </div>

        <div class="search-bar">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="proSearchInput" placeholder="Search for plumbers, electricians, or painters...">
        </div>

        <div class="pills-container">
            <a href="{{ route('professionals.index') }}"
                class="pill {{ $currentCategory == 'all' ? 'active' : '' }}">All Experts</a>
            @foreach($categories as $cat)
                <a href="{{ route('professionals.index', ['category' => $cat['slug']]) }}"
                    class="pill {{ $currentCategory == $cat['slug'] ? 'active' : '' }}">{{ $cat['name'] }}</a>
            @endforeach
        </div>

        <div class="pros-list">
            @if($handymen->isEmpty())
                <div class="empty-state">
                    <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>
                    <p style="font-weight: 500; font-size: 1.1rem;">No professionals found.</p>
                    <p style="font-size: 0.9rem;">Try selecting a different category or clearing filters.</p>
                    <a href="{{ route('professionals.index') }}"
                        style="color: var(--primary); font-weight: 600; display: inline-block; margin-top: 1rem;">Clear
                        Filters</a>
                </div>
            @endif

            @foreach($handymen as $pro)
                <div class="pro-card" data-name="{{ strtolower($pro->name) }}"
                    data-category="{{ strtolower($pro->primaryCategory) }}">
                    <div class="pro-header">
                        <div class="pro-avatar">
                            @if($pro->avatar)
                                <img src="{{ asset('storage/' . $pro->avatar) }}" alt="{{ $pro->name }}">
                            @else
                                <div
                                    style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:white; font-size:1.5rem; font-weight:bold;">
                                    {{ substr($pro->name, 0, 1) }}
                                </div>
                            @endif
                            <!-- Verified Badge -->
                            <div class="verified-badge">
                                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                        </div>
                        <div class="pro-info">
                            <h2 class="pro-name">
                                <div>
                                    <span class="pro-badge">Verified Professional</span>
                                    <span class="pro-real-name">{{ $pro->name }}</span>
                                </div>
                                @if($pro->average_rating > 0)
                                    <span class="rating-chip">
                                        <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2">
                                            <polygon
                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                            </polygon>
                                        </svg>
                                        {{ number_format($pro->average_rating, 1) }} <span
                                            style="color:var(--text-muted);font-weight:500;">({{ $pro->review_count }})</span>
                                    </span>
                                @endif
                            </h2>
                        </div>
                    </div>

                    <p class="pro-desc">
                        @if($pro->Expertise)
                            {{ $pro->Expertise }}
                        @else
                            Professional specialist delivering top-tier services in {{ $pro->primaryCategory }}. Highly rated
                            for prompt response and excellent craftsmanship. Available for urgent bookings.
                        @endif
                    </p>

                    <div class="pro-tags">
                        @php
                            $proTags = [];
                            if (is_string($pro->Tags)) {
                                $proTags = json_decode($pro->Tags, true) ?? [];
                            } elseif (is_array($pro->Tags)) {
                                $proTags = $pro->Tags;
                            }
                        @endphp
                        @if(empty($proTags))
                            <span class="tag">{{ strtoupper($pro->primaryCategory) }}</span>
                        @else
                            @foreach($proTags as $t)
                                <span class="tag">{{ strtoupper($t) }}</span>
                            @endforeach
                        @endif
                    </div>

                    <div class="pro-actions">
                        <span class="btn-text" style="cursor:pointer;" onclick="openReviewsModal({{ $pro->UserID }})">
                            View Reviews{{ $pro->review_count > 0 ? ' (' . $pro->review_count . ')' : '' }}
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                        <a href="{{ route('booking.create', ['handyman' => $pro->UserID]) }}" class="btn-solid">Book Now</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- JavaScript Hidden No Results Message -->
        <div id="noProResultsMsg" style="display:none; text-align:center; padding: 4rem; color: var(--text-muted);">
            No professionals matched your search. Try different keywords.
        </div>
    </div>

    <!-- Reviews Modal -->
    <div class="reviews-overlay" id="reviewsModal">
        <div class="reviews-sheet">
            <div class="reviews-close" onclick="closeReviewsModal()">&times;</div>
            <h2 id="reviewsModalTitle">Reviews</h2>
            <div class="reviews-avg" id="reviewsModalAvg"></div>
            <div id="reviewsModalContent"></div>
        </div>
    </div>

    <!-- Dropdown and Search Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Profile Dropdown Toggle
            const profileBtn = document.getElementById('profileDropdownBtn');
            const profileMenu = document.getElementById('profileDropdownMenu');
            if (profileBtn) {
                profileBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    profileMenu.classList.toggle('show');
                });
                document.addEventListener('click', (e) => {
                    if (!profileMenu.contains(e.target)) profileMenu.classList.remove('show');
                });
            }

            // Realtime Search Filter
            const searchInput = document.getElementById('proSearchInput');
            const cards = document.querySelectorAll('.pro-card');
            const noResults = document.getElementById('noProResultsMsg');

            if (searchInput) {
                searchInput.addEventListener('input', function (e) {
                    const query = e.target.value.toLowerCase();
                    let visibleCount = 0;

                    cards.forEach(card => {
                        const name = card.getAttribute('data-name');
                        const cat = card.getAttribute('data-category');

                        if (name.includes(query) || cat.includes(query)) {
                            card.style.display = 'block';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    if (visibleCount === 0) {
                        noResults.style.display = 'block';
                    } else {
                        noResults.style.display = 'none';
                    }
                });
            }
        });

        // Reviews data
        @php
            $reviewsData = $handymen->mapWithKeys(function ($h) {
                return [
                    $h->UserID => [
                        'name' => $h->name,
                        'avg' => $h->average_rating,
                        'count' => $h->review_count,
                        'reviews' => $h->reviews->map(function ($r) {
                            return [
                                'rating' => $r->Rating,
                                'feedback' => $r->feedback,
                                'customer' => $r->customer ? $r->customer->name : 'Anonymous',
                                'date' => $r->created_at ? $r->created_at->format('M d, Y') : '',
                            ];
                        })->values()
                    ]
                ];
            });
        @endphp
        const handymenReviews = @json($reviewsData);

          window.openReviewsModal = function(userId) {
            const data = handymenReviews[userId];
            if (!data) return;
            document.getElementById('reviewsModalTitle').textContent = data.name + ' — Reviews';
            const avgEl = document.getElementById('reviewsModalAvg');
            if (data.count > 0) {
                avgEl.innerHTML = `<span class="stars">★ ${parseFloat(data.avg).toFixed(1)}</span> · ${data.count} review${data.count > 1 ? 's' : ''}`;
            } else {
                avgEl.innerHTML = '';
            }
            const content = document.getElementById('reviewsModalContent');
            if (data.reviews.length === 0) {
                content.innerHTML = '<div class="no-reviews-msg">No reviews yet for this professional.</div>';
            } else {
                content.innerHTML = data.reviews.map(r => `
                    <div class="review-item">
                        <div class="review-header">
                            <span class="review-author">${r.customer}</span>
                                <span class="review-rating">${'★'.repeat(r.rating)}${'☆'.repeat(5-r.rating)}</span>
                        </div>
                        ${r.feedback ? `<p class="review-text">${r.feedback}</p>` : '<p class="review-text" style="font-style:italic;">No written feedback.</p>'}
                        <div class="review-date">${r.date}</div>
                    </div>
                `).join('');
            }
            document.getElementById('reviewsModal').classList.add('show');
        };
          window.closeReviewsModal = function() {
            document.getElementById('reviewsModal').classList.remove('show');
        };
          document.getElementById('reviewsModal').addEventListener('click', function(e) {
            if (e.target === this) closeReviewsModal();
        });
            < /s
cript> 
 </body></html>
