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

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Spider-Man themed products
$products = [
    1 => ['name' => 'Spider-Man Web Shooters', 'price' => 299.99, 'description' => 'High-tech web shooters like Peter Parker uses', 'image' => '🕸️'],
    2 => ['name' => 'Spider Suit (Classic)', 'price' => 599.99, 'description' => 'Classic red and blue Spider-Man suit', 'image' => '🕷️'],
    3 => ['name' => 'Spider Sense Tracker', 'price' => 199.99, 'description' => 'Early warning system for danger detection', 'image' => '⚡'],
    4 => ['name' => 'Web Fluid Cartridges', 'price' => 49.99, 'description' => 'Refill cartridges for web shooters (Pack of 6)', 'image' => '🧪'],
    5 => ['name' => 'Spider-Man Mask', 'price' => 89.99, 'description' => 'Authentic Spider-Man mask with web pattern', 'image' => '🎭'],
    6 => ['name' => 'Wall Crawling Gloves', 'price' => 149.99, 'description' => 'Special gloves for enhanced grip and climbing', 'image' => '🧤']
];

// Handle product details view
$productId = isset($_GET['id']) ? (int)$_GET['id'] : null;
$viewingProduct = $productId && isset($products[$productId]) ? $products[$productId] : null;

// Handle add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = (int)$_POST['product_id'];
    if (isset($products[$productId])) {
        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = 0;
        }
        $_SESSION['cart'][$productId]++;
        $cartMessage = "Added {$products[$productId]['name']} to your hero kit!";
    }
}

// Handle remove from cart
if (isset($_GET['remove_from_cart'])) {
    $removeId = (int)$_GET['remove_from_cart'];
    if (isset($_SESSION['cart'][$removeId])) {
        unset($_SESSION['cart'][$removeId]);
        $cartMessage = "Removed item from your hero kit!";
    }
}

