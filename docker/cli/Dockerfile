FROM php:7.0.28-cli

ARG UID=1000
ARG GID=1000
ARG USER=nobody
ARG GROUP=nobody

RUN groupadd -g "$GID" "$GROUP" \
    && useradd -m -g "$GID" -u "$UID" "$USER"

RUN apt-get update \
    && apt-get install -y unzip zlib1g-dev \
    && docker-php-ext-install zip \
    && apt-get clean

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer
