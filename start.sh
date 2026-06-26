#!/bin/sh

if [ ! -f .env ]; then
    echo 'APP_KEY=base64:3dS7foK5bGHreglO6hisBAh/pE8EvNQDPVN9lMmhN4M=' > .env
fi

php artisan migrate --force --no-interaction 2>&1 || echo "Migration skipped/continued"

echo "DB_HOST: $DB_HOST"
echo "APP_ENV: $APP_ENV"
echo "APP_DEBUG: $APP_DEBUG"

php artisan serve --host=0.0.0.0 --port=8000
