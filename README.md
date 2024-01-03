## API for multitenant
![design](/design.png "Basic design of architecture")

## Description
This repo has the objective of learn:
- PHP/Symfony
- Domain Driven Design
- Hexagonal architecture
- Testing
- SQL/Mysql
- Apache
- Multitenant architecture
- Docker workflow

Then in the cloud server we have install apache and config apache-proxy, create an own docker registry, where we go push docker images (multitenant-api and web clients).

## Start 
**Add URL in hosts list**
In this stage, for to work, we need add multitenant.vm and tenant1.multitenant.vm in hosts list.
```sh
127.0.1.1       multitenant.vm
127.0.1.1       tenant1.multitenant.vm
```
In next stage we will create nginx-proxy-reverse or apache-proxy, for managers the images.
**Create databases and tables**
In this stage, the databases management is maunualy.

Open a console and run
```sh
make-db ssh # Move into db container
mysql -u root -p
CREATE database gerent; 
CREATE database gerent_test; 
CREATE database tenant; 
CREATE database tenant_test;
```
In the other console and run
```sh
make ssh # Move into server container
sf doctrine:schema:update --em=tenant_em --dump-sql
sf doctrine:schema:update --em=gerent_em --dump-sql
```
Copy the output SQL and run in the db container

## Test
```sh
make ssh # Move into container
bin/phpunit # run all test
bin/phpunit --testsuite suite_name # run all test of the suite
bin/phpunit --filter test_name # run only test_name
```

## References
[Docs - Symfony](https://symfony.com/doc/current/index.html)

[Docs - Doctrine](https://www.doctrine-project.org/projects/doctrine-orm/en/2.17/index.html)

[Docs - Apache](https://httpd.apache.org/docs/)

[Repo - codenip-symfony-doctrine](https://github.com/codenip-tech/codenip-symfony-doctrine)

[Repo - php-ddd-example](https://github.com/CodelyTV/php-ddd-example)

[Repo - modular-monolith-example](https://github.com/codenip-tech/modular-monolith-example)