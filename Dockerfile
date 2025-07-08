# Menggunakan image PHP yang sudah terinstal dengan Apache
FROM php:8.2-fpm

# Install dependencies sistem dan ekstensi PHP yang dibutuhkan
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev git unzip libzip-dev

# Install ekstensi PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd zip pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Salin file project Laravel ke dalam container
COPY . .

# Install dependencies Laravel via Composer
RUN composer install --no-dev --optimize-autoloader

# Expose port 9000 untuk PHP-FPM
EXPOSE 9000

# Jalankan PHP-FPM

CMD php artisan serve --host=0.0.0.0 --port=8000
