<?php

namespace Acme\BillerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// Contracts
use Acme\Biller\Entity\ItemInterface;

/**
 * Item
 * 
 * @ORM\Entity
 */
class Item
    extends AbstractItem
    implements ItemInterface
{
}