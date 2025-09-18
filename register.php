<?php
session_start();

$error = '';
$success = '';

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
        // Store registration data in SESSION
        $_SESSION['registered_user'] = [
            'name' => $name,
            'age' => (int)$age,
            'email' => $email,
            'registration_time' => date('Y-m-d H:i:s')
        ];
        
        $success = 'Registration successful! Redirecting to profile...';
        
        // Redirect to profile with GET parameter
        header("Location: profile.php?view=details");
        exit;
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
</head>
<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php">ELPHP-JASH</a>
				<div class="collapse navbar-collapse">
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
				<div class="col-md-6 col-lg-5">
					<div class="card border-0 shadow-sm">
						<div class="card-body p-4">
							<div class="text-center mb-4">
								<h2 class="fw-normal mb-1">Create Account</h2>
								<p class="text-muted small">Fill in your details to get started</p>
								<?php if ($error): ?>
									<div class="alert alert-danger py-2 small"><?php echo htmlspecialchars($error); ?></div>
								<?php endif; ?>
								<?php if ($success): ?>
									<div class="alert alert-success py-2 small"><?php echo htmlspecialchars($success); ?></div>
								<?php endif; ?>
							</div>
							
							<form method="POST" class="needs-validation" novalidate>
								<div class="mb-3">
									<label for="fullName" class="form-label">Full Name</label>
									<input type="text" name="fullName" class="form-control" id="fullName" placeholder="John Doe" value="<?php echo htmlspecialchars($_POST['fullName'] ?? ''); ?>" required>
									<div class="invalid-feedback">Please enter your full name.</div>
								</div>
								
								<div class="mb-3">
									<label for="age" class="form-label">Age</label>
									<input type="number" name="age" class="form-control" id="age" placeholder="25" min="1" max="120" value="<?php echo htmlspecialchars($_POST['age'] ?? ''); ?>" required>
									<div class="invalid-feedback">Please enter a valid age (1-120).</div>
								</div>
								
								<div class="mb-3">
									<label for="registerEmail" class="form-label">Email</label>
									<input type="email" name="registerEmail" class="form-control" id="registerEmail" placeholder="your@email.com" value="<?php echo htmlspecialchars($_POST['registerEmail'] ?? ''); ?>" required>
									<div class="invalid-feedback">Please enter a valid email.</div>
								</div>
								
								<button type="submit" class="btn btn-success w-100 mb-3">Register</button>
								
								<div class="text-center">
									<span class="text-muted small">Already have an account? </span>
									<a href="login.php" class="text-decoration-none">Sign in</a>
								</div>
								<div class="mt-3 text-center">
									<small class="text-info">Registration will store data in SESSION and redirect to profile</small>
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
