# Deployment Guide — SendFlow

## Infrastructure Requirements

- PHP ^8.2 with SQLite support
- Composer
- Web server (Nginx, Apache, or Laravel Herd/Valet)
- Queue worker (database driver)
- Cron for scheduler

## Docker Deployment

A Dockerfile and docker-compose.yml are provided:

**Dockerfile:**
- PHP 8.2 (CLI + FPM) with SQLite, GD, PCNTL, Posix, and Xdebug
- Composer installed
- Exposes port 8000
- Entry point: `php artisan serve --host=0.0.0.0 --port=8000`

**docker-compose.yml:**
- Single service (`app`) running on port 8000
- SQLite database persists via volume mount
- Vite HMR on port 5173 (optional)

### Docker Quick Start

```bash
docker compose up -d
```

## Manual Deployment

1. Clone the repository
2. Run `composer install --no-dev --optimize-autoloader`
3. Configure `.env` with production values
4. Run `php artisan key:generate`
5. Run `php artisan migrate --force`
6. Build assets: `npm install && npm run build`
7. Set up queue worker: `php artisan queue:work --daemon`
8. Set up cron for scheduler: `* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1`
9. Point web server to `public/` directory

## Environment Variables

| Variable | Production Value |
|---|---|
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `MAIL_MAILER` | `smtp` |
| `MAIL_HOST` | SMTP server host |
| `MAIL_USERNAME` | SMTP username |
| `MAIL_PASSWORD` | SMTP password or App Password |
| `MAIL_ENCRYPTION` | `tls` |

## CI/CD

(No CI/CD pipeline files detected in the repository. CI/CD can be set up via GitHub Actions, GitLab CI, or similar.)
