# Laravel application for sending requests to the external API

# Project Overview:

## Technologies Used
Frontend: JavaScript, CSS, Tailwind.
Backend: PHP, Laravel, Blade.
Database: MySQL.
Authentication: no.
Data format: JSON.
Deployment: GitHub.

## Base URL
http://localhost:8000

## Features
- Send http requests to the external Rick and Morty API using Laravel http::Client
- Display a list of characters from the Rick and Morty API.
- Display a list of episodes from the Rick and Morty API.
- Display a list of locations from the Rick and Morty API.

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

## Dependencies:
- TailwindCSS framework for rapidly building custom designs.
- Axios library to make HTTP requests from the browser.
- FakerPHP library that generates fake data for testing purposes.
- Mockery library for creating mock objects in unit tests in the PHP application.
- Nunomaduro for creating various PHP packages and tools. 
- PHPUnit - unit testing framework for PHP.
- Maatwebsite\Excel package for export Excel files in Laravel applications.

## Common Http status codes
|Http code|body                 |Description                                |
|---------|---------------------|-------------------------------------------|
|200      |OK                   |Successful request                         |
|201      |Created              |Resource created                           |
|204      |OK                   |Delete refresh token                       |
|400      |Bad Request          |Missing a reqired parameter or the server could not understand the request|
|401      |Unauthorized         |Required user authentication               |
|403      |Forbidden            |The server understood the request but refuzes to authorized it|
|404      |Not Found            |The requested resource could not be found  |
|405      |Method Not Allowed   |The method used in the request is not supported for the target resource, such as attempting to use a POST method when only GET requests are allowed.  |
|422      |empty request        |Parameter is missing.                      |
|500      |Internal Server Error|An unexpected condition was encoured. The server was unable to fulfil the request|
