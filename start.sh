#!/bin/sh
set -e

# Create .env if missing (Render env vars take precedence)
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generate key only if no APP_KEY set via env
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Run migrations
php artisan migrate --force

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=8000
