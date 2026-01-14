<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Elegant PHP Framework</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Modern CSS Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #FF2D20;
            --primary-dark: #E5271E;
            --primary-light: #FF6B5B;
            --dark-bg: #0F172A;
            --dark-card: #1E293B;
            --dark-text: #F1F5F9;
            --dark-subtext: #94A3B8;
            --light-bg: #F8FAFC;
            --light-card: #FFFFFF;
            --light-text: #1E293B;
            --light-subtext: #64748B;
            --accent-color: #3B82F6;
            --gradient-primary: linear-gradient(135deg, #FF2D20 0%, #FF6B5B 100%);
            --gradient-dark: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.16);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 20px;
            --radius-xl: 28px;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: var(--light-bg);
            color: var(--light-text);
            line-height: 1.6;
            transition: var(--transition);
        }

        body.dark-mode {
            background-color: var(--dark-bg);
            color: var(--dark-text);
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header & Navigation */
        .header {
            padding: 24px 0;
            position: relative;
            z-index: 100;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .logo-icon {
            color: var(--primary-color);
            font-size: 1.8rem;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: inherit;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
            padding: 8px 0;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-primary);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .theme-toggle {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: inherit;
            transition: var(--transition);
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-toggle:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        body.dark-mode .theme-toggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .btn {
            padding: 12px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-family: 'Instrument Sans', sans-serif;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: inherit;
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            padding: 80px 0 120px;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 10;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 24px;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        body.dark-mode .hero-title {
            background: linear-gradient(135deg, #FF6B5B 0%, #FF9E8F 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--light-subtext);
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        body.dark-mode .hero-subtitle {
            color: var(--dark-subtext);
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 60px;
            flex-wrap: wrap;
        }

        .hero-graphic {
            position: relative;
            height: 300px;
            margin-top: 40px;
        }

        .graphic-circle {
            position: absolute;
            border-radius: 50%;
            background: var(--gradient-primary);
            opacity: 0.1;
            filter: blur(40px);
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: 0;
            left: 10%;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            top: 50px;
            right: 15%;
            background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%);
            opacity: 0.1;
        }

        .circle-3 {
            width: 150px;
            height: 150px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #10B981 0%, #34D399 100%);
            opacity: 0.1;
        }

        .hero-blade {
            position: absolute;
            width: 100px;
            height: 100px;
            opacity: 0.8;
            animation: float 6s ease-in-out infinite;
        }

        .blade-1 {
            top: 20px;
            left: 15%;
            animation-delay: 0s;
            color: var(--primary-color);
        }

        .blade-2 {
            top: 100px;
            right: 20%;
            animation-delay: 2s;
            color: #3B82F6;
        }

        .blade-3 {
            bottom: 40px;
            left: 30%;
            animation-delay: 4s;
            color: #10B981;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        /* Features Section */
        .section {
            padding: 100px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 16px;
        }

        .section-subtitle {
            text-align: center;
            color: var(--light-subtext);
            max-width: 600px;
            margin: 0 auto 60px;
            font-size: 1.125rem;
        }

        body.dark-mode .section-subtitle {
            color: var(--dark-subtext);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .feature-card {
            background-color: var(--light-card);
            border-radius: var(--radius-lg);
            padding: 40px 30px;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        body.dark-mode .feature-card {
            background-color: var(--dark-card);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: var(--radius-lg);
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            color: white;
            font-size: 1.8rem;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .feature-description {
            color: var(--light-subtext);
            margin-bottom: 24px;
            flex-grow: 1;
        }

        body.dark-mode .feature-description {
            color: var(--dark-subtext);
        }

        .feature-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .feature-link:hover {
            gap: 12px;
        }

        /* CTA Section */
        .cta-section {
            padding: 100px 0;
            background: var(--gradient-primary);
            color: white;
            border-radius: var(--radius-xl);
            margin: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .cta-subtitle {
            font-size: 1.125rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto 40px;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn-secondary {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .cta-btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* Footer */
        .footer {
            padding: 60px 0 40px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 1.25rem;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            text-decoration: none;
            color: var(--light-subtext);
            transition: var(--transition);
        }

        body.dark-mode .footer-links a {
            color: var(--dark-subtext);
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 40px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            color: var(--light-subtext);
            font-size: 0.9rem;
        }

        body.dark-mode .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--dark-subtext);
        }

        /* Mobile Responsiveness */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.8rem;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
            
            .nav-links {
                position: fixed;
                top: 80px;
                left: 0;
                right: 0;
                background-color: var(--light-card);
                flex-direction: column;
                padding: 30px;
                gap: 20px;
                box-shadow: var(--shadow-lg);
                transform: translateY(-100%);
                opacity: 0;
                visibility: hidden;
                transition: var(--transition);
                z-index: 99;
                border-radius: 0 0 var(--radius-lg) var(--radius-lg);
            }
            
            body.dark-mode .nav-links {
                background-color: var(--dark-card);
            }
            
            .nav-links.active {
                transform: translateY(0);
                opacity: 1;
                visibility: visible;
            }
            
            .hero-title {
                font-size: 2.4rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 300px;
                text-align: center;
            }
            
            .section {
                padding: 70px 0;
            }
            
            .cta-section {
                margin: 70px 0;
                padding: 70px 20px;
            }
            
            .cta-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .feature-card {
                padding: 30px 20px;
            }
        }

        /* Utility Classes */
        .text-center {
            text-align: center;
        }

        .mt-1 { margin-top: 8px; }
        .mt-2 { margin-top: 16px; }
        .mt-3 { margin-top: 24px; }
        .mt-4 { margin-top: 32px; }
        .mt-5 { margin-top: 40px; }

        .mb-1 { margin-bottom: 8px; }
        .mb-2 { margin-bottom: 16px; }
        .mb-3 { margin-bottom: 24px; }
        .mb-4 { margin-bottom: 32px; }
        .mb-5 { margin-bottom: 40px; }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container nav-container">
            <a href="/" class="logo">
                <i class="fas fa-code logo-icon"></i>
                <span>Laravel</span>
            </a>
            
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="nav-links" id="navLinks">
                <a href="#" class="nav-link">Home</a>
                <a href="#" class="nav-link">Documentation</a>
                <a href="#" class="nav-link">Packages</a>
                <a href="#" class="nav-link">Ecosystem</a>
                <a href="#" class="nav-link">News</a>
            </div>
            
            <div class="nav-actions">
                <button class="theme-toggle" id="themeToggle">
                    <i class="fas fa-moon"></i>
                </button>
                
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">The PHP Framework for Web Artisans</h1>
                <p class="hero-subtitle">Laravel is a web application framework with expressive, elegant syntax. We've already laid the foundation — freeing you to create without sweating the small things.</p>
                
                <div class="hero-buttons">
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-book"></i> Read Documentation
                    </a>
                    <a href="#" class="btn btn-outline">
                        <i class="fas fa-play-circle"></i> Watch Laracasts
                    </a>
                </div>
                
                <div class="hero-graphic">
                    <div class="graphic-circle circle-1"></div>
                    <div class="graphic-circle circle-2"></div>
                    <div class="graphic-circle circle-3"></div>
                    
                    <i class="fas fa-cog hero-blade blade-1 fa-spin" style="animation-duration: 20s;"></i>
                    <i class="fas fa-cog hero-blade blade-2 fa-spin" style="animation-duration: 15s; animation-direction: reverse;"></i>
                    <i class="fas fa-cog hero-blade blade-3 fa-spin" style="animation-duration: 25s;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Why Laravel?</h2>
            <p class="section-subtitle">Laravel values beauty, simplicity, and readability. We believe development must be an enjoyable, creative experience to be truly fulfilling.</p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="feature-title">Expressive Syntax</h3>
                    <p class="feature-description">Enjoy the clean, elegant syntax Laravel is known for. Write code that's simple, readable, and maintainable.</p>
                    <a href="#" class="feature-link">
                        Learn More <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3 class="feature-title">Powerful Tools</h3>
                    <p class="feature-description">Laravel's robust set of tools and pre-built library structure make complex applications simple to build.</p>
                    <a href="#" class="feature-link">
                        Explore Tools <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <h3 class="feature-title">Modern Architecture</h3>
                    <p class="feature-description">Built with modern PHP practices and patterns, Laravel provides a solid foundation for your applications.</p>
                    <a href="#" class="feature-link">
                        View Architecture <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">Ready to Get Started?</h2>
            <p class="cta-subtitle">Join thousands of developers building amazing applications with Laravel. Start your journey today with our comprehensive documentation and tutorials.</p>
            
            <div class="cta-buttons">
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-rocket"></i> Deploy Your App
                </a>
                <a href="#" class="btn cta-btn-secondary">
                    <i class="fas fa-graduation-cap"></i> Learn on Laracasts
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Laravel</h3>
                    <p>The PHP Framework for Web Artisans. Elegant, expressive, and powerful.</p>
                </div>
                
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Laracasts</a></li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">Forge</a></li>
                        <li><a href="#">Vapor</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Community</h3>
                    <ul class="footer-links">
                        <li><a href="#">GitHub</a></li>
                        <li><a href="#">Discord</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Partners</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Resources</h3>
                    <ul class="footer-links">
                        <li><a href="#">Packages</a></li>
                        <li><a href="#">Ecosystem</a></li>
                        <li><a href="#">Certification</a></li>
                        <li><a href="#">Contribute</a></li>
                        <li><a href="#">Security</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Laravel. All rights reserved. Laravel is a trademark of Taylor Otwell.</p>
            </div>
        </div>
    </footer>

    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = themeToggle.querySelector('i');
        
        // Check for saved theme preference or default to light
        const savedTheme = localStorage.getItem('theme') || 'light';
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        }
        
        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            
            if (document.body.classList.contains('dark-mode')) {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
                localStorage.setItem('theme', 'dark');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
                localStorage.setItem('theme', 'light');
            }
        });
        
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navLinks = document.getElementById('navLinks');
        const mobileMenuIcon = mobileMenuBtn.querySelector('i');
        
        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            
            if (navLinks.classList.contains('active')) {
                mobileMenuIcon.classList.remove('fa-bars');
                mobileMenuIcon.classList.add('fa-times');
            } else {
                mobileMenuIcon.classList.remove('fa-times');
                mobileMenuIcon.classList.add('fa-bars');
            }
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', (event) => {
            const isClickInsideMenu = navLinks.contains(event.target);
            const isClickOnMenuBtn = mobileMenuBtn.contains(event.target);
            
            if (!isClickInsideMenu && !isClickOnMenuBtn && navLinks.classList.contains('active')) {
                navLinks.classList.remove('active');
                mobileMenuIcon.classList.remove('fa-times');
                mobileMenuIcon.classList.add('fa-bars');
            }
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    if (navLinks.classList.contains('active')) {
                        navLinks.classList.remove('active');
                        mobileMenuIcon.classList.remove('fa-times');
                        mobileMenuIcon.classList.add('fa-bars');
                    }
                }
            });
        });
        
        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);
        
        // Observe elements for animation
        document.querySelectorAll('.feature-card, .section-title, .section-subtitle').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>