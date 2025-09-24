<?php
session_start();

$error = '';
$success = '';

// Simple file-based user storage
$usersFile = 'users.json';

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

// Check for logout message
if (isset($_GET['message']) && $_GET['message'] === 'logged_out') {
    $success = 'Successfully logged out! Your session has been destroyed.';
}

// POST handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['loginEmail'] ?? '');
    $password = trim($_POST['loginPassword'] ?? '');
    
    // Validation
    if (empty($email)) {
        $error = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address';
    } elseif (empty($password)) {
        $error = 'Password is required';
    } elseif (strlen($password) < 3) {
        $error = 'Password must be at least 3 characters long';
    } else {
        // Load saved users
        $users = loadUsers();
        $loginSuccess = false;
        
        // Check if this email exists in saved users (from registration)
        if (isset($users[$email])) {
            // User exists - use their saved data
            $userData = $users[$email];
            $user = [
                'id' => crc32($email),
                'email' => $userData['email'],
                'name' => $userData['name'],
                'age' => $userData['age'],
                'role' => 'Registered Hero',
                'registration_time' => $userData['registration_time']
            ];
            $loginSuccess = true;
            $success = 'Welcome back, ' . $userData['name'] . '! Redirecting...';
        } else {
            // New user - create guest account
            $emailParts = explode('@', $email);
            $username = ucfirst($emailParts[0]);
            
            $user = [
                'id' => crc32($email),
                'email' => $email,
                'name' => $username,
                'role' => 'Guest Hero'
            ];
            $loginSuccess = true;
            $success = 'Login successful! Redirecting...';
        }
        
        if ($loginSuccess) {
            // Store in SESSION
            $_SESSION['user'] = $user;
            
            // Redirect with GET parameter
            header("Location: profile.php?user=" . $user['id']);
            exit;
        }
    }
}

// Check if there are any registered users to show hint
$users = loadUsers();
$hasRegisteredUsers = !empty($users);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELPHP-JASH - Login</title>
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
        
        .login-container {
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
        
        .login-container::before {
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
        
        .login-card {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 20px;
            border: 1px solid rgba(255, 23, 68, 0.3);
            backdrop-filter: blur(15px);
            box-shadow: 0 20px 40px rgba(255, 23, 68, 0.2);
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }
        
        .login-card:hover {
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
        
        .form-check-input:checked {
            background-color: #ff1744;
            border-color: #ff1744;
        }
        
        .registration-hint {
            background: rgba(255, 23, 68, 0.1);
            border: 1px solid rgba(255, 23, 68, 0.3);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
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
        
        .login-title {
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
                    <li class="nav-item"><a class="nav-link active" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Join</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div style="padding-top: 80px;"></div>
    
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-5 col-lg-4">
                    <div class="card login-card border-0">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <div class="spider-logo">🕷️</div>
                                <h2 class="login-title mb-3">Welcome Back</h2>
                                <p class="text-light opacity-75">Your friendly neighborhood login</p>
                            </div>
                        
                        <?php if ($hasRegisteredUsers): ?>
                            <div class="registration-hint">
                                <div class="d-flex align-items-center">
                                    <span class="text-spidey me-2">🕸️</span>
                                    <div>
                                        <small class="fw-bold text-spidey">Registered Heroes Available!</small><br>
                                        <small class="text-muted">Use any registered email:</small>
                                        <?php foreach ($users as $email => $userData): ?>
                                            <br><small class="text-spidey fw-bold"><?php echo htmlspecialchars($email); ?></small>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                        <?php endif; ?>
                        <?php if ($success): ?>
                            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                        <?php endif; ?>
                        
                        <form method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label">Email</label>
                                <input type="email" name="loginEmail" class="form-control" id="loginEmail" placeholder="peter@spidey.com" value="<?php echo htmlspecialchars($_POST['loginEmail'] ?? ''); ?>" required>
                                <div class="invalid-feedback">Please enter a valid email.</div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="loginPassword" class="form-label">Password</label>
                                <input type="password" name="loginPassword" class="form-control" id="loginPassword" placeholder="••••••••" required minlength="3">
                                <div class="invalid-feedback">Password must be at least 3 characters.</div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label small text-muted" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#" class="text-spidey text-decoration-none small">Forgot password?</a>
                            </div>
                            
                            <button type="submit" class="btn btn-spidey w-100">Swing In</button>
                            
                            <div class="text-center mt-4">
                                <span class="text-muted small">New hero? </span>
                                <a href="register.php" class="text-spidey text-decoration-none fw-bold">Join us</a>
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