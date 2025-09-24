<?php
session_start();

$error = '';
$success = '';

// Simple file-based user storage
$usersFile = __DIR__ . '/users.json';

// Load existing users
function loadUsers() {
    global $usersFile;
    if (file_exists($usersFile)) {
        $content = file_get_contents($usersFile);
        return json_decode($content, true) ?: [];
    }
    return [];
}

// Save users
function saveUsers($users) {
    global $usersFile;
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
}

// Clear registration session for retry
if (isset($_GET['clear_registration'])) {
    unset($_SESSION['registered_user']);
    header("Location: register.php");
    exit;
}

// POST handling for registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['fullName'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $email = trim($_POST['registerEmail'] ?? '');
    
    // Validation
    if (empty($name)) {
        $error = 'Full name is required';
    } elseif (empty($age) || !is_numeric($age) || $age < 1 || $age > 120) {
        $error = 'Please enter a valid age (1-120)';
    } elseif (empty($email)) {
        $error = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address';
    } else {
        // Load existing users
        $users = loadUsers();
        
        // Check if email already exists
        if (isset($users[$email])) {
            $error = 'This email is already registered! Try logging in instead.';
        } else {
            // Save user data permanently
            $userData = [
                'name' => $name,
                'age' => (int)$age,
                'email' => $email,
                'registration_time' => date('Y-m-d H:i:s')
            ];
            
            $users[$email] = $userData;
            saveUsers($users);
            
            // Also store in session for immediate access
            $_SESSION['registered_user'] = $userData;
            
            $success = 'Registration successful! You can now login with this email. Redirecting...';
            
            // Redirect to profile with GET parameter
            header("Location: profile.php?view=details");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELPHP-JASH - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0a0e1a 0%, #1a1f2e 50%, #2a1810 100%);
            color: white;
            min-height: 100vh;
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
        
        .register-container {
            background: 
                radial-gradient(circle at 20% 80%, rgba(255, 23, 68, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 193, 7, 0.3) 0%, transparent 50%),
                linear-gradient(135deg, #0a0e1a 0%, #1a1f2e 100%);
            position: relative;
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
            overflow: hidden;
        }
        
        .register-container::before {
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
        
        .register-card {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 20px;
            border: 1px solid rgba(255, 23, 68, 0.3);
            backdrop-filter: blur(15px);
            box-shadow: 0 20px 40px rgba(255, 23, 68, 0.2);
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }
        
        .register-card:hover {
            border-color: rgba(255, 23, 68, 0.6);
            box-shadow: 0 30px 60px rgba(255, 23, 68, 0.3);
        }
        
        .spider-logo {
            font-size: 4rem;
            color: #ff1744;
            margin-bottom: 1rem;
            text-shadow: 0 0 20px rgba(255, 23, 68, 0.5);
            animation: pulse 2s ease-in-out infinite alternate;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            100% { transform: scale(1.05); }
        }
        
        .btn-spidey {
            background: linear-gradient(135deg, #ff1744 0%, #d50000 100%);
            border: none;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px;
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
        
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 23, 68, 0.3);
            border-radius: 15px;
            padding: 15px;
            color: white;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #ff1744;
            box-shadow: 0 0 0 0.2rem rgba(255, 23, 68, 0.25);
            color: white;
        }
        
        .form-label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .text-spidey {
            color: #ff1744 !important;
        }
        
        .text-spidey:hover {
            color: #ffc107 !important;
        }
        
        .alert {
            border-radius: 15px;
            border: none;
            backdrop-filter: blur(10px);
        }
        
        .alert-danger {
            background: rgba(220, 53, 69, 0.2);
            color: #ff6b6b;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }
        
        .alert-success {
            background: rgba(40, 167, 69, 0.2);
            color: #51cf66;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }
        
        .register-title {
            background: linear-gradient(135deg, #fff 0%, #ff1744 50%, #ffc107 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">🕸 ELPHP-JASH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link active" href="register.php">Join</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div style="padding-top: 80px;"></div>
    
    <div class="register-container">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card register-card border-0">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <div class="spider-logo">🕷️</div>
                                <h2 class="register-title mb-3">Join the Web</h2>
                                <p class="text-light opacity-75">Become a friendly neighborhood hero</p>
                            </div>

                            <?php if ($error): ?>
                                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                            <?php endif; ?>
                            <?php if ($success): ?>
                                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                            <?php endif; ?>
                        
                        <form method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Hero Name</label>
                                <input type="text" name="fullName" class="form-control" id="fullName" placeholder="Peter Parker" value="<?php echo htmlspecialchars($_POST['fullName'] ?? ''); ?>" required>
                                <div class="invalid-feedback">Please enter your hero name.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" name="age" class="form-control" id="age" placeholder="25" min="1" max="120" value="<?php echo htmlspecialchars($_POST['age'] ?? ''); ?>" required>
                                <div class="invalid-feedback">Please enter a valid age (1-120).</div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="registerEmail" class="form-label">Email</label>
                                <input type="email" name="registerEmail" class="form-control" id="registerEmail" placeholder="hero@spidey.com" value="<?php echo htmlspecialchars($_POST['registerEmail'] ?? ''); ?>" required>
                                <div class="invalid-feedback">Please enter a valid email.</div>
                            </div>
                            
                            <button type="submit" class="btn btn-spidey w-100">Join the Hero Squad</button>
                            
                            <div class="text-center mt-4">
                                <span class="text-muted small">Already a hero? </span>
                                <a href="login.php" class="text-spidey text-decoration-none fw-bold">Swing In</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>