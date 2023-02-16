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
9. then view app in https://0.0.0.0:8000/ (must use https) 

This app is just for demonstration and the functionality has no purpose.

Additionally, I would not design and implement some of these features in the way they have been implemented here in some of the tests; in commercial production software.