<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - benerin.id</title>
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
            --success: #10b981;
            --warning: #f59e0b;
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

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--text-dark);
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

        .container {
            max-width: 1000px;
            margin: 2.5rem auto;
            padding: 0 1.5rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .title h1 {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .title p {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
        }

        /* Tabs */
        .tabs {
            display: flex;
            gap: 1rem;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .tab-btn {
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
        }

        .tab-btn.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        /* Invoice Grid */
        .invoice-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .invoice-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .invoice-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .badge {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            padding: 0.35rem 0.6rem;
            border-radius: 6px;
            letter-spacing: 0.5px;
        }

        .badge-pending {
            background: #fffbeb;
            color: #d97706;
        }

        .badge-paid {
            background: #ecfdf5;
            color: var(--success);
        }

        .job-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .job-meta {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
        }

        .pro-box {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: var(--bg-page);
            border-radius: 12px;
        }

        .pro-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .pro-info {
            display: flex;
            flex-direction: column;
        }

        .pro-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .pro-role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px dashed var(--border-color);
            padding-top: 1rem;
        }

        .price-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .price-value {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--primary);
        }

        .btn-pay {
            width: 100%;
            background: var(--primary);
            color: white;
            padding: 0.75rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.9rem;
            text-align: center;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-block;
        }

        .btn-pay:hover {
            background: var(--primary-hover);
        }

        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            background: white;
            border-radius: 20px;
            border: 1px dashed var(--border-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.25rem;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #eff6ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <!-- Top Navbar -->
    <nav class="top-navbar">
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="brand">benerin<span>id</span></a>
            <div class="nav-links">
                @if(auth()->check() && auth()->user()->Role === 'handyman')
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ route('history.index') }}">Jobs</a>
                    <a href="#">Earnings</a>
                    <a href="{{ route('chat.index') }}">Messages</a>
                    <a href="{{ route('payments.index') }}" class="active">Payments</a>
                @else
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ route('services.index') }}">Services</a>
                    <a href="{{ route('professionals.index') }}">Professionals</a>
                    <a href="{{ route('chat.index') }}">Messages</a>
                    <a href="{{ route('payments.index') }}" class="active">Payments</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #047857; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; font-weight: 600; font-size: 0.9rem;">
                {{ session('success') }}
            </div>
        @endif

        <div class="header">
            <div class="title">
                <h1>My Invoices</h1>
                <p>Manage pending and completed transaction invoices</p>
            </div>
        </div>

        <div class="tabs">
            <button class="tab-btn active" onclick="switchTab('pending')">Pending Payments ({{ $unpaidJobs->count() }})</button>
            <button class="tab-btn" onclick="switchTab('paid')">Payment History ({{ $paidJobs->count() }})</button>
        </div>

        <!-- Pending Invoices Section -->
        <div id="pending-section" class="tab-content">
            @if($unpaidJobs->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <div>
                        <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:0.25rem;">All caught up!</h3>
                        <p style="font-size:0.85rem; color:var(--text-muted);">You have no outstanding invoices to pay.</p>
                    </div>
                </div>
            @else
                <div class="invoice-grid">
                    @foreach($unpaidJobs as $job)
                        <div class="invoice-card">
                            <div class="card-top">
                                <div>
                                    <h3 class="job-title">{{ $job->JobType }}</h3>
                                    <p class="job-meta">#{{ $job->JobID }} • {{ $job->JobName }}</p>
                                </div>
                                <span class="badge badge-pending">Unpaid</span>
                            </div>

                            <div class="pro-box">
                                <div class="pro-avatar">
                                    {{ $job->handyman ? substr($job->handyman->name, 0, 1) : 'H' }}
                                </div>
                                <div class="pro-info">
                                    <span class="pro-name">{{ $job->handyman ? $job->handyman->name : 'Handyman Pro' }}</span>
                                    <span class="pro-role">Assigned Pro</span>
                                </div>
                            </div>

                            <div class="price-row">
                                <span class="price-label">Job Cost (Subtotal)</span>
                                <span class="price-value">${{ number_format($job->JobPrice, 2) }}</span>
                            </div>

                            <a href="{{ route('payments.checkout', $job->JobID) }}" class="btn-pay">Pay Invoice</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Paid Invoices Section -->
        <div id="paid-section" class="tab-content" style="display: none;">
            @if($paidJobs->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                    </div>
                    <div>
                        <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:0.25rem;">No payment history</h3>
                        <p style="font-size:0.85rem; color:var(--text-muted);">Invoices you pay will be archived here.</p>
                    </div>
                </div>
            @else
                <div class="invoice-grid">
                    @foreach($paidJobs as $job)
                        <div class="invoice-card" style="opacity: 0.95;">
                            <div class="card-top">
                                <div>
                                    <h3 class="job-title">{{ $job->JobType }}</h3>
                                    <p class="job-meta">#{{ $job->JobID }} • {{ $job->JobName }}</p>
                                </div>
                                <span class="badge badge-paid">Paid</span>
                            </div>

                            <div class="pro-box">
                                <div class="pro-avatar">
                                    {{ $job->handyman ? substr($job->handyman->name, 0, 1) : 'H' }}
                                </div>
                                <div class="pro-info">
                                    <span class="pro-name">{{ $job->handyman ? $job->handyman->name : 'Handyman Pro' }}</span>
                                    <span class="pro-role">Assigned Pro</span>
                                </div>
                            </div>

                            <div class="price-row">
                                <span class="price-label">Total Settled</span>
                                <span class="price-value" style="color: var(--success);">${{ number_format($job->JobPrice * 1.08 + 5.0, 2) }}</span>
                            </div>

                            <div style="text-align: center; color: var(--success); font-weight: 700; font-size: 0.85rem; display: flex; align-items: center; justify-content: center; gap: 0.35rem; padding: 0.5rem; background: #ecfdf5; border-radius: 10px;">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                Invoice Fully Settled
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        function switchTab(tab) {
            const btns = document.querySelectorAll('.tab-btn');
            btns.forEach(btn => btn.classList.remove('active'));

            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => content.style.display = 'none');

            if (tab === 'pending') {
                btns[0].classList.add('active');
                document.getElementById('pending-section').style.display = 'block';
            } else {
                btns[1].classList.add('active');
                document.getElementById('paid-section').style.display = 'block';
            }
        }
    </script>
</body>

</html>
