# Siedler

A lightweight PHP/jQuery prototype inspired by *Settlers of Catan*. It provides a simple login flow backed by a MySQL database and renders a draggable, randomized hex game board in the browser.

## Features
- Login page that validates users against the configured MySQL database.
- Game view that renders a randomized hex tile layout and number tokens.
- Draggable board area for easier viewing on smaller screens.

## Tech stack
- PHP (routing, login, database access)
- MySQL (user table lookup)
- HTML/CSS/JavaScript with jQuery + jQuery UI

## Project structure
- `index.php` — entry point and basic router.
- `controller.php` — controller actions and template rendering.
- `entities/` — database connection + user model.
- `views/` — HTML templates for login, home, and game field.
- `styles/`, `js/`, `images/` — static assets.

## Local setup
1. **Ensure PHP is installed** (PHP 7+ recommended).
2. **Configure the database connection** in `entities/db.php`.
   - Update the host, database, user, and password to your local MySQL instance.
3. **Start the PHP built-in server** from the project root:

   ```bash
   php -S 0.0.0.0:8000
   ```

4. Open `http://localhost:8000` in your browser.

## Login flow
- The login form posts credentials, hashes the password with MD5, and forwards to `index.php?aktion=login`.
- The controller checks credentials with `User::findeNachUsernameUndPassword()`.

## Notes
- The current database connection in `entities/db.php` points to a remote MySQL instance. Replace it for local development.
- Passwords are hashed with MD5 in this prototype; consider stronger hashing (e.g., `password_hash`) if evolving this project.
