# SMP Pangudi Luhur Kalibawang Website

Modern school website CMS built with Laravel 12, Vue.js, Inertia.js, and Filament.

## Live Website

https://smppangudiluhurboro.sch.id/

---

## Features

- Public school profile website
- Blog & news management
- School announcements
- Event & agenda management
- Teacher directory
- Student directory
- Gallery & albums
- Download center
- Testimonials
- Contact form
- Comment system with rate limiting
- Responsive frontend UI
- Admin dashboard using Filament

---

## Tech Stack

### Backend

- Laravel 12
- PHP 8+
- MySQL

### Frontend

- Vue.js
- Inertia.js
- Tailwind CSS
- Vite

### Admin Panel

- Filament PHP

### Testing

- PHPUnit

---

## Installation

Clone the repository:

```bash
git clone https://github.com/thomasandrianto/smp-pangudi-luhur-website.git
```

Enter project directory:

```bash
cd smp-pangudi-luhur-website
```

Install dependencies:

```bash
composer install
npm install
```

Copy environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure database connection in `.env`.

Run migrations:

```bash
php artisan migrate
```

Create storage symlink:

```bash
php artisan storage:link
```

Build frontend assets:

```bash
npm run build
```

Run development server:

```bash
php artisan serve
```

---

## Testing

Run feature and unit tests:

```bash
php artisan test
```

---

## Admin Panel

Admin panel URL:

```plaintext
/dashboard-pl
```

---

## Security Features

- Route throttling for public forms
- CSRF protection
- Session encryption
- Secure cookies
- Input validation
- Authentication middleware

---

## Project Structure

```plaintext
app/
├── Filament/
├── Http/
├── Models/

resources/
├── js/
├── views/

database/
├── migrations/
├── factories/
├── seeders/
```

---

## Deployment

This project is successfully deployed on shared hosting using cPanel environment.

---

## License

This project is open-source and available for educational purposes.
