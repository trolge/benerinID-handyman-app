<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - benerin.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a56db;
            --primary-dark: #1e40af;
            --primary-light: #eff6ff;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --text-light: #94a3b8;
            --bg-page: #f8fafc;
            --border-color: #e2e8f0;
            --input-bg: #f1f5f9;
            --success: #16a34a;
            --warning: #f59e0b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: var(--bg-page); color: var(--text-dark); height: 100vh; display: flex; flex-direction: column; }
        a { text-decoration: none; color: inherit; }
        button, input, textarea { border: none; outline: none; background: none; font-family: inherit; }

        /* Top Navbar */
        .top-navbar { height: 70px; background: white; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; flex-shrink: 0; z-index: 100; }
        .nav-left { display: flex; align-items: center; gap: 3rem; }
        .brand { font-size: 1.5rem; font-weight: 800; color: var(--primary); display: flex; align-items: center; letter-spacing: -0.5px; }
        .brand span { color: var(--text-dark); }
        .nav-links { display: flex; gap: 2rem; height: 100%; align-items: center; }
        .nav-links a { font-weight: 600; font-size: 0.95rem; color: var(--text-muted); padding: 1.5rem 0; position: relative; }
        .nav-links a:hover { color: var(--text-dark); }
        .nav-links a.active { color: var(--primary); }
        .nav-links a.active::after { content: ''; position: absolute; bottom: -2px; left: 0; right: 0; height: 3px; background: var(--primary); border-radius: 3px 3px 0 0; }
        .nav-right { display: flex; align-items: center; gap: 1.5rem; }
        .user-avatar-nav { width: 36px; height: 36px; border-radius: 50%; background: #374151; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 2px solid white; box-shadow: 0 0 0 1px var(--border-color); }
        .user-avatar-nav img { width: 100%; height: 100%; object-fit: cover; }

        /* Chat Layout */
        .chat-layout { display: flex; flex: 1; overflow: hidden; }

        /* Sidebar - Conversation List */
        .chat-sidebar { width: 380px; background: white; border-right: 1px solid var(--border-color); display: flex; flex-direction: column; flex-shrink: 0; }
        .sidebar-header { padding: 1.5rem; border-bottom: 1px solid var(--border-color); }
        .sidebar-title { font-size: 1.25rem; font-weight: 800; color: var(--text-dark); margin-bottom: 1rem; }
        .search-box { position: relative; }
        .search-box input { width: 100%; padding: 0.75rem 1rem 0.75rem 2.75rem; background: var(--input-bg); border-radius: 12px; font-size: 0.9rem; font-weight: 500; border: 1px solid transparent; transition: all 0.2s; }
        .search-box input:focus { border-color: var(--primary); background: white; }
        .search-box input::placeholder { color: var(--text-light); }
        .search-box svg { position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%); color: var(--text-light); }

        .conversation-list { flex: 1; overflow-y: auto; }
        .conversation-list::-webkit-scrollbar { width: 4px; }
        .conversation-list::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }

        .conv-item { display: flex; align-items: center; gap: 0.85rem; padding: 1rem 1.5rem; cursor: pointer; transition: background 0.15s; border-left: 3px solid transparent; position: relative; }
        .conv-item:hover { background: #f8fafc; }
        .conv-item.active { background: var(--primary-light); border-left-color: var(--primary); }
        .conv-avatar { width: 44px; height: 44px; border-radius: 50%; background: #e2e8f0; flex-shrink: 0; overflow: hidden; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem; color: var(--text-muted); }
        .conv-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .conv-info { flex: 1; min-width: 0; }
        .conv-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.2rem; }
        .conv-name { font-weight: 700; font-size: 0.9rem; color: var(--text-dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .conv-time { font-size: 0.65rem; font-weight: 600; color: var(--text-light); flex-shrink: 0; margin-left: 0.5rem; }
        .conv-job-label { font-size: 0.7rem; font-weight: 600; color: var(--primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 0.15rem; }
        .conv-preview { font-size: 0.8rem; color: var(--text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 500; }
        .conv-unread { background: var(--primary); color: white; font-size: 0.6rem; font-weight: 800; min-width: 18px; height: 18px; border-radius: 99px; display: flex; align-items: center; justify-content: center; padding: 0 5px; position: absolute; right: 1.5rem; top: 1rem; }

        .conv-empty { padding: 3rem 2rem; text-align: center; color: var(--text-muted); font-weight: 500; font-size: 0.9rem; }

        /* Chat Main Area */
        .chat-main { flex: 1; display: flex; flex-direction: column; background: var(--bg-page); }

        /* Chat Header */
        .chat-header { padding: 1rem 1.5rem; background: white; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
        .chat-header-left { display: flex; align-items: center; gap: 0.85rem; }
        .chat-header-avatar { width: 40px; height: 40px; border-radius: 50%; background: #e2e8f0; overflow: hidden; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; color: var(--text-muted); }
        .chat-header-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .chat-header-name { font-weight: 700; font-size: 1rem; }
        .chat-header-job { font-size: 0.75rem; color: var(--text-muted); font-weight: 500; }
        .chat-status-badge { font-size: 0.6rem; font-weight: 800; padding: 0.3rem 0.65rem; border-radius: 99px; text-transform: uppercase; letter-spacing: 0.5px; }
        .badge-pending { background: #fef9c3; color: #a16207; }
        .badge-active { background: #dbeafe; color: #1d4ed8; }
        .badge-completed { background: #dcfce7; color: #166534; }

        /* Messages Area */
        .chat-messages { flex: 1; overflow-y: auto; padding: 1.5rem; display: flex; flex-direction: column; gap: 0.5rem; }
        .chat-messages::-webkit-scrollbar { width: 5px; }
        .chat-messages::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }

        .msg-date-divider { text-align: center; margin: 1rem 0; }
        .msg-date-divider span { font-size: 0.65rem; font-weight: 700; color: var(--text-light); background: var(--bg-page); padding: 0.3rem 1rem; border-radius: 99px; text-transform: uppercase; letter-spacing: 1px; border: 1px solid var(--border-color); }

        .msg-row { display: flex; gap: 0.5rem; max-width: 75%; animation: msgIn 0.2s ease; }
        .msg-row.mine { margin-left: auto; flex-direction: row-reverse; }
        @keyframes msgIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }

        .msg-avatar-sm { width: 28px; height: 28px; border-radius: 50%; background: #e2e8f0; flex-shrink: 0; overflow: hidden; display: flex; align-items: center; justify-content: center; font-size: 0.6rem; font-weight: 700; color: var(--text-muted); margin-top: 2px; }
        .msg-avatar-sm img { width: 100%; height: 100%; object-fit: cover; }

        .msg-bubble { padding: 0.7rem 1rem; border-radius: 16px; font-size: 0.9rem; line-height: 1.5; font-weight: 500; position: relative; }
        .msg-row:not(.mine) .msg-bubble { background: white; color: var(--text-dark); border-bottom-left-radius: 4px; box-shadow: 0 1px 2px rgba(0,0,0,0.04); }
        .msg-row.mine .msg-bubble { background: var(--primary); color: white; border-bottom-right-radius: 4px; }
        .msg-time { font-size: 0.6rem; color: var(--text-light); margin-top: 0.25rem; font-weight: 600; }
        .msg-row.mine .msg-time { text-align: right; color: rgba(255,255,255,0.6); }

        /* Chat Input */
        .chat-input-area { padding: 1rem 1.5rem; background: white; border-top: 1px solid var(--border-color); flex-shrink: 0; }
        .chat-input-wrap { display: flex; align-items: center; gap: 0.75rem; background: var(--input-bg); border-radius: 16px; padding: 0.5rem 0.5rem 0.5rem 1.25rem; border: 1px solid transparent; transition: all 0.2s; }
        .chat-input-wrap:focus-within { border-color: var(--primary); background: white; }
        .chat-input-wrap input { flex: 1; font-size: 0.95rem; font-weight: 500; padding: 0.5rem 0; color: var(--text-dark); }
        .chat-input-wrap input::placeholder { color: var(--text-light); }
        .btn-send { width: 40px; height: 40px; border-radius: 12px; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s; flex-shrink: 0; }
        .btn-send:hover { background: var(--primary-dark); }
        .btn-send:disabled { background: #94a3b8; cursor: not-allowed; }

        /* Empty Chat State */
        .chat-empty { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; color: var(--text-muted); gap: 1rem; }
        .chat-empty svg { width: 64px; height: 64px; color: #cbd5e1; }
        .chat-empty h3 { font-size: 1.1rem; font-weight: 700; color: var(--text-dark); }
        .chat-empty p { font-size: 0.9rem; max-width: 300px; text-align: center; line-height: 1.5; }
    </style>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="top-navbar">
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="brand">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" style="margin-right:8px;">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#1a56db"/>
                    <path d="M2 17L12 22L22 17M2 12L12 17L22 12" stroke="#1a56db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                benerin<span>.id</span>
            </a>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('history.index') }}">Jobs</a>
                <a href="#">Earnings</a>
                <a href="{{ route('chat.index') }}" class="active">Messages</a>
                <a href="{{ route('payments.index') }}">Payments</a>
            </div>
        </div>
        <div class="nav-right">
            <div class="user-avatar-nav">
                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar">
                @else
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                @endif
            </div>
        </div>
    </nav>

    <!-- Chat Layout -->
    <div class="chat-layout">
        <!-- Sidebar -->
        <div class="chat-sidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-title">Messages</h2>
                <div class="search-box">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" id="convSearch" placeholder="Search conversations..." oninput="filterConversations(this.value)">
                </div>
            </div>
            <div class="conversation-list" id="convList">
                @forelse($jobs as $job)
                    @php
                        $otherUser = $isHandyman ? $job->customer : $job->handyman;
                        $otherName = $otherUser ? $otherUser->name : 'Unknown';
                        $otherAvatar = $otherUser && $otherUser->avatar ? asset('storage/' . $otherUser->avatar) : null;
                        $isActive = $activeJob && $activeJob->JobID === $job->JobID;
                    @endphp
                    <a href="{{ route('chat.index', ['job' => $job->JobID]) }}" class="conv-item {{ $isActive ? 'active' : '' }}" data-name="{{ strtolower($otherName) }}" data-job="{{ strtolower($job->JobName) }}">
                        <div class="conv-avatar">
                            @if($otherAvatar)
                                <img src="{{ $otherAvatar }}" alt="{{ $otherName }}">
                            @else
                                {{ $otherUser ? substr($otherUser->name, 0, 1) : '?' }}
                            @endif
                        </div>
                        <div class="conv-info">
                            <div class="conv-top">
                                <span class="conv-name">{{ $otherName }}</span>
                                @if($job->latestMessage)
                                    <span class="conv-time">{{ $job->latestMessage->created_at->diffForHumans(null, true, true) }}</span>
                                @endif
                            </div>
                            <div class="conv-job-label">{{ $job->JobType ?? $job->JobName }}</div>
                            <div class="conv-preview">
                                @if($job->latestMessage)
                                    {{ $job->latestMessage->SenderID === auth()->id() ? 'You: ' : '' }}{{ Str::limit($job->latestMessage->message, 40) }}
                                @else
                                    No messages yet
                                @endif
                            </div>
                        </div>
                        @if($job->unreadCount > 0)
                            <span class="conv-unread">{{ $job->unreadCount }}</span>
                        @endif
                    </a>
                @empty
                    <div class="conv-empty">
                        <p>No conversations yet.</p>
                        <p style="font-size:0.8rem; margin-top:0.5rem;">Conversations are created when you book or receive a job.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Chat Main -->
        <div class="chat-main">
            @if($activeJob)
                @php
                    $chatPartner = $isHandyman ? $activeJob->customer : $activeJob->handyman;
                    $chatPartnerName = $chatPartner ? $chatPartner->name : 'Unknown';
                    $chatPartnerAvatar = $chatPartner && $chatPartner->avatar ? asset('storage/' . $chatPartner->avatar) : null;

                    $statusBadge = 'badge-active';
                    $statusText = strtoupper($activeJob->JobStatus);
                    if ($activeJob->JobStatus === 'pending') $statusBadge = 'badge-pending';
                    elseif ($activeJob->JobStatus === 'finished') { $statusBadge = 'badge-completed'; $statusText = 'COMPLETED'; }
                @endphp

                <!-- Chat Header -->
                <div class="chat-header">
                    <div class="chat-header-left">
                        <div class="chat-header-avatar">
                            @if($chatPartnerAvatar)
                                <img src="{{ $chatPartnerAvatar }}" alt="{{ $chatPartnerName }}">
                            @else
                                {{ $chatPartner ? substr($chatPartner->name, 0, 1) : '?' }}
                            @endif
                        </div>
                        <div>
                            <div class="chat-header-name">{{ $chatPartnerName }}</div>
                            <div class="chat-header-job">{{ $activeJob->JobType ?? $activeJob->JobName }} &middot; {{ \Carbon\Carbon::parse($activeJob->JobStartDate)->format('M d, Y') }}</div>
                        </div>
                    </div>
                    <span class="chat-status-badge {{ $statusBadge }}">{{ $statusText }}</span>
                </div>

                <!-- Messages -->
                <div class="chat-messages" id="chatMessages">
                    @php $lastDate = null; @endphp
                    @forelse($messages as $msg)
                        @php
                            $msgDate = $msg->created_at->format('M d, Y');
                            $isMine = $msg->SenderID === auth()->id();
                        @endphp
                        @if($msgDate !== $lastDate)
                            <div class="msg-date-divider"><span>{{ $msg->created_at->isToday() ? 'Today' : ($msg->created_at->isYesterday() ? 'Yesterday' : $msgDate) }}</span></div>
                            @php $lastDate = $msgDate; @endphp
                        @endif
                        <div class="msg-row {{ $isMine ? 'mine' : '' }}" data-id="{{ $msg->MessageID }}">
                            @if(!$isMine)
                                <div class="msg-avatar-sm">
                                    @if($msg->sender && $msg->sender->avatar)
                                        <img src="{{ asset('storage/' . $msg->sender->avatar) }}">
                                    @else
                                        {{ $msg->sender ? substr($msg->sender->name, 0, 1) : '?' }}
                                    @endif
                                </div>
                            @endif
                            <div>
                                <div class="msg-bubble">{{ $msg->message }}</div>
                                <div class="msg-time">{{ $msg->created_at->format('g:i A') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="chat-empty" id="emptyChat">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                            <h3>Start the conversation</h3>
                            <p>Send a message about this job to get started.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Input -->
                <div class="chat-input-area">
                    <form method="POST" action="{{ route('chat.send', $activeJob->JobID) }}" id="chatForm" autocomplete="off">
                        @csrf
                        <div class="chat-input-wrap">
                            <input type="text" name="message" id="chatInput" placeholder="Type a message..." required maxlength="2000" autofocus>
                            <button type="submit" class="btn-send" id="btnSend">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <!-- No conversation selected -->
                <div class="chat-empty">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    <h3>Your Messages</h3>
                    <p>Select a conversation or create a new booking to start chatting.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Scroll to bottom of chat
        const chatMessages = document.getElementById('chatMessages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Search filter
        window.filterConversations = function(query) {
            const q = query.toLowerCase();
            document.querySelectorAll('.conv-item').forEach(item => {
                const name = item.dataset.name || '';
                const job = item.dataset.job || '';
                item.style.display = (name.includes(q) || job.includes(q)) ? '' : 'none';
            });
        };

        // Polling for new messages
        @if($activeJob)
        const JOB_ID = {{ $activeJob->JobID }};
        const POLL_URL = '{{ route("chat.poll", $activeJob->JobID) }}';
        let lastMessageId = {{ $messages->last() ? $messages->last()->MessageID : 0 }};

        function pollMessages() {
            fetch(`${POLL_URL}?after=${lastMessageId}`)
                .then(r => r.json())
                .then(newMsgs => {
                    if (!newMsgs.length) return;

                    // Remove empty state if present
                    const emptyEl = document.getElementById('emptyChat');
                    if (emptyEl) emptyEl.remove();

                    const container = document.getElementById('chatMessages');
                    let lastRenderedDate = container.querySelector('.msg-date-divider:last-of-type span')?.textContent || '';

                    newMsgs.forEach(msg => {
                        // Date divider
                        const today = new Date().toLocaleDateString('en-US', {month:'short', day:'numeric', year:'numeric'});
                        const msgDateLabel = msg.date === today ? 'Today' : msg.date;
                        if (msgDateLabel !== lastRenderedDate) {
                            const divider = document.createElement('div');
                            divider.className = 'msg-date-divider';
                            divider.innerHTML = `<span>${msgDateLabel}</span>`;
                            container.appendChild(divider);
                            lastRenderedDate = msgDateLabel;
                        }

                        const row = document.createElement('div');
                        row.className = 'msg-row' + (msg.is_mine ? ' mine' : '');
                        row.dataset.id = msg.id;

                        let avatarHtml = '';
                        if (!msg.is_mine) {
                            if (msg.sender_avatar) {
                                avatarHtml = `<div class="msg-avatar-sm"><img src="${msg.sender_avatar}"></div>`;
                            } else {
                                avatarHtml = `<div class="msg-avatar-sm">${msg.sender_name.charAt(0)}</div>`;
                            }
                        }

                        row.innerHTML = `
                            ${avatarHtml}
                            <div>
                                <div class="msg-bubble">${escapeHtml(msg.message)}</div>
                                <div class="msg-time">${msg.time}</div>
                            </div>
                        `;
                        container.appendChild(row);
                        lastMessageId = msg.id;
                    });

                    container.scrollTop = container.scrollHeight;
                })
                .catch(() => {});
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }

        setInterval(pollMessages, 3000);

        // Handle form submit via AJAX for smoother UX
        const chatForm = document.getElementById('chatForm');
        const chatInput = document.getElementById('chatInput');

        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const msg = chatInput.value.trim();
            if (!msg) return;

            const formData = new FormData(chatForm);

            // Optimistic UI: add message immediately
            const container = document.getElementById('chatMessages');
            const emptyEl = document.getElementById('emptyChat');
            if (emptyEl) emptyEl.remove();

            const row = document.createElement('div');
            row.className = 'msg-row mine';
            const now = new Date();
            const timeStr = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
            row.innerHTML = `
                <div>
                    <div class="msg-bubble">${escapeHtml(msg)}</div>
                    <div class="msg-time">${timeStr}</div>
                </div>
            `;
            container.appendChild(row);
            container.scrollTop = container.scrollHeight;
            chatInput.value = '';

            // Send to server
            fetch(chatForm.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).then(r => {
                if (!r.ok) console.error('Send failed');
                // Poll will pick up the message and update lastMessageId
            }).catch(err => console.error('Send error:', err));
        });
        @endif
    });
    </script>
</body>
</html>
