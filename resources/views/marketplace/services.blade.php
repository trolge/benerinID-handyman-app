<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - benerin.id</title>
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
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; color: var(--text-dark); background-color: var(--bg-page); line-height: 1.5; }
        a { text-decoration: none; color: inherit; }
        button, input, select { font-family: inherit; }

        /* Top Navbar (Dashboard Synced) */
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
        .btn-emergency { background-color: var(--primary); color: white; padding: 0.6rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.875rem; transition: background 0.2s; border: none; cursor:pointer;}
        .btn-emergency:hover { background-color: var(--primary-hover); }
        .icon-btn { color: var(--text-muted); width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; cursor: pointer;}
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background-color: #374151; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 2px solid white; box-shadow: 0 0 0 1px var(--border-color); cursor: pointer;}
        
        /* Dropdown UI */
        .dropdown-menu { position: absolute; top: calc(100% + 10px); right: 0; background: white; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); width: 220px; border: 1px solid var(--border-color); padding: 0.5rem; display: none; flex-direction: column; z-index: 200; transform-origin: top right; }
        .dropdown-menu.show { display: flex; animation: slideDown 0.2s ease-out forwards; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px) scale(0.95); } to { opacity: 1; transform: translateY(0) scale(1); } }
        .dropdown-item { padding: 0.75rem 1rem; color: var(--text-dark); font-size: 0.875rem; font-weight: 500; border-radius: 8px; transition: background 0.15s; display: flex; align-items: center; gap: 0.75rem; border: none; cursor:pointer;}
        .dropdown-item:hover { background: var(--bg-page); }
        .dropdown-item.text-danger { color: #dc2626; }
        .dropdown-item.text-danger:hover { background: #fef2f2; }

        .container { max-width: 1200px; margin: 0 auto; padding: 2rem 5%; }

        /* Toolbar */
        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; gap: 1rem; flex-wrap: wrap;}
        .filters { display: flex; gap: 0.75rem; flex-wrap: wrap;}
        .filter-select { padding: 0.6rem 2rem 0.6rem 1rem; appearance: none; background: white url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="%236b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>') no-repeat right 0.75rem center; background-size: 12px; border: 1px solid var(--border-color); border-radius: 8px; color: var(--text-dark); font-size: 0.875rem; font-weight: 500; cursor: pointer; outline: none; }
        
        .search-box { display: flex; align-items: center; background: white; border: 1px solid var(--border-color); border-radius: 8px; padding: 0.1rem 1rem; width: 300px; }
        .search-box svg { color: var(--text-muted); }
        .search-box input { border: none; outline: none; padding: 0.5rem 0.5rem; width: 100%; font-size: 0.875rem; }

        /* Service Grid */
        .services-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
        
        .service-card { background: var(--card-bg); border-radius: 16px; overflow: hidden; border: 1px solid var(--border-color); transition: transform 0.2s, box-shadow 0.2s; }
        .service-card:hover { transform: translateY(-4px); box-shadow: 0 12px 20px -8px rgba(0,0,0,0.1); }
        
        .card-img-wrap { height: 180px; width: 100%; position: relative; }
        .card-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .btn-heart { position: absolute; top: 1rem; right: 1rem; width: 32px; height: 32px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1); cursor: pointer;}
        
        .card-content { padding: 1.5rem; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.5rem; }
        .card-desc { font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        
        .card-action { margin-top: 1rem; display: block; width: 100%; text-align: center; background: var(--bg-page); color: var(--primary); padding: 0.75rem; border-radius: 8px; font-weight: 600; font-size: 0.875rem; transition: background 0.2s;}
        .card-action:hover { background: #eff6ff; }
        
        .direct-browse-banner { margin-top: 4rem; background: var(--primary); border-radius: 16px; padding: 3rem; text-align: center; color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; }
        .direct-browse-banner h2 { font-size: 2rem; font-weight: 800; margin-bottom: 1rem; }
        .direct-browse-banner p { font-size: 1.1rem; opacity: 0.9; margin-bottom: 2rem; max-width: 600px; }
        .btn-white { background: white; color: var(--primary); padding: 0.875rem 2.5rem; border-radius: 8px; font-weight: 700; font-size: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: transform 0.2s; }
        .btn-white:hover { transform: translateY(-2px); }

    </style>
</head>
<body>

    <!-- Unified Top Navbar -->
    <nav class="top-navbar">
        <div class="nav-left">
            <a href="{{ auth()->check() ? route('dashboard') : url('/') }}" class="brand">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" style="margin-right:8px;" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#1a56db"/>
                    <path d="M2 17L12 22L22 17M2 12L12 17L22 12" stroke="#1a56db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                benerin<span>.id</span>
            </a>
            <div class="nav-links">
                @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                @endauth
                <a href="{{ route('services.index') }}" class="active">Services</a>
                <a href="{{ route('professionals.index') }}">Professionals</a>
                @auth
                <a href="#">Messages</a>
                <a href="#">Payments</a>
                @endauth
            </div>
        </div>
        <div class="nav-right">
            @auth
            <button class="btn-emergency">Emergency Support</button>
            <div class="icon-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </div>
            <div class="icon-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
            </div>
            <div class="user-menu" style="position: relative;">
                <div class="user-avatar" id="profileDropdownBtn">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    @endif
                </div>
                <div class="dropdown-menu" id="profileDropdownMenu">
                    <div style="padding: 0.5rem 1rem; border-bottom: 1px solid var(--border-color); margin-bottom: 0.5rem;">
                        <p style="font-weight: 700; font-size: 0.9rem; color: var(--text-dark);">{{ auth()->user()->name }}</p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">{{ auth()->user()->email }}</p>
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
            @else
            <a href="{{ route('login') }}" class="btn-emergency" style="background:#f3f4f6; color:#111; border:1px solid #d1d5db;">Log in</a>
            @endauth
        </div>
    </nav>

    <div class="container">
        
        <div class="toolbar">
            <div class="filters">
                <select class="filter-select"><option>All Categories</option></select>
                <select class="filter-select"><option>All Providers</option></select>
                <select class="filter-select"><option>All Prices</option></select>
            </div>
            
            <div class="search-box">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" id="serviceSearchInput" placeholder="Search for repairs...">
            </div>
        </div>

        <div class="services-grid" id="servicesGrid">
            @foreach($categories as $cat)
            <div class="service-card" data-title="{{ strtolower($cat['name']) }}" data-desc="{{ strtolower($cat['desc']) }}">
                <div class="card-img-wrap">
                    <img src="{{ $cat['image'] }}" alt="{{ $cat['name'] }}">
                    <div class="btn-heart">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">{{ $cat['name'] }}</h3>
                    <p class="card-desc">{{ $cat['desc'] }}</p>
                    
                    <a href="{{ route('professionals.index', ['category' => $cat['slug']]) }}" class="card-action">
                        View Professionals →
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- No results state (hidden by default) -->
        <div id="noResultsMsg" style="display:none; text-align:center; padding: 4rem; color: var(--text-muted);">
            No services matched your search. Try different keywords.
        </div>

        <div class="direct-browse-banner">
            <h2>Already know what you need?</h2>
            <p>Skip the categories and browse our entire verified directory of expert craftsmen, handymen, and specialists.</p>
            <a href="{{ route('professionals.index') }}" class="btn-white">Browse All Professionals</a>
        </div>

    </div>

    <!-- Dropdown and Search Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Profile Dropdown Toggle
            const profileBtn = document.getElementById('profileDropdownBtn');
            const profileMenu = document.getElementById('profileDropdownMenu');
            if(profileBtn) {
                profileBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    profileMenu.classList.toggle('show');
                });
                document.addEventListener('click', (e) => {
                    if(!profileMenu.contains(e.target)) profileMenu.classList.remove('show');
                });
            }

            // Realtime Search Filter
            const searchInput = document.getElementById('serviceSearchInput');
            const cards = document.querySelectorAll('.service-card');
            const noResults = document.getElementById('noResultsMsg');

            if(searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const query = e.target.value.toLowerCase();
                    let visibleCount = 0;

                    cards.forEach(card => {
                        const title = card.getAttribute('data-title');
                        const desc = card.getAttribute('data-desc');
                        
                        if(title.includes(query) || desc.includes(query)) {
                            card.style.display = 'block';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    if(visibleCount === 0) {
                        noResults.style.display = 'block';
                    } else {
                        noResults.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>
