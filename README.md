[![Latest Stable Version](https://poser.pugx.org/kg-bot/laravel-tikfinity-webhooks/v/stable)](https://packagist.org/packages/kg-bot/laravel-tikfinity-webhooks)
[![Total Downloads](https://poser.pugx.org/kg-bot/laravel-tikfinity-webhooks/downloads)](https://packagist.org/packages/kg-bot/laravel-tikfinity-webhooks)
[![Latest Unstable Version](https://poser.pugx.org/kg-bot/laravel-tikfinity-webhooks/v/unstable)](https://packagist.org/packages/kg-bot/laravel-tikfinity-webhooks)
[![License](https://poser.pugx.org/kg-bot/laravel-tikfinity-webhooks/license)](https://packagist.org/packages/kg-bot/laravel-tikfinity-webhooks)
[![Monthly Downloads](https://poser.pugx.org/kg-bot/laravel-tikfinity-webhooks/d/monthly)](https://packagist.org/packages/kg-bot/laravel-tikfinity-webhooks)
[![Daily Downloads](https://poser.pugx.org/kg-bot/laravel-tikfinity-webhooks/d/daily)](https://packagist.org/packages/kg-bot/laravel-tikfinity-webhooks)


<a href="https://www.buymeacoffee.com/KgBot"><img src="https://img.buymeacoffee.com/button-api/?text=Buy me a beer&emoji=🍺&slug=KgBot&button_colour=5F7FFF&font_colour=ffffff&font_family=Cookie&outline_colour=000000&coffee_colour=FFDD00"></a>

# TikFinity Webhooks

This package provides a set of webhooks for TikFinity, allowing you to easily integrate TikTok LIVE events into your application.

## Installation
You can install the package via Composer:

```bash
composer require kg-bot/laravel-tikfinity-webhooks
```
## Configuration
After installing the package, you need to publish the configuration file:

```bash
php artisan vendor:publish --tag="tikfinity-webhooks-config
```

This will create a `tikfinity-webhooks.php` file in your `config` directory. You can customize the configuration as needed.

## Migrations
You can publish the migrations using the following command:

```bash
php artisan vendor:publish --tag="tikfinity-webhooks-migrations"
```

## Routes
The package provides a set of routes for handling TikTok webhooks. You can find the routes in the `routes/web.php` file. You can customize the routes as needed.

## Usage
You can use the webhooks in your application to handle TikTok LIVE Gift and LIVE comment events.

To handle the events, you should configure the pipes in your `tikfinity-webhooks.php` configuration file. The package provides a set of example pipes that you can use to handle the events. You can also create your own pipes to handle the events as needed.

## Profile
You can use the `KgBot\TikfinityWebhooks\Models\TikTokProfile` model to save TikTok profile information.

## Example
You can use the package to handle TikTok LIVE Gift and LIVE comment events. Here is an example of how to handle a LIVE Gift event:

### Create a Pipe

You can create a pipe to handle the LIVE Gift event. Here is an example of a pipe that verifies if the event is a gift event:
```php
use Closure;
use KgBot\TikFinityWebhooks\Contracts\PipeContract;
use KgBot\TikFinityWebhooks\DTO\WebhookData;

final class VerifyGiftWebhook implements PipeContract
{
    /**
     * @throws EventNotAllowed
     */
    public function handle(WebhookData $webhookData, Closure $next): mixed
    {
        if(!$webhookData->isGiftEvent()) {
            throw new EventNotAllowed('Event is not a gift event');
        }

        return $next($webhookData);
    }
}
```

Each pipe should implement the `PipeContract` interface and define the `handle` method. The `handle` method receives the `WebhookData` object and a closure to pass the data to.

### Register the Pipe
You can register the pipe for each event in the `tikfinity-webhooks.php` configuration file by overwriting the `pipes` array. Here is an example of how to register the `VerifyGiftWebhook` pipe for the `gift` event:

```php
return [
    'pipes' => [
        'gift' => [
            VerifyGiftWebhook::class,
            // Other pipes can be added here
        ],
    ],
];
```

## Testing

```bash
composer test
```

## License
This package is open-sourced software licensed under the [MIT license](https://opensource.org/license/mit/).

## Contributing
If you want to contribute to this package, feel free to open a pull request or create an issue. Your contributions are welcome!

## Support
If you have any questions or need support, you can open an issue on the GitHub repository or contact me directly.

