<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller;

/**
 * A line is part of a Bill
 *
 * A line represent an InventoryItemInterface
 * that is applied to one BillInterface
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
interface BillLineInterface 
{
    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription();

    /**
     * Set the sale price
     * 
     * @return array of tax
     */
    public function setSalePrice($price);

    /**
     * Return the sale price
     * 
     * @return array of tax
     */
    public function getSalePrice();
}