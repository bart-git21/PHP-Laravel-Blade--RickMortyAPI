# Laravel application for sending requests to the external API

# Project Overview:

## Technologies Used
Frontend: JavaScript, CSS, Bootsrap.
Backend: PHP, Laravel, Blade.
Database: MySQL.
Authentication: Laravel/Breeze.
Testing: Pest.
Data format: JSON.
Deployment: GitHub.

## Features
- User authentication using Laravel/Breeze.
- Send http requests to the external Rick and Morty API using Laravel http::Client
- First user see one button to get all characters, all locations and all episodes.
![screen](https://github.com/bart-git21/PHP-Laravel-Blade--RickMortyAPI/blob/main/public/images/intro.jpg)
- Click on it to start saving data.
![screen](https://github.com/bart-git21/PHP-Laravel-Blade--RickMortyAPI/blob/main/public/images/loading.jpg)
- Display the Rick and Morty characters list.
![screen](https://github.com/bart-git21/PHP-Laravel-Blade--RickMortyAPI/blob/main/public/images/result.jpg)
- User can favorites the character. It displays on 'Favorite characters' page.
![screen](https://github.com/bart-git21/PHP-Laravel-Blade--RickMortyAPI/blob/main/public/images/favorite.jpg)
- User can filter the characters.
![screen](https://github.com/bart-git21/PHP-Laravel-Blade--RickMortyAPI/blob/main/public/images/filter.jpg)
- User can download excel file with filtered data.
![screen](https://github.com/bart-git21/PHP-Laravel-Blade--RickMortyAPI/blob/main/public/images/excel.jpg)
- User can update external rickmorty API data.
![screen](https://github.com/bart-git21/PHP-Laravel-Blade--RickMortyAPI/blob/main/public/images/update.jpg)

# Usage

## Installation
### Prereqisites
- PHP and composer installed
### Clone the repository
```
$ git clone https://github.com/bart-git21/PHP-Laravel-Blade--RickMortyAPI.git
```
### Install dependencies
```
$ composer install
```
## Base URL
http://localhost:8000

## Dependencies:
- Bootstrap framework for rapidly building custom designs.
- Axios library to make HTTP requests from the browser.
- phpoffice/phpspreadsheet package for export Excel files in Laravel applications.
- Laravel/Breeze for authentication.
