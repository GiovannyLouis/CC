<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- EDIT HERE: Page Title -->
    <title>[Your Full Name] | [Your Professional Title]</title>
    <!-- FontAwesome CDN for modern icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* Light Theme Color Palette */
            --bg-primary: #f8fafc;
            --bg-secondary: #ffffff;
            --bg-card: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --accent: #2563eb;
            --accent-hover: #1d4ed8;
            --accent-light: rgba(37, 99, 235, 0.1);
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 20px;
            --radius-full: 9999px;
            --transition: all 0.3s ease;
        }

        [data-theme="dark"] {
            /* Dark Theme Color Palette */
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-card: #1e293b;
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --text-muted: #64748b;
            --accent: #3b82f6;
            --accent-hover: #60a5fa;
            --accent-light: rgba(59, 130, 246, 0.15);
            --border-color: #334155;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.3);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            transition: background-color 0.3s ease, color 0.3s ease;
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        ul {
            list-style: none;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .section {
            padding: 5rem 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .section-subtitle {
            color: var(--accent);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
            display: block;
        }

        .section-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.75rem;
            border-radius: var(--radius-full);
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid transparent;
        }

        .btn-primary {
            background-color: var(--accent);
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-outline {
            background-color: transparent;
            border-color: var(--border-color);
            color: var(--text-primary);
        }

        .btn-outline:hover {
            border-color: var(--accent);
            color: var(--accent);
            transform: translateY(-2px);
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            transition: var(--transition);
        }

        [data-theme="light"] .navbar {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .nav-logo {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-logo span {
            color: var(--accent);
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-link {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-secondary);
            transition: var(--transition);
        }

        .nav-link:hover {
            color: var(--accent);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .theme-toggle {
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: var(--radius-full);
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-toggle:hover {
            background-color: var(--accent-light);
            color: var(--accent);
        }

        .hamburger {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 1.5rem;
            cursor: pointer;
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 100px;
            padding-bottom: 4rem;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 3rem;
            align-items: center;
        }

        .hero-tagline {
            display: inline-block;
            padding: 0.35rem 1rem;
            background-color: var(--accent-light);
            color: var(--accent);
            border-radius: var(--radius-full);
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
        }

        .hero-title {
            font-size: 3.25rem;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            font-weight: 400;
        }

        .hero-bio {
            color: var(--text-muted);
            font-size: 1.05rem;
            margin-bottom: 2rem;
            max-width: 540px;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .hero-image-container {
            position: relative;
            display: flex;
            justify-content: center;
        }

        .hero-image-wrapper {
            position: relative;
            width: 300px;
            height: 300px;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            overflow: hidden;
            border: 4px solid var(--accent);
            box-shadow: var(--shadow-lg);
            animation: morphShape 8s ease-in-out infinite;
        }

        @keyframes morphShape {
            0% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
            50% { border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%; }
            100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .about-text p {
            color: var(--text-secondary);
            margin-bottom: 1.25rem;
            font-size: 1.05rem;
        }

        .about-highlights {
            margin: 1.5rem 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .highlight-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        .highlight-item i {
            color: var(--accent);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .stat-card {
            background-color: var(--bg-card);
            padding: 1.5rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent);
        }

        .stat-number {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .skill-category-card {
            background-color: var(--bg-card);
            padding: 2rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .skill-category-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .category-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .category-icon {
            width: 45px;
            height: 45px;
            border-radius: var(--radius-sm);
            background-color: var(--accent-light);
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .category-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
        }

        .skill-tag {
            padding: 0.4rem 0.8rem;
            background-color: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
            transition: var(--transition);
        }

        .skill-tag:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .filter-tabs {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }

        .tab-btn {
            padding: 0.5rem 1.25rem;
            border-radius: var(--radius-full);
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .tab-btn:hover, .tab-btn.active {
            background-color: var(--accent);
            color: #ffffff;
            border-color: var(--accent);
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        .project-card {
            background-color: var(--bg-card);
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
        }

        .project-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .project-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .project-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .project-card:hover .project-image {
            transform: scale(1.05);
        }

        .project-content {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .project-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .project-description {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 1.25rem;
            flex-grow: 1;
        }

        .project-tech {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-bottom: 1.5rem;
        }

        .tech-badge {
            font-size: 0.75rem;
            padding: 0.2rem 0.6rem;
            background-color: var(--accent-light);
            color: var(--accent);
            border-radius: var(--radius-sm);
            font-weight: 600;
        }

        .project-links {
            display: flex;
            gap: 1rem;
        }

        .project-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-primary);
            transition: var(--transition);
        }

        .project-link:hover {
            color: var(--accent);
        }

        .timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: var(--border-color);
        }

        @media (min-width: 768px) {
            .timeline::before {
                left: 50%;
                transform: translateX(-50%);
            }
        }

        .timeline-item {
            position: relative;
            margin-bottom: 2.5rem;
        }

        .timeline-dot {
            position: absolute;
            left: 11px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: var(--radius-full);
            background-color: var(--accent);
            border: 4px solid var(--bg-primary);
            z-index: 10;
        }

        @media (min-width: 768px) {
            .timeline-dot {
                left: 50%;
                transform: translateX(-50%);
            }
        }

        .timeline-content {
            margin-left: 50px;
            background-color: var(--bg-card);
            padding: 1.75rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        @media (min-width: 768px) {
            .timeline-item:nth-child(even) .timeline-content {
                margin-left: calc(50% + 30px);
            }
            .timeline-item:nth-child(odd) .timeline-content {
                margin-left: 0;
                margin-right: calc(50% + 30px);
            }
        }

        .timeline-role {
            font-size: 1.15rem;
            font-weight: 700;
        }

        .timeline-company {
            color: var(--accent);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }

        .timeline-date {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
            display: inline-block;
            background-color: var(--bg-primary);
            padding: 0.2rem 0.6rem;
            border-radius: var(--radius-sm);
        }

        .timeline-details {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .timeline-details li {
            position: relative;
            padding-left: 1.2rem;
            margin-bottom: 0.4rem;
        }

        .timeline-details li::before {
            content: '•';
            color: var(--accent);
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 0.8fr 1.2fr;
            gap: 3rem;
        }

        .contact-info-card {
            background-color: var(--bg-card);
            padding: 2rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            height: 100%;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-sm);
            background-color: var(--accent-light);
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .info-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .info-value {
            font-weight: 600;
            color: var(--text-primary);
        }

        .social-links {
            display: flex;
            gap: 0.75rem;
            margin-top: 2rem;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-full);
            background-color: var(--bg-primary);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .social-btn:hover {
            background-color: var(--accent);
            color: #ffffff;
            border-color: var(--accent);
            transform: translateY(-3px);
        }

        .contact-form {
            background-color: var(--bg-card);
            padding: 2rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .form-input, .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-color);
            background-color: var(--bg-primary);
            color: var(--text-primary);
            font-family: inherit;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-light);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .toast-notification {
            display: none;
            padding: 1rem;
            background-color: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22c55e;
            border-radius: var(--radius-sm);
            margin-top: 1rem;
            font-size: 0.9rem;
            text-align: center;
        }

        .footer {
            background-color: var(--bg-secondary);
            border-top: 1px solid var(--border-color);
            padding: 2.5rem 0;
            text-align: center;
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .footer-text {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        @media (max-width: 992px) {
            .hero-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .hero-bio {
                margin: 0 auto 2rem auto;
            }
            .hero-buttons {
                justify-content: center;
            }
            .about-grid {
                grid-template-columns: 1fr;
            }
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }
            .nav-menu {
                position: fixed;
                top: 70px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 70px);
                background-color: var(--bg-card);
                flex-direction: column;
                justify-content: center;
                transition: var(--transition);
                border-top: 1px solid var(--border-color);
            }
            .nav-menu.active {
                left: 0;
            }
            .hero-title {
                font-size: 2.25rem;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- EDIT HERE: Navigation Bar -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="#" class="nav-logo">
                <i class="fa-solid fa-code"></i>
                <!-- EDIT HERE: Brand / Logo Text -->
                [Your Logo / Name]
            </a>

            <nav>
                <ul class="nav-menu" id="nav-menu">
                    <li><a href="#about" class="nav-link">About</a></li>
                    <li><a href="#skills" class="nav-link">Skills</a></li>
                    <li><a href="#projects" class="nav-link">Projects</a></li>
                    <li><a href="#experience" class="nav-link">Experience</a></li>
                    <li><a href="#contact" class="nav-link">Contact</a></li>
                </ul>
            </nav>

            <div class="nav-actions">
                <button class="theme-toggle" id="theme-toggle" aria-label="Toggle Theme">
                    <i class="fa-solid fa-moon"></i>
                </button>
                <button class="hamburger" id="hamburger-btn" aria-label="Toggle Menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- EDIT HERE: Hero Section -->
    <section class="hero" id="hero">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-content">
                    <span class="hero-tagline"><!-- EDIT HERE: Greeting --> 👋 Welcome to my portfolio</span>
                    <h1 class="hero-title">
                        <!-- EDIT HERE: Your Name -->
                        Hi, I'm <span style="color: var(--accent);">[Your Full Name]</span>
                    </h1>
                    <h2 class="hero-subtitle">
                        <!-- EDIT HERE: Headline / Subtitle -->
                        [Your Role / Title - e.g., Senior Full-Stack Software Engineer]
                    </h2>
                    <p class="hero-bio">
                        <!-- EDIT HERE: Short Elevator Pitch -->
                        [Your Tagline / Elevator Pitch - e.g., Building scalable web applications, elegant interactive interfaces, and robust cloud services with modern web technologies.]
                    </p>
                    <div class="hero-buttons">
                        <a href="#projects" class="btn btn-primary">
                            <i class="fa-solid fa-briefcase"></i> View My Work
                        </a>
                        <a href="#contact" class="btn btn-outline">
                            <i class="fa-solid fa-envelope"></i> Contact Me
                        </a>
                    </div>
                </div>

                <div class="hero-image-container">
                    <div class="hero-image-wrapper">
                        <!-- EDIT HERE: Profile Image URL -->
                        <img src="https://placehold.co/400x400/2563eb/ffffff?text=Your+Photo" alt="Profile Picture" class="hero-image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EDIT HERE: About Me Section -->
    <section class="section" id="about" style="background-color: var(--bg-secondary);">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Get To Know Me</span>
                <h2 class="section-title">About Me</h2>
            </div>

            <div class="about-grid">
                <div class="about-text">
                    <p>
                        <!-- EDIT HERE: Paragraph 1 -->
                        [Your Detailed Bio - Paragraph 1. Describe your journey, passion for technology, background, and core mission.]
                    </p>
                    <p>
                        <!-- EDIT HERE: Paragraph 2 -->
                        [Your Detailed Bio - Paragraph 2. Share what drives you, how you handle problem-solving, team leadership, or your product philosophy.]
                    </p>

                    <div class="about-highlights">
                        <!-- EDIT HERE: Bullet Points -->
                        <div class="highlight-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>[Highlight 1 - e.g. Clean Code advocate]</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>[Highlight 2 - e.g. Agile Methodologies]</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>[Highlight 3 - e.g. Responsive Design]</span>
                        </div>
                        <div class="highlight-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>[Highlight 4 - e.g. Continuous Integration]</span>
                        </div>
                    </div>
                </div>

                <div class="stats-grid">
                    <!-- EDIT HERE: Stat Item 1 -->
                    <div class="stat-card">
                        <div class="stat-number">[5+]</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                    <!-- EDIT HERE: Stat Item 2 -->
                    <div class="stat-card">
                        <div class="stat-number">[30+]</div>
                        <div class="stat-label">Projects Completed</div>
                    </div>
                    <!-- EDIT HERE: Stat Item 3 -->
                    <div class="stat-card">
                        <div class="stat-number">[15+]</div>
                        <div class="stat-label">Happy Clients / Organizations</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EDIT HERE: Skills Section -->
    <section class="section" id="skills">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">My Expertise</span>
                <h2 class="section-title">Technical Skills</h2>
            </div>

            <div class="skills-grid">
                <!-- EDIT HERE: Skill Category 1 (Frontend) -->
                <div class="skill-category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i class="fa-solid fa-desktop"></i>
                        </div>
                        <h3 class="category-title">Frontend Development</h3>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag">[HTML5 / CSS3]</span>
                        <span class="skill-tag">[JavaScript / TypeScript]</span>
                        <span class="skill-tag">[React.js]</span>
                        <span class="skill-tag">[Vue.js]</span>
                        <span class="skill-tag">[Tailwind CSS]</span>
                    </div>
                </div>

                <!-- EDIT HERE: Skill Category 2 (Backend) -->
                <div class="skill-category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i class="fa-solid fa-server"></i>
                        </div>
                        <h3 class="category-title">Backend Development</h3>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag">[Node.js / Express]</span>
                        <span class="skill-tag">[Python / Django]</span>
                        <span class="skill-tag">[PostgreSQL / MySQL]</span>
                        <span class="skill-tag">[MongoDB]</span>
                        <span class="skill-tag">[RESTful APIs & GraphQL]</span>
                    </div>
                </div>

                <!-- EDIT HERE: Skill Category 3 (Tools & DevOps) -->
                <div class="skill-category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>
                        <h3 class="category-title">Tools & DevOps</h3>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag">[Git / GitHub]</span>
                        <span class="skill-tag">[Docker]</span>
                        <span class="skill-tag">[AWS / GCP]</span>
                        <span class="skill-tag">[CI/CD Pipelines]</span>
                        <span class="skill-tag">[Linux / Bash]</span>
                    </div>
                </div>

                <!-- EDIT HERE: Skill Category 4 (UI/UX Design) -->
                <div class="skill-category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i class="fa-solid fa-palette"></i>
                        </div>
                        <h3 class="category-title">UI/UX & Others</h3>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag">[Figma / Adobe XD]</span>
                        <span class="skill-tag">[Wireframing]</span>
                        <span class="skill-tag">[Prototyping]</span>
                        <span class="skill-tag">[Web Accessibility (a11y)]</span>
                        <span class="skill-tag">[Unit Testing]</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EDIT HERE: Projects Section -->
    <section class="section" id="projects" style="background-color: var(--bg-secondary);">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Portfolio</span>
                <h2 class="section-title">Featured Projects</h2>
            </div>

            <!-- Filter Categories (All, Web, Apps, Design) -->
            <div class="filter-tabs">
                <button class="tab-btn active" data-filter="all">All</button>
                <button class="tab-btn" data-filter="web">Web</button>
                <button class="tab-btn" data-filter="apps">Apps</button>
                <button class="tab-btn" data-filter="design">Design</button>
            </div>

            <div class="projects-grid">
                <!-- EDIT HERE: Project Item 1 -->
                <div class="project-card" data-category="web">
                    <div class="project-image-wrapper">
                        <img src="https://placehold.co/600x400/2563eb/ffffff?text=Project+1+Preview" alt="Project 1" class="project-image">
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">[Project 1 Title]</h3>
                        <p class="project-description">
                            [Short descriptive summary of what Project 1 achieves, key features built, and problems solved.]
                        </p>
                        <div class="project-tech">
                            <span class="tech-badge">[React]</span>
                            <span class="tech-badge">[Node.js]</span>
                            <span class="tech-badge">[MongoDB]</span>
                        </div>
                        <div class="project-links">
                            <a href="#" class="project-link" target="_blank"><i class="fa-solid fa-external-link"></i> Live Demo</a>
                            <a href="#" class="project-link" target="_blank"><i class="fa-brands fa-github"></i> GitHub</a>
                        </div>
                    </div>
                </div>

                <!-- EDIT HERE: Project Item 2 -->
                <div class="project-card" data-category="apps">
                    <div class="project-image-wrapper">
                        <img src="https://placehold.co/600x400/0f172a/ffffff?text=Project+2+Preview" alt="Project 2" class="project-image">
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">[Project 2 Title]</h3>
                        <p class="project-description">
                            [Short descriptive summary of Project 2. Explain technical highlights and key user functionalities.]
                        </p>
                        <div class="project-tech">
                            <span class="tech-badge">[React Native]</span>
                            <span class="tech-badge">[Firebase]</span>
                            <span class="tech-badge">[Redux]</span>
                        </div>
                        <div class="project-links">
                            <a href="#" class="project-link" target="_blank"><i class="fa-solid fa-external-link"></i> Live Demo</a>
                            <a href="#" class="project-link" target="_blank"><i class="fa-brands fa-github"></i> GitHub</a>
                        </div>
                    </div>
                </div>

                <!-- EDIT HERE: Project Item 3 -->
                <div class="project-card" data-category="design">
                    <div class="project-image-wrapper">
                        <img src="https://placehold.co/600x400/3b82f6/ffffff?text=Project+3+Preview" alt="Project 3" class="project-image">
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">[Project 3 Title]</h3>
                        <p class="project-description">
                            [Short descriptive summary of Project 3 focus on UI/UX redesign, wireframes, and design system creation.]
                        </p>
                        <div class="project-tech">
                            <span class="tech-badge">[Figma]</span>
                            <span class="tech-badge">[UI/UX]</span>
                            <span class="tech-badge">[Design System]</span>
                        </div>
                        <div class="project-links">
                            <a href="#" class="project-link" target="_blank"><i class="fa-solid fa-external-link"></i> Prototype</a>
                            <a href="#" class="project-link" target="_blank"><i class="fa-brands fa-figma"></i> Figma</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EDIT HERE: Work Experience / Timeline Section -->
    <section class="section" id="experience">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Career Journey</span>
                <h2 class="section-title">Work Experience</h2>
            </div>

            <div class="timeline">
                <!-- EDIT HERE: Experience Item 1 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3 class="timeline-role">[Job Title 1]</h3>
                        <div class="timeline-company">[Company Name 1] • [Location or Remote]</div>
                        <span class="timeline-date">[2023 - Present]</span>
                        <ul class="timeline-details">
                            <li>[Key accomplishment or core responsibility 1]</li>
                            <li>[Key accomplishment or core responsibility 2]</li>
                            <li>[Impact stat or metric achieved, e.g., Improved site speed by 40%]</li>
                        </ul>
                    </div>
                </div>

                <!-- EDIT HERE: Experience Item 2 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3 class="timeline-role">[Job Title 2]</h3>
                        <div class="timeline-company">[Company Name 2] • [Location]</div>
                        <span class="timeline-date">[2021 - 2023]</span>
                        <ul class="timeline-details">
                            <li>[Key accomplishment or core responsibility 1]</li>
                            <li>[Key accomplishment or core responsibility 2]</li>
                            <li>[Impact stat or metric achieved]</li>
                        </ul>
                    </div>
                </div>

                <!-- EDIT HERE: Experience Item 3 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3 class="timeline-role">[Job Title 3]</h3>
                        <div class="timeline-company">[Company Name 3] • [Location]</div>
                        <span class="timeline-date">[2019 - 2021]</span>
                        <ul class="timeline-details">
                            <li>[Key accomplishment or core responsibility 1]</li>
                            <li>[Key accomplishment or core responsibility 2]</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EDIT HERE: Contact Section -->
    <section class="section" id="contact" style="background-color: var(--bg-secondary);">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Get In Touch</span>
                <h2 class="section-title">Contact Me</h2>
            </div>

            <div class="contact-grid">
                <div class="contact-info-card">
                    <h3 style="font-size: 1.25rem; margin-bottom: 1.5rem;">Contact Information</h3>
                    
                    <!-- EDIT HERE: Direct Email -->
                    <div class="info-item">
                        <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <div class="info-label">Email</div>
                            <div class="info-value">[your.email@example.com]</div>
                        </div>
                    </div>

                    <!-- EDIT HERE: Direct Phone -->
                    <div class="info-item">
                        <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <div class="info-label">Phone</div>
                            <div class="info-value">[+1 (123) 456-7890]</div>
                        </div>
                    </div>

                    <!-- EDIT HERE: Location -->
                    <div class="info-item">
                        <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div>
                            <div class="info-label">Location</div>
                            <div class="info-value">[City, Country]</div>
                        </div>
                    </div>

                    <div style="margin-top: 2rem;">
                        <div class="info-label">Connect with me</div>
                        <!-- EDIT HERE: Social Media Profiles -->
                        <div class="social-links">
                            <a href="#" class="social-btn" aria-label="LinkedIn" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="#" class="social-btn" aria-label="GitHub" target="_blank"><i class="fa-brands fa-github"></i></a>
                            <a href="#" class="social-btn" aria-label="Twitter/X" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#" class="social-btn" aria-label="Dribbble" target="_blank"><i class="fa-brands fa-dribbble"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Contact Interactive Form -->
                <form class="contact-form" id="contact-form">
                    <div class="form-group">
                        <label class="form-label" for="form-name">Your Name</label>
                        <input type="text" id="form-name" class="form-input" placeholder="e.g. John Doe" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="form-email">Your Email</label>
                        <input type="email" id="form-email" class="form-input" placeholder="e.g. john@example.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="form-subject">Subject</label>
                        <input type="text" id="form-subject" class="form-input" placeholder="e.g. Project Inquiry" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="form-message">Message</label>
                        <textarea id="form-message" class="form-textarea" placeholder="Write your message here..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="fa-solid fa-paper-plane"></i> Send Message
                    </button>

                    <div class="toast-notification" id="toast-message">
                        Thank you! Your message has been sent successfully (Demo Mode).
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- EDIT HERE: Footer Section -->
    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-text">
                &copy; <span id="current-year"></span> <strong>[Your Full Name]</strong>. All rights reserved.
            </div>
            <div>
                <a href="#hero" class="nav-link" style="font-size: 0.85rem;"><i class="fa-solid fa-arrow-up"></i> Back to top</a>
            </div>
        </div>
    </footer>

    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeIcon = themeToggleBtn.querySelector('i');
        const htmlElement = document.documentElement;

        // Check stored theme preference or set dark mode default
        const savedTheme = localStorage.getItem('theme') || 'dark';
        htmlElement.setAttribute('data-theme', savedTheme);
        updateThemeIcon(savedTheme);

        themeToggleBtn.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            htmlElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });

        function updateThemeIcon(theme) {
            if (theme === 'dark') {
                themeIcon.className = 'fa-solid fa-sun';
            } else {
                themeIcon.className = 'fa-solid fa-moon';
            }
        }

        const hamburgerBtn = document.getElementById('hamburger-btn');
        const navMenu = document.getElementById('nav-menu');

        hamburgerBtn.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            const isOpen = navMenu.classList.contains('active');
            hamburgerBtn.querySelector('i').className = isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
        });

        // Close menu when a navigation link is clicked
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
                hamburgerBtn.querySelector('i').className = 'fa-solid fa-bars';
            });
        });

        const tabBtns = document.querySelectorAll('.tab-btn');
        const projectCards = document.querySelectorAll('.project-card');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class from all buttons
                tabBtns.forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                btn.classList.add('active');

                const filter = btn.getAttribute('data-filter');

                projectCards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    if (filter === 'all' || category === filter) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        const contactForm = document.getElementById('contact-form');
        const toastNotification = document.getElementById('toast-message');

        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Show custom success message inside page (No alert window)
            toastNotification.style.display = 'block';
            contactForm.reset();

            // Hide toast notification after 5 seconds
            setTimeout(() => {
                toastNotification.style.display = 'none';
            }, 5000);
        });

        document.getElementById('current-year').textContent = new Date().getFullYear();
    </script>
</body>
</html>