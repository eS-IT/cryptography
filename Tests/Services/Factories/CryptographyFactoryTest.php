<?php

/**
 * @since       10.07.2025 - 09:55
 *
 * @author      Patrick Froch <info@netgroup.de>
 *
 * @see         http://www.netgroup.de
 *
 * @copyright   NetGroup GmbH 2025
 */

declare(strict_types=1);

namespace Esit\Cryptography\Tests\Services\Factories;

use Esit\Cryptography\Classes\Services\Factories\CryptographyFactory;
use PHPUnit\Framework\TestCase;

class CryptographyFactoryTest extends TestCase
{


    public function testCreateCryptographyHelperReturnsHelperWithConstructorSettings(): void
    {
        $factory = new CryptographyFactory('pwassword', 'aes-256-cbc');
        $this->assertNotNull($factory->createCryptographyHelper());
    }


    public function testCreateCryptographyHelperReturnsHelperWithoutConstructorSettings(): void
    {
        $factory = new CryptographyFactory();
        $this->assertNotNull($factory->createCryptographyHelper('pwassword', 'aes-256-cbc'));
    }
}
