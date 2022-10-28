# PHP XML BOOK STORE

search directory and subdirectories for xml files and if found files locate db and search 


## Overview

This Docker Compose configuration lets you run easily PHP 8 with Nginx, PHP-FPM, PostgreSQL.

* web (Nginx)
* php (PHP 8.1 with PHP-FPM)
* db (PostgreSQL)

### Starting Docker Compose

Checkout the repository or download the sources.

Simply run `docker-compose up --build` and you are done.

Nginx will be available on `localhost:81` and PostgreSQL on `localhost:5432`.

## src  :

* src/index.php -> frontend -> localhost:81
* src/cron.php -> cron and collect database file  -> localhost:81/cron.php
* src/ajax.php -> search author,books from db without reload page whit fronent  -> localhost:81/ajax.php?author=bla bla

## config : 

* all configs included .docker directory
