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
            background: linear-gradient(135deg, #0d1421 0%, #1a252f 100%);
            min-height: 100vh;
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
        
        .login-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(227, 30, 36, 0.1);
        }
        
        .spider-logo {
            font-size: 4rem;
            color: #e31e24;
            margin-bottom: 1rem;
        }
        
        .btn-spidey {
            background: linear-gradient(135deg, #e31e24 0%, #b71c1c 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            padding: 15px;
            transition: all 0.3s ease;
        }
        
        .btn-spidey:hover {
            background: linear-gradient(135deg, #b71c1c 0%, #e31e24 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(227, 30, 36, 0.4);
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px;
        }
        
        .form-control:focus {
            border-color: #e31e24;
            box-shadow: 0 0 0 0.2rem rgba(227, 30, 36, 0.25);
        }
        
        .text-spidey {
            color: #e31e24;
        }
        
        .text-spidey:hover {
            color: #b71c1c;
        }
        
        .form-check-input:checked {
            background-color: #e31e24;
            border-color: #e31e24;
        }
        
        .registration-hint {
            background: rgba(227, 30, 36, 0.1);
            border: 1px solid rgba(227, 30, 36, 0.3);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">🕷️ ELPHP-JASH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link active" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-5 col-lg-4">
                <div class="card login-card border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="spider-logo">🕷️</div>
                            <h2 class="fw-bold mb-3">Welcome Back</h2>
                            <p class="text-muted">Your friendly neighborhood login</p>
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