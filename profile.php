<?php
session_start();
// Require login
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// GET usage: capture user id from query string
$requestedId = isset($_GET['user']) ? (int)$_GET['user'] : 0;
$currentUser = $_SESSION['user'];

// Simple rule: only allow viewing your own profile id
if($requestedId !== $currentUser['id']) {
    // Redirect to your own profile enforcing correct GET param
    header('Location: profile.php?user=' . urlencode($currentUser['id']));
    exit;
}

$pageTitle = 'Profile';
require __DIR__ . '/includes/header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-7">
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-body p-4">
        <h3 class="mb-3">Your Profile</h3>
        <dl class="row mb-0">
          <dt class="col-sm-4">Name</dt>
          <dd class="col-sm-8 mb-2"><?php echo htmlspecialchars($currentUser['name']); ?></dd>

          <dt class="col-sm-4">Email</dt>
          <dd class="col-sm-8 mb-2"><?php echo htmlspecialchars($currentUser['email']); ?></dd>

          <dt class="col-sm-4">Role</dt>
          <dd class="col-sm-8 mb-2"><span class="badge bg-secondary"><?php echo htmlspecialchars($currentUser['role']); ?></span></dd>

          <dt class="col-sm-4">Session ID</dt>
          <dd class="col-sm-8 mb-2 small text-muted"><?php echo session_id(); ?></dd>
        </dl>
      </div>
    </div>
    <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
    <a href="login.php" class="btn btn-outline-secondary btn-sm">Back to Login</a>
  </div>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
