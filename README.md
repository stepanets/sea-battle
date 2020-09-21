# Sea Battle Game

### Sea Battle game for code review project

### Run with docker


#### Build container

`docker build --build-arg VERSION=7.4 --tag sea-battle/cli:7.4 ./docker/`

#### Install dependencies

`docker run --rm -ti -v $PWD:/app sea-battle/cli:7.4 composer install`

#### Run the game

`docker run --rm -ti -v $PWD:/app -w /app sea-battle/cli:7.4 ./main.php`

#### Run tests

`docker run --rm -ti -v $PWD:/app -w /app sea-battle/cli:7.4 vendor/bin/phpunit`