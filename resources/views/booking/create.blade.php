<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Booking - benerin.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a56db;
            --primary-hover: #1e40af;
            --text-dark: #111827;
            --text-muted: #6b7280;
            --bg-page: #f8fafc;
            --border-color: #e2e8f0;
            --input-bg: #f1f5f9;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f1f5f9; color: var(--text-dark); display: flex; justify-content: center; }
        a { text-decoration: none; color: inherit; }
        button, input, textarea { border: none; outline: none; background: none; font-family: inherit; }

        .mobile-container { width: 100%; max-width: 480px; background: #fcfdfe; min-height: 100vh; position: relative; padding-bottom: 7rem; box-shadow: 0 0 40px rgba(0,0,0,0.05); }

        /* Header */
        .header { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; border-bottom: 1px solid var(--border-color); background: white; position: sticky; top: 0; z-index: 50;}
        .header-left { display: flex; align-items: center; gap: 1rem; }
        .back-btn { color: var(--text-muted); display: flex; align-items: center; justify-content: center; cursor: pointer; }
        .header-titles { display: flex; flex-direction: column; }
        .header-titles h1 { font-size: 1.1rem; font-weight: 800; color: var(--primary); line-height: 1.2;}
        .header-titles span { font-size: 0.65rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px;}
        .help-link { color: var(--primary); font-size: 0.875rem; font-weight: 700; }

        .form-section { padding: 1.25rem 1.5rem; }
        .section-label { font-size: 0.65rem; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.75rem; display: block;}
        
        /* Inputs */
        .text-input { width: 100%; background: #f1f5f9; border-radius: 12px; padding: 1.25rem 1.25rem; font-size: 0.95rem; font-weight: 500; transition: box-shadow 0.2s; border: 1px solid transparent; }
        .text-input:focus { box-shadow: 0 0 0 2px var(--primary); background: white; }
        .text-input::placeholder { color: #94a3b8; }
        textarea.text-input { resize: vertical; min-height: 140px; }

        /* Pills */
        .pills-grid { display: flex; flex-wrap: wrap; gap: 0.75rem; }
        .type-pill { background: #e2e8f0; color: var(--text-dark); padding: 0.85rem 1.5rem; border-radius: 99px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.2s; border: 2px solid transparent; }
        .type-pill:hover { background: #cbd5e1; }
        .type-pill.active { background: var(--primary); color: white; box-shadow: 0 4px 6px rgba(26,86,219,0.2); }

        /* Media Upload */
        .media-grid { display: flex; gap: 1rem; overflow-x: auto; scrollbar-width: none; padding-bottom: 0.5rem; }
        .media-grid::-webkit-scrollbar { display: none; }
        .media-box { flex: 0 0 100px; height: 100px; border-radius: 12px; overflow: hidden; position: relative; background: #e2e8f0; }
        .upload-box { flex: 0 0 100px; height: 100px; border: 2px dashed #93c5fd; background: #eff6ff; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem; cursor: pointer; color: var(--primary); transition: border-color 0.2s; border-radius: 12px; }
        .upload-box:hover { border-color: var(--primary); color: var(--primary); }
        .upload-box svg { width: 24px; height: 24px; }
        .upload-box span { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.5px; }
        .media-img { width: 100%; height: 100%; object-fit: cover; }
        .remove-media { position: absolute; top: 0.35rem; right: 0.35rem; width: 22px; height: 22px; background: #6b7280; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; cursor: pointer; border: 1.5px solid #f8fafc; }
        
        /* Interactive Calendar Module */
        .cal-wrapper { border: 1px solid #f1f5f9; border-radius: 16px; overflow: hidden; background: #ffffff; padding: 0.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.02); }
        .cal-header { display: flex; justify-content: space-between; align-items: center; padding: 1rem; border-bottom: none; }
        .cal-nav { color: var(--text-muted); padding: 0.5rem; cursor: pointer; }
        .cal-title { font-size: 0.95rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; cursor: pointer; padding: 0.5rem 1rem; border-radius: 8px; transition: background 0.2s;}
        .cal-title:hover { background: var(--input-bg); }
        
        .cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); padding: 0.5rem; gap: 0.75rem 0.2rem; }
        .day-name { font-size: 0.65rem; font-weight: 800; color: var(--text-muted); text-align: center; margin-bottom: 0.5rem; }
        .date-cell { aspect-ratio: 1; display: flex; align-items: center; justify-content: center; font-size: 0.875rem; font-weight: 600; cursor: pointer; border-radius: 50%; transition: background 0.2s;}
        .date-cell:hover:not(.empty) { background: var(--input-bg); }
        .date-cell.selected { background: var(--primary); color: white; font-weight: 800; box-shadow: 0 4px 10px rgba(26,86,219,0.3); }
        .date-cell.empty { cursor: default; }

        /* Month Scroller Overlay */
        .scroller-overlay { display: none; padding: 1rem; background: var(--bg-page); position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 10; flex-direction: column; }
        .scroller-overlay.active { display: flex; }
        .year-selector { display: flex; align-items: center; justify-content: center; gap: 2rem; margin-bottom: 2rem; padding: 1rem 0;}
        .year-val { font-size: 1.5rem; font-weight: 800; color: var(--text-dark); }
        .months-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
        .month-chip { text-align: center; padding: 1rem 0; font-weight: 700; font-size: 0.9rem; background: white; border: 1px solid var(--border-color); border-radius: 12px; cursor: pointer; color: var(--text-muted); transition: all 0.2s;}
        .month-chip.active { background: var(--primary); color: white; border-color: var(--primary); box-shadow: 0 4px 6px rgba(26,86,219,0.3); }

        /* Time Picker */
        .time-picker-wrapper { border: 1px solid #f1f5f9; border-radius: 16px; padding: 2rem 1.5rem; display: flex; flex-direction: column; align-items: center; background: #ffffff; box-shadow: 0 4px 20px rgba(0,0,0,0.02); }
        .dials-container { display: flex; align-items: center; justify-content: center; gap: 1rem; margin-bottom: 2rem; height: 160px; overflow: hidden; position: relative; width: 100%;}
        /* Fading mask */
        .dials-container::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 50px; background: linear-gradient(to bottom, white 0%, rgba(255,255,255,0) 100%); z-index: 2; pointer-events: none;}
        .dials-container::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 50px; background: linear-gradient(to top, white 0%, rgba(255,255,255,0) 100%); z-index: 2; pointer-events: none;}
        
        .dial { height: 100%; overflow-y: scroll; scroll-snap-type: y mandatory; scrollbar-width: none; padding: 55px 0; }
        .dial::-webkit-scrollbar { display: none; }
        .dial-item { height: 50px; display: flex; align-items: center; justify-content: center; scroll-snap-align: center; font-size: 1.75rem; font-weight: 800; color: #cbd5e1; transition: all 0.2s;}
        .dial-item.active { font-size: 2.25rem; color: #111827; }
        
        .dial-separator { font-size: 2rem; font-weight: 800; color: #111827; }
        
        .ampm-toggle { display: flex; flex-direction: column; gap: 0.5rem; margin-left: 1rem; }
        .ampm-btn { padding: 0.75rem 1.25rem; border-radius: 8px; font-weight: 800; font-size: 0.95rem; background: #f1f5f9; color: #64748b; cursor: pointer; transition: all 0.2s; text-align: center;}
        .ampm-btn.active { background: #4f46e5; color: white; box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3); }

        .presets { width: 100%; text-align: center; }
        .presets-label { font-size: 0.65rem; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem; display: block;}
        .preset-pills { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem; }
        .preset-pill { border: 1px solid var(--border-color); background: white; padding: 0.85rem 0; text-align: center; border-radius: 8px; font-weight: 700; font-size: 0.75rem; color: var(--text-dark); cursor: pointer; transition: all 0.1s;}
        .preset-pill.active { border-color: var(--primary); color: var(--primary); background: #eff6ff;}

        /* Footer Sticky Action */
        .bottom-action { position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; background: #fcfdfe; padding: 1rem 1.5rem; border-top: 1px solid var(--border-color); z-index: 100;}
        .btn-submit { width: 100%; background: var(--primary); color: white; padding: 1.125rem; border-radius: 12px; font-weight: 700; font-size: 1.05rem; display: flex; align-items: center; justify-content: center; gap: 0.75rem; transition: background 0.2s; box-shadow: 0 4px 14px rgba(26,86,219,0.3);}
        .btn-submit:hover { background: var(--primary-hover); }

        /* Error States */
        input:invalid { border-color: red;}
    </style>
</head>
<body>

    <form class="mobile-container" action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Hidden Inputs for logic composition -->
        <input type="hidden" name="JobType" id="iJobType" value="Plumbing">
        <input type="hidden" name="JobStartDate" id="iJobStartDate">

        <div class="header">
            <div class="header-left">
                <a href="{{ url()->previous() }}" class="back-btn">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                </a>
                <div class="header-titles">
                    <h1>Create Booking</h1>
                </div>
            </div>
            <a href="#" class="help-link">Help</a>
        </div>

        <div class="form-section">
            <label class="section-label">Job Title</label>
            <input type="text" name="JobName" class="text-input" placeholder="e.g., Leaking Sink in Kitchen" required>
        </div>

        <div class="form-section">
            <label class="section-label">Repair Type</label>
            <div class="pills-grid" id="typePills">
                <div class="type-pill active">Plumbing</div>
                <div class="type-pill">Drain Cleaning</div>
                <div class="type-pill">Electrical</div>
                <div class="type-pill">Carpentry</div>
                <div class="type-pill">HVAC</div>
            </div>
        </div>

        <div class="form-section">
            <label class="section-label">Description of Repair</label>
            <textarea name="JobDesk" class="text-input" placeholder="Describe the issue in detail. What happened? How long has it been like this?" required></textarea>
        </div>

        <div class="form-section">
            <label class="section-label">Media Upload <span style="font-weight:400; text-transform:none; letter-spacing:0; font-size:0.7rem;">(optional, max 5 photos)</span></label>
            <div class="media-grid" id="mediaPreviewGrid">
                <div class="upload-box" id="uploadBoxBtn" onclick="document.getElementById('hiddenFileInput').click()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    <span>ADD PHOTO</span>
                </div>
            </div>
            <input type="file" id="hiddenFileInput" name="JobImages[]" style="display:none;" accept="image/*" multiple>
        </div>

        <div class="form-section">
            <label class="section-label">Select Date</label>
            <div class="cal-wrapper" style="position: relative;">
                
                <!-- standard calendar view -->
                <div id="calendarView">
                    <div class="cal-header">
                        <div class="cal-nav" id="calPrev"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg></div>
                        <div class="cal-title" id="calTitleDisplay">JUNE 2019</div>
                        <div class="cal-nav" id="calNext"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg></div>
                    </div>
                    <div class="cal-grid" id="calGrid">
                        <!-- Populated by JS -->
                    </div>
                </div>

                <!-- month/year scroller overlay view -->
                <div class="scroller-overlay" id="calScroller">
                    <div class="year-selector">
                        <div class="cal-nav" id="yearPrev"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg></div>
                        <div class="year-val" id="yearDisplay">2019</div>
                        <div class="cal-nav" id="yearNext"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg></div>
                    </div>
                    <div class="months-grid" id="monthsGrid">
                        <!-- Populated by JS -->
                    </div>
                    <button type="button" class="btn-submit" id="closeScrollerBtn" style="margin-top:auto;">Done</button>
                </div>

            </div>
        </div>

        <div class="form-section" style="padding-bottom: 3rem;">
            <label class="section-label">Select Time</label>
            <div class="time-picker-wrapper">
                
                <div class="dials-container">
                    <div class="dial" id="hourDial">
                        @for($r=0; $r<40; $r++)
                            @for($h=1; $h<=12; $h++)
                                <div class="dial-item" data-val="{{ $h }}">{{ $h }}</div>
                            @endfor
                        @endfor
                    </div>
                    <div class="dial-separator">:</div>
                    <div class="dial" id="minDial">
                        @for($r=0; $r<40; $r++)
                            @foreach(['00','05','10','15','20','25','30','35','40','45','50','55'] as $m)
                                <div class="dial-item" data-val="{{ $m }}">{{ $m }}</div>
                            @endforeach
                        @endfor
                    </div>
                    
                    <div class="ampm-toggle">
                        <div class="ampm-btn active" id="btnAM">AM</div>
                        <div class="ampm-btn" id="btnPM">PM</div>
                    </div>
                </div>

                <div class="presets">
                    <span class="presets-label">Presets</span>
                    <div class="preset-pills">
                        <div class="preset-pill active" data-h="9" data-m="00" data-ampm="AM">9 AM</div>
                        <div class="preset-pill" data-h="12" data-m="00" data-ampm="PM">12 PM</div>
                        <div class="preset-pill" data-h="4" data-m="00" data-ampm="PM">4 PM</div>
                        <div class="preset-pill" data-h="6" data-m="00" data-ampm="PM">6 PM</div>
                    </div>
                </div>

            </div>
        </div>

        <div class="bottom-action">
            <button type="button" class="btn-submit" id="finalSubmitBtn">
                Book Appointment
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 0.25rem"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>
            <button type="submit" id="hiddenSubmitBtn" style="display:none;"></button>
        </div>

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // -- Job Type Selection --
            const typePills = document.querySelectorAll('#typePills .type-pill');
            const iJobType = document.getElementById('iJobType');
            typePills.forEach(pill => {
                pill.addEventListener('click', () => {
                    typePills.forEach(p => p.classList.remove('active'));
                    pill.classList.add('active');
                    iJobType.value = pill.textContent;
                });
            });

            // -- Media Upload Logic (multi-file with DataTransfer) --
            const fileInput = document.getElementById('hiddenFileInput');
            const mediaGrid = document.getElementById('mediaPreviewGrid');
            const uploadBoxBtn = document.getElementById('uploadBoxBtn');
            let storedFiles = new DataTransfer();

            fileInput.addEventListener('change', function() {
                Array.from(this.files).forEach(file => {
                    if (storedFiles.items.length >= 5) return; // max 5
                    storedFiles.items.add(file);
                    const reader = new FileReader();
                    reader.onload = (evt) => {
                        const box = document.createElement('div');
                        box.className = 'media-box';
                        const idx = storedFiles.items.length - 1;
                        box.dataset.fileIndex = idx;

                        const img = document.createElement('img');
                        img.className = 'media-img';
                        img.src = evt.target.result;

                        const rmBtn = document.createElement('div');
                        rmBtn.className = 'remove-media';
                        rmBtn.innerHTML = '&times;';
                        rmBtn.onclick = () => {
                            const fileIdx = parseInt(box.dataset.fileIndex);
                            const newDT = new DataTransfer();
                            Array.from(storedFiles.files).forEach((f, i) => { if (i !== fileIdx) newDT.items.add(f); });
                            storedFiles = newDT;
                            fileInput.files = storedFiles.files;
                            // re-index remaining
                            document.querySelectorAll('#mediaPreviewGrid .media-box').forEach((b, i) => b.dataset.fileIndex = i);
                            box.remove();
                        };

                        box.appendChild(img);
                        box.appendChild(rmBtn);
                        mediaGrid.insertBefore(box, uploadBoxBtn);
                    };
                    reader.readAsDataURL(file);
                });
                fileInput.files = storedFiles.files;
                this.value = '';
            });

            // -- Calendar & Scroller Logic --
            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            let currentDate = new Date();
            let viewMonth = currentDate.getMonth();
            let viewYear = currentDate.getFullYear();
            let selectedDateObj = new Date();

            const calTitle = document.getElementById('calTitleDisplay');
            const calGrid = document.getElementById('calGrid');
            const calScroller = document.getElementById('calScroller');
            
            // Build Month scroller
            const monthsGrid = document.getElementById('monthsGrid');
            monthNames.forEach((n, i) => {
                let div = document.createElement('div');
                div.className = 'month-chip' + (i === viewMonth ? ' active' : '');
                div.textContent = n.substring(0,3).toUpperCase();
                div.onclick = () => {
                    document.querySelectorAll('.month-chip').forEach(c=>c.classList.remove('active'));
                    div.classList.add('active');
                    viewMonth = i;
                };
                monthsGrid.appendChild(div);
            });

            const yearDisplay = document.getElementById('yearDisplay');
            document.getElementById('yearPrev').onclick = () => { viewYear--; yearDisplay.textContent = viewYear; };
            document.getElementById('yearNext').onclick = () => { viewYear++; yearDisplay.textContent = viewYear; };

            calTitle.onclick = () => {
                yearDisplay.textContent = viewYear;
                document.querySelectorAll('.month-chip').forEach((c,i)=> c.classList.toggle('active', i === viewMonth));
                calScroller.classList.add('active');
            };

            document.getElementById('closeScrollerBtn').onclick = () => {
                calScroller.classList.remove('active');
                renderCalendar();
            };

            function renderCalendar() {
                calTitle.textContent = `${monthNames[viewMonth].toUpperCase()} ${viewYear}`;
                calGrid.innerHTML = '';
                
                // Add day headers
                ['SUN','MON','TUE','WED','THU','FRI','SAT'].forEach(d => {
                    calGrid.innerHTML += `<div class="day-name">${d}</div>`;
                });

                let firstDay = new Date(viewYear, viewMonth, 1).getDay();
                let daysInMonth = new Date(viewYear, viewMonth+1, 0).getDate();

                for(let i=0; i<firstDay; i++) calGrid.innerHTML += `<div class="date-cell empty"></div>`;
                for(let i=1; i<=daysInMonth; i++) {
                    let cell = document.createElement('div');
                    cell.className = 'date-cell';
                    if(selectedDateObj.getDate() === i && selectedDateObj.getMonth() === viewMonth && selectedDateObj.getFullYear() === viewYear) {
                        cell.classList.add('selected');
                    }
                    cell.textContent = i;
                    cell.onclick = () => {
                        selectedDateObj = new Date(viewYear, viewMonth, i);
                        renderCalendar();
                    };
                    calGrid.appendChild(cell);
                }
            }

            document.getElementById('calPrev').onclick = () => {
                viewMonth--; if(viewMonth < 0) {viewMonth = 11; viewYear--;} renderCalendar();
            };
            document.getElementById('calNext').onclick = () => {
                viewMonth++; if(viewMonth > 11) {viewMonth = 0; viewYear++;} renderCalendar();
            };

            renderCalendar();

            // -- Time Dials & Presets --
            let curHourStr = "9";
            let curMinStr = "00";
            let curAmPm = "AM";

            const hDial = document.getElementById('hourDial');
            const mDial = document.getElementById('minDial');
            
            function styleDialActive(dialElement, activeVal, isMin) {
                let targetIndex = 0;
                if(!isMin) {
                    targetIndex = 20 * 12 + (parseInt(activeVal) - 1);
                } else {
                    targetIndex = 20 * 12 + (parseInt(activeVal) / 5);
                }
                
                let targetEl = dialElement.children[targetIndex];
                if(targetEl) {
                    let currentActive = dialElement.querySelector('.active');
                    if(currentActive) currentActive.classList.remove('active');
                    targetEl.classList.add('active');
                    dialElement.scrollTo({top: targetEl.offsetTop - 55, behavior: 'instant'});
                }
            }

            // Sync preset buttons
            const presetPills = document.querySelectorAll('.preset-pill');
            presetPills.forEach(pill => {
                pill.onclick = () => {
                    presetPills.forEach(p => p.classList.remove('active'));
                    pill.classList.add('active');
                    curHourStr = pill.getAttribute('data-h');
                    curMinStr = pill.getAttribute('data-m');
                    curAmPm = pill.getAttribute('data-ampm');
                    
                    document.getElementById('btnAM').classList.toggle('active', curAmPm === 'AM');
                    document.getElementById('btnPM').classList.toggle('active', curAmPm === 'PM');
                    
                    styleDialActive(hDial, curHourStr, false);
                    styleDialActive(mDial, curMinStr, true);
                };
            });
            
            // Initial styling highlight
            setTimeout(()=>{
                styleDialActive(hDial, 9, false);
                styleDialActive(mDial, 00, true);
                hDial.style.visibility = 'visible';
                mDial.style.visibility = 'visible';
            }, 10);

            // Time Dial manual scroll interactions
            hDial.addEventListener('scroll', () => {
                presetPills.forEach(p => p.classList.remove('active')); // Break preset glow safely
                let centerOffset = hDial.scrollTop + 55;
                let items = hDial.children;
                let approxIndex = Math.floor(hDial.scrollTop / 50);
                let start = Math.max(0, approxIndex - 5);
                let end = Math.min(items.length, approxIndex + 10);
                let closest = null; let minDiff = 999;
                
                for(let i=start; i<end; i++) {
                    let diff = Math.abs(items[i].offsetTop - centerOffset);
                    if(diff < minDiff) { minDiff = diff; closest = items[i]; }
                }
                if(closest && !closest.classList.contains('active')) {
                    let currentActive = hDial.querySelector('.active');
                    if(currentActive) currentActive.classList.remove('active');
                    closest.classList.add('active');
                    curHourStr = closest.getAttribute('data-val');
                }
            });
            
            mDial.addEventListener('scroll', () => {
                presetPills.forEach(p => p.classList.remove('active'));
                let centerOffset = mDial.scrollTop + 55;
                let items = mDial.children;
                let approxIndex = Math.floor(mDial.scrollTop / 50);
                let start = Math.max(0, approxIndex - 5);
                let end = Math.min(items.length, approxIndex + 10);
                let closest = null; let minDiff = 999;
                
                for(let i=start; i<end; i++) {
                    let diff = Math.abs(items[i].offsetTop - centerOffset);
                    if(diff < minDiff) { minDiff = diff; closest = items[i]; }
                }
                if(closest && !closest.classList.contains('active')) {
                    let currentActive = mDial.querySelector('.active');
                    if(currentActive) currentActive.classList.remove('active');
                    closest.classList.add('active');
                    curMinStr = closest.getAttribute('data-val');
                }
            });

            document.getElementById('btnAM').onclick = function() { curAmPm='AM'; presetPills.forEach(p => p.classList.remove('active')); this.classList.add('active'); document.getElementById('btnPM').classList.remove('active'); };
            document.getElementById('btnPM').onclick = function() { curAmPm='PM'; presetPills.forEach(p => p.classList.remove('active')); this.classList.add('active'); document.getElementById('btnAM').classList.remove('active'); };

            // Final Form Submission String Compilation
            document.getElementById('finalSubmitBtn').onclick = () => {
                // Compile combined string: YYYY-MM-DD HH:MM:SS
                let h = parseInt(curHourStr);
                if(curAmPm === 'PM' && h < 12) h += 12;
                if(curAmPm === 'AM' && h === 12) h = 0;
                
                selectedDateObj.setHours(h);
                selectedDateObj.setMinutes(parseInt(curMinStr));
                
                // Format directly into standard SQL datetime
                // Because native ISO drops timezone and pads, we manually stringify
                let yr = selectedDateObj.getFullYear();
                let mo = String(selectedDateObj.getMonth()+1).padStart(2,'0');
                let dt = String(selectedDateObj.getDate()).padStart(2,'0');
                let hr = String(selectedDateObj.getHours()).padStart(2,'0');
                let mn = String(selectedDateObj.getMinutes()).padStart(2,'0');
                
                document.getElementById('iJobStartDate').value = `${yr}-${mo}-${dt} ${hr}:${mn}:00`;
                
                // Trigger native submit
                document.getElementById('hiddenSubmitBtn').click();
            };
        });
    </script>
</body>
</html>
