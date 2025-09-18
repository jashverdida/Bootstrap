<?php
session_start();

// Check if user is logged in via SESSION
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Get GET parameter for user ID
$userId = $_GET['user'] ?? null;

// Verify the GET parameter matches the SESSION user
if (!$userId || $userId != $_SESSION['user']['id']) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php?message=logged_out");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Profile Dashboard</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-success">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.html">My Bootstrap Site</a>
				<div class="collapse navbar-collapse">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
						<li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
						<li class="nav-item"><a class="nav-link active" href="profile.php?user=<?php echo $user['id']; ?>">Profile</a></li>
						<li class="nav-item"><a class="nav-link" href="profile.php?user=<?php echo $user['id']; ?>&logout=1">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		<!-- Hero Section -->
		<div class="bg-success text-white py-5 mb-5">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-lg-8">
						<h1 class="display-4 fw-bold mb-3">Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
						<p class="lead mb-4">Your personalized dashboard showing SESSION and GET parameter data</p>
						<div class="alert alert-light text-dark py-2">
							<strong>GET Parameter:</strong> user=<?php echo htmlspecialchars($userId); ?> | 
							<strong>SESSION Active:</strong> User logged in successfully
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Profile Content -->
		<div class="container">
			<!-- User Info Cards -->
			<div class="row g-4 mb-5">
				<div class="col-md-6">
					<div class="card border-0 shadow-sm h-100">
						<div class="card-header bg-primary text-white">
							<h5 class="mb-0">📋 SESSION Data</h5>
						</div>
						<div class="card-body">
							<h6 class="card-title">User Information from $_SESSION</h6>
							<table class="table table-sm">
								<tr><td><strong>User ID:</strong></td><td><?php echo htmlspecialchars($user['id']); ?></td></tr>
								<tr><td><strong>Name:</strong></td><td><?php echo htmlspecialchars($user['name']); ?></td></tr>
								<tr><td><strong>Email:</strong></td><td><?php echo htmlspecialchars($user['email']); ?></td></tr>
								<tr><td><strong>Role:</strong></td><td><span class="badge bg-<?php echo $user['role'] === 'Admin' ? 'warning' : 'info'; ?>"><?php echo htmlspecialchars($user['role']); ?></span></td></tr>
							</table>
							<small class="text-muted">This data is stored in $_SESSION['user'] and persists across pages</small>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card border-0 shadow-sm h-100">
						<div class="card-header bg-info text-white">
							<h5 class="mb-0">🔗 GET Parameters</h5>
						</div>
						<div class="card-body">
							<h6 class="card-title">URL Parameters Received</h6>
							<table class="table table-sm">
								<tr><td><strong>$_GET['user']:</strong></td><td><?php echo htmlspecialchars($userId); ?></td></tr>
								<tr><td><strong>Current URL:</strong></td><td class="small"><?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?></td></tr>
								<tr><td><strong>HTTP Method:</strong></td><td><?php echo htmlspecialchars($_SERVER['REQUEST_METHOD']); ?></td></tr>
							</table>
							<a href="profile.php?user=<?php echo $user['id']; ?>&demo=test&timestamp=<?php echo time(); ?>" class="btn btn-sm btn-outline-info">Add More GET Params</a>
							<br><small class="text-muted mt-2 d-block">GET parameters are passed in the URL and accessible via $_GET</small>
						</div>
					</div>
				</div>
			</div>

			<!-- Demo Section showing POST vs GET vs SESSION -->
			<div class="row g-4 mb-5">
				<div class="col-lg-12">
					<div class="card border-0 shadow-sm">
						<div class="card-header bg-secondary text-white">
							<h5 class="mb-0">📚 PHP Lab Demonstration</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-4">
									<h6 class="text-primary">POST Method ✅</h6>
									<p class="small">Used in <code>login.php</code> for form submission. Data sent securely in request body, not visible in URL.</p>
									<ul class="list-unstyled small">
										<li>• Login form uses POST</li>
										<li>• $_POST['loginEmail']</li>
										<li>• $_POST['loginPassword']</li>
									</ul>
								</div>
								<div class="col-md-4">
									<h6 class="text-success">GET Method ✅</h6>
									<p class="small">Used for this page URL. Data passed in URL parameters, visible and bookmarkable.</p>
									<ul class="list-unstyled small">
										<li>• ?user=<?php echo $userId; ?></li>
										<li>• $_GET['user']</li>
										<li>• URL navigation</li>
									</ul>
								</div>
								<div class="col-md-4">
									<h6 class="text-warning">SESSION ✅</h6>
									<p class="small">Server-side storage persisting user data across pages. Secure and private.</p>
									<ul class="list-unstyled small">
										<li>• $_SESSION['user']</li>
										<li>• Persists until logout</li>
										<li>• Server-side storage</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- All GET Parameters Display -->
			<?php if (!empty($_GET)): ?>
			<div class="row g-4 mb-5">
				<div class="col-lg-12">
					<div class="card border-0 shadow-sm">
						<div class="card-header bg-warning text-dark">
							<h5 class="mb-0">🔍 All GET Parameters</h5>
						</div>
						<div class="card-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Parameter</th>
										<th>Value</th>
										<th>Type</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($_GET as $key => $value): ?>
									<tr>
										<td><code><?php echo htmlspecialchars($key); ?></code></td>
										<td><?php echo htmlspecialchars($value); ?></td>
										<td><span class="badge bg-info">GET</span></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<!-- Action Buttons -->
			<div class="row justify-content-center mb-5">
				<div class="col-lg-8 text-center">
					<div class="card border-0 shadow-sm">
						<div class="card-body p-4">
							<h5 class="card-title mb-4">Quick Actions</h5>
							<a href="profile.php?user=<?php echo $user['id']; ?>&action=view&tab=settings" class="btn btn-primary me-2 mb-2">View Settings (GET)</a>
							<a href="profile.php?user=<?php echo $user['id']; ?>&action=edit&mode=advanced" class="btn btn-secondary me-2 mb-2">Edit Profile (GET)</a>
							<a href="login.php" class="btn btn-outline-primary me-2 mb-2">Back to Login</a>
							<a href="profile.php?user=<?php echo $user['id']; ?>&logout=1" class="btn btn-danger mb-2">Logout (Destroy SESSION)</a>
						</div>
					</div>
				</div>
			</div>

			<!-- PHP Code Examples -->
			<div class="row g-4 mb-5">
				<div class="col-lg-6">
					<div class="card border-0 shadow-sm h-100">
						<div class="card-header bg-dark text-white">
							<h6 class="mb-0">💻 Login.php Code (POST + SESSION)</h6>
						</div>
						<div class="card-body">
							<pre class="small"><code>// POST handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];
    
    // Authenticate user
    foreach ($users as $user) {
        if ($user['email'] === $email && 
            $user['password'] === $password) {
            // Store in SESSION
            $_SESSION['user'] = $user;
            // Redirect with GET
            header("Location: profile.php?user=" . $user['id']);
        }
    }
}</code></pre>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card border-0 shadow-sm h-100">
						<div class="card-header bg-dark text-white">
							<h6 class="mb-0">💻 Profile.php Code (GET + SESSION)</h6>
						</div>
						<div class="card-body">
							<pre class="small"><code>// Check SESSION
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Get GET parameter
$userId = $_GET['user'] ?? null;

// Verify GET matches SESSION
if ($userId != $_SESSION['user']['id']) {
    header("Location: login.php");
    exit;
}</code></pre>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Footer -->
		<footer class="bg-dark text-white py-4">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6">
						<p class="mb-0">&copy; 2025 PHP Lab Demo - POST, GET, SESSION</p>
					</div>
					<div class="col-md-6 text-md-end">
						<small>Session ID: <?php echo htmlspecialchars(session_id()); ?></small>
					</div>
				</div>
			</div>
		</footer>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>