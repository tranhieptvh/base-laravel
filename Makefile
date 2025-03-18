env=local
build:
	docker compose -f docker-compose.${env}.yml build
up:
	sudo service apache2 stop
	docker compose -f docker-compose.${env}.yml up -d
down:
	docker compose -f docker-compose.${env}.yml down

restart:
	docker compose -f docker-compose.${env}.yml restart

exec:
	docker exec -it app sh
