<?php

declare (strict_types=1);

namespace Tamara\Wp\Plugin\Dependencies\Tamara\Model;

class Merchant
{
    public const SINGLE_CHECKOUT_ENABLED = 'single_checkout_enabled',
        PUBLIC_KEY = 'public_key';

    private $singleCheckoutEnabled;
    private $publicKey;

    public static function fromArray(array $data): Merchant
    {
        $self = new self();
        $self->setSingleCheckoutEnabled(isset($data[self::SINGLE_CHECKOUT_ENABLED]) ? (bool) $data[self::SINGLE_CHECKOUT_ENABLED] : false);
        $self->setPublicKey(isset($data[self::PUBLIC_KEY]) ? (string) $data[self::PUBLIC_KEY] : '');

        return $self;
    }

    public function getSingleCheckoutEnabled()
    {
        return $this->singleCheckoutEnabled;
    }

    public function getPublicKey()
    {
        return $this->publicKey;
    }

    public function setSingleCheckoutEnabled(bool $singleCheckoutEnabled)
    {
        $this->singleCheckoutEnabled = $singleCheckoutEnabled;
    }

    public function setPublicKey(string $publicKey)
    {
        $this->publicKey = $publicKey;
    }
}
