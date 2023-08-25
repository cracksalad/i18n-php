# i18n

This library depends on [php-gettext/Gettext](https://github.com/php-gettext/Gettext) and is inspired by [delight-im/PHP-I18N](https://github.com/delight-im/PHP-I18N) as well as [gettext](https://www.php.net/manual/en/function.gettext).

The main difference to delight-im/PHP-I18N is that this library does not use `gettext()` and `setlocale()` but instead is stateless and thereby supports independent (concurrent) request handling as it is done with [PSR-15: HTTP Handlers](https://www.php-fig.org/psr/psr-15/) and [OpenSwoole](https://openswoole.com/).

## Installation

NOTE: This library requires PHP 8.0+

```bash
composer require cracksalad/i18n
```

## Usage

```php
use Cracksalad\I18n;

$i18n = I18n::load('en');

$i18n->_('Hello world!');       
// -> Hello world!

// format (using sprintf() internally)
$i18n->_f('%d items saved', 42);      
// -> 42 items saved

// ICU MessageFormat
$i18n->_fe('I first published this library on {0, date, short}', 1692982322);
// -> I first published this library on 8/23/23

// singular vs. plural with format
$i18n->_pf('%d item saved', '%d items saved', 42);
// -> 42 items saved
$i18n->_pf('%d item saved', '%d items saved', 1);
// -> 42 item saved
```

## License

This library is licensed under the MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
