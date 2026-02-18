# Green API WhatsApp Laravel Wrapper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/yourname/green-api-laravel.svg?style=flat-square)](https://packagist.org/packages/yourname/green-api-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/yourname/green-api-laravel.svg?style=flat-square)](https://packagist.org/packages/yourname/green-api-laravel)
[![License](https://img.shields.io/packagist/l/yourname/green-api-laravel.svg?style=flat-square)](https://packagist.org/packages/yourname/green-api-laravel)

A clean, expressive, and lightweight Laravel wrapper for the [Green API](https://green-api.com/) (WhatsApp). This package allows you to integrate WhatsApp messaging into your Laravel applications in minutes using native Facades and Events.

## Features
- ✅ Easy configuration via `.env`
- ✅ Clean Facade for sending messages and files
- ✅ Built-in Webhook handling
- ✅ Event-driven architecture for incoming messages

---

## Installation

1. **Install the package via composer:**

```bash
composer require yourname/green-api-laravel

2. **Publish the configuration file:**

```bash
php artisan vendor:publish --tag="greenapi-config"


## Configuration

```bash
GREEN_API_ID_INSTANCE=your_id_instance_here
GREEN_API_TOKEN_INSTANCE=your_api_token_here
GREEN_API_HOST=[https://api.green-api.com](https://api.green-api.com)

## Usage

1. **Sending a Text Message:**
Use the GreenApi facade to send a message to a specific Chat ID (e.g., 12345678901@c.us for individual or 123456789@g.us for groups).

```bash
use GreenApi;

GreenApi::sendMessage('1234567890@c.us', 'Hello! This is a test message from Laravel.');

