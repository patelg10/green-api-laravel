# Green API WhatsApp Laravel Wrapper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/yourname/green-api-laravel.svg?style=flat-square)](https://packagist.org/packages/yourname/green-api-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/yourname/green-api-laravel.svg?style=flat-square)](https://packagist.org/packages/yourname/green-api-laravel)
[![License](https://img.shields.io/packagist/l/yourname/green-api-laravel.svg?style=flat-square)](https://packagist.org/packages/yourname/green-api-laravel)

A professional, expressive Laravel wrapper for the [Green API](https://green-api.com/). This package provides a seamless way to integrate WhatsApp messaging into your Laravel applications using clean OOP principles, Facades, and an event-driven webhook system.

---

## 🚀 Features

- ✅ **Quick Setup** – Automatic package discovery and configuration publishing.
- ✅ **Fluent API** – Simple `GreenApi` facade for sending text and media.
- ✅ **Webhook Ready** – Built-in endpoint and event dispatcher for incoming messages.
- ✅ **Developer Friendly** – Full IDE auto-completion support via DocBlocks.
- ✅ **Clean Architecture** – Follows Laravel best practices.

---

## 📦 Installation

**Install the package via Composer:**

```bash
composer require patelg10/green-api-laravel
```

**Publish the configuration file:**

```bash
php artisan vendor:publish --tag="greenapi-config"
```

## ⚙️ Configuration
**Add your Green API credentials to your .env file.
You can find these in your Green API console.**

```
GREEN_API_ID_INSTANCE=your_id_instance_here
GREEN_API_TOKEN_INSTANCE=your_api_token_here
GREEN_API_HOST=https://api.green-api.com
```

## 🛠 Usage
**Sending a Text Message**

The package uses a Facade to make sending messages simple:
```
use YourName\GreenApi\Facades\GreenApi;

// Send message to a phone number (e.g., 1234567890@c.us)
GreenApi::sendMessage(
    '1234567890@c.us',
    'Hello! This is a test message from Laravel.'
);
```
**Sending a File (via URL)**

Send documents, images, or videos by providing a public URL:

```
use YourName\GreenApi\Facades\GreenApi;

GreenApi::sendFileByUrl(
    '1234567890@c.us',
    'https://example.com/invoice.pdf',
    'invoice.pdf',
    'Please find your invoice attached.'
);
```

## 🔔 Handling Webhooks (Incoming Messages)
This package automatically registers a POST route at:
```
/greenapi/webhook
```
This endpoint listens for events from Green API and dispatches a Laravel Event.

**Step 1: Create a Listener**

Generate a listener in your application:
```
php artisan make:listener HandleWhatsAppWebhook
```

**Step 2: Register the Listener**

In your App\Providers\EventServiceProvider.php:
```
use YourName\GreenApi\Events\WebhookReceived;
use App\Listeners\HandleWhatsAppWebhook;

protected $listen = [
    WebhookReceived::class => [
        HandleWhatsAppWebhook::class,
    ],
];
```

**Step 3: Implement the Logic**

In HandleWhatsAppWebhook.php:
```
namespace App\Listeners;

use YourName\GreenApi\Events\WebhookReceived;

class HandleWhatsAppWebhook
{
    public function handle(WebhookReceived $event)
    {
        $payload = $event->payload;

        // Check if the webhook is an incoming message
        if ($payload['typeWebhook'] === 'incomingMessageReceived') {
            $sender = $payload['senderData']['sender'];
            $message = $payload['messageData']['textMessageData']['textMessage'] ?? '';

            // Your business logic here (Save to DB, reply, etc.)
            \Log::info("New WhatsApp from {$sender}: {$message}");
        }
    }
}
```

## 🧪 Testing
If you are contributing to the package, you can run tests using:
```
composer test
```

## 🛡 Security
If you discover any security-related issues, please email, Instead of using the issue tracker.
```
patelg10@gmail.com
```

## 📄 License
This package is open-sourced software licensed under the **MIT License.**
