env = ./.env.example
ifneq ("$(wildcard ./.env)","")
    env = ./.env
endif

# compose-файл теперь в корне — -f не нужен
docker = docker compose -p ${APP_NAME} --env-file ${env}

include ${env}
export

.PHONY: install
install:
	${docker} up -d
	${docker} exec php-fpm composer install
	${docker} exec php-fpm php artisan key:generate
	${docker} exec php-fpm php artisan storage:link
	${docker} exec php-fpm php artisan migrate:fresh --seed

.PHONY: run
run:
	${docker} up -d

.PHONY: stop
stop:
	${docker} stop

.PHONY: down
down:
	${docker} down

.PHONY: php
php:
	${docker} exec -it php-fpm bash

.PHONY: mysql
mysql:
	${docker} exec -it mysql bash

.PHONY: nginx
nginx:
	${docker} exec -it nginx sh

.PHONY: phpmyadmin
phpmyadmin:
	${docker} exec -it phpmyadmin bash

.PHONY: meilisearch
meilisearch:
	${docker} exec -it meili sh
