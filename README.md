# project-x-backend
Laravel Backend API for the project

# How to setup the project
1. `cp .env.example` .env (Change credentials if needed)
2. `composer install`
3. `php artisan key:generate`

# How to start the project
1. Start MAMP and the needed servers (MySQL and Apache)
2. `php artisan migrate:fresh`
3. `php artisan serve`
4. Check if its working (http://localhost:8000)

# Staging Backend
https://socialup-api.herokuapp.com/

Heroku Deployment - Credentials not necessary
