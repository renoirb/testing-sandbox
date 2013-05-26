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
}