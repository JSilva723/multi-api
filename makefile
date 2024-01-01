#!/bin/bash

UID = $(shell id -u)
DOCKER_API = multiservice-api
DOCKER_DB = multiservice-db

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

up: ## Start the containers
	U_ID=${UID} docker-compose up -d

down: ## Stop the containers
	U_ID=${UID} docker-compose down

build: ## Build the containers
	U_ID=${UID} docker-compose build

restart: ## Restart the containers
	$(MAKE) down && $(MAKE) up

ssh: ## bash into the app container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} bash

ssh-db: ## bash into the db container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_DB} bash

src-style:
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_API} vendor/bin/php-cs-fixer fix src --rules=@Symfony --dry-run

tests-style:
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_API} vendor/bin/php-cs-fixer fix tests --rules=@Symfony --dry-run

src-style-fix:
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_API} vendor/bin/php-cs-fixer fix src --rules=@Symfony

tests-style-fix:
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_API} vendor/bin/php-cs-fixer fix tests --rules=@Symfony

lint: ## Code check styles
	@make src-style
	@make tests-style

lint-fix: ## Code fix styles
	@make src-style-fix
	@make tests-style-fix