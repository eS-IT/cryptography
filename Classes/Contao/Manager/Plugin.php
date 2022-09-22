<?php

/**
 * @package     cryptography
 * @filesource  Plugin.php
 * @version     1.0.0
 * @since       19.09.2022 - 20:09
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2022
 * @license     EULA
 */

declare(strict_types=1);

namespace Esit\Cryptography\Classes\Contao\Manager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{


    /**
     * @param ParserInterface $parser
     * @return array|\Contao\ManagerPlugin\Bundle\Config\ConfigInterface[]
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(\Esit\Cryptography\EsitCryptographyBundle::class)
                        ->setLoadAfter([\Contao\CoreBundle\ContaoCoreBundle::class])
        ];
    }
}
