# DineWithUs

Modern restaurant reservation platform connecting diners and chefs with real-time bookings, menu management, and analytics.

## Overview

DineWithUs streamlines how guests discover menus and reserve tables while giving chefs/admins the tools to manage bookings, menus, and performance insights in one place.

## Core Features

### Client
- Discover menus with dish details, pricing, and search/filter
- Create and manage accounts (profile updates, password recovery)
- Book tables with date/time selection, party size, and special requests
- Manage bookings (view history, modify, cancel, receive confirmations)

### Chef/Admin
- Secure auth and restaurant profile management
- Approve/reject reservations and manage table availability
- Menu creation and updates (categories, pricing, availability, offers)
- Analytics dashboard: pending counts, approved bookings (today/tomorrow), upcoming reservations, client registrations, custom reports

## Tech Stack

- Frontend: HTML5, CSS3, JavaScript, Tailwind CSS
- Backend: PHP, MySQL
- Other: Responsive layout, cross-browser compatibility, basic real-time updates, secure data handling, performance-focused

## Getting Started

1) Clone the repo into your web root (e.g., `c:/xampp/htdocs/dine`).
2) Create the database and tables: import `script.sql` into MySQL (database name: `dinewithus`).
3) Configure DB connection in `config/database.php` and `db.php` (host, db name, user, password).
4) Ensure `uploads/` is writable for profile/menu/dish images.
5) Run the app via your local web server (e.g., Apache on XAMPP) and open `http://localhost/dine`.

## Demo Data

- Use the insert statements in `script.sql` (or your own) to seed clients, menus, and reservations for testing.

## Project Structure

- `components/` shared layout pieces (header, footer)
- `config/` database configuration
- `img/` static assets
- `js/` client-side scripts
- `uploads/` user-uploaded images
- Root PHP files handle authentication, reservations, and menu management

## Contributing

Pull requests are welcome. Please open an issue first to discuss major changes or new features.