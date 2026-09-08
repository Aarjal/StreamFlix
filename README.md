# StreamFlix

A simple movie-style website built with **PHP**, **MySQL**, **HTML/CSS**, and **JavaScript**.

## Features

- Multi-page PHP website (Home, Movies, Plans, Login)
- Session-based login/logout flow
- CSRF-protected login form
- Remember username option on login page
- Active navigation + additional pages (Profile, Feedback, FAQs)
- Movie filtering by title/genre with sorting options
- Plan billing switch (monthly/yearly)
- Improved UI consistency for form controls, dropdowns, and navigation states
- More-menu dropdown appears on hover/focus (not always expanded)
- Demo user for quick testing
- Reusable shared components (`head.php`, `nav.php`, `session.php`)
- Basic frontend interactions via JavaScript

## Tech Stack

- PHP 8+
- MySQL / MariaDB
- HTML5 + CSS3
- Vanilla JavaScript

## Project Structure

```
index.php                 # Entry point (redirects to home page)
.env.example              # Safe template for local configuration
src/
	pages/                  # UI pages
		faq.php
		feedback.php
		home.php
		login.php
		movies.php
		plans.php
		profile.php
	php/                    # Backend logic and shared includes
		config.php          # Loads environment-specific configuration
		db.php
		head.php
		init_db.sql
		login_handler.php
		logout.php
		nav.php
		session.php
		setup.php
	scripts/                # Frontend JS
		app.js
	styles/                 # Shared and page styles
assets/images/            # Static image assets
```

## Quick Start (Local Setup)

### 1) Clone and open the project

```bash
git clone https://github.com/Aarjal/PROJECT-1.git
cd PROJECT-1
```

### 2) Start MySQL and configure database credentials

Start **MySQL** from the XAMPP Control Panel. Copy the safe configuration
template before changing any values:

```powershell
Copy-Item .env.example .env
```

The `.env` file is ignored by Git, so passwords and machine-specific values
stay local. Its standard XAMPP defaults are:

- Host: `127.0.0.1`
- Database: `streamflix`
- User: `root`
- Password: *(empty)*

If yours differs, edit the corresponding `STREAMFLIX_DB_*` values in `.env`.
System environment variables can also override `.env` values.

### 3) Create database and tables

Use **one** of these:

- Create a database named `streamflix` in phpMyAdmin, then import
  `src/php/init_db.sql`, or
- Create the `streamflix` database in phpMyAdmin, then visit
  `http://localhost:8000/src/php/setup.php` after starting the PHP server.

`setup.php` creates the tables and demo user. It only runs from localhost in
the `local` environment, and you only need it once.

### 4) Run the app

From the project folder, start PHP's built-in local server:

```powershell
& 'C:\xampp\php\php.exe' -S localhost:8000
```

Then open:

- `http://localhost:8000/` (recommended)

Alternatively, place this project inside XAMPP's `htdocs` folder and open it
through Apache. Do not use VS Code Live Server: it cannot execute PHP.

## Demo Login

- Username: `demo`
- Password: `demo123`

## Important Notes

- `index.php` redirects to `src/pages/home.php`.
- `login_handler.php` expects POST requests from the login form.
- If login fails with DB errors, re-check `.env` and ensure the `users` table exists.
- Do not set `APP_ENV=local` on a public deployment. The setup page is blocked
  unless the app is explicitly in its local environment.

## Future Improvements

- Save feedback and plan selections through backend handlers
- Add registration and password reset flows
