# Gunakan image PHP dengan Composer dan ekstensi yang dibutuhkan
FROM composer:2.6 as build

WORKDIR /app

# Copy semua file ke container
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy ke image PHP Apache
FROM php:8.2-apache

# Install dependency OS untuk SQLite
RUN apt-get update && apt-get install -y libsqlite3-dev

# Install ekstensi yang dibutuhkan Laravel
RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite

# Copy project ke folder web server
COPY --from=build /app /var/www/html

# Set permission storage, bootstrap/cache, dan database
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Expose port 80
EXPOSE 80

# Jalankan Laravel dengan PHP built-in server
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"] 