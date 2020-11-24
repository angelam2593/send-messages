## Requirements:
- PHP >= 7.0
- Laravel 8
- composer
- MAMP(MacOS)/WAMP/XAMPP/AMP(Ubuntu/Windows)

## Project setup
```
git clone https://github.com/angelam2593/send-messages.git
```
Open the terminal and go to the project's location.
### Manages dependencies
```
composer install
```
### Runs migrations
```
php artisan migrate
```
### Setup .env file
NEXMO_KEY and NEXMO_SECRET from Nexmo API
DB_DATABASE, DB_USERNAME and DB_PASSWORD create database messages_db and insert the name in DB_DATABASE, for mac DB_USERNAME and DB_PASSWORD are usually both root
### Serves Laravel on the development server
```
php artisan serve
```
Open the localhost on your web browser.
