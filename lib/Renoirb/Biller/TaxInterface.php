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
 * Each Tax has a rate, and some of them are compounded on an other
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