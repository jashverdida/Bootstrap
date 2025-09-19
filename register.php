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
        
        .register-card {
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
            transition: all 0.3s ease;
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
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link active" href="register.php">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Simple Registration Section -->
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-5 col-lg-4">
                <div class="card register-card border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="spider-logo">🕷️</div>
                            <h2 class="fw-bold mb-3">Join the Web</h2>
                            <p class="text-muted">Become a friendly neighborhood hero</p>
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