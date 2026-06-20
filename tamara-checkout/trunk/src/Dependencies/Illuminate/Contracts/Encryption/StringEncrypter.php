<?php

namespace Tamara\Wp\Plugin\Dependencies\Illuminate\Contracts\Encryption;

interface StringEncrypter
{
    /**
     * Encrypt a string without serialization.
     *
     * @param  string  $value
     * @return string
     *
     * @throws \Tamara\Wp\Plugin\Dependencies\Illuminate\Contracts\Encryption\EncryptException
     */
    public function encryptString($value);

    /**
     * Decrypt the given string without unserialization.
     *
     * @param  string  $payload
     * @return string
     *
     * @throws \Tamara\Wp\Plugin\Dependencies\Illuminate\Contracts\Encryption\DecryptException
     */
    public function decryptString($payload);
}