// Calculate cart total
$cartTotal = 0;
$cartCount = 0;
foreach ($_SESSION['cart'] as $id => $quantity) {
    if (isset($products[$id])) {
        $cartTotal += $products[$id]['price'] * $quantity;
        $cartCount += $quantity;
    }
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
    <style>
        :root {
            --spidey-red: #ff1744;
            --spidey-blue: #1976d2;
            --spidey-gold: #ffc107;
            --spidey-dark: #0a0e1a;
            --spidey-darker: #1a1f2e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--spidey-dark) 0%, var(--spidey-darker) 100%);
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, rgba(10,14,26,0.95), rgba(26,31,46,0.95));
            z-index: -1;
        }

        @keyframes webPattern {
            0%, 100% { transform: rotate(0deg) scale(1); }
            33% { transform: rotate(5deg) scale(1.1); }
            66% { transform: rotate(-5deg) scale(0.9); }
        }

        .navbar {
            background: rgba(10, 14, 26, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 23, 68, 0.3);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            color: var(--spidey-red) !important;
            font-weight: bold;
            font-size: 1.4rem;
            text-shadow: 0 0 10px rgba(255, 23, 68, 0.5);
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.1);
            text-shadow: 0 0 20px rgba(255, 23, 68, 0.8);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--spidey-red) !important;
            text-shadow: 0 0 10px rgba(255, 23, 68, 0.5);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--spidey-red);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            transition: all 0.3s ease;
            color: #ffffff;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(255, 23, 68, 0.3);
            border-color: rgba(255, 23, 68, 0.5);
        }

        .spider-logo {
            font-size: 3rem;
            color: var(--spidey-red);
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
            display: inline-block;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .btn-spidey {
            background: linear-gradient(135deg, var(--spidey-red) 0%, #b71c1c 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 23, 68, 0.3);
        }

        .btn-spidey:hover {
            background: linear-gradient(135deg, #b71c1c 0%, var(--spidey-red) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 23, 68, 0.5);
            color: white;
        }

        .btn-outline-spidey {
            border: 2px solid var(--spidey-red);
            color: var(--spidey-red);
            background: transparent;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-spidey:hover {
            background: var(--spidey-red);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 23, 68, 0.4);
        }

        .text-spidey {
            color: var(--spidey-red) !important;
            font-weight: bold;
        }

        .table-spidey {
            background: rgba(255, 23, 68, 0.05);
            border-radius: 12px;
            overflow: hidden;
            color: #ffffff;
        }

        .table-spidey th {
            background: rgba(255, 23, 68, 0.2);
            color: #ffffff;
            font-weight: 600;
            border: none;
            padding: 15px;
        }

        .table-spidey td {
            border: none;
            padding: 15px;
            color: #ffffff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

            .profile-card .table-spidey.light-table th,
            .profile-card .table-spidey.light-table td {
                color: #111 !important;
                background: #ffffff !important;
            }

            .profile-card .table-spidey.light-table td,
            .profile-card .table-spidey.light-table td * {
                color: #111 !important;
            }

        .product-card {
            background: rgba(255, 23, 68, 0.1);
            border: 1px solid rgba(255, 23, 68, 0.3);
            border-radius: 15px;
            transition: all 0.3s ease;
            color: #ffffff;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(255, 23, 68, 0.4);
            border-color: rgba(255, 23, 68, 0.6);
        }

        .cart-badge {
            background: var(--spidey-red);
            border-radius: 50%;
            position: absolute;
            top: -5px;
            right: -5px;
            min-width: 20px;
            height: 20px;
            font-size: 12px;
            box-shadow: 0 0 10px rgba(255, 23, 68, 0.5);
        }

        .demo-section {
            background: rgba(255, 23, 68, 0.1);
            border-radius: 15px;
            border: 1px solid rgba(255, 23, 68, 0.3);
            padding: 20px;
            margin: 20px 0;
            backdrop-filter: blur(10px);
        }

        .card-header {
            background: rgba(255, 23, 68, 0.1) !important;
            border-bottom: 2px solid rgba(255, 23, 68, 0.3) !important;
            border-radius: 20px 20px 0 0 !important;
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.2);
            border: 1px solid rgba(76, 175, 80, 0.4);
            color: #ffffff;
            backdrop-filter: blur(10px);
        }

        .text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .web-pattern {
            display: none;
        }

        @keyframes webMove {
            from { background-position: 0 0, 0 0; }
            to { background-position: 100px 100px, -100px 100px; }
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .spider-logo {
                font-size: 2.5rem;
            }
            
            .navbar-brand {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="web-pattern"></div>
    
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
                    <?php if ($isRegistrationView): ?>
                        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link active" href="#">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="profile.php?view=details&clear_registration=1">Clear & Return</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link active" href="#">Profile</a></li>
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="#cart">
                                🛒 Hero Kit
                                <?php if ($cartCount > 0): ?>
                                    <span class="cart-badge badge text-white d-flex align-items-center justify-content-center"><?php echo $cartCount; ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="profile.php?user=<?php echo $user['id']; ?>&logout=1">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container" style="padding-top: 100px;">
        <?php if (isset($cartMessage)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                � <?php echo htmlspecialchars($cartMessage); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card profile-card border-0">
                    <div class="card-header text-center">
                        <div class="spider-logo">🕷️</div>
                        <?php if ($isRegistrationView): ?>
                            <h4 class="text-spidey fw-bold">Hero Registration Complete!</h4>
                            <small class="text-muted">Welcome to the Spider-Verse</small>
                        <?php else: ?>
                            <h4 class="text-spidey fw-bold">Welcome Hero, <?php echo htmlspecialchars($user['name']); ?>!</h4>
                            <small class="text-muted">Your web of information & hero gear</small>
                        <?php endif; ?>
                    </div>
                    <div class="card-body p-5">
                        <!-- User Details Section -->
                        <?php if ($isRegistrationView): ?>
                            <h5 class="text-spidey mb-4">🕸️ Your Hero Details</h5>
                            <table class="table table-spidey light-table">
                                <tr>
                                    <th style="width: 30%">Hero Name:</th>
                                    <td style="color:#111 !important; background:#fff;"><span style="color:#111"><?php echo htmlspecialchars($registered_user['name']); ?></span></td>
                                </tr>
                                <tr>
                                    <th>Age:</th>
                                    <td style="color:#111 !important; background:#fff;"><span style="color:#111"><?php echo htmlspecialchars($registered_user['age']); ?> years old</span></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td style="color:#111 !important; background:#fff;"><span style="color:#111"><?php echo htmlspecialchars($registered_user['email']); ?></span></td>
                                </tr>
                                <tr>
                                    <th>Joined the Web:</th>
                                    <td style="color:#111 !important; background:#fff;"><span style="color:#111"><?php echo htmlspecialchars($registered_user['registration_time']); ?></span></td>
                                </tr>
                            </table>
                        <?php endif; ?>

                        <?php if (!$isRegistrationView): ?>
                            <h5 class="text-spidey mb-4">🕸️ Your Hero Profile</h5>
                            <table class="table table-spidey light-table">
                                <tr>
                                    <th style="width: 30%">Hero Name:</th>
                                    <td style="color:#111 !important; background:#fff;"><span style="color:#111"><?php echo htmlspecialchars($user['name']); ?></span></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td style="color:#111 !important; background:#fff;"><span style="color:#111"><?php echo htmlspecialchars($user['email']); ?></span></td>
                                </tr>
                                <tr>
                                    <th>Hero ID:</th>
                                    <td style="color:#111 !important; background:#fff;"><span style="color:#111"><?php echo htmlspecialchars($user['id']); ?></span></td>
                                </tr>
                                <tr>
                                    <th>Role:</th>
                                    <td style="color:#111 !important; background:#fff;"><span style="color:#111"><?php echo htmlspecialchars($user['role']); ?></span></td>
                                </tr>
                            </table>
                        <?php endif; ?>

                        <?php if (!$isRegistrationView): ?>
                            <!-- Product Catalog Section -->
                            <hr class="my-5">
                            
                            <?php if ($viewingProduct): ?>
                                <!-- Product Details View -->
                                <h5 class="text-spidey mb-4">🛍️ Hero Gear Details</h5>
                                <div class="product-card p-4 mb-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-2 text-center">
                                            <div style="font-size: 4rem;"><?php echo $viewingProduct['image']; ?></div>
                                        </div>
                                        <div class="col-md-7">
                                            <h4 class="text-spidey"><?php echo htmlspecialchars($viewingProduct['name']); ?></h4>
                                            <p class="mb-2"><?php echo htmlspecialchars($viewingProduct['description']); ?></p>
                                            <h5 class="text-spidey">$<?php echo number_format($viewingProduct['price'], 2); ?></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <?php if (isset($user) && isset($user['role']) && $user['role'] !== 'guest'): ?>
                                                <form method="POST" class="d-inline">
                                                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                                    <button type="submit" name="add_to_cart" class="btn btn-spidey w-100 mb-2">Add to Kit</button>
                                                </form>
                                            <?php endif; ?>
                                            <a href="profile.php?user=<?php echo $user['id']; ?>" class="btn btn-outline-spidey w-100">Back to Catalog</a>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <!-- Product Catalog -->
                                <h5 class="text-spidey mb-4">🛍️ Spider-Man Hero Gear Catalog</h5>
                                <div class="row g-3 mb-4">
                                    <?php foreach ($products as $id => $product): ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="product-card p-3 h-100">
                                                <div class="text-center mb-3">
                                                    <div style="font-size: 3rem;"><?php echo $product['image']; ?></div>
                                                </div>
                                                <h6 class="text-spidey"><?php echo htmlspecialchars($product['name']); ?></h6>
                                                <p class="small mb-2"><?php echo htmlspecialchars($product['description']); ?></p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-spidey fw-bold">$<?php echo number_format($product['price'], 2); ?></span>
                                                    <a href="profile.php?user=<?php echo $user['id']; ?>&id=<?php echo $id; ?>" class="btn btn-outline-spidey btn-sm">View Details</a>
                                                    <?php if (isset($user) && isset($user['role']) && $user['role'] !== 'guest'): ?>
                                                        <form method="POST" class="d-inline ms-2">
                                                            <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                                            <button type="submit" name="add_to_cart" class="btn btn-spidey btn-sm">Add to Kit</button>
                                                        </form>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Shopping Cart Section -->
                            <div id="cart">
                                <h5 class="text-spidey mb-4">🛒 Your Hero Kit (Cart)</h5>
                                <?php if (empty($_SESSION['cart'])): ?>
                                    <div class="text-center py-4">
                                        <div style="font-size: 3rem; opacity: 0.5;">🕷️</div>
                                        <p class="text-muted">Your hero kit is empty. Add some gear above!</p>
                                    </div>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-spidey light-table">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>
                                                    <?php if (isset($products[$id])): ?>
                                                        <tr>
                                                            <td>
                                                                <span style="font-size: 1.5rem;" class="me-2"><?php echo $products[$id]['image']; ?></span>
                                                                <?php echo htmlspecialchars($products[$id]['name']); ?>
                                                            </td>
                                                            <td>$<?php echo number_format($products[$id]['price'], 2); ?></td>
                                                            <td><?php echo $quantity; ?></td>
                                                            <td class="text-spidey fw-bold">$<?php echo number_format($products[$id]['price'] * $quantity, 2); ?></td>
                                                            <td>
                                                                <a href="profile.php?user=<?php echo $user['id']; ?>&remove_from_cart=<?php echo $id; ?>" class="btn btn-outline-danger btn-sm">Remove</a>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3">Total Hero Kit Value:</th>
                                                    <th class="text-spidey">$<?php echo number_format($cartTotal, 2); ?></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- PHP Demo Section -->
                        <div class="demo-section">
                            <h5 class="text-spidey mb-3">⚡ Web Powers Demo</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="text-spidey">POST Method ✓</h6>
                                    <?php if ($isRegistrationView): ?>
                                        <p class="small">Registration form used POST to send hero data securely.</p>
                                    <?php else: ?>
                                        <p class="small">Add to cart uses POST. Cart has <?php echo $cartCount; ?> items.</p>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="text-spidey">GET Method ✓</h6>
                                    <?php if ($isRegistrationView): ?>
                                        <p class="small">URL parameter: ?view=details</p>
                                    <?php else: ?>
                                        <p class="small">Product details: <?php echo $viewingProduct ? "?id=$productId" : "Viewing catalog"; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="text-spidey">SESSION ✓</h6>
                                    <?php if ($isRegistrationView): ?>
                                        <p class="small">Hero data stored in web session.</p>
                                    <?php else: ?>
                                        <p class="small">Cart stored in session: $<?php echo number_format($cartTotal, 2); ?> total.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <?php if ($isRegistrationView): ?>
                                <a href="register.php" class="btn btn-outline-spidey me-2">Back to Register</a>
                                <a href="login.php" class="btn btn-spidey me-2">Swing to Login</a>
                                <a href="profile.php?view=details&clear_registration=1" class="btn btn-outline-danger">Clear Registration</a>
                            <?php else: ?>
                                <a href="login.php" class="btn btn-outline-spidey me-2">Back to Login</a>
                                <a href="profile.php?user=<?php echo $user['id']; ?>&logout=1" class="btn btn-spidey">Swing Out (Logout)</a>
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