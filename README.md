## Rss feed task
This project is an RSS feed reader built in Laravel for Mintos


# Installation steps
```sh
# install required composer packages
composer install 

# copy environment file
cp .env.example .env 

# generate application key
php artisan key:generate

# migrate database
php artisan migrate 

# serve with PHP (optional)
php artisan serve
```