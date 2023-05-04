# Use the official PHP image as the base image
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    gnupg

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest
# Set the working directory
WORKDIR /var/www

# Copy the existing application files
COPY . /var/www
COPY certs/server.crt /etc/ssl/certs/
COPY certs/server.key /etc/ssl/private/
# ... the rest of your Dockerfile ...
COPY entrypoint.sh /entrypoint.sh


# Set permissions and install Laravel dependencies
RUN chown -R www-data:www-data /var/www && chmod -R 775 /var/www/storage
RUN composer install
RUN chmod +x entrypoint.sh

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM server
CMD ["/entrypoint.sh"]
