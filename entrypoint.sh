#!/bin/bash
set -e

echo "=== ENTRYPOINT START ==="

echo "Running migrations..."
php artisan migrate --force
echo "Migration step done."

PORT="${PORT:-8080}"
echo "PORT is set to: $PORT"

echo "Current ports.conf:"
cat /etc/apache2/ports.conf

echo "Rewriting ports.conf..."
echo "Listen ${PORT}" > /etc/apache2/ports.conf
echo "New ports.conf:"
cat /etc/apache2/ports.conf

echo "Current 000-default.conf VirtualHost line:"
grep VirtualHost /etc/apache2/sites-enabled/000-default.conf

echo "Rewriting VirtualHost port..."
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-enabled/000-default.conf

echo "New VirtualHost line:"
grep VirtualHost /etc/apache2/sites-enabled/000-default.conf

echo "=== STARTING APACHE ==="
exec apache2-foreground