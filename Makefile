SHELL := /bin/bash

tests:
	php bin/console doctrine:database:drop --force --env=test --if-exists || true
	php bin/console doctrine:database:create --env=test
	php bin/console doctrine:migrations:migrate -n --env=test
	php bin/console doctrine:fixtures:load -n --env=test
	php bin/phpunit --colors=always $(MAKECMDGOALS)

tests-coverage:
	php bin/console doctrine:database:drop --force --env=test --if-exists || true
	php bin/console doctrine:database:create --env=test
	php bin/console doctrine:migrations:migrate -n --env=test
	php bin/console doctrine:fixtures:load -n --env=test
	php bin/phpunit --colors=always --coverage-html tests_coverage
.PHONY: tests