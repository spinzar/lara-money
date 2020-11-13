<?php

if (!function_exists('currency')) {
    /**
     * currency.
     *
     * @param string $currency
     *
     * @return \Money\Currency
     */
    function currency($currency)
    {
        return new Money\Currency($currency);
    }
}

if (!function_exists('money')) {
    /**
     * money.
     *
     * @param int|string $amount
     * @param string     $currency
     *
     * @return \Spinzar\Money\Money
     */
    function money($amount, $currency = null)
    {
        return new Spinzar\Money\Money(
            $amount,
            new Money\Currency($currency ?: Spinzar\Money\Money::getDefaultCurrency())
        );
    }
}

if (!function_exists('money_min')) {
    /**
     * money min.
     *
     * @param \Spinzar\Money\Money $first
     * @param \Spinzar\Money\Money ...$collection
     *
     * @return \Spinzar\Money\Money
     */
    function money_min(Spinzar\Money\Money $first, Spinzar\Money\Money ...$collection)
    {
        return Spinzar\Money\Money::min($first, ...$collection);
    }
}

if (!function_exists('money_max')) {
    /**
     * money max.
     *
     * @param \Spinzar\Money\Money $first
     * @param \Spinzar\Money\Money ...$collection
     *
     * @return \Spinzar\Money\Money
     */
    function money_max(Spinzar\Money\Money $first, Spinzar\Money\Money ...$collection)
    {
        return Spinzar\Money\Money::max($first, ...$collection);
    }
}

if (!function_exists('money_avg')) {
    /**
     * money avg.
     *
     * @param \Spinzar\Money\Money $first
     * @param \Spinzar\Money\Money ...$collection
     *
     * @return \Spinzar\Money\Money
     */
    function money_avg(Spinzar\Money\Money $first, Spinzar\Money\Money ...$collection)
    {
        return Spinzar\Money\Money::avg($first, ...$collection);
    }
}

if (!function_exists('money_sum')) {
    /**
     * money sum.
     *
     * @param \Spinzar\Money\Money $first
     * @param \Spinzar\Money\Money ...$collection
     *
     * @return \Spinzar\Money\Money
     */
    function money_sum(Spinzar\Money\Money $first, Spinzar\Money\Money ...$collection)
    {
        return Spinzar\Money\Money::sum($first, ...$collection);
    }
}

if (!function_exists('money_parse')) {
    /**
     * money parse.
     *
     * @param mixed                       $value
     * @param \Money\Currency|string|null $currency
     *
     * @return \Spinzar\Money\Money|null
     */
    function money_parse($value, $currency = null)
    {
        return Spinzar\Money\Money::parse($value, $currency);
    }
}

if (!function_exists('money_parse_by_bitcoin')) {
    /**
     * money parse by bitcoin.
     *
     * @param string      $money
     * @param string|null $forceCurrency
     * @param int         $fractionDigits
     *
     * @return \Spinzar\Money\Money
     */
    function money_parse_by_bitcoin($money, $forceCurrency = null, $fractionDigits = 2)
    {
        return Spinzar\Money\Money::parseByBitcoin($money, $forceCurrency, $fractionDigits);
    }
}

if (!function_exists('money_parse_by_decimal')) {
    /**
     * money parse by decimal.
     *
     * @param string            $money
     * @param string|null       $forceCurrency
     * @param \Money\Currencies $currencies
     *
     * @return \Spinzar\Money\Money
     */
    function money_parse_by_decimal($money, $forceCurrency = null, Money\Currencies $currencies = null)
    {
        return Spinzar\Money\Money::parseByDecimal($money, $forceCurrency, $currencies);
    }
}

if (!function_exists('money_parse_by_intl')) {
    /**
     * money parse by intl.
     *
     * @param string            $money
     * @param string|null       $forceCurrency
     * @param string|null       $locale
     * @param \Money\Currencies $currencies
     *
     * @return \Spinzar\Money\Money
     */
    function money_parse_by_intl($money, $forceCurrency = null, $locale = null, Money\Currencies $currencies = null)
    {
        return Spinzar\Money\Money::parseByIntl($money, $forceCurrency, $locale, $currencies);
    }
}

if (!function_exists('money_parse_by_intl_localized_decimal')) {
    /**
     * money parse by intl localized decimal.
     *
     * @param string            $money
     * @param string            $forceCurrency
     * @param string|null       $locale
     * @param \Money\Currencies $currencies
     *
     * @return \Spinzar\Money\Money
     */
    function money_parse_by_intl_localized_decimal(
        $money,
        $forceCurrency,
        $locale = null,
        Money\Currencies $currencies = null
    ) {
        return Spinzar\Money\Money::parseByIntlLocalizedDecimal($money, $forceCurrency, $locale, $currencies);
    }
}
