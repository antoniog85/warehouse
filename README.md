# Warehouse microservice

This microservice provides all the basic functionality to manage a warehouse.

The domain logic is located in the /src folder, whereas the framework specific functionality it's in the /app folder.

## Endpoints

Verb | Endpoint                | Parameters                      |
---- | ----------------------- | ------------------------------- |
GET  | /warehouses             |                                 |

## Development

To execute run the docker image please run `docker-compose up` from the root of the project.

To shut it down: `docker-compose stop`

### Run composer

Reference: https://hub.docker.com/r/composer/composer/

From the root of the project, please run `docker run --rm -v $(pwd):/app composer/composer install`

## Migration and seeding

From the root of the project, please run `php artisan migrate:refresh --seed`

## Testing

Reference: https://hub.docker.com/r/phpunit/phpunit/

From the root of the project, please run `docker run -v $(pwd):/app phpunit/phpunit ./tests`