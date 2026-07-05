#!/bin/bash
set -e

echo "=== ENTRYPOINT START ==="

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "No APP_KEY set, generating..."
    php artisan key:generate --force
fi

# Create storage link if not exists
php artisan storage:link --force 2>/dev/null || true

# Cache configuration for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Wait for database connection
echo "Waiting for database connection..."
php -r '
$max_attempts = 20;
$attempts = 0;
while ($attempts < $max_attempts) {
    $host = getenv("DB_HOST") ?: getenv("MYSQLHOST") ?: "127.0.0.1";
    $port = getenv("DB_PORT") ?: getenv("MYSQLPORT") ?: "3306";
    $database = getenv("DB_DATABASE") ?: getenv("MYSQLDATABASE") ?: "laravel";
    $username = getenv("DB_USERNAME") ?: getenv("MYSQLUSER") ?: "root";
    $password = getenv("DB_PASSWORD") ?: getenv("MYSQLPASSWORD") ?: "";
    try {
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
        echo "Database is ready!\n";
        exit(0);
    } catch (PDOException $e) {
        echo "Database not ready yet... " . $e->getMessage() . " (Attempt " . ($attempts + 1) . "/" . $max_attempts . ")\n";
        sleep(3);
        $attempts++;
    }
}
echo "Error: Database connection timed out after $max_attempts attempts.\n";
exit(1);
'

echo "Running migrations..."
php artisan migrate --force
echo "Migration step done."

PORT="${PORT:-8080}"
echo "PORT is set to: $PORT"

echo "Rewriting ports.conf..."
echo "Listen ${PORT}" > /etc/apache2/ports.conf

echo "Rewriting VirtualHost port..."
sed -i "s/<VirtualHost \*:[0-9]*>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-enabled/000-default.conf

echo "=== STARTING APACHE ==="
exec apache2-foreground