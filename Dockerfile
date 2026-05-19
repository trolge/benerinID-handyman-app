# =======================================================
# Stage 1: Build Frontend Assets
# =======================================================
FROM node:20-alpine AS asset-builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# =======================================================
# Stage 2: Final Production Environment
# =======================================================
FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    bash \
    mysql-client

# Install PHP extensions helper and required extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_mysql bcmath zip gd opcache intl pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application source code
COPY . .

# Copy built frontend assets from Stage 1
COPY --from=asset-builder /app/public/build ./public/build

# Install PHP Composer dependencies (production optimized)
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Setup directory permissions for Laravel storage and bootstrap cache
RUN mkdir -p /var/www/storage/framework/cache/data \
    && mkdir -p /var/www/storage/framework/sessions \
    && mkdir -p /var/www/storage/framework/views \
    && mkdir -p /var/www/storage/logs \
    && chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copy Nginx, Supervisor, and Entrypoint configurations
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisor.conf /etc/supervisor/conf.d/supervisord.conf

# Add Entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose port 80
EXPOSE 80

# Run entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
