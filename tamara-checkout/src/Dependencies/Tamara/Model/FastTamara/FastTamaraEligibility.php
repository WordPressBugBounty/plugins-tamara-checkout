<?php

declare(strict_types=1);

namespace Tamara\Wp\Plugin\Dependencies\Tamara\Model\FastTamara;

class FastTamaraEligibility
{
    public const ORDER = 'order',
        CUSTOMER = 'customer',
        AMOUNT = 'amount',
        CURRENCY = 'currency',
        PHONE_NUMBER = 'phone_number',
        EMAIL = 'email';

    private $amount;
    private $currency;
    private $phoneNumber;
    private $email;

    public function setAmount(float $amount): FastTamaraEligibility
    {
        $this->amount = $amount;

        return $this;
    }

    public function setCurrency(string $currency): FastTamaraEligibility
    {
        $this->currency = $currency;

        return $this;
    }

    public function setPhoneNumber(string $phoneNumber): FastTamaraEligibility
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function setEmail(string $email): FastTamaraEligibility
    {
        $this->email = $email;

        return $this;
    }

    public function toArray(): array
    {
        return [
            self::ORDER => [
                self::AMOUNT => $this->amount,
                self::CURRENCY => $this->currency,
            ],
            self::CUSTOMER => [
                self::PHONE_NUMBER => $this->phoneNumber,
                self::EMAIL => $this->email,
            ],
        ];
    }
}
