<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Entity;

// Contracts
use Renoirb\Biller\LineInterface;
use Renoirb\Biller\InventoryItemInterface;

/**
 * Bill Line
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class Line
    implements LineInterface
{

    /** 
     * @var float
     */
    protected $sale_price = 0;

    /**
     * @var string
     */
    protected $description = NULL;

    public function __construct(InventoryItemInterface $item = NULL)
    {
        if($item !== NULL){
            $this->setDescription($item->getDescription());            
        }

        return $this;
    }

    /**
     * Set the description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying LineInterface
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * {@inheritDoc}
     *
     * Satisfying LineInterface
     */
    public function setSalePrice($price)
    {
        $this->sale_price = $price;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying LineInterface
     */
    public function getSalePrice()
    {
        return $this->sale_price;
    }
}