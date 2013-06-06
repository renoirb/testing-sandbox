<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller;

// Contracts
use Doctrine\Common\Collections\ArrayCollection;
use Renoirb\Biller\TaxInterface;

/**
 * An inventory item
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
interface InventoryItemInterface
{
    /**
     * Set Applicable Tax
     *
     * @return InventoryItemInterface
     */
    public function setTaxList(ArrayCollection $taxes);

    /**
     * List all applicable taxes on a given item
     * 
     * @return ArrayCollection<TaxInterface>
     */
    public function getTaxList();

    /**
     * Add an applicable Tax
     *
     * @return InventoryItemInterface
     */
    public function addTax(TaxInterface $tax);

    /**
     * Remove an applicable Tax
     *
     * @return InventoryItemInterface
     */
    public function removeTax(TaxInterface $tax);

    /**
     * Get inventory description
     * 
     * @return string
     */
    public function getName();

    /**
     * Set item Name
     *
     * @return InventoryItemInterface
     */
    public function setName($name);

    /**
     * Get inventory description
     * 
     * @return string
     */
    public function getDescription();

    /**
     * Set item Description
     *
     * @return InventoryItemInterface
     */
    public function setDescription($description);

    /**
     * Get inventory cost of a given item
     * 
     * @return float cost amount
     */
    public function getCost();

    /**
     * Set item Cost
     *
     * @return InventoryItemInterface
     */
    public function setCost($cost);
}