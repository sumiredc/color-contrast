.PHONY: muhoho
muhoho:
	@echo "( ^ω^)ﾑﾎﾎ"

.PHONY: run
run: 
	docker compose run --rm php php index.php contrast:check

.PHONY: autoload
autoload:
	docker compose run --rm php composer dumpautoload

.PHONY: test
test:
	docker compose run --rm php ./vendor/bin/pest

.PHONY: phpstan
phpstan: 
	docker compose run --rm php ./vendor/bin/phpstan analyse
