FROM php:8.2-fpm

# install depencies
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


WORKDIR /var/www

# hapus isi dulu biar aman
RUN rm -rf /var/www/*

# 🔥 CLONE DARI GITHUB
RUN git clone https://github.com/wazis23/yatindo-website.git .

# Install Laravel
RUN composer install --no-dev --optimize-autoloader

# Install frontend & build
RUN npm install && npm run build
# Permission
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

RUN cp .env.example .env
# Copy nginx config
COPY nginx/default.conf /etc/nginx/sites-available/default

RUN php artisan storage:link

# Expose port
EXPOSE 80

# Start service
CMD service nginx start && php-fpm

CMD ["php-fpm"]
