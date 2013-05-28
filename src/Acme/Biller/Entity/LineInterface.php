<?php

/**
 * This file is part of Acme Biller
 *
 * @package AcmeBiller
 */

namespace Acme\Biller\Entity;

/**
 * A line is part of a Bill
 *
 * A line represent an InventoryItemInterface
 * that is applied to one BillInterface
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
interface LineInterface 
{
    /**
     * Set cost
     *
     * @param float $cost
     * 
     * @return ItemInterface
     */
    public function setCost($cost);

    /**
     * Get cost
     *
     * @return float 
     */
    public function getCost();

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription();


    /**
     * Flag item as taxable
     *
     * @param boolean $bool If taxable or not, default: false
     * 
     * @return ItemInterface
     */
    public function setTaxable($bool);

    /**
     * Read item flag if it is taxable
     *
     * @return boolean
     */
    public function isTaxable();

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