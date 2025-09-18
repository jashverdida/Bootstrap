<?php
session_start();
// If already logged in, redirect to profile
if(isset($_SESSION['user'])){
    header('Location: profile.php?user=' . urlencode($_SESSION['user']['id']));
    exit;
}

// Hard-coded users (simulate database)
$users = [
    ['id' => 1, 'email' => 'alice@example.com', 'password' => 'password123', 'name' => 'Alice Johnson', 'role' => 'Admin'],
    ['id' => 2, 'email' => 'bob@example.com', 'password' => 'secret456', 'name' => 'Bob Smith', 'role' => 'Member']
];

$error = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    foreach($users as $u){
        if($u['email'] === $email && $u['password'] === $password){
            $_SESSION['user'] = $u; // SESSION usage
            header('Location: profile.php?user=' . urlencode($u['id'])); // GET usage
            exit;
        }
    }
    $error = 'Invalid email or password';
}

$pageTitle = 'Login';
require __DIR__ . '/includes/header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card shadow-sm border-0">
      <div class="card-body p-4">
        <h3 class="mb-3">Login</h3>
        <?php if($error): ?>
          <div class="alert alert-danger py-2 small mb-3"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST" novalidate>
          <div class="mb-3">
            <label class="form-label small text-uppercase fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" required placeholder="alice@example.com">
          </div>
          <div class="mb-3">
            <label class="form-label small text-uppercase fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button class="btn btn-primary w-100">Sign In</button>
        </form>
        <p class="mt-3 mb-0 small text-muted">Try: alice@example.com / password123 or bob@example.com / secret456</p>
      </div>
    </div>
  </div>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
