FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    zip \
    curl \
    && docker-php-ext-install intl pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Node.js (for Vite build)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Fix Apache MPM: force only mpm_prefork, FAIL BUILD if more than one MPM enabled
RUN a2dismod mpm_event mpm_worker 2>/dev/null; \
    a2enmod mpm_prefork; \
    MPM_COUNT=$(ls /etc/apache2/mods-enabled/ | grep -c '^mpm_.*\.load$'); \
    echo "MPM modules enabled: $MPM_COUNT"; \
    ls /etc/apache2/mods-enabled/ | grep mpm; \
    if [ "$MPM_COUNT" -ne 1 ]; then \
        echo "ERROR: Expected exactly 1 MPM module, found $MPM_COUNT"; \
        exit 1; \
    fi
# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set Apache DocumentRoot to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first (for Docker cache)
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy package files and build frontend assets
COPY package.json package-lock.json ./
RUN npm ci
COPY vite.config.js ./
COPY resources ./resources
RUN npm run build

# Copy the rest of the application
COPY . .

# Re-run composer scripts (package:discover, etc.)
RUN composer dump-autoload --optimize

# Copy custom php.ini
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Expose port
EXPOSE 8080

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Start via entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]