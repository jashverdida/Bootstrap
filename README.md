# ELPHP-JASH - Spider-Man Themed PHP Lab Activity

A modern Bootstrap practice website that demonstrates PHP concepts with a Spider-Man: Miles Morales inspired design.

## 🕸️ Lab Requirements Implementation

This project fulfills the PHP lab activity requirements by implementing **POST**, **GET**, and **SESSION** concepts:

### ✅ 1. POST (Form Submission)
- **Registration Form** (`register.php`): Users submit name, age, and email via POST
- **Shopping Cart** (`profile.php`): Add products to cart using POST requests
- Form validation and error handling implemented

### ✅ 3. SESSION (Storing Temporary User Data)
- **User Registration Data**: Stores registered user info in `$_SESSION['registered_user']`
- **Shopping Cart**: Cart items stored in `$_SESSION['cart']` array
- **User Authentication**: Session-based user management
- Persistent data across page navigation

### ✅ 4. GET (Passing Data via URL)
- **Profile Views**: `profile.php?view=details` for different profile sections
- **User Details**: `profile.php?user=1` for specific user information
- **Product Details**: `profile.php?id=2` for individual product viewing
- **Cart Management**: `profile.php?remove_from_cart=1` for item removal
- **Logout**: `profile.php?logout=1` for session termination

## 🚀 Features

### Core Functionality
- **User Registration System**: Complete form with validation
- **Profile Management**: View registered user details
- **Shopping Cart**: Add/remove products with session persistence
- **Product Catalog**: Browse products with detail views
- **Session Management**: Secure user data handling

### Design Features
- **Spider-Man Theme**: Miles Morales inspired color scheme
- **Responsive Design**: Bootstrap 5.3.2 framework
- **Glassmorphism Effects**: Modern UI with backdrop filters
- **Interactive Animations**: Hover effects and transitions
- **Cross-browser Compatibility**: Works on all modern browsers

## 📁 File Structure

```
├── index.php          # Homepage with hero section
├── about.php          # About page with web story
├── register.php       # User registration form (POST)
├── login.php          # Login interface
├── profile.php        # User profile & shopping cart (GET/SESSION)
└── README.md          # This file
```

Note: `dashboard.php` was removed from the project because it had no integration with the site's user, cart, or session flows. If you need a placeholder or redirect, we can add a small stub page that redirects to `index.php`.

## 🛠️ Technical Implementation

### POST Implementation
```php
// Registration form handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['fullName'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $email = trim($_POST['registerEmail'] ?? '');
    // Store in session
    $_SESSION['registered_user'] = $userData;
}
```

### GET Implementation
```php
// Profile view handling
$view = $_GET['view'] ?? null;
$userId = $_GET['user'] ?? null;
$productId = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Cart management
if (isset($_GET['remove_from_cart'])) {
    $removeId = (int)$_GET['remove_from_cart'];
    unset($_SESSION['cart'][$removeId]);
}
```

### SESSION Implementation
```php
// User session management
if (!isset($_SESSION['registered_user'])) {
    header('Location: register.php');
    exit;
}

// Shopping cart session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
```

## 🎯 Lab Activity Concepts Applied

| Concept | Implementation | File Location |
|---------|---------------|---------------|
| **POST** | Registration form submission | `register.php` |
| **POST** | Add to cart functionality | `profile.php` |
| **GET** | Profile view parameters | `profile.php?view=details` |
| **GET** | Product detail views | `profile.php?id=2` |
| **GET** | Cart item removal | `profile.php?remove_from_cart=1` |
| **SESSION** | User registration data | `$_SESSION['registered_user']` |
| **SESSION** | Shopping cart storage | `$_SESSION['cart']` |

## 🌐 How to Run

1. **Setup XAMPP**: Ensure Apache and PHP are running
2. **Copy Files**: Place all files in `C:\xampp\htdocs\bootstrap\`
3. **Access Website**: Visit `http://localhost/bootstrap/index.php`
4. **Test Features**:
   - Register a new user
   - View profile with different GET parameters
   - Add items to cart and see session persistence

## 🎨 Design System

- **Colors**: Spider-Man red (`#ff1744`), dark themes, gold accents
- **Framework**: Bootstrap 5.3.2
- **Effects**: Glassmorphism, backdrop filters, animations
- **Typography**: Modern sans-serif with proper spacing
- **Responsive**: Mobile-first design approach

## 📝 Notes

This project demonstrates a practical application of PHP's core concepts in a real-world scenario, combining user registration, session management, and dynamic content delivery through a modern, visually appealing interface.

---

**🕸️ With Great Power Comes Great Responsibility - Spider-Man**