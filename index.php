<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELPHP-JASH</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0a0e1a 0%, #1a1f2e 50%, #2a1810 100%);
            color: white;
            overflow-x: hidden;
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
        
        .btn-spidey {
            background: linear-gradient(135deg, #ff1744 0%, #d50000 100%);
            border: none;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-spidey:hover {
            background: linear-gradient(135deg, #d50000 0%, #ff1744 100%);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 23, 68, 0.4);
        }
        
        .btn-spidey::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-spidey:hover::before {
            left: 100%;
        }
        
        .btn-outline-spidey {
            border: 2px solid #ff1744;
            color: #ff1744;
            border-radius: 25px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .btn-outline-spidey:hover {
            background: #ff1744;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 23, 68, 0.3);
        }
        
        .hero-section {
            min-height: 100vh;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255, 23, 68, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 193, 7, 0.3) 0%, transparent 50%),
                linear-gradient(135deg, #0a0e1a 0%, #1a1f2e 100%);
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="web" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M0 0L100 100M100 0L0 100" stroke="rgba(255,23,68,0.1)" stroke-width="1"/></pattern></defs><rect width="1000" height="1000" fill="url(%23web)"/></svg>');
            opacity: 0.3;
            animation: webAnimation 20s linear infinite;
        }
        
        @keyframes webAnimation {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(-100px) translateY(-100px); }
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-title {
            font-size: 4rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 3px;
            background: linear-gradient(135deg, #fff 0%, #ff1744 50%, #ffc107 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 2rem;
            animation: titleGlow 3s ease-in-out infinite alternate;
        }
        
        @keyframes titleGlow {
            0% { filter: drop-shadow(0 0 20px rgba(255, 23, 68, 0.5)); }
            100% { filter: drop-shadow(0 0 40px rgba(255, 23, 68, 0.8)); }
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 3rem;
            line-height: 1.6;
        }
        
        .card {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 15px;
            border: 1px solid rgba(255, 23, 68, 0.3);
            color: #fff;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-10px);
            border-color: rgba(255, 23, 68, 0.6);
            box-shadow: 0 20px 40px rgba(255, 23, 68, 0.2);
        }
        
        .bg-spidey {
            background: linear-gradient(135deg, #ff1744 0%, #d50000 100%) !important;
        }
        
        .text-spidey {
            color: #ff1744 !important;
        }
        
        .stats-section {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 20px;
            border: 1px solid rgba(255, 23, 68, 0.3);
            backdrop-filter: blur(15px);
            position: relative;
            overflow: hidden;
        }
        
        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 23, 68, 0.1) 0%, transparent 100%);
        }
        
        .spider-icon {
            font-size: 3rem;
            color: #ff1744;
            text-shadow: 0 0 20px rgba(255, 23, 68, 0.5);
            animation: pulse 2s ease-in-out infinite alternate;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }
        
        footer {
            background: rgba(0, 0, 0, 0.95) !important;
            border-top: 2px solid #ff1744;
            backdrop-filter: blur(10px);
        }
        
        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, #ff1744 50%, transparent 100%);
            margin: 4rem 0;
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-section {
                min-height: 80vh;
            }
        }
    </style>
</head>
<body>
    <!-- Header --> 
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">🕸 SPIDER-MAN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
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

    <!-- Add some top padding to account for fixed navbar -->
    <div style="padding-top: 80px;"></div>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <div class="spider-icon mb-4">🕸</div>
                    <h1 class="hero-title">SPIDER-MAN</h1>
                    <h2 class="display-6 mb-4" style="color: #ffc107; font-weight: 600; text-transform: uppercase;">Miles Morales Edition</h2>
                    <p class="hero-subtitle">Experience the ultimate web-slinging adventure. Miles Morales discovers explosive powers that set him apart from his mentor, Peter Parker. Master unique venom blast attacks and stealth camouflage to become the new Spider-Man.</p>
                    <div class="d-flex flex-column flex-sm-row gap-3 mb-4">
                        <a href="register.php" class="btn btn-spidey btn-lg px-5 py-3">JOIN NOW</a>
                        <a href="about.php" class="btn btn-outline-spidey btn-lg px-5 py-3">DISCOVER MORE</a>
                    </div>
                    <div class="row text-center mt-5">
                        <div class="col-4">
                            <h3 class="text-spidey mb-0">01</h3>
                            <small class="text-uppercase">Powers</small>
                        </div>
                        <div class="col-4">
                            <h3 class="text-spidey mb-0">02</h3>
                            <small class="text-uppercase">Skills</small>
                        </div>
                        <div class="col-4">
                            <h3 class="text-spidey mb-0">03</h3>
                            <small class="text-uppercase">Hero</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div style="position: relative; height: 600px; overflow: hidden; border-radius: 20px;">
                        <img src="https://4kwallpapers.com/images/walls/thumbs_3t/7493.jpg" 
                             class="img-fluid" 
                             style="width: 100%; height: 100%; object-fit: cover; filter: brightness(1.2) contrast(1.1);" 
                             alt="Spider-Man">
                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, rgba(255,23,68,0.3) 0%, rgba(255,193,7,0.2) 100%);"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Powers Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-4 fw-bold mb-3" style="background: linear-gradient(135deg, #fff 0%, #ff1744 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">ULTIMATE SPIDER POWERS</h2>
                    <p class="lead text-light opacity-75">Master the extraordinary abilities that make Miles Morales a unique Spider-Man</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-lg h-100 text-center">
                        <div class="card-body p-4">
                            <div class="bg-spidey rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <span class="text-white" style="font-size: 40px;">👁</span>
                            </div>
                            <h4 class="card-title mb-3 text-spidey">SPIDER-SENSE</h4>
                            <p class="card-text text-light">Enhanced precognitive awareness that alerts Miles to incoming danger, giving him superhuman reflexes and reaction time.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-lg h-100 text-center">
                        <div class="card-body p-4">
                            <div class="bg-spidey rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <span class="text-white" style="font-size: 40px;">⚡</span>
                            </div>
                            <h4 class="card-title mb-3 text-spidey">VENOM BLAST</h4>
                            <p class="card-text text-light">Bio-electric energy projection unique to Miles. Channel venom through touch to stun enemies and overload electronics.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-lg h-100 text-center">
                        <div class="card-body p-4">
                            <div class="bg-spidey rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <span class="text-white" style="font-size: 40px;">👻</span>
                            </div>
                            <h4 class="card-title mb-3 text-spidey">CAMOUFLAGE</h4>
                            <p class="card-text text-light">Invisibility powers allowing Miles to blend seamlessly with surroundings for stealth attacks and reconnaissance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5">
        <div class="container">
            <div class="stats-section p-5 position-relative">
                <div class="row g-4 text-center position-relative" style="z-index: 2;">
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <h2 class="display-3 fw-bold mb-0 text-spidey" style="text-shadow: 0 0 20px rgba(255, 23, 68, 0.5);">95%</h2>
                            <p class="mb-0 text-uppercase font-weight-bold">Mission Success</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <h2 class="display-3 fw-bold mb-0 text-spidey" style="text-shadow: 0 0 20px rgba(255, 23, 68, 0.5);">1000+</h2>
                            <p class="mb-0 text-uppercase font-weight-bold">Villains Defeated</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <h2 class="display-3 fw-bold mb-0 text-spidey" style="text-shadow: 0 0 20px rgba(255, 23, 68, 0.5);">2M+</h2>
                            <p class="mb-0 text-uppercase font-weight-bold">Lives Saved</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <h2 class="display-3 fw-bold mb-0 text-spidey" style="text-shadow: 0 0 20px rgba(255, 23, 68, 0.5);">∞</h2>
                            <p class="mb-0 text-uppercase font-weight-bold">Hero Legacy</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Showcase Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 order-lg-2">
                    <img src="https://images.unsplash.com/photo-1715783735932-2aaa7bcfab34?q=80&w=1032&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-fluid rounded shadow" alt="Analytics Dashboard">
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="pe-lg-5">
                        <h2 class="display-6 mb-3">Amazing Spider Powers</h2>
                        <p class="lead mb-4 text-light opacity-75">Discover the incredible abilities that make Spider-Man one of the greatest superheroes of all time.</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><span class="text-spidey me-2">✓</span> Wall-crawling abilities</li>
                            <li class="mb-2"><span class="text-spidey me-2">✓</span> Enhanced reflexes and agility</li>
                            <li class="mb-2"><span class="text-spidey me-2">✓</span> Organic web shooters</li>
                            <li class="mb-2"><span class="text-spidey me-2">✓</span> Precognitive spider-sense</li>
                            <li class="mb-2"><span class="text-spidey me-2">✓</span> And much more...</li>
                        </ul>
                        <a href="about.php" class="btn btn-spidey btn-lg">Learn More</a>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1612036782180-6f0b6cd846fe?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-fluid rounded shadow" alt="Team Collaboration">
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-5">
                        <h2 class="display-6 mb-3">Hero Team-Up</h2>
                        <p class="lead mb-4 text-light opacity-75">Join forces with other heroes and work together to protect the world from evil villains and threats.</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><span class="text-spidey me-2">⭐</span> Avengers membership</li>
                            <li class="mb-2"><span class="text-spidey me-2">⭐</span> Fantastic Four ally</li>
                            <li class="mb-2"><span class="text-spidey me-2">⭐</span> X-Men collaboration</li>
                            <li class="mb-2"><span class="text-spidey me-2">⭐</span> Solo hero missions</li>
                        </ul>
                        <a href="about.php" class="btn btn-spidey btn-lg">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-5 fw-bold mb-3">What Fans Say</h2>
                    <p class="lead text-light opacity-75">Loved by fans and fellow superheroes worldwide</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <span class="text-warning">★★★★★</span>
                            </div>
                            <p class="card-text mb-4">"Spider-Man is the greatest superhero ever! His wit, courage, and amazing powers make him truly spectacular."</p>
                            <div class="d-flex align-items-center">
                                <img src="https://images.unsplash.com/photo-1521714161819-15534968fc5f?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                                     class="rounded-circle me-3" 
                                     style="width: 50px; height: 50px; object-fit: cover;" 
                                     alt="Sarah Johnson">
                                <div>
                                    <h6 class="mb-0">Mary Jane Watson</h6>
                                    <small class="text-muted">Daily Bugle Reporter</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <span class="text-warning">★★★★★</span>
                            </div>
                            <p class="card-text mb-4">"Amazing wall-crawling abilities! Spider-Man always saves the day when New York City needs him most."</p>
                            <div class="d-flex align-items-center">
                                <img src="https://images.unsplash.com/photo-1657558045738-21507cf53606?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                                     class="rounded-circle me-3" 
                                     style="width: 50px; height: 50px; object-fit: cover;" 
                                     alt="Mike Chen">
                                <div>
                                    <h6 class="mb-0">J. Jonah Jameson</h6>
                                    <small class="text-muted">Daily Bugle Editor</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <span class="text-warning">★★★★★</span>
                            </div>
                            <p class="card-text mb-4">"Spider-Man's heroic spirit is inspiring. He shows us that anyone can be a hero with great responsibility."</p>
                            <div class="d-flex align-items-center">
                                <img src="https://images.unsplash.com/photo-1590341328520-63256eb32bc3?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                                     class="rounded-circle me-3" 
                                     style="width: 50px; height: 50px; object-fit: cover;" 
                                     alt="Emily Rodriguez">
                                <div>
                                    <h6 class="mb-0">Aunt May Parker</h6>
                                    <small class="text-muted">Peter's Guardian</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-5">
        <div class="container text-center">
            <div class="stats-section p-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="display-5 fw-bold mb-3">Ready to Be a Hero?</h2>
                        <p class="lead mb-4 text-light opacity-75">Join Spider-Man and millions of fans who believe that with great power comes great responsibility.</p>
                        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                            <a href="register.php" class="btn btn-spidey btn-lg px-5">Start Building</a>
                            <a href="login.php" class="btn btn-outline-spidey btn-lg px-5">Sign In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-3 text-spidey">🕸 SPIDER-MAN</h5>
                    <p class="text-light">Experience the ultimate Spider-Man adventure with Miles Morales. Master unique powers, explore New York City, and become the hero you're meant to be.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3" style="text-decoration: none;"><span style="font-size: 20px;">📱</span></a>
                        <a href="#" class="text-white me-3" style="text-decoration: none;"><span style="font-size: 20px;">🐦</span></a>
                        <a href="#" class="text-white me-3" style="text-decoration: none;"><span style="font-size: 20px;">💼</span></a>
                        <a href="#" class="text-white" style="text-decoration: none;"><span style="font-size: 20px;">📷</span></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-light text-decoration-none">Home</a></li>
                        <li><a href="about.php" class="text-light text-decoration-none">About</a></li>
                        <!-- Dashboard removed -->
                        <li><a href="login.php" class="text-light text-decoration-none">Login</a></li>
                        <li><a href="register.php" class="text-light text-decoration-none">Register</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="mb-3">Resources</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Documentation</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Examples</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Themes</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Blog</a></li>
                        <li><a href="#" class="text-light text-decoration-none">GitHub</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="mb-3">Support</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Help Center</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Community</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Contact</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Status</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Privacy</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="mb-3">Newsletter</h6>
                    <p class="text-light small">Stay updated with the latest Spider-Man news and releases.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control form-control-sm" placeholder="Your email">
                        <button class="btn btn-spidey btn-sm" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: #e31e24;">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-light mb-0">&copy; 2025 Spider-Man: Miles Morales Edition. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="text-light text-decoration-none small">Privacy Policy</a></li>
                        <li class="list-inline-item"><span class="text-muted">|</span></li>
                        <li class="list-inline-item"><a href="#" class="text-light text-decoration-none small">Terms of Service</a></li>
                        <li class="list-inline-item"><span class="text-muted">|</span></li>
                        <li class="list-inline-item"><a href="#" class="text-light text-decoration-none small">Cookies</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle CDN (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>