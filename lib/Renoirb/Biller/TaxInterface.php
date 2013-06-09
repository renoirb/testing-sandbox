<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller;

/**
 * Tax
 *
 * Each Tax has a rate, and some of them are compounded
 *
 * Unless the tax is declared as compound, the calculation of
 * the sale price of a Line is based on the cost of it's 
 * originating InventoryItem times the rate of the tax.
 *
 * When declared as compounded the calculation would be to 
 * take into account the Line's current sale price times 
 * the rate
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
interface TaxInterface
{
    /**
     * Tax rate
     *
     * Integer number, representing a % rate
     * 
     * @return integer
     */
    public function getRate();

    /**
     * Name of the tax
     *
     * e.g. In Canada, services tax is called "TPS"
     * 
     * @return string
     */
    public function getName();

    /**
     * Whether the tax is calculated on top of others
     * 
     * @return boolean
     */
    public function isCompound();
}