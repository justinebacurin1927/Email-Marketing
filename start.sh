#!/bin/sh
set -e

# Create a minimal .env with only APP_KEY (Render env vars handle the rest)
if [ ! -f .env ]; then
    echo 'APP_KEY=base64:3dS7foK5bGHreglO6hisBAh/pE8EvNQDPVN9lMmhN4M=' > .env
fi

php artisan migrate --force
php artisan serve --host=0.0.0.0 --port=8000
