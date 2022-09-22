<?php

/**
 * @package     Cryptography
 * @since       22.09.2022 - 13:37
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2022
 * @license     EULA
 */

declare(strict_types=1);

namespace Esit\Cryptography\Classes\Services\Helper;

use Esit\Cryptography\Classes\Exceptions\InvalidArgumentException;

class CryptographyHelper
{

    /**
     * Passwort für die Verschlüsselung.
     * @var string
     */
    private string $secret;


    /**
     * Verschlüselungsmethode
     * @var string
     */
    private string $cipher;


    /**
     * @param string $secret
     * @param string $cipher
     */
    public function __construct(string $secret, string $cipher)
    {
        if ('' === $secret) {
            throw new InvalidArgumentException('secret could not be empty');
        }

        if ('' === $cipher) {
            throw new InvalidArgumentException('cipher could not be empty');
        }

        $this->secret   = $secret;
        $this->cipher   = $cipher;
    }


    /**
     * Gibt den aus dem Passwort erzeugten Schlüssel zurück.
     * @param  string $secret
     * @return string
     */
    private function getKey(string $secret): string
    {
        $secret = $secret ?: $this->secret;

        return \hash('SHA256', $secret, false);
    }


    /**
     * Gibt den Initialisierungsvektor zurück.
     * @throws \Exception
     * @return string
     */
    private function getIv(): string
    {
        return \random_bytes(\openssl_cipher_iv_length($this->cipher)) ?: '';
    }


    /**
     * Verschlüsselt einen String.
     * @param string $data
     * @param string $secret
     * @return string
     * @throws \Exception
     */
    public function encrypt(string $data, string $secret = ''): string
    {
        $key        = $this->getKey($secret);
        $iv         = $this->getIv();
        $ciphertext = \openssl_encrypt($data, $this->cipher, $key, \OPENSSL_RAW_DATA, $iv);

        return \base64_encode($ciphertext) . ':' . \base64_encode($iv);
    }


    /**
     * Entschlüsselt einen String.
     * @param string $data
     * @param string $secret
     * @return string
     */
    public function decrypt(string $data, string $secret = ''): string
    {
        $key       = $this->getKey($secret);
        $dataarray = \explode(':', $data);
        $encrypted = \base64_decode($dataarray[0], true);
        $iv        = \base64_decode($dataarray[1], true);

        if (false !== $encrypted && false !== $iv) {
            return (string)\openssl_decrypt($encrypted, $this->cipher, $key, \OPENSSL_RAW_DATA, $iv);
        }
    }
}
