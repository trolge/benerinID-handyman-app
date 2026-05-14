<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service History - benerin.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #eff6ff;
            --success: #16a34a;
            --success-light: #dcfce7;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --text-light: #94a3b8;
            --bg-page: #f8fafc;
            --border-color: #f1f5f9;
            --input-bg: #f1f5f9;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-page); color: var(--text-dark); display: flex; justify-content: center; }
        a { text-decoration: none; color: inherit; }
        button, input { border: none; outline: none; background: none; font-family: inherit; }

        .mobile-container { width: 100%; max-width: 480px; background: #ffffff; min-height: 100vh; position: relative; padding-bottom: 2rem; }

        /* Header */
        .header { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem 1.5rem 1.25rem; background: white; position: sticky; top: 0; z-index: 50;}
        .header h1 { font-size: 1.05rem; font-weight: 800; color: var(--primary); }
        .icon-btn { color: var(--primary); display: flex; align-items: center; justify-content: center; cursor: pointer; }

        .content { padding: 0 1.5rem; }

        /* Search */
        .search-container { position: relative; margin-bottom: 1.25rem; }
        .search-icon { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light); }
        .search-input { width: 100%; padding: 0.85rem 1rem 0.85rem 3rem; background: var(--input-bg); border-radius: 12px; font-size: 0.95rem; font-weight: 500; color: var(--text-dark); border: 1px solid transparent; transition: border-color 0.2s;}
        .search-input:focus { border-color: var(--primary); background: white; }
        .search-input::placeholder { color: var(--text-light); }

        /* Toggles */
        .toggle-container { display: flex; background: var(--input-bg); border-radius: 12px; padding: 0.25rem; margin-bottom: 1.5rem; }
        .toggle-btn { flex: 1; padding: 0.65rem 0; text-align: center; font-size: 0.8rem; font-weight: 700; color: var(--text-muted); border-radius: 10px; cursor: pointer; transition: all 0.2s; }
        .toggle-btn.active { background: white; color: var(--primary); box-shadow: 0 2px 8px rgba(0,0,0,0.05); }

        /* Job Cards */
        .card-list { display: flex; flex-direction: column; gap: 1rem; padding-bottom: 4rem; }
        .job-card { background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.25rem; box-shadow: 0 4px 20px rgba(0,0,0,0.02); display: flex; flex-direction: column; gap: 1rem; }
        
        .card-header { display: flex; justify-content: space-between; align-items: center; }
        .badge { font-size: 0.6rem; font-weight: 800; padding: 0.35rem 0.6rem; border-radius: 99px; text-transform: uppercase; letter-spacing: 0.5px; }
        .badge.in-progress { background: var(--primary-light); color: var(--primary); }
        .badge.completed { background: var(--success-light); color: var(--success); }
        .badge.pending { background: #fef9c3; color: #a16207; }

        .job-price { font-size: 1.05rem; font-weight: 800; color: var(--text-dark); }

        .job-title { font-size: 1rem; font-weight: 800; line-height: 1.3; color: var(--text-dark); }

        .job-profile { display: flex; align-items: center; justify-content: space-between; }
        .profile-left { display: flex; align-items: center; gap: 0.75rem; }
        .avatar { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; background: #e2e8f0; }
        .profile-info { display: flex; flex-direction: column; gap: 0.1rem; }
        .profile-name { font-size: 0.825rem; font-weight: 700; color: var(--text-dark); }
        .job-time { font-size: 0.7rem; font-weight: 600; color: var(--text-light); }
        
        .rating-pill { background: #ffedd5; color: #9a3412; font-size: 0.7rem; font-weight: 800; padding: 0.2rem 0.6rem; border-radius: 99px; display: flex; align-items: center; gap: 0.25rem; }
        .rating-pill svg { width: 10px; height: 10px; }

        .card-actions { display: flex; gap: 0.75rem; margin-top: 0.25rem; }
        .btn-action { flex: 1; padding: 0.8rem; text-align: center; border-radius: 12px; font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.2s; display: inline-block;}
        .btn-gray { background: var(--input-bg); color: var(--text-muted); }
        .btn-gray:hover { background: #e2e8f0; }
        .btn-primary { background: #4f46e5; color: white; }
        .btn-primary:hover { background: #4338ca; }
        .btn-primary-ghost { background: var(--input-bg); color: var(--primary); }

        .hidden { display: none !important; }
        
        .empty-state { text-align: center; padding: 3rem 1rem; color: var(--text-muted); font-weight: 600; font-size: 0.9rem;}

        /* Details Modal */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 500; align-items: flex-end; justify-content: center; backdrop-filter: blur(4px); }
        .modal-overlay.active { display: flex; animation: fadeBg 0.2s ease; }
        @keyframes fadeBg { from { opacity: 0; } to { opacity: 1; } }
        .modal-sheet { background: white; border-radius: 24px 24px 0 0; width: 100%; max-width: 480px; max-height: 90vh; overflow-y: auto; padding: 1.5rem; animation: slideUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
        @keyframes slideUp { from { transform: translateY(60px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .modal-handle { width: 40px; height: 4px; background: #e2e8f0; border-radius: 99px; margin: 0 auto 1.5rem; }
        .modal-title { font-size: 1.1rem; font-weight: 800; margin-bottom: 0.25rem; }
        .modal-type { font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1.5rem; }
        .modal-section-label { font-size: 0.65rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
        .modal-desc-text { font-size: 0.9rem; line-height: 1.7; color: #374151; background: var(--input-bg); border-radius: 10px; padding: 1rem; margin-bottom: 1.5rem; }
        .modal-photos { display: flex; gap: 0.75rem; overflow-x: auto; scrollbar-width: none; margin-bottom: 1.5rem; }
        .modal-photos::-webkit-scrollbar { display: none; }
        .modal-photo { width: 110px; height: 85px; flex-shrink: 0; border-radius: 10px; object-fit: cover; border: 1px solid var(--border-color); cursor: zoom-in; transition: transform 0.2s; }
        .modal-photo:hover { transform: scale(1.04); }
        .btn-close-modal { width: 100%; padding: 0.875rem; border-radius: 12px; background: var(--input-bg); color: var(--text-muted); font-weight: 700; font-size: 0.9rem; cursor: pointer; margin-top: 0.5rem; }
        /* Lightbox */
        #historyLightbox { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.92); z-index:1000; align-items:center; justify-content:center; cursor:zoom-out; }
    </style>
</head>
<body>

    <div class="mobile-container">
        
        <div class="header">
            <a href="{{ route('dashboard') }}" class="icon-btn">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </a>
            <h1>Service History</h1>
            <div class="icon-btn">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
            </div>
        </div>

        <div class="content">
            
            <div class="search-container">
                <svg class="search-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" class="search-input" id="searchInput" placeholder="Search for jobs...">
            </div>

            <div class="toggle-container">
                <div class="toggle-btn active" id="tab-active">Active</div>
                <div class="toggle-btn" id="tab-completed">Completed</div>
            </div>

            <div class="card-list" id="cardList">
                
                @forelse($jobs as $job)
                    @php
                        $displayPrice = ($job->JobStatus === 'finished' && $job->JobPrice) 
                            ? '$'.number_format($job->JobPrice, 2) 
                            : 'Unbilled';
                        
                        $statusClass = 'in-progress'; // default for accepted, inspection, repairing
                        $statusText = strtoupper($job->JobStatus); // ACCEPTED, INSPECTION, REPAIRING
                        
                        if($job->JobStatus == 'finished') {
                            $statusClass = 'completed';
                            $statusText = 'COMPLETED';
                        } elseif($job->JobStatus == 'pending') {
                           $statusClass = 'pending';
                           $statusText = 'PENDING';
                        }
                        
                        $isHandyman = auth()->check() && auth()->user()->Role === 'handyman';
                        $counterpartName = $isHandyman ? ($job->customer ? $job->customer->name : 'Unknown Client') : ($job->handyman ? $job->handyman->name : 'Unassigned Professional');
                        
                        $avatarObj = $isHandyman ? ($job->customer ? $job->customer->avatar : null) : ($job->handyman ? $job->handyman->avatar : null);
                        $avatar = $avatarObj ? asset('storage/'.$avatarObj) : 'https://ui-avatars.com/api/?name='.urlencode($counterpartName).'&background=random';
                        
                        // Rating Logic
                        if($isHandyman) {
                            $rating = $job->customer && $job->customer->rating > 0 ? $job->customer->rating : 4.9;
                        } else {
                            $rating = $job->handyman && $job->handyman->rating > 0 ? $job->handyman->rating : 4.9;
                        }
                        
                        // Format Start Date
                        $timeStr = \Carbon\Carbon::parse($job->JobStartDate)->format('M d, Y • h:i A');
                    @endphp

                    <div class="job-card" data-status="{{ $job->JobStatus }}">
                        <div class="card-header">
                            <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                            <span class="job-price" style="color: {{ $job->JobStatus === 'finished' && $job->JobPrice ? 'var(--text-dark)' : 'var(--text-light)' }}; font-size: {{ $job->JobStatus === 'finished' && $job->JobPrice ? '1.05rem' : '0.85rem' }};">{{ $displayPrice }}</span>
                        </div>
                        
                        <h2 class="job-title">{{ $job->JobName }}</h2>
                        
                        <div class="job-profile">
                            <div class="profile-left">
                                <img src="{{ $avatar }}" class="avatar" alt="Handyman">
                                <div class="profile-info">
                                    <span class="profile-name">{{ $counterpartName }}</span>
                                    <span class="job-time">{{ $timeStr }}</span>
                                </div>
                            </div>
                            
                            @if($job->JobStatus !== 'pending')
                            <div class="rating-pill">
                                <svg viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                {{ number_format($rating, 1) }}
                            </div>
                            @endif
                        </div>

                        <div class="card-actions">
                            <button type="button" class="btn-action btn-gray"
                                onclick="openHistoryModal({{ $job->JobID }})">
                                View Details
                            </button>
                            @if($job->JobStatus === 'finished')
                                @if(!$isHandyman)
                                    <a href="#" class="btn-action btn-primary">Rebook</a>
                                @endif
                                <a href="#" class="btn-action btn-gray">Leave Review</a>
                            @else
                                <a href="#" class="btn-action btn-primary-ghost" style="flex:1;">View Status</a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state">No jobs found in your history.</div>
                @endforelse

            </div>

        </div>
    </div>

    <!-- Job Details Modal -->
    <div class="modal-overlay" id="historyModal">
        <div class="modal-sheet">
            <div class="modal-handle"></div>
            <p class="modal-type" id="histModalType">—</p>
            <h2 class="modal-title" id="histModalTitle">Job Details</h2>

            <div id="histModalPhotosWrap" style="display:none; margin-bottom:1.5rem;">
                <p class="modal-section-label">Photos</p>
                <div class="modal-photos" id="histModalPhotos"></div>
            </div>

            <p class="modal-section-label">Description</p>
            <div class="modal-desc-text" id="histModalDesc">No description provided.</div>

            <button class="btn-close-modal" onclick="closeHistoryModal()">Close</button>
        </div>
    </div>

    <!-- Photo Lightbox -->
    <div id="historyLightbox" onclick="this.style.display='none'">
        <img id="historyLightboxImg" src="" style="max-width:90vw; max-height:90vh; border-radius:8px; object-fit:contain;">
    </div>

    <script>
        const jobsPayload = @json($jobs->map(function($j) {
            return [
                'JobID'   => $j->JobID,
                'JobName' => $j->JobName,
                'JobType' => $j->JobType,
                'JobDesk' => $j->JobDesk,
                'JobImages' => $j->JobImages,
            ];
        })->values());

        const storageBase = '{{ asset("storage") }}';

        window.openHistoryModal = function(jobId) {
            const job = jobsPayload.find(j => j.JobID == jobId);
            if (!job) return;
            document.getElementById('histModalTitle').textContent = job.JobName || '—';
            document.getElementById('histModalType').textContent = job.JobType || '—';
            document.getElementById('histModalDesc').textContent = job.JobDesk || 'No description provided.';

            const photosContainer = document.getElementById('histModalPhotos');
            const photosWrap = document.getElementById('histModalPhotosWrap');
            photosContainer.innerHTML = '';
            const imgs = Array.isArray(job.JobImages) ? job.JobImages : (job.JobImages ? JSON.parse(job.JobImages) : []);
            if (imgs && imgs.length > 0) {
                photosWrap.style.display = 'block';
                imgs.forEach(path => {
                    const img = document.createElement('img');
                    img.className = 'modal-photo';
                    img.src = storageBase + '/' + path;
                    img.alt = 'Job photo';
                    img.onclick = () => {
                        document.getElementById('historyLightboxImg').src = img.src;
                        document.getElementById('historyLightbox').style.display = 'flex';
                    };
                    photosContainer.appendChild(img);
                });
            } else {
                photosWrap.style.display = 'none';
            }

            document.getElementById('historyModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        window.closeHistoryModal = function() {
            document.getElementById('historyModal').classList.remove('active');
            document.body.style.overflow = '';
        };

        document.getElementById('historyModal').addEventListener('click', function(e) {
            if (e.target === this) closeHistoryModal();
        });

        document.addEventListener('DOMContentLoaded', () => {
            const tabBtnActive = document.getElementById('tab-active');
            const tabBtnCompleted = document.getElementById('tab-completed');
            const searchInput = document.getElementById('searchInput');
            const jobCards = document.querySelectorAll('.job-card');

            let currentFilter = 'active';

            function filterCards() {
                const query = searchInput.value.toLowerCase();
                let visibleCount = 0;
                
                jobCards.forEach(card => {
                    const status = card.getAttribute('data-status');
                    const title = card.querySelector('.job-title').textContent.toLowerCase();
                    const filterMatch = (currentFilter === 'active' && ['pending', 'accepted', 'inspection', 'repairing'].includes(status)) ||
                                        (currentFilter === 'completed' && status === 'finished');
                    const searchMatch = title.includes(query);
                    
                    if(filterMatch && searchMatch) {
                        card.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        card.classList.add('hidden');
                    }
                });
                
                // Show empty indicator safely? Not required strictly for layout prototype but good UX
            }

            tabBtnActive.addEventListener('click', () => {
                tabBtnActive.classList.add('active');
                tabBtnCompleted.classList.remove('active');
                currentFilter = 'active';
                filterCards();
            });

            tabBtnCompleted.addEventListener('click', () => {
                tabBtnCompleted.classList.add('active');
                tabBtnActive.classList.remove('active');
                currentFilter = 'completed';
                filterCards();
            });

            searchInput.addEventListener('input', filterCards);
            
            // Initial filter run
            filterCards();
        });
    </script>
</body>
</html>
