laravelDemo

This is a simple laravel, vue, docker, octane/swoole server demo to demonstrate my proficiency
with these languages and technologies.

Requirements:
1. docker installed

Please follow the below instructions to view the project locally:
1. git clone https://github.com/joshatkin1/laravelDemo.git
2. cd laravelDemo
3. composer install or update
4. cp .env.example .env  (all configs are already set for practical purposes, this wouldn't be the case commercially)
5. php artisan key:generate
6. ./vendor/bin/sail build --no-cache
7. ./vendor/bin/sail up -d
8. ./vendor/bin/sail artisan octane:reload

There is no real purpose of the functionality in this project, just a demonstration.