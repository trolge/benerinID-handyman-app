<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - benerin.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a56db;
            --primary-hover: #1e40af;
            --text-dark: #111827;
            --text-muted: #6b7280;
            --bg-page: #f4f6f8;
            --border-color: #e5e7eb;
            --success: #b45309;
            --success-bg: #fff7ed;
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1.5rem;
        }

        .checkout-wrapper {
            background: white;
            width: 100%;
            max-width: 440px;
            border-radius: 28px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border-color);
            overflow: hidden;
            position: relative;
        }

        .checkout-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .back-btn {
            cursor: pointer;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.3px;
        }

        .shield-icon {
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .checkout-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .section-label {
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 0.75rem;
            display: block;
        }

        /* Card container */
        .summary-card {
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 1.25rem;
            position: relative;
            background: white;
        }

        .flex-box {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .job-photo-placeholder {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: var(--bg-page);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .job-photo-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .job-info {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }

        .job-name-title {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .assigned-name {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .date-box {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.35rem;
            font-weight: 500;
        }

        .status-completed-badge {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            background: #ea580c;
            color: white;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Cost breakdown card */
        .breakdown-card {
            background: #f8fafc;
            border-radius: 20px;
            border: 1px solid var(--border-color);
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .breakdown-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .breakdown-row.total-row {
            border-top: 1px solid var(--border-color);
            padding-top: 0.85rem;
            margin-top: 0.25rem;
            font-weight: 800;
        }

        .breakdown-row.total-row .val {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--text-dark);
            letter-spacing: -0.5px;
        }

        .platform-fee-row span {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .info-circle {
            font-size: 0.7rem;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: help;
            color: var(--text-muted);
        }

        .warranty-tag {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-align: right;
            margin-top: -0.25rem;
            font-weight: 500;
        }

        /* Payment method card */
        .payment-method-card {
            border: 2px solid var(--primary);
            border-radius: 16px;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            cursor: pointer;
        }

        .card-selector {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .card-icon {
            width: 38px;
            height: 24px;
            background: #0f172a;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.65rem;
            font-weight: 800;
        }

        .card-details {
            display: flex;
            flex-direction: column;
            gap: 0.1rem;
        }

        .card-number {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .card-expiry {
            font-size: 0.7rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .check-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .add-method-btn {
            border: 1px dashed var(--border-color);
            border-radius: 16px;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--text-dark);
            font-weight: 700;
            font-size: 0.85rem;
            background: #f8fafc;
            cursor: pointer;
        }

        .add-icon {
            width: 20px;
            height: 20px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            background: white;
        }

        .pay-btn {
            width: 100%;
            background: var(--primary);
            color: white;
            padding: 1rem;
            border-radius: 16px;
            font-weight: 800;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(26, 86, 219, 0.3);
        }

        .pay-btn:hover {
            background: var(--primary-hover);
        }

        .ssl-text {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-top: 1rem;
        }

        /* Success Overlay and Rating Portal */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.98);
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            text-align: center;
        }

        .success-tick {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #ecfdf5;
            color: #10b981;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
            margin-bottom: 1.5rem;
            animation: bounceIn 0.6s ease-out forwards;
        }

        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }

        .rating-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .rating-desc {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .stars-row {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .star {
            font-size: 2.25rem;
            color: #d1d5db;
            cursor: pointer;
            transition: color 0.15s;
        }

        .star.selected {
            color: #f59e0b;
        }

        .btn-submit-rating {
            background: var(--primary);
            color: white;
            width: 100%;
            padding: 0.85rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit-rating:hover {
            background: var(--primary-hover);
        }
    </style>
</head>

<body>
    <div class="checkout-wrapper">
        <!-- Success/Rating Portal overlay -->
        @if(session('payment_success'))
            <div class="overlay">
                <div class="success-tick">✓</div>
                <h2 class="rating-title">Payment Successful!</h2>
                <p class="rating-desc">Your invoice has been fully paid. How was your service experience with <strong>{{ $job->handyman ? $job->handyman->name : 'your handyman' }}</strong>?</p>

                <form method="POST" action="{{ route('payments.rate', $job->JobID) }}" style="width: 100%; display: flex; flex-direction: column; align-items: center;">
                    @csrf
                    <input type="hidden" name="rating" id="rating-input" value="5">

                    <div class="stars-row">
                        <span class="star selected" onclick="setRating(1)">★</span>
                        <span class="star selected" onclick="setRating(2)">★</span>
                        <span class="star selected" onclick="setRating(3)">★</span>
                        <span class="star selected" onclick="setRating(4)">★</span>
                        <span class="star selected" onclick="setRating(5)">★</span>
                    </div>

                    <button type="submit" class="btn-submit-rating">Submit Feedback & Return</button>
                </form>
            </div>
        @endif

        <div class="checkout-header">
            <a href="{{ route('payments.index') }}" class="back-btn">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </a>
            <span class="header-title">Checkout</span>
            <div class="shield-icon">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            </div>
        </div>

        <div class="checkout-body">
            <div>
                <span class="section-label">Job Summary</span>
                <div class="summary-card">
                    <span class="status-completed-badge">Completed</span>
                    <div class="flex-box">
                        <div class="job-photo-placeholder">
                            @if($job->JobImages && count($job->JobImages) > 0)
                                <img src="{{ asset('storage/' . $job->JobImages[0]) }}" alt="Job Preview">
                            @else
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            @endif
                        </div>
                        <div class="job-info">
                            <span class="job-name-title">{{ $job->JobType }}</span>
                            <span class="assigned-name">Assigned to {{ $job->handyman ? $job->handyman->name : 'Handyman Pro' }}</span>
                            <div class="date-box">
                                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                {{ $job->JobStartDate ? \Carbon\Carbon::parse($job->JobStartDate)->format('F d, Y') : 'TBD' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <span class="section-label">Cost Breakdown</span>
                <div class="breakdown-card">
                    @php
                        $subtotal = floatval($job->JobPrice);
                        $platformFee = 5.00;
                        $total = $subtotal + $platformFee;

                        $items = is_array($job->InvoiceItems) ? $job->InvoiceItems : ($job->InvoiceItems ? json_decode($job->InvoiceItems, true) : []);
                    @endphp

                    @if(!empty($items))
                        @foreach($items as $item)
                            <div class="breakdown-row">
                                <span>{{ $item['name'] }}</span>
                                <span>${{ number_format($item['price'], 2) }}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="breakdown-row">
                            <span>Labor & Materials</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                    @endif

                    <div class="breakdown-row platform-fee-row">
                        <span>
                            Platform Fee
                            <div class="info-circle" title="Flat fee for connecting you with verified professionals">?</div>
                        </span>
                        <span>$5.00</span>
                    </div>



                    <div class="breakdown-row total-row">
                        <span class="label">Total Amount</span>
                        <span class="val">${{ number_format($total, 2) }}</span>
                    </div>

                    <div class="warranty-tag">Price includes 12-Month Warranty</div>
                </div>
            </div>

            <div>
                <span class="section-label">Payment Method</span>
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <div class="payment-method-card">
                        <div class="card-selector">
                            <div class="card-icon">VISA</div>
                            <div class="card-details">
                                <span class="card-number">Visa ending in 4242</span>
                                <span class="card-expiry">Expires 12/26</span>
                            </div>
                        </div>
                        <div class="check-circle">
                            <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                    </div>

                    <div class="add-method-btn">
                        <span>Add New Method</span>
                        <div class="add-icon">+</div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('payments.process', $job->JobID) }}">
                @csrf
                <button type="submit" class="pay-btn">
                    Pay ${{ number_format($total, 2) }}
                </button>
            </form>

            <div class="ssl-text">
                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                SSL SECURE PAYMENT
            </div>
        </div>
    </div>

    <script>
        function setRating(r) {
            document.getElementById('rating-input').value = r;
            const stars = document.querySelectorAll('.star');
            stars.forEach((star, idx) => {
                if (idx < r) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }
    </script>
</body>

</html>
