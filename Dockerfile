# Dockerfile para producción
FROM php:7.0-fpm-alpine

# Instalar dependencias necesarias
RUN apk update \
    && apk add --no-cache --update linux-headers ${PHPIZE_DEPS} \
    && apk add libzip-dev \
       freetype-dev \
       libjpeg-turbo-dev \
       libpng-dev \
    && docker-php-ext-install \
       exif \
       mysqli \
       pdo \
       pdo_mysql \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install opcache

# Configuración de directorio de trabajo
WORKDIR /var/www

# Copiar archivos de la aplicación
COPY . /var/www

# Configurar permisos de las carpetas necesarias
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Configurar opcache para optimización en producción
RUN docker-php-ext-enable opcache

# Exponer el puerto
EXPOSE 9000

# Comando para correr PHP-FPM
CMD ["php-fpm"]