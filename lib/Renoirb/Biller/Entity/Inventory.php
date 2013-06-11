<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Entity;

// Entities
use Renoirb\Biller\Entity\InventoryItem;

// Contracts
use Renoirb\Biller\InventoryInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * An inventory of items
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class Inventory
    implements InventoryInterface
{
    /**
     * @var ArrayCollection<InventoryItemInterface>
     */
    protected $items;

    public function __construct() {
        $this->items = new ArrayCollection();

        return $this;
    }


    /**
     * {@inheritDoc}
     *
     * Satisfying InventoryInterface
     */
    public function setItemList(ArrayCollection $list)
    {
        $this->items = $list;
    
        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying InventoryInterface
     */
    public function getItemList()
    {
        return $this->items;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying InventoryInterface
     */
    public function addItem(InventoryItemInterface $item)
    {
        $this->items->add($item);

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying InventoryInterface
     */
    public function removeItem(InventoryItemInterface $item)
    {
        $this->items->removeElement($item);

        return $this;
    }
}