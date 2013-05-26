<?php

namespace Acme\BillerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Imported Item
 * 
 * @ORM\Entity
 */
class ItemImported
    extends ItemTaxable
{
    const IMPORT_RATE = 0.05;
}
