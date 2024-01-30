docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d

test:
	docker exec app-php-cli-1 vendor/bin/phpunit --colors=always

run dev:
	docker exec app-node-1 npm run dev

memory:
	sysctl -w vm.max_map_count=262144
