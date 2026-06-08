FROM php:8.4-fpm-alpine

# Install system dependencies & PHP extensions yang dibutuhkan Laravel
RUN apk add --no-cache \
    nginx \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    libzip-dev \
    unzip \
    git \
    curl \
    nodejs \
    npm

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip bcmath

# Install Composer resmi versi terbaru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy seluruh project kodingan
COPY . .

# Jalankan instalasi tanpa mengecek batasan platform lokal laptop
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# Build aset frontend Vite
RUN npm install && npm run build

# Atur izin folder storage Laravel
RUN chmod -R 775 storage bootstrap/cache

# Expose port yang digunakan Railway
EXPOSE 80

# Jalankan Laravel serve langsung di port yang disediakan server
CMD php artisan serve --host=0.0.0.0 --port=$PORT