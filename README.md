# i18n

[![Latest Stable Version](https://poser.pugx.org/cracksalad/i18n/v)](https://packagist.org/packages/cracksalad/i18n)
[![Total Downloads](https://poser.pugx.org/cracksalad/i18n/downloads)](https://packagist.org/packages/cracksalad/i18n)
[![License](https://poser.pugx.org/cracksalad/i18n/license)](https://packagist.org/packages/cracksalad/i18n)
[![PHP Version Require](https://poser.pugx.org/cracksalad/i18n/require/php)](https://packagist.org/packages/cracksalad/i18n)
[![Psalm Type Coverage](https://shepherd.dev/github/cracksalad/i18n-php/coverage.svg)](https://packagist.org/packages/cracksalad/i18n)

This library depends on [php-gettext/Gettext](https://github.com/php-gettext/Gettext) and is inspired by [delight-im/PHP-I18N](https://github.com/delight-im/PHP-I18N) as well as [gettext](https://www.php.net/manual/en/function.gettext).

Although this library is mainly compatible with delight-im/PHP-I18N, there are some differences. The main difference is that this library does not use `gettext()` and `setlocale()` but instead is stateless and thereby supports independent (concurrent) request handling as it is done with [PSR-15: HTTP Handlers](https://www.php-fig.org/psr/psr-15/) and [OpenSwoole](https://openswoole.com/). Another difference is that this library does not try to detect the users language based on the domain and path of the current URL or on some cookie.

## Installation

NOTE: This library requires PHP 8.0+

```bash
composer require cracksalad/i18n
```

## Usage

First you need to create translation files (e.g. using `xgettext` in bash) in a folder structure like this:

```
locale/
├─ en/
│  ├─ LC_MESSAGES/
│  │  ├─ messages.mo
│  │  ├─ messages.po
├─ de/
│  ├─ LC_MESSAGES/
│  │  ├─ messages.mo
│  │  ├─ messages.po
```

```php
use Cracksalad\I18n\I18n;

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
// -> 1 item saved
```

## License

This library is licensed under the MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
