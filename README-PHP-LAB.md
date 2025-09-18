# PHP Lab Activity: POST, GET, SESSION (Bootstrap UI)

This mini project demonstrates the required PHP concepts using a simple Login + Profile flow.

## ✅ Concepts Demonstrated
| Concept  | Where Used | Description |
|----------|------------|-------------|
| POST     | `login.php` | The login form submits email & password via POST. |
| SESSION  | `login.php`, `profile.php`, `logout.php` | User data is stored in `$_SESSION['user']` after successful login. Session checked on profile & cleared on logout. |
| GET      | `profile.php?user=ID` | The profile page expects a `user` id in the query string. Redirects to the correct one if mismatched. |

## 🗂 File Overview
- `login.php` – Displays form, processes POST, sets session, redirects to profile with `?user=` GET parameter.
- `profile.php` – Uses GET (`user` param) and SESSION to show the logged-in user’s info.
- `logout.php` – Destroys the session and redirects back to login.
- `includes/header.php` & `includes/footer.php` – Shared layout with Bootstrap 5.

## 👤 Test Users
Use either of these credentials:
```
alice@example.com / password123
bob@example.com   / secret456
```

## ▶️ How to Run (Local)
Make sure you have PHP installed. In the project root run:
```
php -S localhost:8000
```
Open: http://localhost:8000/login.php

## 🔄 Flow
1. Visit `login.php` and submit credentials (POST).
2. On success you are redirected to `profile.php?user=1` (for Alice) or `?user=2` (for Bob) → GET.
3. Your user data stays available via `$_SESSION['user']` until logout.
4. Click Logout → session destroyed, redirected to login.

## 🔐 Session Notes
- Session auto-starts in `header.php` (only if not already active).
- For simplicity, credentials are hard-coded. In real apps, you'd query a database and hash passwords.

## 💡 Extending Ideas
- Add an edit profile form (POST) updating a SESSION copy.
- Add a guestbook page storing messages in `$_SESSION['messages']`.
- Add flash messages (store once in SESSION, show then unset).

## 📝 Submission Tips
When presenting, point out:
- The POST handling block at the top of `login.php`.
- The GET usage in the redirect and access of `$_GET['user']` in `profile.php`.
- The SESSION storage line: `$_SESSION['user'] = $u;` and validation in `profile.php`.

## ✅ Requirements Coverage
- POST ✓
- GET ✓
- SESSION ✓
- Bootstrap UI ✓

Enjoy and good luck presenting!
