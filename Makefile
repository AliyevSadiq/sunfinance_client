init: docker-down docker-pull docker-build docker-up

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

app-init: app-install-composer

app-install-composer:
	docker-compose run --rm php-cli_client composer install

app-migrate:
	docker-compose run --rm php-fpm php artisan migrate

app-rabbitmq:
	docker-compose run --rm php-fpm php artisan rabbitmq:consume

app-test:
	docker-compose run --rm php-cli_client php artisan test

composer-update:
	yes | docker-compose run --rm php-cli_client composer update



key-generate:
	docker-compose run --rm php-cli_client php artisan  key:generate

doc-generate:
	docker-compose run --rm php-cli_client php artisan  l5-swagger:generate


optimize:
	docker-compose run --rm php-cli_client php artisan optimize && php artisan serve
