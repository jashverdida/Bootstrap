<?php
session_start();

$error = '';
$success = '';

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
        // Create user data from input (extract name from email)
        $emailParts = explode('@', $email);
        $username = ucfirst($emailParts[0]);
        
        $user = [
            'id' => crc32($email), // Generate unique ID from email
            'email' => $email,
            'name' => $username,
            'role' => 'User'
        ];
        
        // Store in SESSION
        $_SESSION['user'] = $user;
        $success = 'Login successful! Redirecting...';
        
        // Redirect with GET parameter
        header("Location: profile.php?user=" . $user['id']);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ELPHP-JASH - Login</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php">ELPHP-JASH</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
		
		<!-- Simple Login Section -->
		<div class="container">
			<div class="row justify-content-center align-items-center min-vh-100">
				<div class="col-md-5 col-lg-4">
					<div class="card border-0 shadow-sm">
						<div class="card-body p-4">
							<div class="text-center mb-4">
								<h2 class="fw-normal mb-1">Sign In</h2>
								<p class="text-muted small">Enter your credentials to continue</p>
								<?php if ($error): ?>
									<div class="alert alert-danger py-2 small"><?php echo htmlspecialchars($error); ?></div>
								<?php endif; ?>
								<?php if ($success): ?>
									<div class="alert alert-success py-2 small"><?php echo htmlspecialchars($success); ?></div>
								<?php endif; ?>
							</div>
							
							<form method="POST" class="needs-validation" novalidate>
								<div class="mb-3">
									<label for="loginEmail" class="form-label">Email</label>
									<input type="email" name="loginEmail" class="form-control" id="loginEmail" placeholder="your@email.com" value="<?php echo htmlspecialchars($_POST['loginEmail'] ?? ''); ?>" required>
									<div class="invalid-feedback">Please enter a valid email.</div>
								</div>
								
								<div class="mb-3">
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
									<a href="#" class="text-decoration-none small">Forgot password?</a>
								</div>
								
								<button type="submit" class="btn btn-primary w-100 mb-3">Sign In</button>
								
								<div class="text-center">
									<span class="text-muted small">Don't have an account? </span>
									<a href="register.php" class="text-decoration-none">Sign up</a>
								</div>
								<div class="mt-3 text-center">
									<small class="text-info">Enter any valid email and password (3+ characters) to login</small>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
		<script>
			// Basic Bootstrap validation only (PHP handles form processing)
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
