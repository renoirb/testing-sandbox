<?php

namespace Acme\Biller\Entity;

interface ItemInterface 
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
     * Set description
     *
     * @param string $description
     * 
     * @return ItemInterface
     */
    public function setDescription($description);

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
     * Return list of tax rates
     * 
     * @return array of tax
     */
    public function getTaxRates();
}