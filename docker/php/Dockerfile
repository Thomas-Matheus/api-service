FROM php:7.4-apache

WORKDIR /var/www/html

RUN apt-get update
RUN apt-get install -y \
        zip \
        unzip \
        vim \
        wget \
        curl \
        git
RUN rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

# Run docker-php-ext-install for available extensions
RUN docker-php-ext-install pdo pdo_mysql opcache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

ENV APACHE_DOCUMENT_ROOT /path/to/new/root

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Update the default apache site with the config we created.
ADD dev.service.com.conf /etc/apache2/sites-enabled/000-default.conf
