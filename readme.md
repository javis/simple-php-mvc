# Simple PHP MVC example

Simple MVC Framework built with common modules. The PHP components I decided to use are:

* **illuminate/database** as a database layer, because I'm familiarized with it from Laravel
* **filp/whoops** for better error handling, speed up development by making debugging easier
* **matomo/ini** for easier .ini file parsing, solves some php bugs etc
* **mrjgreen/phroute** for routing URLs to controllers
* **twig/twig** for the views, also very popular.
* **tamtamchik/simple-flash** at some point I needed to display messages and I added this session flash component which works in a very similar way as the functionality that comes with Laravel

## Description of the filesystem
- **app**: all the code relative the the app goes inside this folder
    - **config**: all the config files can go inside this folder. right now there is only the database config file
    - **controllers**: MVC directory
    - **models**: MVC directory
    - **views**: MVC directory
    - **commands**: to store custom CLI scripts
    - *bootstrap.php*: this file is autoincluded and builds the APP environment required to run the web app and cli scripts
    - *routes.php*: file for defining the app routes
- **public**: exposes only the public content allowing to hide the app files
    - *index.php*: App single point entry

## Requirements
- PHP 7.1
- Apache with mod_rewrite enabled
- mysql

## Set up Instructions
- run `composer install` at the root directory
- create a DB for the project
- config the DB connection in the `app/config/database.ini` file
- run `php app/commands/generate_db.php` to generate the DB
- in Apache, add a virtual host pointing to the `public` folder

### Virtual Host Example
```
<VirtualHost *:80>
ServerAdmin admin@example.com
ServerName morsum.com
ServerAlias www.morsum.com
DocumentRoot /home/javis/morsum/public
ErrorLog ${APACHE_LOG_DIR}/error.log
CustomLog ${APACHE_LOG_DIR}/access.log combined
<Directory "/home/javis/morsum/public">
   Options Indexes FollowSymLinks MultiViews
   AllowOverride All
   Order allow,deny
   Allow from all
   Require all granted
</Directory>
</VirtualHost>
```
