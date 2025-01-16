# Use uma imagem oficial do PHP com suporte ao Laravel
FROM php:8.2-fpm

# Instale dependências do sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql

# Instalar extensões necessárias
RUN pecl install redis && docker-php-ext-enable redis

# Instale Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copie os arquivos para o container
COPY . /var/www
WORKDIR /var/www

# Ajustar permissões durante a construção do container
RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expor a porta padrão do PHP
EXPOSE 9000

CMD ["php-fpm"]
