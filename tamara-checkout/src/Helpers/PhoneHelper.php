<?php

namespace Tamara\Wp\Plugin\Helpers;

class PhoneHelper
{
    /**
     * Known Tamara market dialing codes (digits only, no leading zeros).
     *
     * @return string[]
     */
    public static function getKnownDialCodes()
    {
        return ['966', '971', '965', '973'];
    }

    /**
     * Countries qualified to show Tamara on checkout (KSA and UAE).
     *
     * @return string[]
     */
    public static function getQualifiedCountryCodes()
    {
        return ['SA', 'AE'];
    }

    /**
     * Whether the billing/checkout country qualifies for Tamara (KSA or UAE).
     *
     * @param string $countryCode ISO 3166-1 alpha-2 country code
     *
     * @return bool
     */
    public static function isQualifiedCountry($countryCode)
    {
        return in_array(strtoupper((string) $countryCode), self::getQualifiedCountryCodes(), true);
    }

    /**
     * Resolve dialing code digits for a WooCommerce country code (e.g. SA -> 966).
     *
     * @param string $countryCode ISO 3166-1 alpha-2 country code
     *
     * @return string
     */
    public static function getDialCodeDigits($countryCode)
    {
        $countryCode = strtoupper((string) $countryCode);
        if ('' === $countryCode) {
            return '';
        }

        $callingCode = '';
        if (function_exists('WC') && WC()->countries) {
            $callingCode = (string) WC()->countries->get_country_calling_code($countryCode);
        }

        if ('' === $callingCode) {
            $fallback = [
                'SA' => '966',
                'AE' => '971',
                'KW' => '965',
                'BH' => '973',
            ];
            $callingCode = $fallback[$countryCode] ?? '';
        }

        if ('' === $callingCode) {
            return '';
        }

        // Strip non-digits, then leading zeros (e.g. +966 / 00966 -> 966).
        return ltrim(preg_replace('/\D+/', '', $callingCode), '0');
    }

    /**
     * Format phone for Tamara pre-checkout API as:
     * <country_code_without_plus_or_zeros_prefixed><phone_number_without_zero_prefix>
     *
     * If the customer phone already includes a country calling code, that dial code is kept
     * and any national trunk zero after it is stripped. Otherwise the dialing code is taken
     * from the billing country.
     *
     * @param string $phone
     * @param string $billingCountryCode ISO country code from checkout billing address
     *
     * @return string
     */
    public static function formatForPreCheckout($phone, $billingCountryCode = '')
    {
        if ('' === trim((string) $phone)) {
            return '';
        }

        $digits = preg_replace('/\D+/', '', (string) $phone);
        if ('' === $digits) {
            return '';
        }

        // International prefix 00...
        if (0 === strpos($digits, '00')) {
            $digits = substr($digits, 2);
        }

        $billingDialCode = self::getDialCodeDigits($billingCountryCode);

        // Phone already starts with billing country dial code.
        if ('' !== $billingDialCode && 0 === strpos($digits, $billingDialCode)) {
            return self::combineDialCodeAndNationalNumber($billingDialCode, $digits);
        }

        // Phone already starts with a known Tamara market dial code (longest match first).
        $knownDialCodes = self::getKnownDialCodes();
        usort($knownDialCodes, function ($a, $b) {
            return strlen($b) - strlen($a);
        });
        foreach ($knownDialCodes as $knownDialCode) {
            if (0 === strpos($digits, $knownDialCode)) {
                return self::combineDialCodeAndNationalNumber($knownDialCode, $digits);
            }
        }

        // No country code in input — prepend dial code from billing country.
        $nationalNumber = ltrim($digits, '0');
        if ('' === $nationalNumber) {
            return '';
        }

        if ('' !== $billingDialCode) {
            return $billingDialCode.$nationalNumber;
        }

        return $nationalNumber;
    }

    /**
     * Keep dial code and strip a national trunk zero from the remainder.
     *
     * @param string $dialCode
     * @param string $digits Full digit string that starts with $dialCode
     *
     * @return string
     */
    protected static function combineDialCodeAndNationalNumber($dialCode, $digits)
    {
        $nationalNumber = ltrim(substr($digits, strlen($dialCode)), '0');
        if ('' === $nationalNumber) {
            return '';
        }

        return $dialCode.$nationalNumber;
    }
}
