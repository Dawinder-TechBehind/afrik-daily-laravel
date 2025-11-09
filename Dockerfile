# Use richarvey/nginx-php-fpm base image
FROM richarvey/nginx-php-fpm:3.1.6

# Set working directory
WORKDIR /var/www/html

# Install Node.js 20.19.0 and npm (Alpine-compatible)
RUN apk add --no-cache curl tar xz && \
    curl -fsSL https://nodejs.org/dist/v20.19.0/node-v20.19.0-linux-x64.tar.xz -o node.tar.xz && \
    tar -xJf node.tar.xz -C /usr/local --strip-components=1 && \
    rm node.tar.xz && \
    node -v && npm -v

# Copy package files first (for caching)
COPY package*.json ./

# Install dependencies and build Vite assets
RUN npm ci && npm run build

# Copy the rest of the Laravel app
COPY . .

# Laravel + Render environment config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

# Expose port for Render
EXPOSE 80

# Start Nginx + PHP-FPM (default from base image)
CMD ["/start.sh"]
