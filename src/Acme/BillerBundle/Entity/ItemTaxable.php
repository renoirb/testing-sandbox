<?php

namespace Acme\BillerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Taxable Item
 *
 * @ORM\Entity
 */
class ItemTaxable
    extends Item
{
    const CURRENT_RATE = 0.10;
}
