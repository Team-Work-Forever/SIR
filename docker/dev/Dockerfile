FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sudo

RUN apt-get install -y nodejs npm

RUN groupadd -g 999 appuser && useradd -r -u 999 -g appuser appuser

RUN mkdir -p /home/appuser && chown -R appuser:appuser /home/appuser

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /home/appuser/app

COPY --chown=appuser:appuser . .

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R +x /var/www/html

RUN echo "appuser ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/appuser

USER appuser

RUN ln -s /home/appuser/app/ /var/www/html

RUN composer global require laravel/installer
ENV PATH="${PATH}:/home/appuser/.composer/vendor/bin"

EXPOSE 80
CMD ["apache2-foreground"]