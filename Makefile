.PHONY: setup
setup:
	docker-compose up -d
	docker-compose exec laravel.test sh -c "composer install"
	docker-compose exec laravel.test sh -c "php artisan key:generate"
	docker-compose exec laravel.test sh -c "php artisan db:seed"
