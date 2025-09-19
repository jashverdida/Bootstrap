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
            background: linear-gradient(135deg, #0d1421 0%, #1a252f 100%);
            color: white;
        }
        
        .navbar {
            background: rgba(13, 20, 33, 0.95) !important;
            border-bottom: 3px solid #e31e24;
        }
        
        .navbar-brand {
            color: #e31e24 !important;
            font-weight: bold;
        }
        
        .nav-link {
            color: #fff !important;
        }
        
        .nav-link.active {
            color: #e31e24 !important;
        }
        
        .btn-spidey {
            background: linear-gradient(135deg, #e31e24 0%, #b71c1c 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-spidey:hover {
            background: linear-gradient(135deg, #b71c1c 0%, #e31e24 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(227, 30, 36, 0.4);
        }
        
        .btn-outline-spidey {
            border: 2px solid #e31e24;
            color: #e31e24;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-spidey:hover {
            background: #e31e24;
            color: white;
            transform: translateY(-2px);
        }
        
        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            border: none;
            color: #333;
        }
        
        .bg-spidey {
            background: linear-gradient(135deg, #e31e24 0%, #b71c1c 100%) !important;
        }
        
        .text-spidey {
            color: #e31e24 !important;
        }
        
        .hero-section {
            background: linear-gradient(135deg, rgba(13, 20, 33, 0.9), rgba(227, 30, 36, 0.7));
            border-radius: 20px;
            margin: 20px 0;
        }
        
        .stats-section {
            background: rgba(227, 30, 36, 0.1);
            border-radius: 15px;
            border: 1px solid rgba(227, 30, 36, 0.3);
        }
        
        .spider-icon {
            font-size: 2rem;
            color: #e31e24;
        }
        
        footer {
            background: rgba(13, 20, 33, 0.95) !important;
            border-top: 3px solid #e31e24;
        }
    </style>
</head>
<body>
    <!-- Header --> 
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">🕷️ ELPHP-JASH</a>
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
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-white py-5 position-relative overflow-hidden hero-section">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center" style="min-height: 500px;">
                <div class="col-lg-10">
                    <div class="spider-icon mb-4">🕷️</div>
                    <h1 class="display-2 fw-bold mb-4">Your Friendly Neighborhood Spider-Man</h1>
                    <p class="lead fs-4 mb-5">With great power comes great responsibility. Join Spider-Man as he swings through New York City protecting the innocent.</p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                        <a href="register.php" class="btn btn-spidey btn-lg px-5 py-3">Get Started Free</a>
                        <a href="about.php" class="btn btn-outline-spidey btn-lg px-5 py-3">Learn More</a>
                    </div>
                    <div class="mt-5">
                        <small class="opacity-75">Join over 1 million Spider-Man fans worldwide</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-5 fw-bold mb-3">Why Choose Spider-Man?</h2>
                    <p class="lead text-light opacity-75">Amazing powers and heroic qualities that make him the ultimate superhero</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <div class="bg-spidey rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="text-white" style="font-size: 32px;">📱</i>
                            </div>
                            <h4 class="card-title mb-3">Spider Sense</h4>
                            <p class="card-text text-muted">Enhanced awareness that alerts Spider-Man to danger, keeping him one step ahead of villains.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <div class="bg-spidey rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="text-white" style="font-size: 32px;">⚡</i>
                            </div>
                            <h4 class="card-title mb-3">Super Strength</h4>
                            <p class="card-text text-muted">Incredible strength allowing Spider-Man to lift up to 10 tons and overpower most enemies.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <div class="bg-spidey rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="text-white" style="font-size: 32px;">🎨</i>
                            </div>
                            <h4 class="card-title mb-3">Web Slinging</h4>
                            <p class="card-text text-muted">Amazing ability to swing through New York City using web shooters and incredible acrobatic skills.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5">
        <div class="container">
            <div class="stats-section p-5">
                <div class="row g-4 text-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <h2 class="display-4 fw-bold mb-0 text-spidey">15+</h2>
                            <p class="mb-0">Years Protecting NYC</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <h2 class="display-4 fw-bold mb-0 text-spidey">500+</h2>
                            <p class="mb-0">Villains Defeated</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <h2 class="display-4 fw-bold mb-0 text-spidey">1M+</h2>
                            <p class="mb-0">Lives Saved</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <h2 class="display-4 fw-bold mb-0 text-spidey">100%</h2>
                            <p class="mb-0">Hero Rating</p>
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
                            <li class="mb-2"><i class="text-spidey me-2">✓</i> Wall-crawling abilities</li>
                            <li class="mb-2"><i class="text-spidey me-2">✓</i> Enhanced reflexes and agility</li>
                            <li class="mb-2"><i class="text-spidey me-2">✓</i> Organic web shooters</li>
                            <li class="mb-2"><i class="text-spidey me-2">✓</i> Precognitive spider-sense</li>
                            <li class="mb-2"><i class="text-spidey me-2">✓</i> And much more...</li>
                        </ul>
                        <a href="dashboard.php" class="btn btn-spidey btn-lg">View Dashboard</a>
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
                            <li class="mb-2"><i class="text-spidey me-2">✓</i> Avengers membership</li>
                            <li class="mb-2"><i class="text-spidey me-2">✓</i> Fantastic Four ally</li>
                            <li class="mb-2"><i class="text-spidey me-2">✓</i> X-Men collaboration</li>
                            <li class="mb-2"><i class="text-spidey me-2">✓</i> Solo hero missions</li>
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
                    <h5 class="mb-3 text-spidey">🕷️ ELPHP-JASH</h5>
                    <p class="text-light">Your friendly neighborhood Spider-Man fan site. With great power comes great responsibility - and great web development!</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3" style="text-decoration: none;"><i style="font-size: 20px;">📘</i></a>
                        <a href="#" class="text-white me-3" style="text-decoration: none;"><i style="font-size: 20px;">🐦</i></a>
                        <a href="#" class="text-white me-3" style="text-decoration: none;"><i style="font-size: 20px;">💼</i></a>
                        <a href="#" class="text-white" style="text-decoration: none;"><i style="font-size: 20px;">📷</i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-light text-decoration-none">Home</a></li>
                        <li><a href="about.php" class="text-light text-decoration-none">About</a></li>
                        <li><a href="dashboard.php" class="text-light text-decoration-none">Dashboard</a></li>
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
                    <p class="text-light mb-0">&copy; 2025 ELPHP-JASH. All rights reserved.</p>
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