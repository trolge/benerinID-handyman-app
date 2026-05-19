<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Booking - benerin.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #1a56db; --primary-hover: #1e40af; --text-dark: #111827; --text-muted: #6b7280; --bg-page: #f8fafc; --border-color: #e2e8f0; --input-bg: #f1f5f9; --accent: #f59e0b; }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Inter',sans-serif; }
        body { background:var(--bg-page); color:var(--text-dark); }
        a { text-decoration:none; color:inherit; }
        button,input,textarea,select { border:none; outline:none; background:none; font-family:inherit; }

        .top-navbar { height:70px; background:white; border-bottom:1px solid var(--border-color); display:flex; align-items:center; justify-content:space-between; padding:0 2rem; position:sticky; top:0; z-index:100; }
        .nav-left { display:flex; align-items:center; gap:3rem; }
        .brand { font-size:1.5rem; font-weight:800; color:var(--primary); display:flex; align-items:center; letter-spacing:-0.5px; }
        .brand span { color:var(--text-dark); }
        .nav-links { display:flex; gap:2rem; align-items:center; }
        .nav-links a { font-weight:600; font-size:0.95rem; color:var(--text-muted); }
        .nav-links a:hover { color:var(--text-dark); }

        .container { max-width:1100px; margin:0 auto; padding:2rem 2rem 4rem; }
        .page-header { margin-bottom:2rem; }
        .page-title { font-size:1.75rem; font-weight:800; letter-spacing:-0.5px; }
        .page-subtitle { color:var(--text-muted); font-size:0.95rem; margin-top:0.25rem; }

        .booking-grid { display:grid; grid-template-columns:1fr 380px; gap:2rem; align-items:start; }

        /* Left Column - Form */
        .form-card { background:white; border-radius:16px; border:1px solid var(--border-color); padding:2rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.02); }
        .section-label { font-size:0.7rem; font-weight:800; color:#475569; text-transform:uppercase; letter-spacing:1px; margin-bottom:0.75rem; display:block; }
        .form-group { margin-bottom:1.75rem; }
        .text-input { width:100%; background:var(--input-bg); border-radius:12px; padding:1rem 1.25rem; font-size:0.95rem; font-weight:500; border:1px solid transparent; transition:all 0.2s; }
        .text-input:focus { box-shadow:0 0 0 2px var(--primary); background:white; }
        .text-input::placeholder { color:#94a3b8; }
        textarea.text-input { resize:vertical; min-height:120px; }

        .pills-grid { display:flex; flex-wrap:wrap; gap:0.75rem; }
        .type-pill { background:#e2e8f0; color:var(--text-dark); padding:0.75rem 1.25rem; border-radius:99px; font-size:0.85rem; font-weight:600; cursor:pointer; transition:all 0.2s; border:2px solid transparent; }
        .type-pill:hover { background:#cbd5e1; }
        .type-pill.active { background:var(--primary); color:white; box-shadow:0 4px 6px rgba(26,86,219,0.2); }

        .media-grid { display:flex; gap:1rem; flex-wrap:wrap; }
        .upload-box { width:100px; height:100px; border:2px dashed #93c5fd; background:#eff6ff; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:0.4rem; cursor:pointer; color:var(--primary); border-radius:12px; font-size:0.65rem; font-weight:700; }
        .media-box { width:100px; height:100px; border-radius:12px; overflow:hidden; position:relative; }
        .media-box img { width:100%; height:100%; object-fit:cover; }
        .remove-media { position:absolute; top:4px; right:4px; width:20px; height:20px; background:#6b7280; color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:11px; cursor:pointer; }

        /* Right Column - Sidebar */
        .sidebar { display:flex; flex-direction:column; gap:1.5rem; position:sticky; top:90px; }

        .handyman-card { background:white; border-radius:16px; border:1px solid var(--border-color); padding:1.5rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.02); }
        .hm-header { display:flex; align-items:center; gap:1rem; margin-bottom:1rem; }
        .hm-avatar { width:56px; height:56px; border-radius:14px; background:#374151; overflow:hidden; display:flex; align-items:center; justify-content:center; color:white; font-size:1.25rem; font-weight:800; flex-shrink:0; }
        .hm-avatar img { width:100%; height:100%; object-fit:cover; }
        .hm-name { font-size:1.05rem; font-weight:800; }
        .hm-badge { font-size:0.65rem; font-weight:700; color:var(--primary); text-transform:uppercase; letter-spacing:0.5px; }
        .hm-rating { display:inline-flex; align-items:center; gap:0.25rem; font-size:0.8rem; font-weight:700; color:var(--accent); margin-top:0.15rem; }
        .hm-hours { display:flex; align-items:center; gap:0.5rem; font-size:0.85rem; color:var(--text-muted); font-weight:500; margin-top:0.75rem; padding-top:0.75rem; border-top:1px solid var(--border-color); }

        /* Calendar */
        .cal-card { background:white; border-radius:16px; border:1px solid var(--border-color); padding:1.25rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.02); }
        .cal-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; }
        .cal-nav { color:var(--text-muted); cursor:pointer; padding:0.25rem; }
        .cal-title { font-size:0.9rem; font-weight:800; color:var(--primary); letter-spacing:0.5px; }
        .cal-grid { display:grid; grid-template-columns:repeat(7,1fr); gap:0.4rem; }
        .day-name { font-size:0.6rem; font-weight:800; color:var(--text-muted); text-align:center; margin-bottom:0.25rem; }
        .date-cell { aspect-ratio:1; display:flex; align-items:center; justify-content:center; font-size:0.8rem; font-weight:600; cursor:pointer; border-radius:50%; transition:all 0.15s; }
        .date-cell:hover:not(.empty):not(.disabled) { background:var(--input-bg); }
        .date-cell.selected { background:var(--primary); color:white; font-weight:800; box-shadow:0 4px 10px rgba(26,86,219,0.3); }
        .date-cell.empty { cursor:default; }
        .date-cell.disabled { color:#cbd5e1; cursor:not-allowed; }

        /* Time slots */
        .time-card { background:white; border-radius:16px; border:1px solid var(--border-color); padding:1.25rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.02); }
        .time-slots { display:grid; grid-template-columns:repeat(3,1fr); gap:0.5rem; }
        .time-slot { padding:0.7rem 0; text-align:center; border-radius:10px; font-size:0.8rem; font-weight:700; cursor:pointer; border:1px solid var(--border-color); background:white; transition:all 0.15s; color:var(--text-dark); }
        .time-slot:hover:not(.disabled):not(.booked) { border-color:var(--primary); color:var(--primary); background:#eff6ff; }
        .time-slot.selected { background:var(--primary); color:white; border-color:var(--primary); box-shadow:0 4px 10px rgba(26,86,219,0.3); }
        .time-slot.disabled { color:#cbd5e1; cursor:not-allowed; background:#f8fafc; border-color:#f1f5f9; }
        .time-slot.booked { color:#fca5a5; cursor:not-allowed; background:#fef2f2; border-color:#fecaca; text-decoration:line-through; }

        .btn-submit { width:100%; background:var(--primary); color:white; padding:1rem; border-radius:12px; font-weight:700; font-size:1rem; cursor:pointer; transition:background 0.2s; display:flex; align-items:center; justify-content:center; gap:0.5rem; box-shadow:0 4px 14px rgba(26,86,219,0.3); }
        .btn-submit:hover { background:var(--primary-hover); }
        .btn-submit:disabled { background:#94a3b8; cursor:not-allowed; box-shadow:none; }

        .alert { padding:0.85rem 1rem; border-radius:10px; margin-bottom:1.5rem; font-size:0.85rem; font-weight:600; background:#fef2f2; color:#dc2626; border:1px solid #fecaca; }

        .working-hours-note { font-size:0.75rem; color:var(--text-muted); font-weight:500; margin-top:0.5rem; text-align:center; }

        @media(max-width:860px) { .booking-grid { grid-template-columns:1fr; } .sidebar { position:static; } }
    </style>
</head>
<body>
    <nav class="top-navbar">
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="brand">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" style="margin-right:8px;"><path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#1a56db"/><path d="M2 17L12 22L22 17M2 12L12 17L22 12" stroke="#1a56db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                benerin<span>.id</span>
            </a>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('services.index') }}">Services</a>
                <a href="{{ route('professionals.index') }}">Professionals</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Create Booking</h1>
            <p class="page-subtitle">Schedule a service appointment with {{ $handyman->name }}</p>
        </div>

        @if($errors->any())
        <div class="alert">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
        @endif

        <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" id="bookingForm">
            @csrf
            <input type="hidden" name="HandymanID" value="{{ $handyman->UserID }}">
            <input type="hidden" name="JobType" id="iJobType" value="Plumbing">
            <input type="hidden" name="JobStartDate" id="iJobStartDate">

            <div class="booking-grid">
                <!-- Left: Form Fields -->
                <div class="form-card">
                    <div class="form-group">
                        <label class="section-label">Job Title</label>
                        <input type="text" name="JobName" class="text-input" placeholder="e.g., Leaking Sink in Kitchen" value="{{ old('JobName') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="section-label">Repair Type</label>
                        <div class="pills-grid" id="typePills">
                            <div class="type-pill active">Plumbing</div>
                            <div class="type-pill">Drain Cleaning</div>
                            <div class="type-pill">Electrical</div>
                            <div class="type-pill">Carpentry</div>
                            <div class="type-pill">HVAC</div>
                            <div class="type-pill">Painting</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="section-label">Description of Repair</label>
                        <textarea name="JobDesk" class="text-input" placeholder="Describe the issue in detail..." required>{{ old('JobDesk') }}</textarea>
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="section-label">Media Upload <span style="font-weight:400;text-transform:none;letter-spacing:0;font-size:0.7rem;">(optional, max 5)</span></label>
                        <div class="media-grid" id="mediaPreviewGrid">
                            <div class="upload-box" onclick="document.getElementById('hiddenFileInput').click()">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                ADD PHOTO
                            </div>
                        </div>
                        <input type="file" id="hiddenFileInput" name="JobImages[]" style="display:none;" accept="image/*" multiple>
                    </div>
                </div>

                <!-- Right: Sidebar -->
                <div class="sidebar">
                    <!-- Handyman Info Card -->
                    <div class="handyman-card">
                        <span class="section-label">Booking For</span>
                        <div class="hm-header">
                            <div class="hm-avatar">
                                @if($handyman->avatar)
                                    <img src="{{ asset('storage/' . $handyman->avatar) }}" alt="{{ $handyman->name }}">
                                @else
                                    {{ substr($handyman->name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <div class="hm-badge">Verified Professional</div>
                                <div class="hm-name">{{ $handyman->name }}</div>
                                @if($handyman->avg_rating)
                                <div class="hm-rating">
                                    ★ {{ $handyman->avg_rating }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="hm-hours">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            Working Hours: {{ \Carbon\Carbon::parse($handyman->WorkingHoursStart ?? '09:00')->format('g:i A') }} – {{ \Carbon\Carbon::parse($handyman->WorkingHoursEnd ?? '17:00')->format('g:i A') }}
                        </div>
                    </div>

                    <!-- Calendar -->
                    <div class="cal-card">
                        <span class="section-label">Select Date</span>
                        <div class="cal-header">
                            <div class="cal-nav" id="calPrev"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg></div>
                            <div class="cal-title" id="calTitle">MAY 2026</div>
                            <div class="cal-nav" id="calNext"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg></div>
                        </div>
                        <div class="cal-grid" id="calGrid"></div>
                    </div>

                    <!-- Time Slots -->
                    <div class="time-card">
                        <span class="section-label">Select Time</span>
                        <div class="time-slots" id="timeSlots"></div>
                        <div class="working-hours-note" id="whNote"></div>
                    </div>

                    <!-- Submit -->
                    <button type="button" class="btn-submit" id="finalSubmitBtn" disabled>
                        Select a date & time to book
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const HANDYMAN_ID = {{ $handyman->UserID }};
        const WORK_START = '{{ $handyman->WorkingHoursStart ?? "09:00" }}';
        const WORK_END = '{{ $handyman->WorkingHoursEnd ?? "17:00" }}';
        const SLOTS_URL = '{{ route("booking.slots") }}';
        const existingBookings = @json($existingBookings);

        const monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        const now = new Date();
        let viewMonth = now.getMonth(), viewYear = now.getFullYear();
        let selectedDate = null, selectedTime = null;
        let bookedSlotsForDate = [];

        // Type pills
        const typePills = document.querySelectorAll('#typePills .type-pill');
        typePills.forEach(p => p.addEventListener('click', () => {
            typePills.forEach(x => x.classList.remove('active'));
            p.classList.add('active');
            document.getElementById('iJobType').value = p.textContent;
        }));

        // Media upload
        const fileInput = document.getElementById('hiddenFileInput');
        const mediaGrid = document.getElementById('mediaPreviewGrid');
        let storedFiles = new DataTransfer();
        fileInput.addEventListener('change', function() {
            Array.from(this.files).forEach(file => {
                if (storedFiles.items.length >= 5) return;
                storedFiles.items.add(file);
                const reader = new FileReader();
                reader.onload = (e) => {
                    const box = document.createElement('div');
                    box.className = 'media-box';
                    box.innerHTML = `<img src="${e.target.result}"><div class="remove-media">&times;</div>`;
                    box.querySelector('.remove-media').onclick = () => {
                        const newDT = new DataTransfer();
                        const idx = Array.from(mediaGrid.querySelectorAll('.media-box')).indexOf(box);
                        Array.from(storedFiles.files).forEach((f,i) => { if(i!==idx) newDT.items.add(f); });
                        storedFiles = newDT;
                        fileInput.files = storedFiles.files;
                        box.remove();
                    };
                    mediaGrid.insertBefore(box, mediaGrid.querySelector('.upload-box'));
                };
                reader.readAsDataURL(file);
            });
            fileInput.files = storedFiles.files;
            this.value = '';
        });

        // Calendar
        function renderCalendar() {
            const grid = document.getElementById('calGrid');
            document.getElementById('calTitle').textContent = `${monthNames[viewMonth].toUpperCase()} ${viewYear}`;
            grid.innerHTML = '';
            ['SUN','MON','TUE','WED','THU','FRI','SAT'].forEach(d => {
                grid.innerHTML += `<div class="day-name">${d}</div>`;
            });
            const firstDay = new Date(viewYear, viewMonth, 1).getDay();
            const daysInMonth = new Date(viewYear, viewMonth+1, 0).getDate();
            for (let i=0; i<firstDay; i++) grid.innerHTML += '<div class="date-cell empty"></div>';
            for (let i=1; i<=daysInMonth; i++) {
                const cell = document.createElement('div');
                cell.className = 'date-cell';
                cell.textContent = i;
                const cellDate = new Date(viewYear, viewMonth, i);
                const today = new Date(); today.setHours(0,0,0,0);
                if (cellDate < today) {
                    cell.classList.add('disabled');
                } else {
                    cell.onclick = () => {
                        selectedDate = new Date(viewYear, viewMonth, i);
                        selectedTime = null;
                        document.querySelectorAll('.date-cell').forEach(c => c.classList.remove('selected'));
                        cell.classList.add('selected');
                        loadTimeSlots();
                        updateSubmitBtn();
                    };
                }
                if (selectedDate && selectedDate.getDate()===i && selectedDate.getMonth()===viewMonth && selectedDate.getFullYear()===viewYear) {
                    cell.classList.add('selected');
                }
                grid.appendChild(cell);
            }
        }
        document.getElementById('calPrev').onclick = () => { viewMonth--; if(viewMonth<0){viewMonth=11;viewYear--;} renderCalendar(); };
        document.getElementById('calNext').onclick = () => { viewMonth++; if(viewMonth>11){viewMonth=0;viewYear++;} renderCalendar(); };
        renderCalendar();

        // Time slots
        function loadTimeSlots() {
            if (!selectedDate) return;
            const dateStr = `${selectedDate.getFullYear()}-${String(selectedDate.getMonth()+1).padStart(2,'0')}-${String(selectedDate.getDate()).padStart(2,'0')}`;

            fetch(`${SLOTS_URL}?handyman_id=${HANDYMAN_ID}&date=${dateStr}`)
                .then(r => r.json())
                .then(slots => {
                    bookedSlotsForDate = slots;
                    renderTimeSlots(dateStr);
                })
                .catch(() => { bookedSlotsForDate = []; renderTimeSlots(dateStr); });
        }

        function renderTimeSlots(dateStr) {
            const container = document.getElementById('timeSlots');
            const note = document.getElementById('whNote');
            container.innerHTML = '';

            const startH = parseInt(WORK_START.split(':')[0]);
            const startM = parseInt(WORK_START.split(':')[1]);
            const endH = parseInt(WORK_END.split(':')[0]);
            const endM = parseInt(WORK_END.split(':')[1]);

            note.textContent = `Available: ${formatTime12(WORK_START)} – ${formatTime12(WORK_END)}`;

            const nowDate = new Date();
            const isToday = selectedDate.toDateString() === nowDate.toDateString();

            for (let h = startH; h < endH; h++) {
                for (let m = 0; m < 60; m += 30) {
                    if (h === startH && m < startM) continue;
                    const timeStr = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}`;
                    const slot = document.createElement('div');
                    slot.className = 'time-slot';
                    slot.textContent = formatTime12(timeStr);
                    slot.dataset.time = timeStr;

                    // Check if past
                    if (isToday) {
                        const slotDate = new Date(selectedDate);
                        slotDate.setHours(h, m, 0, 0);
                        if (slotDate <= nowDate) {
                            slot.classList.add('disabled');
                            slot.title = 'This time has already passed';
                            container.appendChild(slot);
                            continue;
                        }
                    }

                    // Check if booked
                    const isBooked = bookedSlotsForDate.some(b => {
                        return timeStr >= b.start && timeStr < b.end;
                    });
                    if (isBooked) {
                        slot.classList.add('booked');
                        slot.title = 'Already booked';
                        container.appendChild(slot);
                        continue;
                    }

                    if (selectedTime === timeStr) slot.classList.add('selected');

                    slot.onclick = () => {
                        selectedTime = timeStr;
                        document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                        slot.classList.add('selected');
                        updateSubmitBtn();
                    };
                    container.appendChild(slot);
                }
            }
            if (container.children.length === 0) {
                container.innerHTML = '<div style="grid-column:1/-1;text-align:center;color:var(--text-muted);font-size:0.85rem;padding:1rem;">No available slots on this date.</div>';
            }
        }

        function formatTime12(t) {
            const [h,m] = t.split(':').map(Number);
            const ampm = h >= 12 ? 'PM' : 'AM';
            const h12 = h % 12 || 12;
            return `${h12}:${String(m).padStart(2,'0')} ${ampm}`;
        }

        function updateSubmitBtn() {
            const btn = document.getElementById('finalSubmitBtn');
            if (selectedDate && selectedTime) {
                btn.disabled = false;
                const [h,m] = selectedTime.split(':').map(Number);
                const displayDate = `${monthNames[selectedDate.getMonth()]} ${selectedDate.getDate()}, ${selectedDate.getFullYear()}`;
                btn.innerHTML = `Book for ${displayDate} at ${formatTime12(selectedTime)} <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>`;
            } else {
                btn.disabled = true;
                btn.textContent = 'Select a date & time to book';
            }
        }

        // Submit
        document.getElementById('finalSubmitBtn').onclick = () => {
            if (!selectedDate || !selectedTime) return;
            const [h,m] = selectedTime.split(':').map(Number);
            selectedDate.setHours(h, m, 0, 0);
            const yr = selectedDate.getFullYear();
            const mo = String(selectedDate.getMonth()+1).padStart(2,'0');
            const dt = String(selectedDate.getDate()).padStart(2,'0');
            const hr = String(h).padStart(2,'0');
            const mn = String(m).padStart(2,'0');
            document.getElementById('iJobStartDate').value = `${yr}-${mo}-${dt} ${hr}:${mn}:00`;
            document.getElementById('bookingForm').submit();
        };
    });
    </script>
</body>
</html>
