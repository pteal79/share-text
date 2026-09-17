# pteal79/share-text

A NativePHP Mobile v4 plugin that opens the native share sheet with plain text.

`nativephp/mobile-share` shares a URL or a file. This shares text, so it arrives in
WhatsApp, Messages or Mail as a message.

```php
use Pteal79\ShareText\Facades\ShareText;

ShareText::text($text, subject: 'Job List');
```

## Installation

```bash
composer require pteal79/share-text
php artisan native:plugin:register pteal79/share-text
php artisan native:plugin:list
```

Rebuild the app afterwards (`php artisan native:run`); native code compiles in at build time.

## Bridge function

| Name | Parameters | Returns |
|---|---|---|
| `ShareText.Text` | `text` (required), `subject` (optional) | `{ presented: true }`, or an error when `text` is blank |
