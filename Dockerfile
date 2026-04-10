FROM php:8.2-fpm

# Install dependency
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev

# Install PHP extension
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# hapus isi dulu biar aman
RUN rm -rf /var/www/*

# 🔥 CLONE DARI GITHUB
RUN git clone https://github.com/wazis23/yatindo-website.git .

# Install Laravel
RUN composer install --no-dev --optimize-autoloader

# Permission
RUN chown -R www-data:www-data /var/www

