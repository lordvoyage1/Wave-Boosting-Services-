FROM php:8.2-apache

ENV DEBIAN_FRONTEND=noninteractive

# Install system dependencies
RUN apt-get update && apt-get install -y \
    mariadb-server \
    supervisor \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libzip-dev \
    libonig-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    libxml2-dev \
    libicu-dev \
    curl \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        gd \
        mysqli \
        pdo \
        pdo_mysql \
        mbstring \
        zip \
        curl \
        xml \
        intl \
        opcache

# Enable Apache modules
RUN a2enmod rewrite headers expires deflate

# Add ServerName to suppress warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy Docker config files
COPY docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/wave.ini
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/my.cnf /etc/mysql/conf.d/wave.cnf

# Set working directory and copy application
WORKDIR /var/www/html
COPY . .

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \; \
    && chmod -R 777 /var/www/html/app/cache \
    && chmod -R 777 /var/www/html/app/logs \
    && mkdir -p /var/www/html/assets/uploads \
    && chmod -R 777 /var/www/html/assets/uploads

# Set up MariaDB directories
RUN mkdir -p /var/run/mysqld /var/log/mysql /var/log/supervisor \
    && chown -R mysql:mysql /var/run/mysqld /var/log/mysql

# Copy and set up entrypoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 10000

CMD ["/entrypoint.sh"]
