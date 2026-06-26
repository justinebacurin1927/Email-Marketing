#!/bin/sh

cat > .env << EOF
APP_KEY=${APP_KEY:-base64:3dS7foK5bGHreglO6hisBAh/pE8EvNQDPVN9lMmhN4M=}
APP_ENV=${APP_ENV:-production}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}

DB_CONNECTION=${DB_CONNECTION:-pgsql}
DB_HOST=${DB_HOST:-127.0.0.1}
DB_PORT=${DB_PORT:-5432}
DB_DATABASE=${DB_DATABASE:-postgres}
DB_USERNAME=${DB_USERNAME:-postgres}
DB_PASSWORD=${DB_PASSWORD}
DB_SSLMODE=${DB_SSLMODE:-require}

SESSION_DRIVER=${SESSION_DRIVER:-cookie}
CACHE_STORE=database
QUEUE_CONNECTION=database

MAIL_MAILER=${MAIL_MAILER:-log}
EOF

php artisan migrate --force --no-interaction 2>&1 || echo "Migration skipped/continued"
php artisan serve --host=0.0.0.0 --port=8000
