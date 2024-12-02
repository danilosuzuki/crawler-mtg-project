# Escolher uma imagem base para o PHP
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unzip \
    libxml2-dev \
    libzip-dev \
    libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql sockets zip

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Instalar o ChromeDriver
RUN apt-get update && apt-get install -y \
    chromium \
    && rm -rf /var/lib/apt/lists/*


# Copiar o código do projeto para o container
WORKDIR /var/www

# Copiar o código do Laravel para o diretório do container
COPY . .

# Instalar dependências do Laravel
RUN composer install --no-interaction --optimize-autoloader

# Permissões adequadas para os diretórios de cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expor a porta padrão do PHP-FPM
EXPOSE 9000

# Iniciar o PHP-FPM
CMD ["php-fpm"]
