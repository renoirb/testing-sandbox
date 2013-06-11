<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller;

// Contracts
use Doctrine\Common\Collections\ArrayCollection;
use Renoirb\Biller\InventoryItemInterface;

/**
 * An inventory is a list of all available items
 *
 * Only handling adding or removing items from them
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
interface InventoryInterface
{
    /**
     * Set inventory item list
     *
     * @param ArrayCollection $list
     * 
     * @return InventoryInterface
     */
    public function setItemList(ArrayCollection $list);

    /**
     * Get inventory items on that particular inventory
     * 
     * A inventory item is an item on a Inventory
     *
     * @return ArrayCollection<InventoryItemInterface>
     */
    public function getItemList();

    /**
     * Add an inventory item in the current inventory
     *
     * @return InventoryInterface
     */
    public function addItem(InventoryItemInterface $item);

    /**
     * Remove an inventory item in the current inventory
     *
     * @return InventoryInterface
     */
    public function removeItem(InventoryItemInterface $item);
}