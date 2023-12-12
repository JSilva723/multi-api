## API for multiservice
![design](/design.png "Basic design of architecture")

## Start
```sh
make up
```
## Stop
```sh
make down
```
## Help
```sh
make help
```

## Test
```sh
make ssh # Move into container
bin/phpunit # run all test
bin/phpunit --testsuite suite_name # run all test of the suite
bin/phpunit --filter test_name # run only test_name
```