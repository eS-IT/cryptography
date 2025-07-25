<?php

/**
 * @since       10.07.2025 - 09:25
 *
 * @author      Patrick Froch <info@netgroup.de>
 *
 * @see         http://www.netgroup.de
 *
 * @copyright   NetGroup GmbH 2025
 */

declare(strict_types=1);

namespace Esit\Cryptography\Classes\Services\Factories;

use Esit\Cryptography\Classes\Services\Helper\CryptographyHelper;

class CryptographyFactory
{
    /**
     * @var string
     */
    private string $secret;


    /**
     * @var string
     */
    private string $cipher;


    /**
     * @param string|null $secret
     * @param string|null $cipher
     */
    public function __construct(?string $secret = '', ?string $cipher = 'aes-256-cbc')
    {
        $this->secret = $secret ?: '';
        $this->cipher = $cipher ?: 'aes-256-cbc';
    }


    /**
     * Erstellt einen CryptographyHelper.
     *
     * @param string $secret
     * @param string $cipher
     *
     * @return CryptographyHelper
     */
    public function createCryptographyHelper(string $secret = '', string $cipher = ''): CryptographyHelper
    {
        $secret = $secret ?: $this->secret;
        $cipher = $cipher ?: $this->cipher;

        return new CryptographyHelper($secret, $cipher);
    }
}
