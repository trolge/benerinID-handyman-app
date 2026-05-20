<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>benerin.id - Professional Handyman Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a56db;
            --primary-hover: #1e40af;
            --text-dark: #111827;
            --text-muted: #6b7280;
            --bg-light: #f9fafb;
            --bg-white: #ffffff;
            --footer-bg: #111827;
            --border-color: #e5e7eb;
            --placeholder-gray: #e5e7eb;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; color: var(--text-dark); background-color: var(--bg-white); line-height: 1.5; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        
        /* Navbar */
        nav { display: flex; align-items: center; justify-content: space-between; padding: 1.5rem 0; }
        .brand { font-size: 1.25rem; font-weight: 700; color: var(--primary); display: flex; align-items: center; gap: 8px;}
        .brand span { color: var(--text-dark); }
        .nav-links { display: flex; gap: 2rem; align-items: center; }
        .nav-links a { font-weight: 500; font-size: 0.95rem; color: var(--text-dark); transition: color 0.2s; }
        .nav-links a:hover { color: var(--primary); }
        .nav-actions { display: flex; gap: 1rem; align-items: center; }
        .btn-outline { font-weight: 500; color: var(--text-dark); padding: 0.5rem 1rem; border-radius: 6px; transition: color 0.2s; }
        .btn-outline:hover { color: var(--primary); }
        .btn-primary { background-color: var(--primary); color: white; padding: 0.6rem 1.25rem; border-radius: 6px; font-weight: 600; font-size: 0.95rem; transition: background-color 0.2s, transform 0.1s; border: none; cursor: pointer; display: inline-flex; justify-content: center; align-items: center;}
        .btn-primary:hover { background-color: var(--primary-hover); }
        .btn-primary:active { transform: translateY(1px); }

        /* Hero Section */
        .hero { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; padding: 4rem 0 6rem; align-items: center; }
        .badge { display: inline-flex; align-items: center; gap: 0.5rem; background-color: #eff6ff; color: var(--primary); padding: 0.35rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600; margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .hero h1 { font-size: 3.5rem; font-weight: 800; line-height: 1.1; margin-bottom: 1.5rem; letter-spacing: -0.02em; }
        .hero h1 span { color: var(--primary); }
        .hero p { font-size: 1.125rem; color: var(--text-muted); margin-bottom: 2.5rem; max-width: 480px; }
        .search-box { display: flex; gap: 0.5rem; background: var(--bg-white); padding: 0.5rem; border-radius: 8px; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom: 2rem; }
        .search-input { display: flex; align-items: center; flex: 1; padding: 0 0.5rem; gap: 0.5rem; }
        .search-input input { border: none; outline: none; width: 100%; font-size: 0.95rem; font-family: inherit; }
        .search-input svg { color: var(--text-muted); }
        .search-divider { width: 1px; background: var(--border-color); margin: 0.5rem 0; }
        .avatars { display: flex; align-items: center; gap: 1rem; font-size: 0.875rem; color: var(--text-muted); font-weight: 500;}
        .avatar-group { display: flex; }
        .avatar { width: 32px; height: 32px; border-radius: 50%; background-color: #d1d5db; border: 2px solid white; margin-left: -10px; }
        .avatar:first-child { margin-left: 0; background-color: #9ca3af;}
        .avatar.three { background-color: #6b7280; }
        
        .hero-image { width: 100%; height: 500px; background-color: var(--placeholder-gray); border-radius: 16px; object-fit: cover; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }

        /* Featured Services */
        .services { padding: 5rem 0; background-color: var(--bg-white); }
        .section-header { margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end;}
        .section-title { font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; }
        .section-desc { color: var(--text-muted); max-width: 400px; }
        .view-all { color: var(--primary); font-weight: 600; display: inline-flex; align-items: center; gap: 0.25rem; transition: gap 0.2s;}
        .view-all:hover { gap: 0.5rem; }
        .services-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
        .service-card { background: var(--bg-light); border-radius: 12px; padding: 2rem; transition: transform 0.2s, background-color 0.2s; cursor: pointer; border: 1px solid transparent; }
        .service-card:hover { transform: translateY(-5px); background: var(--bg-white); border-color: var(--border-color); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); }
        .icon-box { width: 40px; height: 40px; border-radius: 8px; background-color: #e0e7ff; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--primary); }
        .service-card h3 { font-size: 1.125rem; font-weight: 600; margin-bottom: 0.5rem; }
        .service-card p { font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1.5rem; line-height: 1.6;}
        .service-price { font-size: 0.75rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.05em; }

        /* Why Choose */
        .why-choose { padding: 5rem 0; text-align: center; }
        .why-header { max-width: 600px; margin: 0 auto 4rem; }
        .why-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 3rem; }
        .feature-item { display: flex; flex-direction: column; align-items: center; }
        .feature-icon { width: 48px; height: 48px; border-radius: 50%; background-color: #eff6ff; color: var(--primary); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; }
        .feature-item h3 { font-size: 1.125rem; font-weight: 600; margin-bottom: 0.75rem; }
        .feature-item p { font-size: 0.95rem; color: var(--text-muted); line-height: 1.6; max-width: 300px;}

        /* Testimonials */
        .testimonials { padding: 5rem 0; background-color: var(--bg-light); }
        .testi-header { text-align: center; margin-bottom: 4rem; }
        .testi-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; }
        .testi-card { background: var(--bg-white); padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .stars { color: #f59e0b; margin-bottom: 1rem; letter-spacing: 2px;}
        .testi-quote { font-size: 0.95rem; font-style: italic; color: var(--text-muted); margin-bottom: 1.5rem; line-height: 1.6; }
        .customer { display: flex; align-items: center; gap: 1rem; }
        .customer-avatar { width: 40px; height: 40px; border-radius: 50%; background-color: #fca5a5; }
        .customer-avatar.two { background-color: #fdba74; }
        .customer-avatar.three { background-color: #fdba74; }
        .customer-info h4 { font-size: 0.875rem; font-weight: 600; }
        .customer-info p { font-size: 0.75rem; color: var(--text-muted); }

        /* CTA */
        .cta { padding: 5rem 0; }
        .cta-box { background: linear-gradient(135deg, #1a56db 0%, #173d9e 100%); border-radius: 24px; padding: 4rem 2rem; text-align: center; color: white; }
        .cta-box h2 { font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; }
        .cta-box p { font-size: 1.125rem; opacity: 0.9; margin-bottom: 2.5rem; max-width: 500px; margin-left: auto; margin-right: auto; }
        .cta-actions { display: flex; justify-content: center; gap: 1rem; }
        .btn-white { background: white; color: var(--primary); font-weight: 600; padding: 0.75rem 1.5rem; border-radius: 8px; transition: transform 0.1s;}
        .btn-white:hover { background: #f9fafb; }
        .btn-white:active { transform: translateY(1px); }
        .btn-outline-white { border: 1px solid rgba(255,255,255,0.3); color: white; font-weight: 600; padding: 0.75rem 1.5rem; border-radius: 8px; transition: background 0.2s;}
        .btn-outline-white:hover { background: rgba(255,255,255,0.1); }

        /* Footer */
        footer { background-color: var(--footer-bg); color: #9ca3af; padding: 4rem 0 2rem; font-size: 0.875rem; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 3rem; margin-bottom: 4rem; }
        .footer-brand { color: white; font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 8px;}
        .footer-desc { margin-bottom: 1.5rem; line-height: 1.6; max-width: 250px;}
        .socials { display: flex; gap: 0.75rem; }
        .social-box { width: 32px; height: 32px; background: rgba(255,255,255,0.1); border-radius: 6px; display: flex; align-items: center; justify-content: center; color: white; cursor: pointer;}
        .social-box:hover { background: rgba(255,255,255,0.2); }
        .footer-col h4 { color: white; font-size: 0.95rem; font-weight: 600; margin-bottom: 1.25rem; }
        .footer-col ul { display: flex; flex-direction: column; gap: 0.75rem; }
        .footer-col a:hover { color: white; }
        .newsletter input { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 0.75rem; border-radius: 6px 0 0 6px; outline: none; width: 100%; font-family: inherit;}
        .newsletter input::placeholder { color: #6b7280; }
        .newsletter button { background: var(--primary); color: white; border: none; padding: 0 1rem; border-radius: 0 6px 6px 0; cursor: pointer; }
        .newsletter-form { display: flex; margin-top: 1rem; }
        .footer-bottom { text-align: center; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); }

        @media (max-width: 1024px) {
            .hero { grid-template-columns: 1fr; gap: 2rem; text-align: center; }
            .hero h1 { font-size: 3rem; }
            .hero p { margin: 0 auto 2.5rem; }
            .badge { margin: 0 auto 1.5rem; }
            .services-grid { grid-template-columns: repeat(2, 1fr); }
            .why-grid, .testi-grid { grid-template-columns: 1fr; gap: 2rem; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 640px) {
            .nav-links { display: none; }
            .services-grid { grid-template-columns: 1fr; }
            .section-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .search-box { flex-direction: column; background: transparent; border: none; box-shadow: none; gap: 0.5rem;}
            .search-input { background: white; border: 1px solid var(--border-color); border-radius: 8px; padding: 0.75rem;}
            .search-divider { display: none; }
            .btn-primary.search-btn { width: 100%; border-radius: 8px; padding: 0.75rem;}
            .footer-grid { grid-template-columns: 1fr; gap: 2rem; }
        }
    </style>
</head>
<body>

    <nav class="container">
        <div class="nav-left">
            <a href="{{ auth()->check() ? route('dashboard') : url('/') }}" class="brand">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" style="margin-right:8px;" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#1a56db"/>
                    <path d="M2 17L12 22L22 17M2 12L12 17L22 12" stroke="#1a56db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                benerin<span>.id</span>
            </a>
        </div>
        <div class="nav-links">
            <a href="#">Services</a>
            <a href="#">How it Works</a>
            <a href="#">Reviews</a>
            <a href="#">Become a Pro</a>
        </div>
        <div class="nav-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-outline">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-primary" style="margin:0; padding:0.5rem 1rem;">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-outline">Log In</a>
                <a href="{{ route('register') }}" class="btn-primary">Sign Up</a>
            @endauth
        </div>
    </nav>

    <main>
        <!-- Hero Section -->
        <section class="container hero">
            <div>
                <div class="badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    Verified Professionals
                </div>
                <h1>Professional <span>Handyman</span> Services for Your Home</h1>
                <p>Find trusted experts for plumbing, electrical, carpentry and more. Fast, reliable, and guaranteed quality in your neighborhood.</p>
                
                <div class="search-box">
                    <div class="search-input">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" placeholder="What service">
                    </div>
                    <div class="search-divider"></div>
                    <div class="search-input">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <input type="text" placeholder="Your Location">
                    </div>
                    <button class="btn-primary search-btn" style="border-radius: 6px;">Find Help</button>
                </div>

                <div class="avatars">
                    <div class="avatar-group">
                        <div class="avatar"></div>
                        <div class="avatar two"></div>
                        <div class="avatar three"></div>
                    </div>
                    <span><strong>1,000+</strong> experts near you</span>
                </div>
            </div>
            <div>
                <div class="hero-image" style="background-image: url('{{ asset('images/hero.png') }}'); background-size: cover; background-position: center;"></div>
            </div>
        </section>

        <!-- Featured Services Section -->
        <section class="services">
            <div class="container">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Our Featured Services</h2>
                        <p class="section-desc">From minor fixes to major renovations, our skilled pros handle it all with precision.</p>
                    </div>
                    <a href="#" class="view-all">View all services <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                </div>
                <div class="services-grid">
                    <div class="service-card">
                        <div class="icon-box">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        </div>
                        <h3>Plumbing</h3>
                        <p>Leaking pipes, drain cleaning, and appliance installations.</p>
                        <div class="service-price">Starting at $49</div>
                    </div>
                    <div class="service-card">
                        <div class="icon-box">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                        </div>
                        <h3>Electrical</h3>
                        <p>Wiring repairs, lighting installation, and smart home setups.</p>
                        <div class="service-price">Starting at $59</div>
                    </div>
                    <div class="service-card">
                        <div class="icon-box">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                        </div>
                        <h3>Carpentry</h3>
                        <p>Furniture assembly, deck repairs, and custom woodwork.</p>
                        <div class="service-price">Starting at $69</div>
                    </div>
                    <div class="service-card">
                        <div class="icon-box">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        </div>
                        <h3>Painting</h3>
                        <p>Interior walls, exterior siding, and cabinet refinishing.</p>
                        <div class="service-price">Starting at $49</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose HandyFix -->
        <section class="why-choose container">
            <div class="why-header">
                <h2>Why Choose HandyFix</h2>
                <p style="color: var(--text-muted); margin-top: 1rem;">We provide the most reliable home maintenance services with a focus on quality, transparency, and your peace of mind.</p>
            </div>
            <div class="why-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <h3>Verified Workers</h3>
                    <p>Every professional undergoes a rigorous multi-step background check and skill verification.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    </div>
                    <h3>Guaranteed Quality</h3>
                    <p>If you're not 100% satisfied with the work, we'll make it right at no extra cost to you.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <h3>Upfront Pricing</h3>
                    <p>Clear, fixed prices for every job. No hidden fees or surprise hourly charges ever.</p>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="testimonials">
            <div class="container">
                <h2 class="section-title testi-header">What Our Customers Say</h2>
                <div class="testi-grid">
                    <div class="testi-card">
                        <div class="stars">★★★★★</div>
                        <p class="testi-quote">"The plumber arrived on time and fixed my leaking faucet in 15 minutes. Very professional and the price was exactly what was quoted online."</p>
                        <div class="customer">
                            <div class="customer-avatar"></div>
                            <div class="customer-info">
                                <h4>Sarah Jenkins</h4>
                                <p>Homeowner in Austin</p>
                            </div>
                        </div>
                    </div>
                    <div class="testi-card">
                        <div class="stars">★★★★★</div>
                        <p class="testi-quote">"I needed some shelves installed in my office. The carpenter did an amazing job and even cleaned up all the sawdust. Highly recommend benerin.id!"</p>
                        <div class="customer">
                            <div class="customer-avatar two"></div>
                            <div class="customer-info">
                                <h4>David Miller</h4>
                                <p>Property Manager</p>
                            </div>
                        </div>
                    </div>
                    <div class="testi-card">
                        <div class="stars">★★★★★</div>
                        <p class="testi-quote">"Finding reliable electricians used to be a nightmare until I found this app. The transparency in pricing and reviews makes it so much easier."</p>
                        <div class="customer">
                            <div class="customer-avatar three"></div>
                            <div class="customer-info">
                                <h4>Emily Chen</h4>
                                <p>Small Business Owner</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta container">
            <div class="cta-box">
                <h2>Ready to fix your home?</h2>
                <p>Join thousands of homeowners who trust benerin.id for their home maintenance needs.</p>
                <div class="cta-actions">
                    <a href="{{ route('register') }}" class="btn-white">Get Started Now</a>
                    <a href="#" class="btn-outline-white">Download App</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div>
                    <a href="#" class="footer-brand">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white"/>
                            <path d="M2 17L12 22L22 17M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        benerin.id
                    </a>
                    <p class="footer-desc">The easiest way to find and book local professionals for all your home repair needs.</p>
                    <div class="socials">
                        <div class="social-box">FB</div>
                        <div class="social-box">IN</div>
                        <div class="social-box">TW</div>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#">Find a Service</a></li>
                        <li><a href="#">How it Works</a></li>
                        <li><a href="#">Our Professionals</a></li>
                        <li><a href="#">Cost Estimator</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="#">Support Center</a></li>
                        <li><a href="#">Safety Guidelines</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Newsletter</h4>
                    <p style="margin-bottom: 0.5rem;">Get home maintenance tips and exclusive offers.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Your Email">
                        <button type="button">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 benerin.id Services Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
