# Galleme (backend)
![build status](https://img.shields.io/github/workflow/status/Galleme/backend/Backend?style=for-the-badge)
![code quality](https://img.shields.io/codacy/grade/0e771b3823e14cf785482c41769c1270?style=for-the-badge)
![code coverage](https://img.shields.io/codacy/coverage/0e771b3823e14cf785482c41769c1270?color=%23ff5500&style=for-the-badge)
![latest release](https://img.shields.io/github/v/release/Galleme/backend?color=%23ff5500&include_prereleases&style=for-the-badge)
![issue status](https://img.shields.io/github/issues-raw/Galleme/backend?color=%23ff5500&style=for-the-badge)

## Prerequisites
### Composer
See [Composer Getting Started](https://getcomposer.org/doc/00-intro.md)

## Installation
### Docker
In order to run the backend on Docker, you will have to run Docker on your device (linux, mac or windows with WSL enabled)

1. Run `docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs`
2. (optional) Create a `sail` alias using `alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'` else you'd have to always call `./vendor/bin/sail`

#### Staring & Stopping
1. Run `sail up` to start
2. Run `sail down` to stop

#### Sail Usage
See [Sail Guide](https://laravel.com/docs/8.x/sail) for more information about using Sail.

#### Important Notes
##### For Windows Users
1. Ensure WSL is enabled on Docker in case of any docker issues.
2. In case you get a getcwd() error or "no such file or directory found" error when executing `sail` type `cd $(pwd)` such that getcwd() symlinking will work properly again.


### Manually
#### Prerequisites
1. PHP with Composer
2. Any Laravel Supported Database (docker container uses MariaDB)
3. [Meilisearch](https://laravel.com/docs/8.x/sail#meilisearch)
4. [Redis](https://laravel.com/docs/8.x/redis)

#### Installation
1. Run `composer install`
2. rename `.env.example` to `.env`
3. Setup the `.env` file correctly (url, database credentials, redis credentials, etc...)
4. Run `php artisan serve`
5. Go to the url displayed on the terminal
