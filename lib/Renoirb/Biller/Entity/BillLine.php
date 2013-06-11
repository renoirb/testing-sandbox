<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Entity;

// Contracts
use Renoirb\Biller\BillLineInterface;
use Renoirb\Biller\InventoryItemInterface;

/**
 * Bill Line
 *
 * A Bill line base entity.
 *
 * To use in a Bundle, you can extend this class and replicate
 * the properties with proper Doctrine2 annotations.
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class BillLine
    implements BillLineInterface
{

    /** 
     * @var float
     */
    protected $sale_price = 0;

    /**
     * @var string
     */
    protected $description = NULL;

    /**
     * Quantity
     * 
     * @var integer
     */
    protected $qty;

    public function __construct(InventoryItemInterface $item = NULL)
    {
        if($item !== NULL){
            $this->setDescription($item->getDescription());            
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function getQuantity()
    {
        return $this->qty;
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function setQuantity($qty)
    {
        $this->qty = $qty;

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
     * Satisfying BillLineInterface
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * {@inheritDoc}
     *
     * Satisfying BillLineInterface
     */
    public function setSalePrice($price)
    {
        $this->sale_price = $price;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillLineInterface
     */
    public function getSalePrice()
    {
        return $this->sale_price;
    }
}