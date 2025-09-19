<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - ELPHP-JASH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --spidey-red: #ff1744;
            --spidey-blue: #1976d2;
            --spidey-gold: #ffc107;
            --spidey-dark: #0a0e1a;
            --spidey-darker: #1a1f2e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--spidey-dark) 0%, var(--spidey-darker) 100%);
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(255, 23, 68, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 193, 7, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(25, 118, 210, 0.1) 0%, transparent 50%);
            z-index: -1;
            animation: webPattern 20s ease-in-out infinite;
        }

        @keyframes webPattern {
            0%, 100% { transform: rotate(0deg) scale(1); }
            33% { transform: rotate(5deg) scale(1.1); }
            66% { transform: rotate(-5deg) scale(0.9); }
        }

        .navbar {
            background: rgba(0, 0, 0, 0.95) !important;
            border-bottom: 2px solid #ff1744;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            color: #ff1744 !important;
            font-weight: bold;
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .nav-link {
            color: #fff !important;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #ff1744 !important;
            transform: translateY(-2px);
        }

        .nav-link.active {
            color: #ff1744 !important;
        }

        .main-content {
            padding-top: 100px;
            padding-bottom: 50px;
        }

        .hero-section {
            text-align: center;
            margin-bottom: 4rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 900;
            background: linear-gradient(45deg, var(--spidey-red), var(--spidey-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from { filter: drop-shadow(0 0 20px rgba(255, 23, 68, 0.5)); }
            to { filter: drop-shadow(0 0 30px rgba(255, 193, 7, 0.5)); }
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
        }

        .spider-logo {
            font-size: 4rem;
            animation: pulse 2s infinite;
            margin-bottom: 1rem;
            display: inline-block;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .about-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(255, 23, 68, 0.2);
            border-color: rgba(255, 23, 68, 0.4);
        }

        .text-spidey {
            color: var(--spidey-red);
            font-weight: bold;
        }

        .footer {
            background: rgba(10, 14, 26, 0.9);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 23, 68, 0.3);
            color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 2rem 0;
            margin-top: 4rem;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .spider-logo {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">🕸 SPIDER-MAN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Join</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container main-content">
        <div class="hero-section">
            <div class="spider-logo">🕷️</div>
            <h1 class="hero-title">About ELPHP-JASH</h1>
            <p class="hero-subtitle">Modern PHP development with Spider-Man style</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Main About Card -->
                <div class="card about-card">
                    <div class="card-body p-5">
                        <h2 class="card-title text-spidey mb-4">🕸️ Our Web Story</h2>
                        <p class="card-text text-white mb-4">Welcome to the Spider-Verse Web - a cutting-edge Bootstrap practice website that combines the thrilling world of Spider-Man with modern web development. This project showcases advanced PHP techniques, responsive design, and cinematic user experiences.</p>
                        
                        <p class="card-text text-white mb-0">Built with the speed and agility of your friendly neighborhood web-crawler, our platform demonstrates the perfect fusion of style and functionality. Every component has been crafted with the same precision Spider-Man uses to navigate the urban jungle.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <span>🕸️ &copy; 2025 ELPHP-JASH - With Great Power Comes Great Responsibility</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
