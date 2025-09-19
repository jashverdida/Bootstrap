<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELPHP-JASH - About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0d1421 0%, #1a252f 100%);
            min-height: 100vh;
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
        
        .about-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(227, 30, 36, 0.1);
            color: #333;
        }
        
        .spider-logo {
            font-size: 4rem;
            color: #e31e24;
            margin-bottom: 1rem;
        }
        
        .text-spidey {
            color: #e31e24 !important;
        }
        
        footer {
            background: rgba(13, 20, 33, 0.95) !important;
            border-top: 3px solid #e31e24;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">🕷️ ELPHP-JASH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="about.php">About</a>
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

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-8 col-lg-6">
                <div class="card about-card border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="spider-logo">🕷️</div>
                            <h2 class="fw-bold mb-3">About Jash</h2>
                            <p class="text-muted">Your friendly neighborhood developer</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="card-text">Hey there! I'm <span class="text-spidey fw-bold">Jash Verdida</span>, a passionate web developer who believes that coding is like having superpowers. Just like Spider-Man swings through New York City, I navigate through lines of code to create amazing web experiences.</p>
                            
                            <p class="card-text">Spider-Man has always been my favorite superhero because he represents the everyday person who gains extraordinary abilities but never forgets his responsibility to help others. As a developer, I try to apply the same principle - using my coding skills to build solutions that make people's lives better.</p>
                            
                            <p class="card-text">When I'm not coding, you'll probably find me watching Spider-Man movies, reading comics, or working on projects like <span class="text-spidey">EXPoints</span> and exploring new technologies. Every line of code I write is infused with the spirit of <em>"With great power comes great responsibility."</em></p>
                        </div>
                        
                        <div class="text-center">
                            <p class="small text-muted mb-3">
                                <em>"With great power comes great responsibility"</em><br>
                                - Uncle Ben (and my coding philosophy)
                            </p>
                            <a href="index.php" class="btn btn-outline-danger me-2">🏠 Back Home</a>
                            <a href="login.php" class="btn" style="background: linear-gradient(135deg, #e31e24 0%, #b71c1c 100%); color: white; border-radius: 12px;">🕸️ Join Me</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white text-center py-4">
        <div class="container">
            <span>&copy; 2025 ELPHP-JASH | Jash Verdida's Friendly Neighborhood Web</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>