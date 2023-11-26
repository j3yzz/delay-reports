sail := ./vendor/bin/sail

.PHONY: depend
depend:
	sudo chmod +x ./script.sh && ./script.sh

.PHONY: setup
setup:
	make depend
	$(sail) up -d

.PHONY: app-install
app-install:
	$(sail) shell -c "composer install"

.PHONY: app-setup
app-setup:
	$(sail) artisan key:generate

.PHONY: app-migrate
app-migrate:
	$(sail) php artisan migrate --seed

.PHONY: dev
dev:
	make setup
	make app-install
	make app-setup
	make app-migrate
