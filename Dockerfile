FROM php:8.2-fpm

# Instale dependências do sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    libxml2-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo_mysql

# Instalar Redis via apt-get (em vez de pecl)
RUN apt-get install -y libzip-dev libxml2-dev libssl-dev \
    && pecl install redis-5.3.4 \
    && docker-php-ext-enable redis

# Instalar extensão de sockets
RUN docker-php-ext-install sockets

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copiar arquivos para o container
COPY . /var/www
WORKDIR /var/www

# Ajustar permissões
RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Rodar o composer install
RUN composer install --no-dev --optimize-autoloader

# Expor a porta do PHP
EXPOSE 9000

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]