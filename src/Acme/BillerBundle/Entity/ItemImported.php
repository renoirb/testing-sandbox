<?php

namespace Acme\BillerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// Contracts
use Acme\Biller\Entity\ItemInterface;

/**
 * Imported Item
 * 
 * @ORM\Entity
 */
class ItemImported
    extends AbstractItem
    implements ItemInterface
{
    const IMPORT_TAX_RATE = 0.05;

    /**
     * {@inheritDoc}
     *
     * Satisfying ItemInterface
     */
    public function getTaxRates()
    {
        $rates = parent::getTaxRates();

        $rates['import'] = static::IMPORT_TAX_RATE;

        return $rates;
    }
}
