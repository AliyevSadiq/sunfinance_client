FROM php:7.4-cli

RUN apt-get update && apt-get install -y libzip-dev libpq-dev zlib1g-dev zip git

# Enabling && Configuring php extensions
RUN docker-php-ext-install pdo  pgsql pdo_pgsql zip

# Installing composer.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --quiet

# Creating user for container.
RUN groupadd -g 1000 appuser_client && useradd -r -u 1000 -g appuser_client appuser_client

# Creating user && composer-cache directories.
RUN mkdir -p /home/appuser_client/.composer/cache/repo/https---asset-packagist.org \
    && mkdir /home/appuser_client/.composer/cache/files

# Giving proper permissions to user.
RUN chown -R appuser_client:appuser_client /home/appuser_client && chmod -R 775 /home/appuser_client

# Running container as user
USER appuser_client

ENV COMPOSER_NO_INTERACTION=1

WORKDIR /app
