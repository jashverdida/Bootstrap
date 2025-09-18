<?php
session_start();

// Check what type of profile view this is
$view = $_GET['view'] ?? null;

if ($view === 'details') {
    // Registration profile view
    if (!isset($_SESSION['registered_user'])) {
        header("Location: register.php");
        exit;
    }
    $registered_user = $_SESSION['registered_user'];
    $isRegistrationView = true;
} else {
    // Login profile view
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }
    
    $userId = $_GET['user'] ?? null;
    $user = $_SESSION['user'];
    
    if (!$userId || $userId != $user['id']) {
        header("Location: login.php");
        exit;
    }
    $isRegistrationView = false;
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php?message=logged_out");
    exit;
}

// Handle clear registration
if (isset($_GET['clear_registration'])) {
    unset($_SESSION['registered_user']);
    header("Location: register.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $isRegistrationView ? 'ELPHP-JASH - Registration Profile' : 'ELPHP-JASH - User Profile'; ?></title>
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
						<?php if ($isRegistrationView): ?>
							<li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
							<li class="nav-item"><a class="nav-link active" href="#">Profile</a></li>
							<li class="nav-item"><a class="nav-link" href="profile.php?view=details&clear_registration=1">Clear & Return</a></li>
						<?php else: ?>
							<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
							<li class="nav-item"><a class="nav-link active" href="#">Profile</a></li>
							<li class="nav-item"><a class="nav-link" href="profile.php?user=<?php echo $user['id']; ?>&logout=1">Logout</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="container mt-5">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<?php if ($isRegistrationView): ?>
								<h4>Registration Complete!</h4>
								<small class="text-muted">Displaying details from registration form</small>
							<?php else: ?>
								<h4>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h4>
							<?php endif; ?>
						</div>
						<div class="card-body">
							<?php if ($isRegistrationView): ?>
								<h5>Your Registration Details</h5>
								<table class="table">
									<tr>
										<td><strong>Full Name:</strong></td>
										<td><?php echo htmlspecialchars($registered_user['name']); ?></td>
									</tr>
									<tr>
										<td><strong>Age:</strong></td>
										<td><?php echo htmlspecialchars($registered_user['age']); ?> years old</td>
									</tr>
									<tr>
										<td><strong>Email:</strong></td>
										<td><?php echo htmlspecialchars($registered_user['email']); ?></td>
									</tr>
									<tr>
										<td><strong>Registered:</strong></td>
										<td><?php echo htmlspecialchars($registered_user['registration_time']); ?></td>
									</tr>
								</table>
							<?php else: ?>
								<h5>Your Profile Information</h5>
								<table class="table">
									<tr>
										<td><strong>Name:</strong></td>
										<td><?php echo htmlspecialchars($user['name']); ?></td>
									</tr>
									<tr>
										<td><strong>Email:</strong></td>
										<td><?php echo htmlspecialchars($user['email']); ?></td>
									</tr>
									<tr>
										<td><strong>User ID:</strong></td>
										<td><?php echo htmlspecialchars($user['id']); ?></td>
									</tr>
									<tr>
										<td><strong>Role:</strong></td>
										<td><?php echo htmlspecialchars($user['role']); ?></td>
									</tr>
								</table>
							<?php endif; ?>
							
							<hr>
							
							<h5>PHP Lab Demo</h5>
							<div class="row">
								<div class="col-md-4">
									<h6 class="text-primary">POST Method ✓</h6>
									<?php if ($isRegistrationView): ?>
										<p class="small">Registration form used POST to send name, age, email.</p>
									<?php else: ?>
										<p class="small">Login form used POST to send data securely.</p>
									<?php endif; ?>
								</div>
								<div class="col-md-4">
									<h6 class="text-success">GET Method ✓</h6>
									<?php if ($isRegistrationView): ?>
										<p class="small">URL parameter: ?view=details</p>
									<?php else: ?>
										<p class="small">URL parameter: ?user=<?php echo $userId; ?></p>
									<?php endif; ?>
								</div>
								<div class="col-md-4">
									<h6 class="text-warning">SESSION ✓</h6>
									<?php if ($isRegistrationView): ?>
										<p class="small">Registration data stored in $_SESSION['registered_user'].</p>
									<?php else: ?>
										<p class="small">User data stored in session across pages.</p>
									<?php endif; ?>
								</div>
							</div>
							
							<div class="mt-4">
								<?php if ($isRegistrationView): ?>
									<a href="register.php" class="btn btn-secondary">Back to Register</a>
									<a href="login.php" class="btn btn-primary">Go to Login</a>
									<a href="profile.php?view=details&clear_registration=1" class="btn btn-danger">Clear Registration</a>
								<?php else: ?>
									<a href="login.php" class="btn btn-secondary">Back to Login</a>
									<a href="profile.php?user=<?php echo $user['id']; ?>&logout=1" class="btn btn-danger">Logout</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>