FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Create system .env file
RUN cp .env.example .env

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate key (It will use the one from Render env in production, but this ensures build passes)
RUN php artisan key:generate

# Create SQLite database file
RUN touch database/database.sqlite
RUN chmod 777 database/database.sqlite
RUN chmod 777 database

# Run migrations
RUN php artisan migrate --force

# Config cache (Optional but good for production)
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Expose port 8000 (though Render sets PORT env var)
EXPOSE 8000

# Start command
CMD sh -c "php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"
