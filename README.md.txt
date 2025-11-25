# E-Commerce Order Management API (Laravel 12 + Sanctum)

A complete, production-ready RESTful API for e-commerce order management built with Laravel 12.

## Features
- User registration & login (Sanctum token authentication)
- Role-based access (admin / customer)
- Product & category management (admin only)
- Shopping cart system
- Order placement with stock deduction
- Mock payment processing
- Full test coverage (all tests passing)
- Clean JSON responses
- Laravel 12 best practices

## Requirements
- PHP 8.2+
- MySQL / MariaDB
- Composer
- Laravel Herd / Valet / Docker

## Installation (30 seconds)

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve