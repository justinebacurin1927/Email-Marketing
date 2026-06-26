#!/bin/sh
set -e

# Create .env if missing (Render uses env vars set in dashboard)
if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate --force
fi

# Run migrations
php artisan migrate --force

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=8000
