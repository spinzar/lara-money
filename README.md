# Money
[![Release](https://img.shields.io/packagist/v/spinzar/money?label=release)](https://github.com/spinzar/laravel-money/releases)
![Downloads](https://img.shields.io/packagist/dt/spinzar/laravel-money)
![Tests](https://img.shields.io/github/workflow/status/spinzar/laravel-money/Tests?label=tests)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/spinzar/laravel-money/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/spinzar/laravel-money/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/spinzar/laravel-money/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![License](https://img.shields.io/github/license/spinzar/laravel-money)](LICENSE.md)


> **Note:** This project abstracts [MoneyPHP](http://moneyphp.org/)

## Installation

Run the following command from you terminal:

```bash
composer require spinzar/lara-money
```

or add this to require section in your composer.json file:

```bash
"spinzar/laravel-money": "~1.0"
```

then run ```composer update```

## Usage

```php
use Spinzar\Money\Money;

echo Money::USD(500); // $5.00
```

## Configuration

The defaults are set in `config/money.php`. Copy this file to your own config directory to modify the values. You can publish the config using this command:

```bash
php artisan vendor:publish --provider="Spinzar\Money\MoneyServiceProvider"
```

This is the contents of the published file:

```php
return [
    /*
     |--------------------------------------------------------------------------
     | Laravel money
     |--------------------------------------------------------------------------
     */
    'locale' => config('app.locale', 'en_US'),
    'defaultCurrency' => config('app.currency', 'USD'),
    'currencies' => [
        'iso' => ['RUB', 'USD', 'EUR'],  // 'all' to choose all ISOCurrencies
        'bitcoin' => ['XBT'], // 'all' to choose all BitcoinCurrencies
        'custom' => [
            'MY1' => 2,
            'MY2' => 3
        ]
    ]
];
```

## Advanced Usage

> See [MoneyPHP](http://moneyphp.org/) for more information

```php
use Spinzar\Money\Money;

Money::USD(500)->add(Money::USD(500)); // $10.00
Money::USD(500)->add(Money::USD(500), Money::USD(500)); // $15.00
Money::USD(500)->subtract(Money::USD(400)); // $1.00
Money::USD(500)->subtract(Money::USD(200), Money::USD(100)); // $2.00
Money::USD(500)->multiply(2); // $10.00
Money::USD(1000)->divide(2); // $5.00
Money::USD(830)->mod(Money::USD(300)); // $2.30 -> Money::USD(230)
Money::USD(-500)->absolute(); // $5.00
Money::USD(500)->negative(); // $-5.00
Money::USD(30)->ratioOf(Money::USD(2)); // 15
Money::USD(500)->isSameCurrency(Money::USD(100)); // true
Money::USD(500)->equals(Money::USD(500)); // true
Money::USD(500)->greaterThan(Money::USD(100)); // true
Money::USD(500)->greaterThanOrEqual(Money::USD(500)); // true
Money::USD(500)->lessThan(Money::USD(1000)); // true
Money::USD(500)->lessThanOrEqual(Money::USD(500)); // true
Money::USD(500)->isZero(); // false
Money::USD(500)->isPositive(); // true
Money::USD(500)->isNegative(); // false
Money::USD(500)->getMoney(); // Instance of \Money\Money

// Aggregation
Money::min(Money::USD(100), Money::USD(200), Money::USD(300)); // Money::USD(100)
Money::max(Money::USD(100), Money::USD(200), Money::USD(300)); // Money::USD(300)
Money::avg(Money::USD(100), Money::USD(200), Money::USD(300)); // Money::USD(200)
Money::sum(Money::USD(100), Money::USD(200), Money::USD(300)); // Money::USD(600)

// Formatters
Money::USD(500)->format(); // $5.00
Money::USD(199)->format(null, null, \NumberFormatter::DECIMAL); // 1,99
Money::XBT(41000000)->formatByBitcoin(); // \xC9\x830.41
Money::USD(500)->formatByDecimal(); // 5.00
Money::USD(500)->formatByIntl(); // $5.00
Money::USD(199)->formatByIntl(null, null, \NumberFormatter::DECIMAL); // 1,99
Money::USD(500)->formatByIntlLocalizedDecimal(); // $5.00
Money::USD(199)->formatByIntlLocalizedDecimal(null, null, \NumberFormatter::DECIMAL) // 1.99

// Parsers
Money::parse('$1.00'); // Money::USD(100)
Money::parseByBitcoin("\xC9\x830.41"); // Money::XBT(41000000)
Money::parseByDecimal('1.00', 'USD'); // Money::USD(100)
Money::parseByIntl('$1.00'); // Money::USD(100)
Money::parseByIntlLocalizedDecimal('1.00', 'USD'); // Money::USD(100)
```

### Create your formatter

```php
class MyFormatter implements \Money\MoneyFormatter
{
    public function format(\Money\Money $money)
    {
        return 'My Formatter';
    }
}

Money::USD(500)->formatByFormatter(new MyFormatter()); // My Formatter
```

## Casts

At this stage the cast can be defined in the following ways:

```php
protected $casts = [
    // cast money using the currency defined in the package config
    'money' => MoneyCast::class,
    // cast money using the defined currency
    'money' => MoneyCast::class . ':AUD',
    // cast money using the currency defined in the model attribute 'currency'
    'money' => MoneyCast::class . ':currency',
];
```

In the example above, if the model attribute `currency` is `null`,
the currency defined in the package configuration is used instead.

Setting money can be done in several ways:

```php
$model->money = 10; // 10.00 USD or any other currency defined
$model->money = 10.23; // 10.23 USD or any other currency defined
$model->money = 'A$10'; // 10.00 AUD
$model->money = '1,000.23'; // 1000.23 USD or any other currency defined
$model->money = '10'; // 0.10 USD or any other currency defined
$model->money = Money::EUR(10); // 10 EUR
```

When we pass the model attribute holding the currency,
such attribute is updated as well when setting money:

```php
$model->currency; // null
$model->money = '€13';
$model->currency; // 'EUR'
$model->money->getAmount(); // '1300'
```

## Helpers

```php
currency('USD');
money(500); // To use default currency present in `config/money.php`
money(500, 'USD');

// Aggregation
money_min(money(100, 'USD'), money(200, 'USD'), money(300, 'USD')); // Money::USD(100)
money_max(money(100, 'USD'), money(200, 'USD'), money(300, 'USD')); // Money::USD(300)
money_avg(money(100, 'USD'), money(200, 'USD'), money(300, 'USD')); // Money::USD(200)
money_sum(money(100, 'USD'), money(200, 'USD'), money(300, 'USD')); // Money::USD(600)

// Parsers
money_parse('$5.00'); // Money::USD(500)
money_parse_by_bitcoin("\xC9\x830.41"); // Money::XBT(41000000)
money_parse_by_decimal('1.00', 'USD'); // Money::USD(100)
money_parse_by_intl('$1.00'); // Money::USD(100)
money_parse_by_intl_localized_decimal('1.00', 'USD'); // Money::USD(100)
```

## Blade Extensions

```php
@currency('USD')
@money(500) // To use default currency present in `config/money.php`
@money(500, 'USD')

// Aggregation
@money_min(@money(100, 'USD'), @money(200, 'USD'), @money(300, 'USD')) // Money::USD(100)
@money_max(@money(100, 'USD'), @money(200, 'USD'), @money(300, 'USD')) // Money::USD(300)
@money_avg(@money(100, 'USD'), @money(200, 'USD'), @money(300, 'USD')) // Money::USD(200)
@money_sum(@money(100, 'USD'), @money(200, 'USD'), @money(300, 'USD')) // Money::USD(600)

// Parsers
@money_parse('$5.00') // Money::USD(500)
@money_parse_by_bitcoin("\xC9\x830.41") // Money::XBT(41000000)
@money_parse_by_decimal('1.00', 'USD') // Money::USD(100)
@money_parse_by_intl('$1.00') // Money::USD(100)
@money_parse_by_intl_localized_decimal('1.00', 'USD') // Money::USD(100)
```
