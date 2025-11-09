# Use the richarvey/nginx-php-fpm image
FROM richarvey/nginx-php-fpm:3.1.6

# Set working directory
WORKDIR /var/www/html

# Copy package and composer files first for caching
COPY package*.json ./
COPY composer.* ./

# Install Node.js v20.19.0 and npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    node -v && npm -v

# Install PHP dependencies (optional if SKIP_COMPOSER=1)
# RUN composer install --no-dev --optimize-autoloader

# Install frontend dependencies and build Vite assets
RUN npm ci && npm run build

# Copy the rest of the Laravel app
COPY . .

# Image configuration
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel configuration
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Expose port 80 for Render
EXPOSE 80

# Start Nginx + PHP-FPM
CMD ["/start.sh"]
