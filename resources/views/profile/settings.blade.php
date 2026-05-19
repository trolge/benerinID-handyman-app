<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings - benerin.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a56db;
            --primary-hover: #1e40af;
            --text-dark: #111827;
            --text-muted: #6b7280;
            --bg-page: #f4f6f8;
            --border-color: #e5e7eb;
            --danger: #dc2626;
            --success: #166534;
            --success-bg: #dcfce7;
            --danger-bg: #fee2e2;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; color: var(--text-dark); background-color: var(--bg-page); line-height: 1.5; }
        a { text-decoration: none; color: inherit; }
        button { cursor: pointer; border: none; font-family: inherit; }

        .top-navbar { height: 70px; background: white; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; }
        .brand { font-size: 1.5rem; font-weight: 800; color: var(--primary); display: flex; align-items: center; letter-spacing: -0.5px;}
        .brand span { color: var(--text-dark); }
        .back-link { display: flex; align-items: center; gap: 0.5rem; font-weight: 600; font-size: 0.95rem; color: var(--text-muted); transition: color 0.2s;}
        .back-link:hover { color: var(--text-dark); }

        .container { max-width: 800px; margin: 3rem auto; padding: 0 1rem; }
        
        .header-section { margin-bottom: 2rem; }
        .header-title { font-size: 1.75rem; font-weight: 800; color: var(--text-dark); margin-bottom: 0.5rem;}
        .header-desc { color: var(--text-muted); font-size: 0.95rem; }

        .form-card { background: white; padding: 2.5rem; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); border: 1px solid var(--border-color); }
        
        .alert { padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem; font-weight: 500; }
        .alert-success { background-color: var(--success-bg); color: var(--success); }
        .alert-danger { background-color: var(--danger-bg); color: var(--danger); }
        .alert ul { margin-left: 1.5rem; margin-top: 0.5rem; }

        .avatar-section { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2.5rem; padding-bottom: 2.5rem; border-bottom: 1px solid var(--border-color);}
        .avatar-preview { width: 80px; height: 80px; border-radius: 50%; background-color: #374151; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 3px solid white; box-shadow: 0 0 0 1px var(--border-color); flex-shrink: 0;}
        .avatar-preview img { width: 100%; height: 100%; object-fit: cover; }
        .avatar-input-box { flex: 1; display: flex; flex-direction: column; gap: 0.5rem; }
        .avatar-input-box label { font-weight: 600; font-size: 0.9rem; color: var(--text-dark); }
        .file-input { display: block; width: 100%; font-size: 0.875rem; color: var(--text-muted); }
        .file-input::-webkit-file-upload-button { background: var(--bg-page); border: 1px solid var(--border-color); border-radius: 6px; padding: 0.5rem 1rem; font-weight: 600; color: var(--text-dark); cursor: pointer; margin-right: 1rem; font-family: 'Inter', sans-serif;}

        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }

        .form-group { display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1.5rem;}
        .form-label { font-size: 0.875rem; font-weight: 600; color: var(--text-dark); }
        .form-input { padding: 0.875rem 1rem; border: 1px solid var(--border-color); border-radius: 8px; font-family: inherit; font-size: 0.95rem; color: var(--text-dark); background: var(--bg-page); transition: all 0.2s;}
        .form-input:focus { outline: none; border-color: var(--primary); background: white; box-shadow: 0 0 0 3px rgba(26,86,219,0.1); }
        .form-text { font-size: 0.75rem; color: var(--text-muted); }

        .btn-submit { background-color: var(--primary); color: white; padding: 0.875rem 2rem; border-radius: 8px; font-weight: 600; font-size: 0.95rem; transition: background 0.2s; box-shadow: 0 4px 14px 0 rgba(26,86,219,0.39); display: inline-flex; align-items: center; gap: 0.5rem;}
        .btn-submit:hover { background-color: var(--primary-hover); }
        
        .form-actions { margin-top: 1rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end;}

        /* Chips UI */
        .chip-container { display: flex; flex-wrap: wrap; gap: 0.75rem; margin-top: 0.5rem; margin-bottom: 0.5rem;}
        .chip { display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.5rem 1rem; border-radius: 999px; font-size: 0.85rem; font-weight: 600; border: 1.5px solid var(--border-color); background: white; color: var(--text-dark); cursor: pointer; transition: all 0.2s; white-space: nowrap;}
        .chip:hover { border-color: var(--text-muted); }
        .chip.active { background: #dbeafe; border-color: #3b82f6; color: #1e40af; }
        .chip .chip-check { display: none; margin-left: -0.25rem; color: #1e40af;}
        .chip.active .chip-check { display: block; }

        /* Professional Upgrade Card */
        .pro-card { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); padding: 2.5rem; border-radius: 16px; margin-top: 2rem; color: white; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4); position: relative; overflow: hidden; }
        .pro-card::after { content: ''; position: absolute; right: -20%; top: -50%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%); border-radius: 50%; pointer-events: none; }
        .pro-text h3 { font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
        .pro-text p { font-size: 0.95rem; opacity: 0.9; max-width: 450px; }
        .btn-upgrade { background: white; color: #1e3a8a; padding: 0.875rem 2rem; border-radius: 99px; font-weight: 800; font-size: 1rem; transition: transform 0.2s, box-shadow 0.2s; white-space: nowrap; flex-shrink: 0; box-shadow: 0 4px 6px rgba(0,0,0,0.1); cursor: pointer; border: none;}
        .btn-upgrade:hover { transform: translateY(-2px); box-shadow: 0 6px 12px rgba(0,0,0,0.15); }
    </style>
</head>
<body>

    <nav class="top-navbar">
        <a href="{{ auth()->check() ? route('dashboard') : url('/') }}" class="brand">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" style="margin-right:8px;" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#1a56db"/>
                <path d="M2 17L12 22L22 17M2 12L12 17L22 12" stroke="#1a56db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            benerin<span>.id</span>
        </a>
        <a href="{{ route('dashboard') }}" class="back-link">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Back to Dashboard
        </a>
    </nav>

    <div class="container">
        <div class="header-section">
            <h1 class="header-title">Profile Settings</h1>
            <p class="header-desc">Manage your account details, profile picture, and security preferences.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                Please fix the following errors:
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="avatar-section">
                    <div class="avatar-preview">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar">
                        @else
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        @endif
                    </div>
                    <div class="avatar-input-box">
                        <label>Profile Picture</label>
                        <input type="file" name="avatar" class="file-input" accept="image/*">
                        <span class="form-text">JPG, PNG or GIF. Max size of 2MB.</span>
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 2.5rem;">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="PhoneNumber" class="form-input" value="{{ old('PhoneNumber', $user->PhoneNumber) }}">
                </div>

                @if(strtolower($user->Role) === 'handyman')
                <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem; color: var(--primary);">Professional Profile</h3>
                <div class="form-group">
                    <label class="form-label">Profile Specialties & Tags</label>
                    <div class="chip-container" id="chipContainer">
                        @php
                            $selectedTags = is_string($user->Tags) ? json_decode($user->Tags, true) ?? [] : (is_array($user->Tags) ? $user->Tags : []);
                            $selectedTags = array_map('strtoupper', array_map('trim', $selectedTags));
                            $availableChips = ['PLUMBING', 'ELECTRICAL', 'HOME CLEANING', 'HVAC & AC', 'CARPENTRY', 'PAINTING', 'CERTIFIED', 'FAST RESPONSE', 'EMERGENCY'];
                        @endphp
                        
                        @foreach($availableChips as $chip)
                            <button type="button" class="chip {{ in_array($chip, $selectedTags) ? 'active' : '' }}" data-val="{{ $chip }}">
                                <svg class="chip-check" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                {{ $chip }}
                            </button>
                        @endforeach
                    </div>
                    @php
                        $tagsValue = is_string($user->Tags) ? implode(', ', json_decode($user->Tags, true) ?? []) : (is_array($user->Tags) ? implode(', ', $user->Tags) : '');
                    @endphp
                    <input type="hidden" name="Tags" id="hiddenTagsInput" value="{{ old('Tags', $tagsValue) }}">
                    <span class="form-text">Click chips to build your profile. These determine which categories you appear in.</span>
                </div>
                <div class="form-group" style="margin-bottom: 2.5rem;">
                    <label class="form-label">Expertise / About Me</label>
                    <textarea name="Expertise" class="form-input" rows="4" placeholder="Describe your experience, certifications, and what makes your services stand out...">{{ old('Expertise', $user->Expertise) }}</textarea>
                    <span class="form-text" style="color:var(--text-muted);">This text will be prominently displayed on your public craftsman card to potential clients.</span>
                </div>

                <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem; color: var(--primary);">Working Hours</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Start Time</label>
                        <input type="time" name="WorkingHoursStart" class="form-input" value="{{ old('WorkingHoursStart', $user->WorkingHoursStart ?? '09:00') }}">
                        <span class="form-text">When you start accepting jobs each day.</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">End Time</label>
                        <input type="time" name="WorkingHoursEnd" class="form-input" value="{{ old('WorkingHoursEnd', $user->WorkingHoursEnd ?? '17:00') }}">
                        <span class="form-text">When you stop accepting jobs each day.</span>
                    </div>
                </div>
                @endif

                <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">Security</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-input" placeholder="Leave blank to keep current">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-input">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        @if($user->Role === 'customer')
        <div class="pro-card">
            <div class="pro-text">
                <h3>
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                    Become a Professional
                </h3>
                <p>Join our network of skilled handymen. Start accepting jobs, setting your own hours, and earning money with completely transparent payouts.</p>
            </div>
            
            <form action="{{ route('profile.become_handyman') }}" method="POST">
                @csrf
                <button type="submit" class="btn-upgrade" onclick="return confirm('Are you sure you want to upgrade your account to a Professional context?')">
                    Apply Now
                </button>
            </form>
        </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chips = document.querySelectorAll('.chip');
            const hiddenInput = document.getElementById('hiddenTagsInput');
            
            chips.forEach(chip => {
                chip.addEventListener('click', (e) => {
                    e.preventDefault();
                    chip.classList.toggle('active');
                    updateHiddenTags();
                });
            });

            function updateHiddenTags() {
                const activeChips = Array.from(document.querySelectorAll('.chip.active')).map(c => c.getAttribute('data-val'));
                hiddenInput.value = activeChips.join(', ');
            }
        });
    </script>
</body>
</html>
