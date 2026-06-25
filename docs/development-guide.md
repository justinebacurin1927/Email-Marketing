# Development Guide — SendFlow

## Prerequisites

- PHP ^8.2
- Composer
- Node.js & npm
- SQLite (included with PHP)

## Setup

```bash
# Copy environment file and configure
cp .env.example .env

# Install PHP dependencies
composer install

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed sample data (optional)
php artisan db:seed --class=SampleDataSeeder

# Install frontend dependencies
npm install

# Build frontend assets
npm run build
```

## Local Development

```bash
# Start all services with one command
composer dev
```

This runs concurrently:
- `php artisan serve` — Laravel dev server (port 8000)
- `php artisan queue:listen --tries=1` — Queue worker
- `php artisan pail --timeout=0` — Log tailing
- `npm run dev` — Vite HMR (port 5173)

## Scheduler (Required for Automations + Scheduled Campaigns)

Run in a separate terminal:
```bash
php artisan schedule:work
```

Or add to crontab:
```
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

## Testing

```bash
# Run all tests
composer test

# Or directly
php artisan test
```

## Artisan Commands

| Command | Schedule | Purpose |
|---|---|---|
| `campaigns:send-scheduled` | Every minute | Sends scheduled campaigns whose send_date has passed |
| `automations:process` | Every minute | Processes active automation triggers and pending steps |

## Environment Configuration

Key `.env` variables:

| Variable | Purpose |
|---|---|
| `DB_CONNECTION=sqlite` | Database connection |
| `MAIL_MAILER=smtp` | Mail driver |
| `MAIL_HOST=smtp.gmail.com` | SMTP host |
| `MAIL_PORT=587` | SMTP port |
| `MAIL_USERNAME` | Gmail address |
| `MAIL_PASSWORD` | Gmail App Password (16 chars) |
| `MAIL_ENCRYPTION=tls` | Encryption |
| `MAIL_FROM_ADDRESS` | Sender email |
